<?php

namespace Poller\App\Model;

use Poller\App\Model\Base\PollAnswer as BasePollAnswer;


/**
 * Class PollAnswer
 * @package Poller\Model
 */
class PollAnswer extends BasePollAnswer
{

    /**
     * Create a in memory Poll Answer.
     *
     * @param string $text the text of this possible answer.
     */
    public function __construct($text=null) {
        if (! is_null($text)) {
            $this->setText(trim($text));
            $this->setVotes(0);
        }
    }

    /**
     * Return the number of votes for this possible answer.
     * @return int
     */
    public function getVoteCount() {
        return $this->getVotes();
    }

    /**
     * Perform a vote for this possible answer.
     */
    public function vote() {

        if($this->getPoll()->isAlreadyVotedByUser()) {
            throw new AlreadyVotedException();
        }

        $votes = $this->getVotes();
        $this->setVotes($votes + 1);
        $this->getPoll()->markAsVotedByUser($this->getId());
        $this->save();
    }

    public function isVotedByUser() {
        return $this->getPoll()->getVotedAnswerId() === $this->getId();
    }

    public function getVotesInPercent() {

        return   round(($this->getVoteCount() * 100) / $this->getPoll()->getTotalVoteCount(), 2);
    }
}



