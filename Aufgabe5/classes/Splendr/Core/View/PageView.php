<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 04.06.15
 * Time: 11:53
 */

namespace Splendr\Core\View;


class PageView extends View {

    protected $header;
    protected $footer;
    protected $title;

    public function __construct($main_view, $title = '') {
        parent::__construct($main_view);
        $this->setTitle($title);
        $this->header = new Template('header');
        $this->header->addData('title', $this->title);
        $this->footer = new Template('footer');
    }

    public function render() {
        $this->header->render();
        parent::render();
        $this->footer->render();
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return string
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @return Template
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * @return Template
     */
    public function getFooter() {
        return $this->footer;
    }

}