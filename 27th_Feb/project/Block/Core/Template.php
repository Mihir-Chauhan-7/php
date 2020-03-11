<?php

namespace Block\Core;

class Template{

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
}

?>