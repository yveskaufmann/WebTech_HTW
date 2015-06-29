<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 11:05
 */
namespace Splendr\Core\View;

interface IView {
    public function render();

    public function addHeader($name, $value);

    public function getHeaders($name, $default_value = null);

    public function addData($name, $value);

    public function getData($name, $default_value = null);

    public function clearData();
}