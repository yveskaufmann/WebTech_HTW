<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 17:21
 */

namespace Poller\Core\Controller;

use Poller\Core\Helper\URL;
use ReflectionClass;
use InvalidArgumentException;
use Poller\Core\View\ErrorView;


class FrontController implements IFrontController {

    const DEFAULT_CONTROLLER = 'Poll';
    const DEFAULT_ACTION = 'index';

    const OPTION_CONTROLLER = 'controller';
    const OPTION_ACTION = 'action';
    const OPTIONS_PARAMS = 'params';

    protected $controller = '';
    protected $action = '';
    protected $params = array();
    protected $aborted = false;

    protected static $instance = null;

    public static function get() {
        if (is_null(self::$instance)) {
            self::$instance = new FrontController();
        }
        return self::$instance;
    }

    public function  __construct(array $options = array()) {
        if (empty($options)) {
            $this->handleRequest();
        } else {
            $this->configureByOptions($options);
        }
    }

    protected function handleRequest() {
        $request_URL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->configureByRequestUri($request_URL);
    }

    /**
     * Configure the auto dispatcher.
     *
     * @param array $options
     */
    public function configureByOptions(array $options) {

        if (! isset($options[self::OPTION_CONTROLLER]) || strlen($options[self::OPTION_CONTROLLER]) <= 0 ) {
            $options[self::OPTION_CONTROLLER] = self::DEFAULT_CONTROLLER;
        }

        if (! isset($options[self::OPTION_ACTION]) || strlen($options[self::OPTION_ACTION]) <= 0) {
            $options[self::OPTION_ACTION] = self::DEFAULT_ACTION;
        }

        if (! isset($options[self::OPTION_ACTION])) {
            $options[self::OPTION_ACTION] = array();
        }
        try {
            $this->setController($options[self::OPTION_CONTROLLER]);
            $this->setAction($options[self::OPTION_ACTION]);
            $this->setParams($options[self::OPTIONS_PARAMS]);
        } catch(InvalidArgumentException $ex) {
            $this->aborted = true;
            $error = new ErrorView('404');
            $error
                ->addData('error', 'Requested resource not found.')
                ->render();
        }
    }

    /**
     * @param $request_URL
     */
    protected function configureByRequestUri($request_URL) {
        $request_URL = trim($request_URL, '/');
        $basename = basename(APP_ROOT);

        if (strpos($request_URL, $basename) === 0) {
            $request_URL = substr($request_URL, strlen($basename));
        }
        $request_URL = preg_replace('/^\//', '', $request_URL);

        $options = explode('/', $request_URL, 3);
        $this->configureByOptions(array(
            self::OPTION_CONTROLLER => isset($options[0]) ? $options[0] : null,
            self::OPTION_ACTION => isset($options[1]) ? $options[1] : null,
            self::OPTIONS_PARAMS => isset($options[2]) ? explode('/', $options[2]) : array(),
        ));
    }

    public function runController($controller, $action = self::DEFAULT_ACTION, $params = array(), $redirect=true) {
        $url = URL::getControllerURL($controller, $action, $params);
        if ($redirect) {
            header('location: '.$url);
            exit;
        }
        $this->configureByRequestUri($url);
        $this->run();
    }

    public function run() {
        if($this->aborted) return;
        $reflection = new ReflectionClass($this->controller);
        $controller = $reflection->newInstance();
        $method = $reflection->getMethod($this->action);

        try {
            return $method->invoke($controller, $this->params);
        } catch(HTTPErrorException $ex) {
            ErrorView::createFrom($ex)->render();
        }
    }

    public function setController($controller) {

        if  (strcasecmp($controller,'front') == 0) {
           $controller = '';
        }

        if (empty($controller)) {
            $controller = self::DEFAULT_ACTION;
        }

        $controllerClass = '\Poller\App\Controller\\'.ucfirst(strtolower($controller)).'Controller';

        if (! class_exists($controllerClass)) {
            throw new InvalidArgumentException(
                'There is no controller called "'.$controller.'".'
            );
        }
        $this->controller = $controllerClass;
    }

    public function setAction($action) {
        $reflection = new ReflectionClass($this->controller);
        if (! $reflection->hasMethod($action) || !$reflection->getMethod($action)->isPublic()) {
            throw new InvalidArgumentException(
                'The controller action '.$action.' has been not defined.');
        }
        $this->action = $action;
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
}

