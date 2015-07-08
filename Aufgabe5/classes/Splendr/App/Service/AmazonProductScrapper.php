<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 08.07.15
 * Time: 00:45
 */

namespace Splendr\App\Service;


use Splendr\App\Model\Product;

class AmazonProductScrapper implements ProductScraper {

    /**
     * Retrieve all information of product
     * by a parsing a html page.
     *
     * @param string $url
     * @return Product mixed
     */
    public function retrieveProductByURL($url) {
        $url_content = $this->loadData($url);
        $document = new \DOMDocument();

        libxml_use_internal_errors(true);
        if ( is_null($url_content) || !$document->loadHTML($url_content)) {
            return null;
        }

        $xpath = new \DOMXPath($document);
        $titleQuery = $xpath->query('//*[@id="productTitle"]');
        $imgQuery = $xpath->query('//*[@id="imgTagWrapperId"]/img | //*[@id="img-canvas"]/img');
        $priceQuery = $xpath->query('//*[@id="priceblock_ourprice"] | //*[@id="priceblock_saleprice"]');

        if (is_null($titleQuery) || is_null($imgQuery) || is_null($priceQuery)) return null;

        if ($titleQuery->length === 0) return null;
        $title = $titleQuery[0]->firstChild->wholeText;
        $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($imgQuery->length === 0 ) return null;
        $img = $imgQuery[0]->getAttribute('src');
        $img = filter_var($img, FILTER_SANITIZE_URL);
        $img = filter_var($img, FILTER_VALIDATE_URL);

        if ($priceQuery->length === 0) return null;
        $price = $priceQuery[0]->firstChild->wholeText;
        $price = str_replace(',', '.', $price);
        $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $price = filter_var($price, FILTER_VALIDATE_FLOAT );

        if (!$title || !$img || !$price ) return null;

        $product = new Product();
        $product->setName($title);
        $product->setImageUrl($img);
        $product->setProductUrl($url);
        $product->setPrice($price);

        return $product;
    }

    /**
     * Check if the given url could be handled
     * by this scraper.
     *
     * @param string $url
     * @return boolean
     */
    public function isURLSupported($url) {

        if (strpos($url, 'http://') === false) {
            $url = 'http://'.$url;
        }
        $url_components = parse_url($url);
        if ($url_components) {
            return strpos($url_components['host'], 'www.amazon.') === 0;
        }
        return false;
    }

    private function loadData($url) {

        if (is_null($url)) {
            return null;
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}