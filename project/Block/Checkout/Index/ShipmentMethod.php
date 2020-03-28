<?php 

namespace Block\Checkout\Index;

class ShipmentMethod extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->setTemplate('checkout\index\shipmentmethod.php');
    }

    public function getShipmentMethods(){
        return \Ccc::objectManager('\Model\Shipment\Method',false)
            ->fetchAll() ?? [];
    }

    public function getSelected(){
        return \Ccc::objectManager('\Model\Cart',true)->shippingId;
    }

}

?>