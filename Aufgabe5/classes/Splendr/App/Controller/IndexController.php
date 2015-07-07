<?php

namespace Splendr\App\Controller;

use Splendr\Core\View\PageView;

class IndexController {

    public function index() {
        $view = new PageView('index/index', 'Splendr - We know what you want.');
        $view->render();
    }

    public function contact() {
        $view = new PageView('index/contact', 'Splendr - Contact.');
        $view->render();
    }

    public function imprint() {
        $view = new PageView('index/imprint', 'Splendr - Inprint.');
        $view->render();
    }
}