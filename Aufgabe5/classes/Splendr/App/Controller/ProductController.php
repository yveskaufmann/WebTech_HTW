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
use Splendr\Core\Helper\Params;
use Splendr\Core\Helper\Request;
use Splendr\Core\View\PageView;

class ProductController {

    const PRODUCT_PARAM = 'product';

    const PRODUCTS_PARAM = 'products';

    public function index($page=1) {
        $products = ProductQuery::create()->allProducts($page);
        $view = new PageView('product/index', 'Products');
        $view->addData(self::PRODUCTS_PARAM, $products);
        $view->render();

    }

    public function show($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $product = ProductQuery::create()->get($id);
        if ( is_null($product) ) {
            throw new HTTPErrorException('404');
        }
        $view = new PageView('product/show', 'Product - '.$product->getName());
        $view->addData(self::PRODUCT_PARAM, $product);
        $view->render();
    }

    public function add() {

        if (Request::isGet()) {
            $view = new PageView('product/add', 'Product - add');
            $view->render();
        }

        $requiredParams = array(
            'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'price' => FILTER_SANITIZE_NUMBER_FLOAT,
            'product_url' => FILTER_SANITIZE_URL,
            'image_url' => FILTER_SANITIZE_URL,
            'description' => FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        foreach($requiredParams as $param) {
            $requiredParams[$param] = Params::getPost($param, null, $requiredParams[$param]);
        }

        $product = new Product();
        $product->setName($requiredParams['name']);
        $product->setPrice($requiredParams['price']);
        $product->setProductUrl($requiredParams['product_url']);
        $product->setImageUrl($requiredParams['image_url']);
        $product->setDescription($requiredParams['description']);
        $product->save();

        FrontController::get()->runController(self::PRODUCTS_PARAM, 'index');
    }

    public function update($id) {
        $product = ProductQuery::create()->get($id);
        if ( is_null($product) ) {
            throw new HTTPErrorException('404');
        }

        $view = new PageView('product/update', 'Product - '.$product->getName());
        $view->addData(self::PRODUCT_PARAM, $product);
    }

    public function delete() {
        $id = Params::getPost('product_id', null, FILTER_SANITIZE_NUMBER_INT);

        if (!is_numeric($id)) {
            throw new HTTPErrorException('404');
        }

        $product = ProductQuery::create()->get($id);
        if (!is_null($product)) {
            $product->delete();
        }

        FrontController::get()->runController(self::PRODUCTS_PARAM, 'all_products');
    }

    public function search($query) {
        $query = filter_var($query, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $products = ProductQuery::create()->searchProduct($query);
        $view = new PageView('products/searchResult','Search - Result');
        $view->addData(self::PRODUCTS_PARAM, $products);
        $view->render();
    }
}