<?php

namespace Block\Core;

use Block\Category\Grid;

class Layout extends Template{


    protected $layout = NULL;

    public function __construct()
    {
        $this->setTemplate('core\layout\one-column.php');
        $this->addChild('\Block\Core\Layout\Element\Header','header');
        $this->addChild('\Block\Core\Layout\Element\Message','message');
        $this->addChild('\Block\Core\Layout\Element\Left','left');
        $this->addChild('\Block\Core\Layout\Element\Content','content');
        $this->addChild('\Block\Core\Layout\Element\Right','right');
        $this->addChild('\Block\Core\Layout\Element\Footer','footer');
        $home = $this->createBlock('\Block\Core\Home');
        $this->getChild('header')->addChild($home,'home');
    }

    public function createBlock($class){
        $object = new $class();
        $object->setLayout($this);
        return $object;
    }
}
?>