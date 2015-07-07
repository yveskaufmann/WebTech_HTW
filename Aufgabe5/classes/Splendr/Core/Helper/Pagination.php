<?php

namespace Splendr\Core\Helper;
use Splendr\Core\View\Template;

/**
 * Helper class for Rendering the Pagination
 * navigation. Which enable the user to switch between pages.
 *
 * Class Pagination
 * @package Poller\Core\Helper
 */
class Pagination {
    const PAGINATION_PARAM = 'pagination';
    const BASE_URL_PARAM = 'baseURL';
    const PAGE_PLACEHOLDER = '${page}';

    /**
     * Renders the pagination navigation for
     * a specified PropelModelPager.
     *
     * @param PropelModelPager $paginationCollection
     * @param string $baseURL a url to a php script which provides access to these pages.
     *                        The URL  must contain the placeholder <code>{page}</code>
     *                        for the page number.
     */
    public static function show($paginationCollection, $baseURL) {
        if (!strpos(self::PAGE_PLACEHOLDER, $baseURL)) {
            if ( $baseURL[strlen($baseURL) - 1] !== '/') {
                $baseURL .= '/';
            }
            $baseURL .=self::PAGE_PLACEHOLDER;
        }
        $template = new Template('pagination');
        $template
            ->addData(self::PAGINATION_PARAM, $paginationCollection)
            ->addData(self::BASE_URL_PARAM, $baseURL);
        $template->render();
    }

}