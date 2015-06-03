<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 02:06
 */

namespace Poller;

require_once(APP_ROOT.'/config/db.php');

class DBHelper {

    private static $instance;

    public static function get() {
        if( ! isset(self::$instance) ) {
            self::$instance = new DBHelper();
        }
        return self::$instance;
    }

    protected $connection;

    public function __construct() {
        $db_type = DB_TYPE;
        $db_host = DB_HOST;
        $db_name = DB_NAME;
        $db_user = DB_USER;
        $db_pass = DB_PASSWORD;
        $db_encoding = DB_ENCODING;

        try {
            $this->connection = new \PDO("$db_type:host=$db_host;dbname=$db_name;charset=$db_encoding", $db_user, $db_pass);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function __destruct() {
        $this->connection = null;
    }

    public function getPDOConnection() {
        return $this->connection;
    }


}