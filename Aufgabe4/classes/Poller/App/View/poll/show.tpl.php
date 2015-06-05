<?php
use \Poller\App\Controller\PollController;
use Poller\Core\Helper\URL;
?>

<div class="container">

    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><?= $this->getData(PollController::POLL_PARAM)->getQuestion(); ?></div>
                <ul class="list-group">
                    <?php foreach($this->getData(PollController::POLL_PARAM)->getPollAnswers() as $answer) { ?>
                        <li class="list-group-item <?= $answer->isVotedByUser() || true ? '' : ''; ?>">
                            <span class="badge">
                                <?= $answer->getVotes(); ?>
                            </span>
                            <a href="<?= URL::getControllerURL('poll', 'vote', $answer->getId());?>">
                                <?= $answer->getText(); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
    </div>
</div>