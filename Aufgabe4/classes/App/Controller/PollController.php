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
use Poller\Core\Helper\Params;
use Poller\Core\View\ErrorView;
use Poller\Core\View\PageView;
use \Poller\Core\View\Template;
use Poller\Core\View\View;

class PollController {
    const QUESTION_PARM = 'question';
    const ANSWERS_PARAM = 'answers';

    public function __construct() {

    }

    public function index() {
        return $this->add();
    }

    public function add() {
        $view = new PageView('poll/add', 'Poll - add');
        if (Params::hasPOST(self::QUESTION_PARM) && Params::hasPOST(self::ANSWERS_PARAM)) {
            $question = Params::getPost(self::QUESTION_PARM);

            if (PollQuery::create()->hasPollWithQuestion($question)) {
                return;
            }

            $poll = new Poll($question);
            $answers = Params::getPost(self::ANSWERS_PARAM);
            $answers = explode(PHP_EOL, $answers);

            foreach($answers as $answer) {
                $poll->addAnswer($answer);
            }
            $poll->save();
        }
        $view->render();
    }

    public function show() {
        return 'show';
    }

}