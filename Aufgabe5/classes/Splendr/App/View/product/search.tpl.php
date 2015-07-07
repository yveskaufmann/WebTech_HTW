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

    <div class="row">
        <div class="col-md-8">
            <form id="search_form" class="form" action="<?= URL::getControllerURL('product', 'search', '${query}') ?>" method="GET" role="search accept-charset="UTF-8">
                <div class="form-group input-group input-group-lg">
                    <label for="query" class="sr-only">Product Search Term</label>
                    <input name="query" id="query" type="text" class="form-control" placeholder="Product name or url" value="<?= $query ?>">
                    <span class="input-group-btn">
                        <button  type="submit" class="btn btn-primary" title="search product" >
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                     </span>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
                if ( trim($query) !== '' && $products->isEmpty()) {
                    Notification::show('There are no products which match your query');
                }
            ?>
            <?php if (! $products->isEmpty()): ?>
            <h2>Search Results</h2>
            <?php endif; ?>
            <?php (new View('product/table', $this))->render() ?>
            <?php Pagination::show($products, URL::getControllerURL('product', 'search', $query, Pagination::PAGE_PLACEHOLDER)); ?>
        </div>
    </div>
</div>