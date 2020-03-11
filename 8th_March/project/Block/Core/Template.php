<?php

namespace Block\Core;

class Template{


    protected $template = NULL;

    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }

    public function getTemplate(){
        return $this->template;
    }

    public function toHTML(){
        ob_start();
        require "Views".DIRECTORY_SEPARATOR.$this->getTemplate();
        $content = ob_get_clean();
        return $content;
    }

    public function getUrl($action = null, $controller = null, $params = []){
        $urlModel = new \Model\Core\Url();

        return $urlModel->getUrl($action,$controller,$params);
    }

}

?>