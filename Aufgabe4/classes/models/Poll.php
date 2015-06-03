<?php

namespace Poller\models;
use Poller\DBHelper;

/**
 * Class Poll
 * @package Poller\models
 */
class Poll implements \IteratorAggregate {
    /**
     * The global id of this poll.
     *
     * @var string
     */
    private $id;

    /**
     * The question text of this poll
     *
     * @var string
     */
    private $question;

    /**
     * List of possible answers for this poll.
     *
     * @var PollAnswer[]
     */
    private $answers;

    /**
     * Create a in memory Poll.
     *
     * @param string $question the question text of this poll.
     */
    public function __construct($question) {
        $question = trim($question);
        $this->createId($question);
        $this->question = $question;
        $this->answers = array();
    }

    /**
     * Create the intern object id which converts the
     * poll text in to a global identifier.
     *
     * @param $question
     */
    public function createId($question) {
        $id_components = array(
            "poll",
            strtolower($question)
        );
        $this->id = md5(join('',$id_components));
    }

    /**
     * Add a new answer to this poll.
     *
     * @param $answer the text of this answer.
     */
    public function addAnswer($answer) {
        if (! is_string($answer)) {
            throw new \InvalidArgumentException('$answer must be a string');
        }
        array_push($this->answers, new PollAnswer($this, $answer));
    }

    /**
     * Count of possible answers.
     *
     * @return int
     */
    public function getAnswerCount() {
        return count($this->answers);
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
        $voteCounts = array_map(function($answer) {
            return $answer->getCountOfVotes();
        }, $this->answers);

        return array_sum($voteCounts);
    }

    /**
     * Return an iterator for all possible poll answers.
     *
     * @return \ArrayIterator
     */
    public function getIterator() {
        $iterator = new \ArrayIterator($this->answers);
        return $iterator;
    }

    /**
     * @return string the id of this poll.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string the question text of this poll.
     */
    public function getQuestion() {
        return $this->question;
    }

    public function persist() {
        $db = DBHelper::get()->getPDOConnection();
        $db->beginTransaction();

        $sth = $db->prepare("Insert Into poller.Poll (id, question) Values(:id, :question)");
        $sth->bindParam(':id', $this->getId(), \PDO::PARAM_STR, 32);
        $sth->bindParam(':question', $this->getQuestion(), \PDO::PARAM_STR, 255);

        if(!$sth->execute()) {
            var_dump($sth->errorInfo());
            $db->rollBack();
            return;
        }

        foreach ($this as $answer) {
           $answer->persist();
        }

        $db->commit();
    }
}