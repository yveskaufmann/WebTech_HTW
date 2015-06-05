<?php
use \Poller\App\Controller\PollController;
use Poller\Core\Helper\URL;

$poll = $this->getData(PollController::POLL_PARAM);

?>

<div class="container">
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
                        <span class="badge">
                             <?= $answer->getText(); ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar"
                                 role="progressbar"
                                 aria-valuenow="<?= $percent; ?>"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style="min-width: 2em;width: <?= $percent;?>%;">
                                <?= $percent; ?>%
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div class="pull-right">
            <a href="<?= URL::getControllerURL('poll','export', $poll->getId()); ?>" class="btn btn-success" role="button">Export as CSV</a>
        </div>

    </div>
</div>