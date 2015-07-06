<?php

    define('APP_ROOT', __DIR__);
    define('APP_BASE_URL', dirname($_SERVER['PHP_SELF']));

require APP_ROOT.'/vendor/autoload.php';
require APP_ROOT.'/config/config.php';


use Splendr\Core\Helper\Session;
use \Splendr\Core\Controller\FrontController;

Session::init();
FrontController::get()->run();