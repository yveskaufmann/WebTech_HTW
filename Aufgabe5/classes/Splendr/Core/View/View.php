<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 23:19
 */

namespace Splendr\Core\View;

use \string;

class View implements IView {

    protected $headers = array();
    protected $data = array();
    protected $template = '';
    protected $parentView = null;

    public function __construct($template, IView $parentView = null) {
        $this->setTemplate($template);
        $this->data = array();
        $this->parentView = $parentView;
    }

    public function render() {
        $this->sendHeaders();
        echo $this->renderTemplate($this->data);
    }

    protected function sendHeaders() {
        if (!headers_sent()) {
            foreach ($this->headers as $name => $headValue) {
                header($name . ': ' . $headValue, true);
            }
        }
        return $this;
    }

    /**
     * @param $data
     * @return string
     */
    protected function renderTemplate($data) {
        ob_start();
        include $this->getPathToTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @return string
     */
    protected function getPathToTemplate() {
        return APP_ROOT . '/classes/Splendr/App/View/' . $this->template . '.tpl.php';
    }

    /**
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * @param $template
     * @return $this
     */
    public function setTemplate($template) {
        $this->template = $template;
        $path_to_template = $this->getPathToTemplate();
        if(! file_exists($path_to_template)){
            throw new \InvalidArgumentException(
                'The specified template was not found please check the template name.'
                .': '.$path_to_template
            );
        }
        return $this;
    }

    public function addHeader($name, $value) {
        $this->headers[trim($name)] = trim($value);
        return $this;
    }

    public function getHeaders($name, $default_value = null) {
        return isset($this->headers[$name]) ? $this->headers[$name] : $default_value;
    }

    public function addData($name, $value) {
        $this->data[trim($name)] = $value;
        return $this;
    }

    public function getData($name, $default_value = '') {

        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        if ( $this->parentView != null ) {
            return $this->parentView->getData($name, $default_value);
        }

        return $default_value;
    }

    public function clearData() {
        $this->data = array();
        return $this;
    }
};
