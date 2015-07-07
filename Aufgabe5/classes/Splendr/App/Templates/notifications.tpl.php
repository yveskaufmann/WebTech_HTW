<?php
    use Splendr\Core\Helper\Notification;
    $message = $this->getData(Notification::MESSAGE_PARAM);
    $type = $this->getData(Notification::MESSAGE_TYPE_PARAM);
?>
<?php if (!is_null($message)): ?>
<div class="alert-<?= $type ?> alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="glyphicon glyphicon-<?= $type ?>-sign" aria-hidden="true"></span>
    <span class="sr-only"><?= ucfirst($type) ?>:</span>
    <div class="center-block">
        <?php if (is_array($message)): ?>
            <ul>
                <?php foreach ($message as $msg): ?>
                    <li><?=$msg?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
        <?= $message ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
