<?php
use \Poller\App\Controller\PollController;
use Poller\Core\Helper\URL;
?>

<div class="container">

    <div class="row">
            <?php if ( $this->getData(PollController::ALREADY_EXIST_PARAM) ) {?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
                    <span class="sr-only">Warning:</span>
                    <div class="center-block">
                        There is already a poll with the same question as yours.
                        Please check out the <a class="alert-link" href="poll/show/<?= $this->getData('poll')->getId(); ?>">other poll</a>
                        or change your question text.
                    </div>
                </div>
            <?php } ?>
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