<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 00:10
 */

namespace Splendr\Core\View;

class Template extends View {

    protected function getPathToTemplate() {
        return APP_ROOT . '/classes/Splendr/App/Templates/' . $this->template . '.tpl.php';
    }
}