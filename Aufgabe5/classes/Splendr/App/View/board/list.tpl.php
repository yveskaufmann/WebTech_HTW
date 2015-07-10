<?php
use Splendr\App\Controller\BoardController;
use Splendr\Core\View\View;

$boards = $this->getData(BoardController::BOARDS_PARAM);
if ($boards->count() > 0) {
    $boardView = new View('board/show');
    foreach( $boards as $board ) {
        $boardView->addData(BoardController::BOARD_PARAM, $board);
        $boardView->render();
    }
}