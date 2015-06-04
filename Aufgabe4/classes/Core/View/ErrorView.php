<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 02:21
 */

namespace Poller\Core\View;

class ErrorView extends PageView {

    protected $error;

    public function __construct($error) {
        parent::__construct('error/'.$error, 'Error '.$error);
        $this->error = $error;
    }
}