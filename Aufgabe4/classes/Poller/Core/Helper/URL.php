<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 22:09
 */

namespace Poller\Core\Helper;


class URL {

    public static function getScriptURL($script) {
        return self::combine(self::getAbsoluteUrl(), array('public_html', 'scripts', $script));
    }

    public static function getCssURL($script) {
        return self::combine(self::getAbsoluteUrl(), array('public_html', 'styles', $script));
    }

    public static function getImageURL($image) {
        return self::combine(self::getAbsoluteUrl(), array('public_html', 'images', $image));
    }

    public static function getControllerURL($controller, $action = 'index', $param = '') {
        if (is_array($param)) {
            $param = implode('/', $param);
        }

        return self::combine(self::getAbsoluteUrl(), array($controller, $action, $param));
    }

    public static function getPublicURL($url = null) {
        return self::combine(self::getAbsoluteUrl(), array('public_html', $url));
    }

    public static function combine($base, array $urls) {

        $base_len = strlen($base) - 1;
        if (strpos($base, '/') === $base_len) {
            $base = substr($base,0, $base_len);
        }

        $urls = array_map(function($url) {
            if (strpos($url, '/') === 0) {
                $url = substr($url, 1);
            }
            return $url;
        }, $urls);

        return $base.'/'.implode('/', $urls);
    }

    public static function getAbsoluteUrl() {
        $scheme = 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://';
        return $scheme.$_SERVER['SERVER_NAME'].APP_BASE_URL;
    }
}

