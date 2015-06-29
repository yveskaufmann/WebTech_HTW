<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 17:21
 */

namespace Splendr\Core\Controller;


interface IFrontController {

    public function setController($controller);
    public function setAction($action);
    public function setParams(array $params);
    public function run();

}