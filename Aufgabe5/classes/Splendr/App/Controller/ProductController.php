<?php

namespace Splendr\App\Controller;

use Splendr\App\Model\AlreadyVotedException;
use Splendr\App\Model\Poll;
use Splendr\App\Model\PollAnswerQuery;
use Splendr\App\Model\PollQuery;
use Splendr\App\Model\Product;
use Splendr\App\Model\ProductQuery;
use Splendr\Core\Controller\FrontController;
use Splendr\Core\Controller\HTTPErrorException;
use Splendr\Core\Helper\Notification;
use Splendr\Core\Helper\Params;
use Splendr\Core\Helper\Request;
use Splendr\Core\View\PageView;

class ProductController {

    const PRODUCT_PARAM = 'product';
    const PRODUCTS_PARAM = 'products';
    const QUERY_PARAM = 'query';

    public function index($page=1) {
        $products = ProductQuery::create()->allProducts($page);
        $view = new PageView('product/index', 'Products');
        $view->addData(self::PRODUCTS_PARAM, $products);
        $view->render();

    }

    public function show($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $product = ProductQuery::create()->findOneById($id);
        if ( is_null($product) ) {
            throw new HTTPErrorException('404');
        }
        $view = new PageView('product/show', 'Product - '.$product->getName());
        $view->addData(self::PRODUCT_PARAM, $product);
        $view->render();
    }

    public function add() {
        $view = new PageView('product/add', 'Product - add');
        if (Request::isGet()) {
            $view->render();
            return;
        }

        $name = Params::getPost('name', null, FILTER_SANITIZE_STRING);

        $price = Params::getPost('price', null, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $price = filter_var($price,FILTER_VALIDATE_FLOAT);

        $product_url = Params::getPost('product_url', null, FILTER_SANITIZE_URL);
        $product_url = filter_var($product_url,FILTER_VALIDATE_URL);

        $image_url = Params::getPost('image_url', null, FILTER_SANITIZE_URL);
        $image_url = filter_var($image_url,FILTER_VALIDATE_URL);

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setProductUrl($product_url);
        $product->setImageUrl($image_url);


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

    public function update($id) {
        $product = ProductQuery::create()->findOneById($id);

        if ( is_null($product) ) {
            throw new HTTPErrorException('404');
        }

        $view = new PageView('product/update', 'Product - Update');
        $view->addData(self::PRODUCT_PARAM, $product);

        if (Request::isGet()) {
            $view->render();
            return;
        }

        $price = Params::getPost('price', null, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $price = filter_var($price,FILTER_VALIDATE_FLOAT);

        $product_url = Params::getPost('product_url', null, FILTER_SANITIZE_URL);
        $product_url = filter_var($product_url,FILTER_VALIDATE_URL);

        $image_url = Params::getPost('image_url', null, FILTER_SANITIZE_URL);
        $image_url = filter_var($image_url,FILTER_VALIDATE_URL);

        $product->setPrice($price);
        $product->setProductUrl($product_url);
        $product->setImageUrl($image_url);


        if (!$product->validate()) {
            /**
             * Because we need the name validation only while saving
             * we must filter out the specific validation rule.
             */
            foreach ($product->getValidationFailures() as $failure) {
                if ($failure->getPropertyPath() == 'name') {
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

        FrontController::get()->runController('product', 'index');
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