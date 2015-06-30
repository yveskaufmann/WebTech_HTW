<?php

namespace Splendr\App\Controller;

use Splendr\Core\View\PageView;

class IndexController {

    public function index() {
        $view = new PageView('index/index', 'Splendr - We know what you want.');
        $view->render();
    }
}