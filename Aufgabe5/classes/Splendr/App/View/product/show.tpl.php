<?php
    use \Splendr\App\Controller\ProductController;
    use Splendr\Core\Helper\URL;
    use Splendr\App\Model\Product;
    $product = $this->getData(ProductController::PRODUCT_PARAM, new Product());
?>

<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 product">
    <div class="thumbnail">
        <a href="<?= $product->getProductUrl() ?>">
            <img height="240" src="<?= $product->getImageUrl() ?>" alt="<?= 'image of '.$product->getName() ?>">
        </a>
        <div class="caption">
            <h4 class="pull-right">EUR <?= $product->getPrice() ?></h4>
            <h4><a href="<?= $product->getProductUrl() ?>"><?= $product->getName() ?></a></h4>
        </div>
        <div class="text-right">
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
    </div>
</div>
