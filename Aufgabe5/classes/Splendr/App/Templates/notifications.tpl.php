<?php
    use Splendr\Core\Helper\Notification;
    $message = $this->getData(Notification::MESSAGE_PARAM);
    $type = $this->getData(Notification::MESSAGE_TYPE_PARAM);
?>
<div class="alert alert-<?= $type ?> alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="glyphicon glyphicon-<?= $type ?>-sign" aria-hidden="true"></span>
    <span class="sr-only"><?= ucfirst($type) ?>:</span>
    <div class="center-block">
        <?= $message ?>
    </div>
</div>
