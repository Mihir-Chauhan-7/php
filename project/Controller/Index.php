<?php

namespace Controller;

class Index extends Base{

    public function gridAction(){
        $this->getLayout()->getChild('content')
            ->addChild('Block\Core\Dashboard','dashboard');
        $this->renderLayout();
    }
}
?>