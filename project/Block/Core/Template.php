<?php

namespace Block\Core;

class Template{

    protected $layout = NULL;
    protected $template = NULL;
    protected $children = [];

    public function __construct()
    {
        $this->setTemplate('core/template.php');
    }

    public function setTemplate($template){
        $this->template = $template;
        return $this;
    }

    public function getTemplate(){
        return $this->template;
    }

    public function addChild($child,$key){
        if(is_object($child)){
            $this->children[$key] = $child; 
        }
        else{
            $object = \Ccc::objectManager($child);
            $this->children[$key] = $object;
        }
        return $this;
    }

    public function getChild($key = NULL){
        if($key == NULL){
            return $this->children;
        }
        return key_exists($key,$this->children) 
            ? $this->children[$key] 
            : NULL;
    }

    public function toHTML(){

        ob_start();

        require "Views".DIRECTORY_SEPARATOR.$this->getTemplate();
        $content = ob_get_clean();
        return $content;
    }

    public function getUrl($action = null, $controller = null, $params = []){
        $urlModel = \Ccc::objectManager('\Model\Core\Url');

        return $urlModel->getUrl($action,$controller,$params);
    }

    public function getChildHTML($className){
        $class = \Ccc::objectManager($className);
        return $class->toHTML();
    }

    public function setLayout($layout){
        $this->layout = $layout;
    }

    public function getLayout(){
        return $this->layout;
    }

}

?>