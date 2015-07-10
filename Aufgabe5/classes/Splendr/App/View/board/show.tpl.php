<?php
    use \Splendr\App\Controller\BoardController;
    use Splendr\Core\Helper\URL;
    use Splendr\App\Model\ProductBoard;
    $board = $this->getData(BoardController::BOARD_PARAM, new ProductBoard());
?>

<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 product">
    <div class="thumbnail">
        <a href="<?= URL::getControllerURL('board', 'products', $board->getId()) ?>">
            <img height="240" src="<?= $board->getImageUrl() ?>" alt="<?= 'image of '.$board->getName() ?>">
        </a>
        <div class="caption">
            <h4><a href="<?= URL::getControllerURL('board', 'products', $board->getId()) ?>"><?= $board->getName() ?><span class="badge"><?= $board->countProducts() ?></span></a></h4>
        </div>
        <div class="text-right">
            <a
                href="<?= URL::getControllerURL('board', 'update', $board->getId()) ?>"
                class="btn btn-primary btn-sm" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-label="Edit Board" aria-hidden="true">
                                </span>
            </a>
            <form class="form" style="display: inline;" action="<?=  URL::getControllerURL('board', 'delete')?>" method="POST">
                <input type="hidden"  name="board_id" value="<?= $board->getId()?>">
                <button type="submit" class="btn btn-primary btn-sm " type="submit">
                    <span class="glyphicon glyphicon-remove" aria-label="Delete Board" aria-hidden="true">
                </button>
            </form>
        </div>
    </div>
</div>
