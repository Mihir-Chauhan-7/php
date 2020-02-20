<?php

namespace App\Controllers;

use App\Models\Cart as cartModel;
use Core\View;

class Cart extends \Core\Controller {

    public function index(){
        if(isset($_SESSION['cart'])){
            View::renderTemplate('\Cart\index.html',[
                'cartData' => $_SESSION['cart']
            ]);
        }
        else{
            View::renderTemplate('\Cart\index.html');
        }
    }
    public function clear(){
        unset($_SESSION['cart']);
        header('Location:/Cybercom/php/Site/public/cart/index');
    }
    public function generate(){
        $flag=0;
        $cart = [];
        if(array_key_exists('cart', $_SESSION) && $_SESSION['cart'] != null){
            $cart = $_SESSION['cart'];
        }
        $cartObj = (array) json_decode($_POST['cartObj']);
        cartModel::createCart($cartObj);
        if(count($cart) > 0){
            foreach($cart as $cartKey=>$cartItem){
                foreach($cartItem as $key=>$value){
                    if($key == 'product_id' &&  $value == $cartObj['product_id']){
                        $flag=1;
                        $cart[$cartKey]['quantity'] = $cartObj['quantity'];
                    }
                }     
            }
        }
        if($flag==0){
            $cart[] = ['product_id' => $cartObj['product_id'] , 'quantity' => $cartObj['quantity']]; 
        }
        $_SESSION['cart'] = $cart;
    }
    
}

?>