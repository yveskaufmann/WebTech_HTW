<?php

namespace Splendr\Core\Helper;
use Splendr\Core\View\Template;

/**
 * Helper class for sending Notifications to a VIEW.
 * This is class is based of the Message class,
 * of the customized simple mvc of the subject
 * web technologies.
 *
 * Class Notification
 * @package Poller\Core\Helper
 */
class Notification {

    public static function show($message = false, $type = false) {
        $message = $message ? $message : Session::get('message');
        $type = $type ? $type : Session::get('message_type');
        $type = $type ? $type : 'success';

        if ($message) {
            $template = new Template('notifications');
            $template->render();
            Session::clear('message');
            Session::clear('message_type');
        }
    }

    public static function set($message = false, $type = 'success') {
        Session::set('message', $message);
        Session::set('message_type', $type);
    }
}