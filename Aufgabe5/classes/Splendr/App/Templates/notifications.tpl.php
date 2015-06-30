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
