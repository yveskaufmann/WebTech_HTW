<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 08.07.15
 * Time: 22:41
 */

namespace Splendr\App\Controller;


use Splendr\App\Model\Account;
use Splendr\App\Model\User;
use Splendr\Core\Controller\FrontController;
use Splendr\Core\Controller\HTTPErrorException;
use Splendr\Core\Helper\Email;
use Splendr\Core\Helper\Login;
use Splendr\Core\Helper\Notification;
use Splendr\Core\Helper\Params;
use Splendr\Core\Helper\Request;
use Splendr\Core\View\PageView;
use Splendr\App\Model\AccountQuery;

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

        $account = new Account();
        $account->setEnabled(0);
        $account->setActivationKey(Login::generateActivationKey());
        $user->setAccount($account);


        if (!$user->validate()) {
            foreach ($user->getValidationFailures() as $failure) {
                Notification::add($failure->getPropertyPath().": ".$failure->getMessage(), 'warning');
            }
            $view->addData(self::USER_PARAM, $user);
            $view->render();
        } else {
            $user->save();
            Email::sendUserActivationMessage($user->getEmail(), $user);
            Notification::add('Please check your mail box in order to activate your account.', 'info');
            FrontController::get()->runController('product', 'index');
        }
    }

    public function activate($key) {
        $account = AccountQuery::create()->findOneByActivationKey($key);
        if (! is_null($account) && $account->getEnabled() === 0) {
            $account->setEnabled(1);
            $account->save();
            Notification::add('Your account is now activated, now you can login.', 'info');
            FrontController::get()->runController('Index', 'index');
        }

        throw new HTTPErrorException('404');
    }
}