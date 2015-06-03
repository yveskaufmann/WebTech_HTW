<?php

    define('APP_ROOT', __DIR__);

    $loader = require APP_ROOT.'/vendor/autoload.php';

	$newPoll = new \Poller\models\Poll('Who should ... ?');
	$newPoll->addAnswer('AAA');
	$newPoll->addAnswer('DDD');
	$newPoll->addAnswer('CCC');
	$newPoll->addAnswer('HHH');

	foreach ($newPoll as $answer) {
		echo "Answer: ".$answer->getAnswer()."\n";
	}

    $newPoll->persist();