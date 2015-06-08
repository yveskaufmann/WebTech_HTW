<?php
use \Poller\App\Controller\PollController;
use Poller\Core\Helper\URL;

$poll = $this->getData(PollController::POLL_PARAM);
?>


<div class="container">
    <?php if (! $poll->enoughVotes()) { ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
            <span class="sr-only">Warning:</span>
            <div class="center-block">
                There are not enough votes please visit
                <a
                    class="alert-link"
                    href="<?= URL::getControllerURL('poll', 'show',$this->getData('poll')->getId()); ?>">this site later.</a>
            </div>
        </div>
    <?php } else { ?>
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= $poll->getQuestion(); ?>
            </div>
            <ul class="list-group">
                <?php foreach($poll->getPollAnswers() as $answer) {
                    $percent = $answer->getVotesInPercent();
                    ?>
                    <li class="list-group-item">
                        <span>
                             <?= $answer->getText(); ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar"
                                 role="progressbar"
                                 aria-valuenow="<?= $percent; ?>"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style="min-width: 2em;width: <?= $percent;?>%;">
                                <?= $percent; ?> %
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <div class="pull-right">Total Votes: <?= $poll->getTotalVoteCount(); ?></div>
        </div>

        <div class="pull-right">
            <a href="<?= URL::getControllerURL('poll','export', $poll->getId()); ?>" class="btn btn-success" role="button">Export as CSV</a>
        </div>

    </div>
    <?php } ?>
</div>