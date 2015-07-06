<?php
    use \Splendr\App\Controller\ProductController;
    use \Splendr\Core\Helper\Notification;
    use Splendr\Core\Helper\URL;
    use Splendr\Core\Helper\Pagination;

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

        <?php if ($products->count() > 0): ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Picture</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach( $products as $product ) { ?>
                <tr>
                    <td><a href="<?= $product->getProductUrl() ?>"><?= $product->getName() ?></a></td>
                    <td>$<?= $product->getPrice() ?></td>
                    <td><img height="100" src="<?= $product->getImageUrl()?>" title="<?= $product->getName()."-image" ?>"/></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php endif; ?>
        <?php Pagination::show($products, URL::getControllerURL('product', 'index', Pagination::PAGE_PLACEHOLDER)); ?>
    </div>
</div>