<?php
/**
 * Created by PhpStorm.
 * User: fxdapokalypse
 * Date: 03.06.15
 * Time: 23:19
 */

namespace Poller\Core\View;

use \string;

class View {

    protected $headers = array();
    protected $data = array();
    protected $template = '';


    public function __construct($template, $data=array()) {
        $this->setTemplate($template);
        $this->data = $data;
    }

    public function render() {
        $this->sendHeaders();
        return $this->renderTemplate($this->data);
        return $this;
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
        require_once $this->getPathToTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @return string
     */
    protected function getPathToTemplate() {
        return APP_ROOT . '/classes/App/View/' . $this->template . '.tpl.php';
    }

    /**
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * @param string $template
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

    public function getData($name, $default_value = null) {
        return isset($this->data[$name]) ? $this->data[$name] : $default_value;
    }

    public function clearData() {
        $this->data = array();
        return $this;
    }

};
