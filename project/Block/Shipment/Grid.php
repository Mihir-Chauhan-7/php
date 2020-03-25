<?php

namespace Block\Shipment;

class Grid extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->shipmentMethodModel = \Ccc::objectManager('\Model\Shipment\Method',true); 
        $this->setTemplate('shipment\method\view.php');
    }

    public function getShipmentMethods(){
        return $this->shipmentMethodModel->fetchAll();   
    }
}
?>