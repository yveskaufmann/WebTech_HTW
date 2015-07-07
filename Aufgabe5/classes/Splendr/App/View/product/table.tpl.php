<?php
    use Splendr\App\Controller\ProductController;
    use Splendr\Core\Helper\URL;
    use Splendr\Core\View\View;

    $products = $this->getData(ProductController::PRODUCTS_PARAM);

    if ($products->count() > 0): ?>
        <?php

        $productView = new View('product/show');
            foreach( $products as $product ) {
                $productView->addData(ProductController::PRODUCT_PARAM, $product);
                $productView->render();
            }
        ?>

    <!--<table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Picture</th>
            <th class="text-right" >Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach( $products as $product ) { ?>
            <tr>
                <td><a href="<?= $product->getProductUrl() ?>"><?= $product->getName() ?></a></td>
                <td>$<?= $product->getPrice() ?></td>
                <td><img class="thumbnail" height="64" src="<?= $product->getImageUrl()?>" title="<?= $product->getName()."-image" ?>"/></td>
                <td>
                    <div class="text-right">
                        <a
                            href="<?= URL::getControllerURL('product', 'show', $product->getId()) ?>"
                            class="btn btn-primary btn-sm" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-label="Open Product" aria-hidden="true">
                                </span>
                        </a>
                        <a
                            href="<?= URL::getControllerURL('product', 'update', $product->getId()) ?>"
                            class="btn btn-primary btn-sm" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-label="Edit Product" aria-hidden="true">
                                </span>
                        </a>
                        <form class="form" style="display: inline;" action="<?=  URL::getControllerURL('product', 'delete')?>" method="POST">
                            <input type="hidden"  name="product_id" value="<?= $product->getId()?>">
                            <button type="submit" class="btn btn-primary btn-sm " type="submit">
                                <span class="glyphicon glyphicon-remove" aria-label="Delete Product" aria-hidden="true">
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table> -->
<?php endif; ?>