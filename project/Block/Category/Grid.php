<?php

namespace Block\Category;

class Grid extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->add = \Ccc::objectManager('Block\Category\Add',true);
        $this->setTemplate('category/view.php');
    }

    public function getCategories(){
        return \Ccc::objectManager('\Model\Category',true)->fetchAll();
    }

    public function getParentName($id){
        return \Ccc::objectManager('\Model\Category',true)->getAdapter()->fetchOne("SELECT name From Categories WHERE id = $id");
    }


}

?>