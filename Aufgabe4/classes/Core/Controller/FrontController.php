<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 17:21
 */

namespace Poller\Core\Controller;

use ReflectionClass;

class FrontController implements IFrontController {

    const DEFAULT_CONTROLLER = 'Poll';
    const DEFAULT_ACTION = 'index';

    const OPTION_CONTROLLER = 'controller';
    const OPTION_ACTION = 'action';
    const OPTIONS_PARAMS = 'params';

    private $controller = '';
    private $action = '';
    private $params = array();

    public function  __construct(array $options = array()) {
        if (empty($options)) {
            $this->handleRequest();
        } else {
            $this->configureByOptions($options);
        }
    }

    protected function handleRequest() {
        $request_URL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $request_URL = trim($request_URL, '/');
        $basename = basename(APP_ROOT);

        if (strpos($request_URL, $basename) === 0 ) {
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

    public function run() {
        $reflection = new ReflectionClass($this->controller);
        $controller = $reflection->newInstance();
        $method = $reflection->getMethod($this->action);
        return $method->invoke($controller, $this->params);
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
            throw new \InvalidArgumentException(
                'There is no controller called "'.$controller.'".'
            );
        }
        $this->controller = $controllerClass;
    }

    public function setAction($action) {
        $reflection = new ReflectionClass($this->controller);
        if (! $reflection->hasMethod($action)) {
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

        $this->setController($options[self::OPTION_CONTROLLER]);
        $this->setAction($options[self::OPTION_ACTION]);
        $this->setParams($options[self::OPTIONS_PARAMS]);
    }
}

