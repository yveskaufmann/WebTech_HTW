<?php

namespace Poller\App\Controller;

use \Poller\Core\Controller\HTTPErrorException;
use \Poller\App\Model\Poll;
use \Poller\App\Model\PollAnswerQuery;
use \Poller\App\Model\PollQuery;
use \Poller\Core\Controller\FrontController;
use \Poller\Core\Helper\Params;
use \Poller\Core\View\PageView;

class PollController {

    const QUESTION_PARAM = 'question';
    const ANSWERS_PARAM = 'answers';
    const ALREADY_EXIST_PARAM = 'already_exist';
    const POLL_PARAM = 'poll';

    public function index() {
         $this->add();
    }

    public function add() {
        $view = new PageView('poll/add', 'Poll - add');
        if (Params::hasPOST(self::QUESTION_PARAM) && Params::hasPOST(self::ANSWERS_PARAM)) {
            $question = Params::getPost(self::QUESTION_PARAM);
            $answers = Params::getPost(self::ANSWERS_PARAM);

            $poll = new Poll($question);
            $poll->addAnswers(explode(PHP_EOL, $answers));

            $view
                ->addData(self::POLL_PARAM, $poll)
                ->addData(self::QUESTION_PARAM, $question)
                ->addData(self::ANSWERS_PARAM, $answers);

            if (PollQuery::create()->hasPollWithQuestion($question)) {
                $view->addData(self::ALREADY_EXIST_PARAM, true);

            } else {
                $poll->save();
                FrontController::get()->runController('poll', 'show', $poll->getId());
            }

        }
        $view->render();
    }

    public function show($pollId) {
        $poll = PollQuery::create()->findOneById($pollId);

        if ( is_null($poll)) {
           throw new HTTPErrorException('404');
        }

        if ($poll->isAlreadyVotedByUser() ||  $poll->getTotalVoteCount() > 5) {
            $view = new PageView('poll/show_result', 'Poll - results');
        } else {
            $view = new PageView('poll/show', 'Poll - show');
        }

        $view
            ->addData(self::POLL_PARAM, $poll)
            ->render();
    }

    public function vote($answerId) {
        $answer = PollAnswerQuery::create()->findOneById($answerId);
        if ( is_null($answer)) {
            throw new HTTPErrorException('404');
        }

        if (! $answer->isVotedByUser()) {
            $answer->vote();

        }

        FrontController::get()->runController('poll','show',$answer->getPollId());
    }

    public function export($pollId) {
        $poll = PollQuery::create()->findOneById($pollId);
        if ( is_null($poll)) {
            throw new HTTPErrorException('404');
        }
        $csvFile =  $poll->toCSV();
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Type: text/csv; charset=utf8');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.$poll->getQuestion().'.csv');
        header('Content-Length: ' . strlen($csvFile));
        echo $csvFile;
    }


}