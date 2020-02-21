<?php

namespace App\Controllers;

use App\Models\Cart as cartModel;
use App\Models\Category;
use App\Models\ProductCart;
use Core\View;

class Cart extends \Core\Controller {

    public function index(){
        if(isset($_SESSION['cartId']))
        {
            $cartData = ProductCart::join('LEFT',['cart_id','product_id','quantity'],
            ['name','url','image','price'],'products','product_id','pid','A.cart_id='.
            $_SESSION['cartId']);
        
             View::renderTemplate('\Cart\index.html',[
                'categories' => Category ::getParentChild(),
                'controller_action' => 'category/view/',
                'cartData' => $cartData
            ]);
        }
        else
        {
            View::renderTemplate('\Cart\index.html');
        }
    }
    public function clear(){
        ProductCart::deleteData($_SESSION['cartId']);
        header('Location:/Cybercom/php/Site/public/cart/index');
    }
    public function generate(){
        $cartObj = (array) json_decode($_POST['cartObj']);
        if(isset($_SESSION['userId'])){
            $_SESSION['cartId'] = cartModel::createCart($cartObj,$_SESSION['userId']);
        }
        else{
            $_SESSION['cartId'] = cartModel::createCart($cartObj,0);
            echo "False";
        }
        // $flag=0;
        // $cart = [];
        // if(array_key_exists('cart', $_SESSION) && $_SESSION['cart'] != null){
        //     $cart = $_SESSION['cart'];
        // }
        
        
        // if(count($cart) > 0){
        //     foreach($cart as $cartKey=>$cartItem){
        //         foreach($cartItem as $key=>$value){
        //             if($key == 'product_id' &&  $value == $cartObj['product_id']){
        //                 $flag=1;
        //                 $cart[$cartKey]['quantity'] = $cartObj['quantity'];
        //             }
        //         }     
        //     }
        // }
        // if($flag==0){
        //     $cart[] = ['product_id' => $cartObj['product_id'] , 'quantity' => $cartObj['quantity']]; 
        // }
        // $_SESSION['cart'] = $cart;
    }
    
}

?>