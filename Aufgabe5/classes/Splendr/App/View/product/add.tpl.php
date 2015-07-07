<?php
    use \Splendr\App\Controller\ProductController;
    use \Splendr\Core\Helper\Notification;
    use Splendr\Core\Helper\URL;
    use Splendr\Core\Helper\Pagination;
    use Splendr\Core\View\View;

    $products = $this->getData(ProductController::PRODUCTS_PARAM);
    $query = $this->getData(ProductController::QUERY_PARAM);
?>

<div class="container">

    <?php Notification::show(); ?>

    <div class="row">
       <div class="col-sm-12 col-sm-offset-6">
           <h2>Add Product</h2>
       </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
        <form class="form-horizontal" method="POST" action="<?= URL::getControllerURL('product', 'add') ?>">
            <div class="form-group">
                <label for="product_name" class="col-sm-2 control-label">Produkt-Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="product_name" placeholder="Produkt-Name">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" name="price" min="0.01" step="0.01" class="form-control" id="price" placeholder="Price">
                </div>
            </div>
            <div class="form-group">
                <label for="product_url" class="col-sm-2 control-label">Produkt URL</label>
                <div class="col-sm-10">
                    <input type="url" name="product_url" class="form-control" id="product_url" placeholder="Produkt URL">
                </div>
            </div>
            <div class="form-group">
                <label for="product_image" class="col-sm-2 control-label">Image URL</label>
                <div class="col-sm-10">
                    <input type="url" name="image_url" class="form-control" id="product_image" placeholder="Product Image">
                </div>
            </div>
            <div class="form-group">
                <label for="product_description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea type="text" name="description" rows="5" class="form-control" id="product_description" placeholder="Product Description"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </form>
        </div>
    </div>

</div>