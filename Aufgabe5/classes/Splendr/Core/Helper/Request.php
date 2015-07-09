<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 06.07.15
 * Time: 18:29
 */

namespace Splendr\Core\Helper;


class Request {
    const HTTP_REFERER_SERVER_PARAM = 'HTTP_REFERER';

    public static function isGet() {
        return 'GET' == self::getRequestMethod();
    }

    public static function isPOST() {
        return 'POST' == self::getRequestMethod();
    }

    private static function getRequestMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function redirectToHTTP_REFERER($fallbackURL=null) {

        if ( is_null($fallbackURL)) {
            $fallbackURL = URL::getAbsoluteUrl();
        }

        if (isset($_SERVER[self::HTTP_REFERER_SERVER_PARAM])) {
            $url = $_SERVER[self::HTTP_REFERER_SERVER_PARAM];
            $url = filter_var($url, FILTER_VALIDATE_URL);
        }

        if ( !isset($url) || !$url) {
            $url = $fallbackURL;
        }

        self::redirectTo($url, 302);
    }

    /**
     * Redirect the Request to a another URL.
     *
     * @param $url
     * @param int $statusCode
     */
    public static function redirectTo($url, $statusCode=302) {
        header('Location: '.$url, true, $statusCode);
        exit();
    }


}