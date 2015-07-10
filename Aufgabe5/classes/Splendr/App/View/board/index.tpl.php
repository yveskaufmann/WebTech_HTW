<?php
    use Splendr\App\Controller\BoardController;
    use \Splendr\Core\Helper\Notification;
    use Splendr\Core\Helper\URL;
    use Splendr\Core\Helper\Pagination;
    use Splendr\Core\View\View;

    $boards = $this->getData(BoardController::BOARDS_PARAM);
?>

<div class="container">

    <div class="row">
        <h2>Boards</h2>
        <?php
            if ($boards->isEmpty()) {
                Notification::show('There are no product boards, please add one');
            }
        ?>
        <?php (new View('board/list', $this))->render() ?>
        <?php Pagination::show($boards, URL::getControllerURL('board', 'index', Pagination::PAGE_PLACEHOLDER)); ?>
    </div>
</div>