<?php

namespace Poller\App\Model;

use Poller\App\Model\Base\Poll as BasePoll;

/**
 * Class Poll
 * @package Poller\Model
 */
class Poll extends BasePoll {

    /**
     * Create a in memory Poll.
     *
     * @param string $question the question text of this poll.
     */
    public function __construct($question = null) {
        if(! is_null($question)) {
            $question = trim($question);
            $this->setId(self::createId($question));
            $this->setQuestion($question);
        }
    }

    /**
     * Create the intern object id which converts the
     * poll text in to a global identifier.
     *
     * @param $question
     * @return string the generated id
     */
    public static function createId($question) {
        $id_components = array(
            "poll",
            strtolower(trim($question))
        );
        return md5(join('',$id_components));
    }

    /**
     * @param array $answers
     */
    public function addAnswers(array $answers) {
        foreach($answers as $answer) {
            $this->addAnswer($answer);
        }
    }

    /**
     * Add a new answer to this poll.
     * Empty strings or already added answers
     * will be ignored.
     *
     * @param string $answer the text of this answer.
     */
    public function addAnswer($answer) {

        if (! is_string($answer)) {
            throw new \InvalidArgumentException('$answer must be a string');
        }

        $answer = trim($answer);
        if ($answer !== '' && $this->isAnswerAlreadyAdded($answer)) {
            $this->addPollAnswer(new PollAnswer($answer));
        }
    }

    /**
     * Check if the answer is already added to this poll.
     *
     * @param $answer
     * @return bool
     */
    private function isAnswerAlreadyAdded($answer) {
        $alreadyAddedAnswers = $this->getPollAnswers()->toArray();
        $answerAlreadyAdded = array_filter($alreadyAddedAnswers, function ($answerObj) use ($answer) {
            return $answerObj['Text'] === $answer;
        });
        return empty($answerAlreadyAdded);
    }

    /**
     * Returns the number of total Votes.
     *
     * @return number
     */
    public function getTotalVoteCount() {
        $votes = 0;
        foreach($this->getPollAnswers() as $answer) {
            $votes += $answer->getVotes();
        }
        return $votes;
    }

    /**
     * Check if the current user has already voted this poll.
     *
     * @return bool
     */
    public function isAlreadyVotedByUser() {
        return isset($_SESSION[$this->getId()]);
    }

    /**
     * @param string $answerId
     */
    public function  markAsVotedByUser($answerId) {
        $_SESSION[$this->getId()] =  $answerId;
    }

    public function getVotedAnswerId() {
        return $this->isAlreadyVotedByUser() ?  $_COOKIE[$this->getId()] : null;
    }

    public function toCSV() {
        $header = array('Question', 'Total Votes');
        $data = array($this->getQuestion(), $this->getTotalVoteCount());

        foreach($this->getPollAnswers() as $answer) {
            array_push($header, $answer->getText());
            array_push($data, $answer->getVoteCount());
        }

        return implode(';', $header).PHP_EOL.implode(';', $data);
    }

    public function enoughVotes() {
        return $this->getTotalVoteCount() >= 3;
    }
}
