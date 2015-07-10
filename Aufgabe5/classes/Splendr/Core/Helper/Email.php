<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 10.07.15
 * Time: 16:45
 */

namespace Splendr\Core\Helper;


class Email {

    public static function sendMessage($to, $subject, $message) {
        $header = 'From: webmaster@splendr.com' . "\r\n" .
                  'Reply-To: webmaster@splendr.com' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $header);
    }

    public static function sendUserActivationMessage($to, $user) {
        $key = $user->getAccount()->getActivationKey();
        $message =
            "Dear ".(string)$user."\n" .
            "\n".
            "Thank you for registering at the Splendr Website.\n".
            "Before we can activate your account one last step must be taken to complete your registration.\n".
            "\n".
            "To complete your registration, please visit this URL:\n".
            URL::getControllerURL("login", "activate", $key)."\n".
            "\n".
            "All the best,\n".
            "\n".
            "Splendr Team\n";

        self::sendMessage($user->getEmail(), 'Activate your splendr Account', $message);
    }
}