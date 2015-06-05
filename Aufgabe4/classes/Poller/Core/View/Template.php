<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 00:10
 */

namespace Poller\Core\View;

class Template extends View {

    protected function getPathToTemplate() {
        return APP_ROOT . '/classes/Poller/App/Templates/' . $this->template . '.tpl.php';
    }
}