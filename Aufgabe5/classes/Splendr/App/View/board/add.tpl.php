<?php
    use Splendr\App\Controller\BoardController;
    use Splendr\App\Model\ProductBoard;
    use Splendr\Core\Helper\URL;

    $board = $this->getData(BoardController::BOARD_PARAM, new ProductBoard());
?>

<div class="container">

    <div class="row">
       <div class="col-sm-12 col-sm-offset-6">
           <h2>Add Product Board</h2>
       </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <form class="form-horizontal" method="POST" action="<?= URL::getControllerURL('board', 'add') ?>">
                <div class="form-group">
                    <label for="board_name" class="col-sm-2 control-label">Board Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="<?= BoardController::NAME_PARAM ?>" class="form-control" id="board_name" placeholder="Board Name" value="<?= $board->getName() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="board_image" class="col-sm-2 control-label">Image URL</label>
                    <div class="col-sm-10">
                        <input type="url" name="<?= BoardController::IMAGE_URL_PARAM ?>" class="form-control" id="board_image" placeholder="Board Image" value="<?= $board->getImageUrl() ?>">
                    </div>
                </div>
                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">Add Board</button>
                </div>
            </form>
        </div>
    </div>
</div>
