<?php

    define('DEV_MODE', true);
    define('APP_ROOT', __DIR__);
    require APP_ROOT.'/vendor/autoload.php';
    require APP_ROOT.'/config/config.php';

    use \Poller\Core\Controller\FrontController;

    FrontController::get()->run();