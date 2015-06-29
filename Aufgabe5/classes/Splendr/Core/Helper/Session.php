<?php

namespace Splendr\Core\Helper;

/**
 * Class Session
 * @package classes\Poller\Core\Helper
 */
class Session {

    protected static $sessionNotYetCreated = true;

    /**
     * Retrieve the value of a session parameter.
     *
     * @param string $param the name of the session parameter.
     * @param mixed $defaultValue will be returned if the request session parameter don't exists.
     * @return mixed the value of the session parameter or the default value if the session parameter don't exists.
     */
    public static function get($param, $defaultValue=null) {
        self::ensureSessionIsCreated();
        if (! isset($_SESSION[$param])) {
            return $defaultValue;
        }
        return $_SESSION[$param];
    }

    /**
     * Set the value for a session parameter.
     *
     * @param string $param the name of the session parameter.
     * @param mixed $value the value of the session parameter.
     */
    public static function set($param, $value) {
        self::ensureSessionIsCreated();
        $_SESSION[$param] = $value;
    }

    /**
     * Checks if the session has a specific parameter.
     * @param string $param
     * @return bool true if the session has the parameter or else if not.
     */
    public static function has($param) {
        self::ensureSessionIsCreated();
        return isset($_SESSION[$param]);
    }

    /**
     * Clear or remove a param from the session.
     *
     * @param string $param the parameter which should be removed.
     */
    public static function clear($param) {
        self::ensureSessionIsCreated();
        unset($_SESSION[$param]);
    }

    /**
     * Create Session and initialize session.
     *
     */
    public static function ensureSessionIsCreated() {
        if ( self::$sessionNotYetCreated ) {
            session_start();
            self::$sessionNotYetCreated = false;
        }
    }

    /**
     * Destroy the session.
     *
     */
    public static function destroy() {
        if (! self::$sessionNotYetCreated ) {
            session_unset();
            session_destroy();
            self::$sessionNotYetCreated = true;
        }
    }

}