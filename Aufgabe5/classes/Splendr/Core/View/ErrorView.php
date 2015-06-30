<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 02:21
 */

namespace Splendr\Core\View;

use Splendr\Core\Controller\HTTPErrorException;

class ErrorView extends PageView {

    /**
     * Create a error view from a HTTPErrorException.
     *
     * @param HTTPErrorException $ex
     * @return ErrorView
     */
    public static function createFrom(HTTPErrorException $ex) {
        $view = new ErrorView($ex->getCode());
        $view->addData('error', $ex->getMessage());
        return $view;
    }

    /**
     * @param string $error
     */
    public function __construct($error) {
        parent::__construct('error/'.$error, 'HTTP: '.$error);
        $this->addData('navIsEnabled', false);
    }
}