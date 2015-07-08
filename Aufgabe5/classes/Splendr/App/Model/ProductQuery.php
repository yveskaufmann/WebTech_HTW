<?php

namespace Splendr\App\Model;

use Splendr\App\Model\Base\ProductQuery as BaseProductQuery;

/**
 * A Query class in order to retrieve
 * already created products.
 *
 * Class ProductQuery
 * @package Splendr\App\Model
 */
class ProductQuery extends BaseProductQuery {

    /**
     * Search for a product by it's name or its url
     * and returns a paginated collection. By default the fist page with ten
     * results will be returned. The result is sorted by the name and the product url.
     *
     * @param string $query the query for a product this could be a part of the name or its url.
     * @param int $page the page of the results.
     * @param int $hits_per_page the hits per page.
     * @return \Propel\Runtime\Util\PropelModelPager|Product[]
     */
    public function searchProduct($query, $page=1, $hits_per_page=6) {
        $page = $this->normalizePage($page);
        $query = trim($query);
        $query = ($query !== '') ? '%'.$query.'%' : $query;
        return $this
            ->where('Product.name like ?', $query)
            ->_or()
            ->where('Product.product_url like ?', $query)
            ->_and()
            ->orderByName()
            ->orderByProductUrl()
            ->paginate($page, $hits_per_page);
    }

    public function allProducts($page=1, $hits_per_page=6) {
        $page = $this->normalizePage($page);
        return $this
            ->orderByName()
            ->paginate($page, $hits_per_page);
    }

    private function normalizePage($page) {
        if ( $page < 0 ) {
            return 1;
        }
        return $page;
    }

}
