<?php
    use \Poller\App\Controller\PollController;
    use \Poller\Core\Helper\URL;
?>

<div class="container">

    <div class="row">
        <form  autocomplete="off" role="form" class="col-md-9" action="" method="post">
            <?php if ( $this->getData(PollController::ALREADY_EXIST_PARAM) ) {?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
                    <span class="sr-only">Warning:</span>
                    <div class="center-block">
                        There is already a poll with the same question as yours.
                        Please check out the <a class="alert-link" href="<?= URL::getControllerURL('poll', 'show',$this->getData('poll')->getId()); ?>">other poll</a>
                        or change your question text.
                    </div>
                </div>
            <?php } ?>
            <h2>Create a Question</h2>
            <div class="form-group">
                <label for="question">Question</label>
                <input
                    value="<?= $this->getData(PollController::QUESTION_PARAM); ?>"
                    id="question" name="question"
                    type="text" class="form-control"
                    required maxlength="255"
                    autofocus>
            </div>
            <div class="form-group">
                <label for="answers">Answers</label>
                <textarea id="answers" name="answers" rows="5" class="form-control" required><?= $this->getData(PollController::ANSWERS_PARAM); ?></textarea>
            </div>
            <div class="form-group-sm pull-right">
                <input class="btn btn-success btn-lg" type="submit" value="Add Poll">
            </div>
        </form>
    </div>
</div>