<?php namespace Block\Category\Index\Index;

use Exception;

class Cart extends \Block\Core\Template{
    
    protected $customerId = 0;

    public function __construct()
    {
        $this->customerId = $_SESSION['customerId'];
        $this->customerModel = \Ccc::objectManager('\Model\Customer\Customer',true);
        $this->setTemplate('category\index\index\cart.php');
    }

    public function getCart(){
        $cart = \Ccc::objectManager('\Model\Cart',false);
        if($cart->getCart($this->customerId) == NULL){
            $customer = \Ccc::objectManager('\Model\Customer\Customer',false);
            if(!$customer->load($this->customerId)){
                throw new Exception("Customer Not Found");
            }
         
            $cart->customerId = $this->customerId;
            $cart->email = $customer->email;
            
            $cart->saveData();
            return $cart;
        }

        return $cart->getCart($this->customerId);
    }

    public function getCustomers(){
        return \Ccc::objectManager('\Model\Customer\Customer',false)->getAdapter()->fetchPairs("SELECT id,name FROM customers");
    }

}
?>