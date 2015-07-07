<?php
    use \Splendr\App\Controller\ProductController;
    use \Splendr\Core\Helper\Notification;
    use Splendr\Core\Helper\URL;
    use Splendr\Core\Helper\Pagination;
    use Splendr\Core\View\View;

    $products = $this->getData(ProductController::PRODUCTS_PARAM);
?>

<div class="container">

    <div class="row">
        <h2>Products</h2>
        <?php
            if ($products->isEmpty()) {
                Notification::show('There are no products, please add one');
            }
        ?>
        <?php (new View('product/table', $this))->render() ?>
        <?php Pagination::show($products, URL::getControllerURL('product', 'index', Pagination::PAGE_PLACEHOLDER)); ?>
    </div>
</div>