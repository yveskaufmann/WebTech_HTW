<?php
    use Splendr\App\Controller\ProductController;
    $products = $this->getData(ProductController::PRODUCTS_PARAM);

    if ($products->count() > 0): ?>
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