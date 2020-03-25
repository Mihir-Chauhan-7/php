<?php

namespace Block\Shipment;

class Add extends \Block\Core\Template{

    public function __construct()
    {
        $this->setTemplate('shipment\method\form.php');
    }

    public function getShipmentMethod(){
        return \Ccc::objectManager('\Model\Shipment\Method',true);
    }
}

?>