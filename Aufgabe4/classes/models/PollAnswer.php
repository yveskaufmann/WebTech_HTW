<?php

namespace Poller\models;
use Poller\DBHelper;

/**
 * Class PollAnswer
 * @package Poller\models
 */
class PollAnswer {

    /**
     * The related poll object of this PollAnswer.
     *
     * @var Poll
     */
    private $poll;

    /**
     * The id of this Answer.
     * @var int
     */
    private $id;

    /**
     * The text of this possible answer.
     * @var string
     */
    private $text;

    /**
     * The number of votes of this possible answer.
     * @var int
     */
    private $votes;

    /**
     * Create a in memory Poll Answer.
     *
     * @param Poll $poll the reference of the related poll.
     * @param string $text the text of this possible answer.
     */
    public function __construct(Poll $poll, $text) {
        $this->id = $poll->getAnswerCount()  + 1;
        $this->poll = $poll;
        $this->text = $text;
        $this->votes = 0;
    }

    /**
     * Return the number of votes for this possible answer.
     * @return int
     */
    public function getVoteCount() {
        return $this->votes;
    }

    /**
     * Perform a vote for this possible answer.
     */
    public function vote() {
        $this->votes++;
    }

    /**
     * Return the text of this possible answer.
     * @return string
     */
    public function getAnswer() {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    public function persist() {

        $db = DBHelper::get()->getPDOConnection();

        if (!$db->inTransaction()) {
            $db->beginTransaction();
        }

        $sth = $db->prepare("Insert Into poller.Poll_Answers (id, poll, text, votes) Values(:id, :poll, :text, :votes)");
        $sth->bindParam(':id', $this->getId(), \PDO::PARAM_INT);
        $sth->bindParam(':poll', $this->poll->getId(), \PDO::PARAM_STR, 32);
        $sth->bindParam(':text', $this->getAnswer(), \PDO::PARAM_STR, 255);
        $sth->bindParam(':votes', $this->getVoteCount(), \PDO::PARAM_INT);

        if(! $sth->execute()) {
            var_dump($sth->errorInfo());
            $db->rollBack();
            return false;
        }

        if (!$db->inTransaction()) {
            $db->commit();
        }

        return true;
    }
}