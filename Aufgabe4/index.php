<?php

    session_start();

    define('DEV_MODE', false);
    define('APP_ROOT', __DIR__);
    define('APP_BASENAME', basename(APP_ROOT));

    require APP_ROOT.'/vendor/autoload.php';
    require APP_ROOT.'/config/config.php';

    use \Poller\Core\Controller\FrontController;

    FrontController::get()->run();