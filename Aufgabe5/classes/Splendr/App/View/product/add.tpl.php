<?php
    use \Splendr\App\Controller\ProductController;
    use \Splendr\Core\Helper\Notification;
    use Splendr\Core\Helper\URL;
    use Splendr\App\Model\Product;

    $product = $this->getData(ProductController::PRODUCT_PARAM, new Product());
    $isAddByURL = $this->getData(ProductController::QUERY_BY_URL_MODE_PARAM);
    $productURL = ($isAddByURL) ? $this->getData(ProductController::URL_PARAM) : '';
?>

<div class="container">

    <?php Notification::show(); ?>

    <div class="row">
       <div class="col-sm-12 col-sm-offset-6">
           <h2>Add Product</h2>
       </div>
    </div>

    <div data-example-id="togglable-tabs">
        <ul id="myTabs" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="dropdown active">
                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Mode <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                    <li class="<?= $isAddByURL ?  '' : 'active'?>"><a href="#dropdown1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1" aria-expanded="true">Manual</a></li>
                    <li class="<?= !$isAddByURL ?  '' : 'active'?>"><a href="#dropdown2" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2" aria-expanded="false">By Amazon URL</a></li>
                </ul>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade <?= $isAddByURL ?  '' : 'active'?> in" id="dropdown1" aria-labelledby="dropdown1-tab">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-horizontal" method="POST" action="<?= URL::getControllerURL('product', 'add') ?>">
                            <div class="form-group">
                                <label for="product_name" class="col-sm-2 control-label">Produkt-Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="product_name" placeholder="Produkt-Name" value="<?= $product->getName() ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" name="price" min="0.01" step="0.01" class="form-control" id="price" placeholder="Price" value="<?=$product->getPrice() ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_url" class="col-sm-2 control-label">Produkt URL</label>
                                <div class="col-sm-10">
                                    <input type="url" name="product_url" class="form-control" id="product_url" placeholder="Produkt URL" value="<?= $product->getProductUrl() ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_image" class="col-sm-2 control-label">Image URL</label>
                                <div class="col-sm-10">
                                    <input type="url" name="image_url" class="form-control" id="product_image" placeholder="Product Image" value="<?= $product->getImageUrl() ?>">
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade <?= $isAddByURL ?  'active' : ''?>" id="dropdown2" aria-labelledby="dropdown2-tab">
                <form class="form-horizontal" method="POST" action="<?= URL::getControllerURL('product', 'addByURL') ?>">
                    <div class="form-group">
                        <label for="product_url_add_by_url" class="col-sm-2 control-label">Produkt URL</label>
                        <div class="col-sm-10">
                            <input type="url" name="product_url_add_by_url" class="form-control" id="product_url_add_by_url" placeholder="Produkt URL" value="<?= $productURL ?>">
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>