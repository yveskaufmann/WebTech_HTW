<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 21:47
 */

namespace Poller\App\Controller;

use \Poller\App\Model\Poll;
use \Poller\App\Model\PollQuery;
use \Poller\App\Model\AlreadyVotedException;
use \Poller\Core\View\Template;
use Poller\Core\View\View;

class PollController {
    public function __construct() {

    }

    public function index() {
        $template1 = new Template('header', array('title' => '' ));
        $view = new View('error/404');
        $view->addData('error', 'asdsdasdsa');
        $template2 = new Template('footer');

        return $template1->render().$view->render().$template2->render();


        // return $this->add();
    }

    public function add($id = '') {

        if (! isset($id)) {
            $id = 'b40473b73c5871bffea8a06cd9b23f93';
        }

        $poll = PollQuery::create()->findOneById($id);
        if (is_null($poll)) {
            $poll = new Poll('Who should ... ?');
            $poll->addAnswer('AAA');
            $poll->addAnswer('DDD');
            $poll->addAnswer('CCC');
            $poll->addAnswer('HHH');
        }

        echo $poll->getTotalVoteCount();

        foreach ($poll->getPollAnswers() as $answer) {
            try {
                $answer->vote();
            } catch(AlreadyVotedException $ex) {

            }
            echo "Answer: ".$answer->toJSON()."\n";
        }

        $poll->save();
        return 'add';
    }

    public function show() {
        return 'show';
    }

}