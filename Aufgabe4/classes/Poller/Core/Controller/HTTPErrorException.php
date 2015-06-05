<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 13:38
 */

namespace Poller\Core\Controller;

use Exception;

class HTTPErrorException extends  Exception {
    public function __construct($httpErrorCode = 404, Exception $previous = null) {
        $message = "The requested resource was not found.";
        parent::__construct($message, $httpErrorCode, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}