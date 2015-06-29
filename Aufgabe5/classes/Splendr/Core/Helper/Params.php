<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 15:30
 */

namespace Splendr\Core\Helper;


class Params {

    /**
     * Return the GET param with the name '$name'.
     *
     * @param string $name
     * @param mixed $defaultValue
     * @return string
     */
    public static function getGET($name, $defaultValue=null) {
        return self::get($name, $defaultValue, $_GET);
    }

    /**
     * Return the POST param with the name '$name'.
     *
     * @param string $name
     * @param mixed $defaultValue
     * @return string
     */
    public static function getPost($name, $defaultValue=null) {
        return self::get($name, $defaultValue, $_POST);
    }

    /**
     * Return the REQUEST param with the name '$name'.
     *
     * @param string $name
     * @param mixed $defaultValue
     * @param array $scope
     * @return string
     */
    public static function get($name, $defaultValue=null, $scope=null) {

        if (is_null($scope)) {
            $scope = $_REQUEST;
        }

        if (isset($scope[$name])) {
            $value = $scope[$name];
            return filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        return $defaultValue;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function hasGET($name) {
        return self::has($name, $_GET);
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function hasPOST($name) {
        return self::has($name, $_POST);
    }

    /**
     * @param string $name
     * @param array $scope
     * @return bool
     */
    public static function has($name, $scope=null) {
        return self::get($name, null, $scope) !== null;
    }


}