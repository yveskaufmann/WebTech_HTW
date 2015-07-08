<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 08.07.15
 * Time: 00:40
 */

namespace Splendr\App\Service;

interface ProductScraper {

    /**
     * Retrieve all information of product
     * by a parsing a html page.
     *
     * @param string $url
     * @return Product mixed
     */
    public function retrieveProductByURL($url);

    /**
     * Check if the given url could be handled
     * by this scraper.
     *
     * @param string $url
     * @return boolean
     */
    public function isURLSupported($url);

}