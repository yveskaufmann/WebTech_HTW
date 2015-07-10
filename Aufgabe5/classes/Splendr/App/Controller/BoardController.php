<?php

namespace Splendr\App\Controller;

use Splendr\App\Model\Base\ProductBoardQuery;
use Splendr\App\Model\ProductBoard;
use Splendr\App\Model\ProductQuery;
use Splendr\Core\Controller\FrontController;
use Splendr\Core\Controller\HTTPErrorException;
use Splendr\Core\Helper\Notification;
use Splendr\Core\Helper\Params;
use Splendr\Core\Helper\Request;
use Splendr\Core\Helper\URL;
use Splendr\Core\View\PageView;

class BoardController {

    const BOARD_PARAM = 'board';
    const BOARDS_PARAM = 'boards';
    const NAME_PARAM = 'name';
    const IMAGE_URL_PARAM = 'image_url';
    const BOARD_ID_PARAM = 'board_id';

    public function index($page=1) {
        $boards = ProductBoardQuery::create()->allBoards($page);
        $view = new PageView('board/index', 'ProductBoards');
        $view->addData(self::BOARDS_PARAM, $boards);
        $view->render();
    }

    public function products($boardId, $page=1) {
        $products = ProductQuery::create()->allProductsByBoard($boardId);
        $view = new PageView('product/index', 'Products');
        $view->addData(ProductController::PRODUCTS_PARAM, $products);
        $view->render();
    }

    public function add() {
        $view = new PageView('board/add', 'ProductBoard - add');
        if (Request::isGet()) {
            $view->render();
            return;
        }

        $name = Params::getPost(self::NAME_PARAM, null, FILTER_SANITIZE_STRING);
        $image_url = Params::getPost(self::IMAGE_URL_PARAM, null, FILTER_SANITIZE_URL);
        $image_url = filter_var($image_url,FILTER_VALIDATE_URL);

        $board = new ProductBoard();
        $board->setName($name);
        $board->setImageUrl($image_url);



        if (!$board->validate()) {
            foreach ($board->getValidationFailures() as $failure) {
                Notification::add($failure->getPropertyPath().": ".$failure->getMessage(), 'warning');
            }
            $view->addData(self::BOARD_PARAM, $board);
            $view->render();
        } else {
            $board->save();
            FrontController::get()->runController('board', 'index');
        }
    }

    public function update($id) {
        $board = ProductBoardQuery::create()->findOneById($id);

        if ( is_null($board) ) {
            throw new HTTPErrorException('404');
        }

        $view = new PageView('board/update', 'ProductBoard - Update');
        $view->addData(self::BOARD_PARAM, $board);

        if (Request::isGet()) {
            $view->render();
            return;
        }

        $image_url = Params::getPost(self::IMAGE_URL_PARAM, null, FILTER_SANITIZE_URL);
        $image_url = filter_var($image_url,FILTER_VALIDATE_URL);

        $board->setImageUrl($image_url);


        if (!$board->validate()) {
            /**
             * Because we need the name validation only while saving
             * we must filter out the specific validation rule.
             */
            foreach ($board->getValidationFailures() as $failure) {
                if ($failure->getPropertyPath() == self::NAME_PARAM) {
                    $valid = true;
                    continue;
                } else {
                    $valid = false;
                }
                Notification::add($failure->getPropertyPath().": ".$failure->getMessage(), 'warning');
            }
        }

        if (! $valid ) {
            $view->render();
        } else {
            $board->save();
            FrontController::get()->runController('board', 'index');
        }

    }

    public function delete() {
        $id = Params::getPost( self::BOARD_ID_PARAM, null, FILTER_SANITIZE_NUMBER_INT);

        if (!$id) {
            throw new HTTPErrorException('404');
        }

        $board = ProductBoardQuery::create()->findOneById($id);
        if (!is_null($board)) {
            foreach($board->getProducts() as $product) {
                $product->setProductBoard(null);
                $product->save();
            }
            $board->delete();
        }

        Request::redirectToHTTP_REFERER(URL::getControllerURL('board', 'index'));
    }

}