<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 06.07.15
 * Time: 18:29
 */

namespace Splendr\Core\Helper;


class Request {
    public static function isGet() {
        return 'GET' == self::getRequestMethod();
    }

    public static function isPOST() {
        return 'POST' == self::getRequestMethod();
    }

    private static function getRequestMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }
}