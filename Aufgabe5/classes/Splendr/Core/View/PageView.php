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
        $this->header = new Template('header', $this);
        $this->footer = new Template('footer', $this);
        $this->setTitle($title);
    }

    public function render() {
        if (isset($this->header)) {
            $this->header->render();
        }

        parent::render();

        if (isset($this->footer)) {
            $this->footer->render();
        }
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
        $this->addData('title', $this->title);
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