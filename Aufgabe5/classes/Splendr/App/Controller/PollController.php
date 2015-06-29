<?php

namespace Splendr\App\Controller;

use \Splendr\Core\Controller\HTTPErrorException;
use \Splendr\App\Model\Poll;
use \Splendr\App\Model\PollAnswerQuery;
use \Splendr\App\Model\PollQuery;
use \Splendr\Core\Controller\FrontController;
use \Splendr\Core\Helper\Params;
use \Splendr\Core\View\PageView;
use Splendr\App\Model\AlreadyVotedException;

class PollController {

    const QUESTION_PARAM = 'question';
    const ANSWERS_PARAM = 'answers';
    const ALREADY_EXIST_PARAM = 'already_exist';
    const POLL_PARAM = 'poll';
    const RE_VALIDATE_PARAM = 'revalidate';

    public function index() {
         $this->add();
    }

    public function add() {
        $view = new PageView('poll/add', 'Poll - add');
        if (Params::hasPOST(self::QUESTION_PARAM) && Params::hasPOST(self::ANSWERS_PARAM)) {

            $question = trim(Params::getPost(self::QUESTION_PARAM));
            $answers = trim(Params::getPost(self::ANSWERS_PARAM));

            $revalidate = $question === '' || $answers === '';
            $alreadyExists = PollQuery::create()->hasPollWithQuestion($question);

            $poll = new Poll($question);
            $poll->addAnswers(explode(PHP_EOL, $answers));

            $view
                ->addData(self::POLL_PARAM, $poll)
                ->addData(self::QUESTION_PARAM, $question)
                ->addData(self::ANSWERS_PARAM, $answers)
                ->addData(self::RE_VALIDATE_PARAM, $revalidate)
                ->addData(self::ALREADY_EXIST_PARAM, $alreadyExists);

            // TODO: Proper Error Message.
            if (!$revalidate && !$alreadyExists) {
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
        if ($poll->isAlreadyVotedByUser()) {
            $view = new PageView('poll/show_result', 'Poll - results');
        } else {
            $view = new PageView('poll/show', 'Poll - show');
        }

        $view
            ->addData(self::POLL_PARAM, $poll)
            ->render();
    }

    public function vote($answerId) {
        $answerId = filter_var($answerId, FILTER_SANITIZE_NUMBER_INT);
        $answer = PollAnswerQuery::create()->findOneById($answerId);

        if ( is_null($answer)) {
            throw new HTTPErrorException('404');
        }

        try {
            if (! $answer->isVotedByUser()) {
                $answer->vote();
            }
        } catch(AlreadyVotedException $ex) {}

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