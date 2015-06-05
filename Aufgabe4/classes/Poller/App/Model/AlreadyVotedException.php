<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 13:38
 */

namespace Poller\App\Model;
use Exception;

class AlreadyVotedException extends  Exception {
    public function __construct($code = 0, Exception $previous = null) {
        $message = "The user has already voted for this poll";
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}