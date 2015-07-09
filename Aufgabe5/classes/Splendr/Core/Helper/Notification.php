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

    const MESSAGE_PARAM = 'message';
    const MESSAGE_TYPE_PARAM = 'message_type';

    public static function show($message = false, $type=false) {
        $message = $message ? $message : Session::get(self::MESSAGE_PARAM);
        $type = $type ? $type : Session::get(self::MESSAGE_TYPE_PARAM);
        $type = $type ? $type : 'info';

        if ($message) {
            $template = new Template('notifications');
            $template
                ->addData(self::MESSAGE_PARAM, $message)
                ->addData(self::MESSAGE_TYPE_PARAM, $type);
            $template->render();

            Session::clear(self::MESSAGE_PARAM);
            Session::clear(self::MESSAGE_TYPE_PARAM);
        }
    }

    public static function set($message = false, $type = 'info') {
        Session::set(self::MESSAGE_PARAM, $message);
        Session::set(self::MESSAGE_TYPE_PARAM, $type);
    }

    public static function add($message, $type) {
        $messages = Session::get(self::MESSAGE_PARAM, array());
        array_push($messages, $message);
        Session::set(self::MESSAGE_PARAM, $messages);
        Session::set(self::MESSAGE_TYPE_PARAM, $type);
    }
}