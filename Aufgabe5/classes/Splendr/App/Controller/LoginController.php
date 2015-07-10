<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 08.07.15
 * Time: 22:41
 */

namespace Splendr\App\Controller;


use Splendr\App\Model\User;
use Splendr\Core\Controller\FrontController;
use Splendr\Core\Controller\HTTPErrorException;
use Splendr\Core\Helper\Login;
use Splendr\Core\Helper\Notification;
use Splendr\Core\Helper\Params;
use Splendr\Core\Helper\Request;
use Splendr\Core\View\PageView;

class LoginController {

    const USER_PARAM = 'user_param';

    const USERNAME_PARAM = 'username';
    const EMAIL_PARAM = 'email';
    const FIRST_NAME_PARAM = 'first_name';
    const LAST_NAME_PARAM = 'last_name';
    const PASSWORD_PARAM = 'password';
    const PASSWORD_CONFIRM = 'password_confirm';


    public function login() {
        if (Request::isGet()) {
            throw new HTTPErrorException('404');
        }

        $email = Params::getPost(self::EMAIL_PARAM, null, FILTER_SANITIZE_EMAIL);
        $password = Params::getPost(self::PASSWORD_PARAM, null, FILTER_SANITIZE_STRING);

        if (Login::login($email, $password)) {
            $user = Login::geCurrentLoggedUser();
            Notification::add(sprintf("Welcome: %s", $user), 'info');

        } else {
            Notification::add("The email and password do not match", 'info');
        }

        Request::redirectToHTTP_REFERER();
    }

    public function logout() {
        Login::logout();
        Request::redirectToHTTP_REFERER();
    }

    /**
     * Handles the User registration
     */
    public function register() {

        $view = new PageView('login/register', 'Register - Create your account.');
        if (Request::isGet()) {
            $view->render();
            return;
        }

        $username = Params::getPost(self::USERNAME_PARAM, null, FILTER_SANITIZE_STRING);
        $email = Params::getPost(self::EMAIL_PARAM, null, FILTER_SANITIZE_EMAIL);
        $first_name = Params::getPost(self::FIRST_NAME_PARAM, null, FILTER_SANITIZE_STRING);
        $last_name = Params::getPost(self::LAST_NAME_PARAM, null, FILTER_SANITIZE_STRING);
        $password = Params::getPost(self::PASSWORD_PARAM, null, FILTER_SANITIZE_STRING);
        $password_confirm = Params::getPost(self::PASSWORD_CONFIRM, null, FILTER_SANITIZE_STRING);

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setFirstName($first_name);
        $user->setLastName($last_name);
        $user->setPassword($password);
        $user->setConfirmPassword($password_confirm);

        if (!$user->validate()) {
            foreach ($user->getValidationFailures() as $failure) {
                Notification::add($failure->getPropertyPath().": ".$failure->getMessage(), 'warning');
            }
            $view->addData(self::USER_PARAM, $user);
            $view->render();
        } else {
            $user->save();
            Notification::add('You can now login in your new account', 'info');
            FrontController::get()->runController('product', 'index');
        }
    }
}