<?php

namespace Block\Customer\Address;

class Add extends \Block\Core\Template{


    public function __construct()
    {
        $this->setTemplate('customer/address/form.php');
    }

    public function getAddress(){
        return \Ccc::objectManager('\Model\Customer\Address',true);
    }


}

?>