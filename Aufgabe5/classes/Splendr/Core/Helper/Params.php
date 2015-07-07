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
     * Return the integer value if it's in the proper format otherwise $defaultValue.
     *
     * @param $name
     * @param null $defaultValue
     * @param null $options
     * @return string
     */
    public static function getGET_INT($name, $defaultValue=null, $options=null) {
        $number =  self::get($name, $defaultValue, FILTER_SANITIZE_NUMBER_INT, $options);
        return is_numeric($number) ? $number : $defaultValue;
    }

    /**
     * Return the GET param with the name '$name'.
     *
     * @param string $name
     * @param mixed $defaultValue
     * @param null $filter
     * @param null $options
     * @return string
     */
    public static function getGET($name, $defaultValue=null, $filter=null, $options=null) {
        return self::get($name, $defaultValue, $_GET, $filter, $options);
    }

    /**
     * Return the POST param with the name '$name'.
     *
     * @param string $name
     * @param mixed $defaultValue
     * @param $filter
     * @param null $options
     * @return string
     */
    public static function getPost($name, $defaultValue=null, $filter=null, $options=null) {
        return self::get($name, $defaultValue, $_POST, $filter, $options);
    }

    /**
     * Return the REQUEST param with the name '$name'.
     *
     * @param string $name
     * @param mixed $defaultValue
     * @param array $scope
     * @param int $filter
     * @return string
     */
    public static function get($name, $defaultValue=null, $scope=null, $filter=FILTER_SANITIZE_FULL_SPECIAL_CHARS, $options=null) {

        if (is_null($scope)) {
            $scope = $_REQUEST;
        }

        if (isset($scope[$name])) {
            $value = $scope[$name];
            if (! is_null($filter)) {
                $value = filter_var($value, $filter, $options);
            }
            return $value;
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