<?php namespace Block\Category\Index\Index;

class Cart extends \Block\Core\Template{
    
    protected $customerId = 0;

    public function __construct()
    {
        $this->customerId = $_SESSION['customerId'];
        $this->customerModel = \Ccc::objectManager('\Model\Customer',true);
        $this->setTemplate('category\index\index\cart.php');
    }

    public function getCart(){
        $cart = \Ccc::objectManager('\Model\Cart',true);
        return $cart;
    } 

    public function getCustomers(){
        return $this->customerModel->getCustomers();
    }

}
?>