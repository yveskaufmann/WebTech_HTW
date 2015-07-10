<?php

namespace Splendr\App\Controller;

use Splendr\App\Model\Product;
use Splendr\App\Model\ProductBoardQuery;
use Splendr\App\Model\ProductQuery;
use Splendr\App\Service\AmazonProductScrapper;
use Splendr\Core\Controller\FrontController;
use Splendr\Core\Controller\HTTPErrorException;
use Splendr\Core\Helper\Notification;
use Splendr\Core\Helper\Params;
use Splendr\Core\Helper\Request;
use Splendr\Core\Helper\URL;
use Splendr\Core\View\PageView;

class ProductController {


    const PRODUCT_PARAM = 'product';
    const PRODUCTS_PARAM = 'products';
    const PRODUCT_BOARD_ID_PARAM = 'product_board';
    const QUERY_PARAM = 'query';
    const QUERY_BY_URL_MODE_PARAM='isAddByURLMode';
    const URL_PARAM='product_url';
    const PRODUCT_BOARDS_PARAM = 'product_boards';
    const IMAGE_URL_PARAM = 'image_url';
    const PRICE_PARAM = 'price';
    const NAME_PARAM = 'name';

    public function index($page=1) {
        $products = ProductQuery::create()->allProducts($page);
        $view = new PageView('product/index', 'Products');
        $view->addData(self::PRODUCTS_PARAM, $products);
        $view->render();
    }

    public function add() {
        $view = new PageView('product/add', 'Product - add');
        if (Request::isGet()) {
            $boards = ProductBoardQuery::create()
                ->orderByName()
                ->find();
            $view
                ->addData(self::PRODUCT_BOARDS_PARAM, $boards)
                ->render();
            return;
        }

        $name = Params::getPost(self::NAME_PARAM, null, FILTER_SANITIZE_STRING);
        $price = Params::getPost(self::PRICE_PARAM, null, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $price = filter_var($price,FILTER_VALIDATE_FLOAT);
        $product_url = Params::getPost(self::URL_PARAM, null, FILTER_SANITIZE_URL);
        $product_url = filter_var($product_url,FILTER_VALIDATE_URL);
        $image_url = Params::getPost(self::IMAGE_URL_PARAM, null, FILTER_SANITIZE_URL);
        $image_url = filter_var($image_url,FILTER_VALIDATE_URL);

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setProductUrl($product_url);
        $product->setImageUrl($image_url);

        $board_id = Params::getPost(self::PRODUCT_BOARD_ID_PARAM, -1, FILTER_SANITIZE_NUMBER_INT);
        if ($board_id > -1) {
            $board = ProductBoardQuery::create()->findOneById($board_id);
            if (!is_null($board)) {
                $product->setBoard($board_id);
            }
        }

        if (!$product->validate()) {
            foreach ($product->getValidationFailures() as $failure) {
                Notification::add($failure->getPropertyPath().": ".$failure->getMessage(), 'warning');
            }
            $view->addData(self::PRODUCT_PARAM, $product);
            $view->render();
        } else {
            $product->save();
            FrontController::get()->runController('product', 'index');
        }
    }

    public function addByURL() {
        $product = null;
        $view = new PageView('product/add', 'Product - add');
        $view->addData(self::QUERY_BY_URL_MODE_PARAM, true);

        if (Request::isGet()) {
            $boards = ProductBoardQuery::create()
                ->orderByName()
                ->find();
            $view
                ->addData(self::PRODUCT_BOARDS_PARAM, $boards)
                ->render();
            $view->render();
            return;
        }

        $product_url = Params::getPost('product_url_add_by_url', null, FILTER_SANITIZE_URL);
        $product_url = filter_var($product_url, FILTER_VALIDATE_URL);

        $url_scraper = new AmazonProductScrapper();
        if ($url_scraper->isURLSupported($product_url)) {
            $product = $url_scraper->retrieveProductByURL($product_url);
        }

        if (is_null($product) || !$product->validate()) {
            Notification::add('The add of a product by the specified url failed, please try another url.', 'warning');
            $view->addData(self::URL_PARAM, $product_url);
            $view->addData(self::PRODUCT_PARAM, new Product());
            $view->render();
        } else {

            $board_id = Params::getPost(self::PRODUCT_BOARD_ID_PARAM, -1, FILTER_SANITIZE_NUMBER_INT);
            if ($board_id > -1) {
                $board = ProductBoardQuery::create()->findOneById($board_id);
                if (!is_null($board)) {
                    $product->setBoard($board_id);
                }
            }

            $product->save();
            FrontController::get()->runController('product', 'index');
        }
    }

    public function update($id) {
        $product = ProductQuery::create()->findOneById($id);

        if ( is_null($product) ) {
            throw new HTTPErrorException('404');
        }

        $view = new PageView('product/update', 'Product - Update');
        $view->addData(self::PRODUCT_PARAM, $product);


        if (Request::isGet()) {
            $boards = ProductBoardQuery::create()
                ->orderByName()
                ->find();
            $view
                ->addData(self::PRODUCT_BOARDS_PARAM, $boards)
                ->render();

            return;
        }

        $price = Params::getPost(self::PRICE_PARAM, null, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $price = filter_var($price,FILTER_VALIDATE_FLOAT);

        $product_url = Params::getPost('product_url', null, FILTER_SANITIZE_URL);
        $product_url = filter_var($product_url,FILTER_VALIDATE_URL);

        $image_url = Params::getPost(self::IMAGE_URL_PARAM, null, FILTER_SANITIZE_URL);
        $image_url = filter_var($image_url,FILTER_VALIDATE_URL);

        $product->setPrice($price);
        $product->setProductUrl($product_url);
        $product->setImageUrl($image_url);

        $board_id = Params::getPost(self::PRODUCT_BOARD_ID_PARAM, -1, FILTER_SANITIZE_NUMBER_INT);
        if ($board_id > -1) {
            $board = ProductBoardQuery::create()->findOneById($board_id);
            if (!is_null($board)) {
                $product->setBoard($board_id);
            }
        }

        if (!$product->validate()) {
            /**
             * Because we need the name validation only while saving
             * we must filter out the specific validation rule.
             */
            foreach ($product->getValidationFailures() as $failure) {
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
            $product->save();
            FrontController::get()->runController('product', 'index');
        }

    }

    public function delete() {
        $id = Params::getPost('product_id', null, FILTER_SANITIZE_NUMBER_INT);

        if (!$id) {
            throw new HTTPErrorException('404');
        }

        $product = ProductQuery::create()->findOneById($id);
        if (!is_null($product)) {
            $product->delete();
        }

        Request::redirectToHTTP_REFERER(URL::getControllerURL('product', 'index'));
    }

    public function search($query='', $page=1) {
        $query = filter_var($query, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $products = ProductQuery::create()->searchProduct($query, $page);
        $view = new PageView('product/search','Search - Result');
        $view->addData(self::PRODUCTS_PARAM, $products);
        $view->addData(self::QUERY_PARAM, $query);
        $view->render();
    }
}