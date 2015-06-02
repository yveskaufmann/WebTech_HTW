<?php
	
	class Poll implements IteratorAggregate {
		private $id;
		private $question;
		private $answers;

		public function __construct($question) {
			$originator = 'me';
			$this->createId($originator, $question);
			$this->question = $question;
			$this->answers = array();
		}

		public function createId($originator, $question) {
			$id_components = array(
				"poll",
				$originator,
				$question
			);
			$this->id = md5(join($id_components));
		}

		public function addAnswer($answer) {
			if (! is_string($answer)) {
				throw new InvalidArgumentException('$answer must be a string');
			}	
			array_push($this->answers, new PollAnswer($this, $answer));
		}

		public function getAnswerById($answerId) {
			if ( $answerId < 0 || $answerId > $this->getCountOfPossibleAnswers()) {
				$errorMessage = sprintf('The requested answer with the id "%d" wasn\'t found.', $answerId);
				throw new LongException($errorMessage);
			}
			return $this->answers[$answerId];
		}

		public function getCountOfPossibleAnswers() {
			return count($this->answers);
		}

		public function getCountOfVotes() {
			$voteCounts = array_map(function($answer) {
				return $answer->getCountOfVotes();
			}, $this->answers);

			return array_sum($voteCounts);
		}

		public function getIterator() {
			$iterator = new ArrayIterator($this->answers);
			return $iterator;
		}
	}

	class PollAnswer {
		private $id;
		private $poll;
		private $text;
		private $countOfVotes;

		public function __construct(Poll $poll, $text) {
			$this->id = $poll->getCountOfPossibleAnswers()  + 1;
			$this->poll = $poll;
			$this->text = $text;
			$this->countOfVotes = 0;
		}

		public function getCountOfVotes() {
			return $this->countOfVotes;
		}

		public function vote() {
			$this->countOfVotes++;
		}

		public function getAnswer() {
			return $this->text;
		}

	}

	$newPoll = new Poll('Who should ... ?');
	$newPoll->addAnswer('AAA');
	$newPoll->addAnswer('DDD');
	$newPoll->addAnswer('CCC');
	$newPoll->addAnswer('HHH');

	foreach ($newPoll as $answer) {
		echo "Answer: ".$answer->getAnswer()."\n";
	}
?>