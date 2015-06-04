<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 02:21
 */

namespace Poller\Core\View;


class ErrorView extends View {

    protected $error;

    public function __construct($error) {
        parent::__construct('error/'.$error);
        $this->error = $error;
    }

    public function render() {
        $header = new Template('header');
        $footer = new Template('footer');

        echo $header->addData('title', $this->error)->render();
        echo parent::render();
        echo $footer->render();
    }
}