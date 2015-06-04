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
     * Add a new answer to this poll.
     * Empty string will be ignored.
     *
     * @param $answer the text of this answer.
     */
    public function addAnswer($answer) {
        if (! is_string($answer)) {
            throw new \InvalidArgumentException('$answer must be a string');
        }

        $answer = trim($answer);
        if ($answer !== '') {
            $this->addPollAnswer(new PollAnswer($answer));
        }
    }

    /**
     * @param $answerId
     * @return PollAnswer
     * @throws \LongException
     */
    public function getAnswerById($answerId) {
        if ( $answerId < 0 || $answerId > $this->getAnswerCount()) {
            $errorMessage = sprintf('The requested answer with the id "%d" wasn\'t found.', $answerId);
            throw new \LongException($errorMessage);
        }
        return $this->answers[$answerId];
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

}
