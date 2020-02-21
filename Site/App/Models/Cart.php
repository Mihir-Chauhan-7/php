<?php

namespace App\Models;

use Core\Model;
use PDO;

class Cart extends \Core\Model
{
    protected static $table = "cart";
    protected static $primaryKey = "id";
    protected static $mainUrl = "cart/";
    protected static $discardList=[];
    public static function createCart($cartObj,$id){
        if(isset($_SESSION['cartId'])){
            $cartId = $_SESSION['cartId'];
        }
        else{
            Cart::insertData(['uid' => $id,'total' => 0]);
            $cartId = $_SESSION['cartId'] = Cart::getLastId();
        }
        if(sizeof(Cart::executeSQL("Select * From cart_product WHERE product_id=".
            $cartObj['product_id']." AND cart_id=".$cartId)) > 0){
            Cart::executeSQL("UPDATE cart_product SET quantity=".$cartObj['quantity']." WHERE product_id=".$cartObj['product_id']);    
        }
        else{
            // echo "Insert into cart_product (cart_id,product_id,quantity) values($cartId,".$cartObj['product_id'].",".$cartObj['quantity'].")";
            Cart::executeSQL("Insert into cart_product (cart_id,product_id,quantity) values($cartId,".$cartObj['product_id'].",".$cartObj['quantity'].")");
        }        
        return $cartId;
        
    }
    public static function saveCart(){
        Cart::executeSQL("UPDATE cart SET uid=".$_SESSION['userId']." WHERE id=".$_SESSION['cartId']);    
    }

}

?>