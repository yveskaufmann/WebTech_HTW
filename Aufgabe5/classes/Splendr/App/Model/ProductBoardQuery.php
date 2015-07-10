<?php

namespace Splendr\App\Model;

use Splendr\App\Model\Base\ProductBoardQuery as BaseProductBoardQuery;

/**
 * Class ProductBoardQuery
 * @package Splendr\App\Model
 */
class ProductBoardQuery extends BaseProductBoardQuery
{
    public function allBoards($page=1, $hits_per_page=6) {
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
