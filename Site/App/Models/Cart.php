<?php

namespace App\Models;

use Core\Model;
use PDO;

class Cart extends \Core\Model
{
    protected static $table = "cart";
    protected static $primaryKey = "id";
    protected static $mainUrl = "cart/";
    //protected static $keyList=['Id','Title','Url','Status','Content','Created At',
    //  'Updated At'];
    protected static $discardList=[];

    public static function createCart($cartObj){
        if(isset($_SESSION['cart_id'])){
            $cartId = $_SESSION['cart_id'];
        }
        else{
            Cart::insertData(['uid' => $_SESSION['userId']]);
            $cartId = $_SESSION['cart_id'] = Cart::getLastId();
        }
        if(sizeof(Cart::executeSQL("Select * From cart_product WHERE product_id=".
            $cartObj['product_id'])) > 0){
            
            Cart::executeSQL("UPDATE cart_product SET cart_id=".$cartId.",quantity=".$cartObj['quantity']." WHERE product_id=".$cartObj['product_id']);    
        }
        else{
            echo "Insert into cart_product (cart_id,product_id,quantity) values($cartId,".$cartObj['product_id'].",".$cartObj['quantity'].")";
            Cart::executeSQL("Insert into cart_product (cart_id,product_id,quantity) values($cartId,".$cartObj['product_id'].",".$cartObj['quantity'].")");
        }        
        echo "Cart Id :".$cartId;
        
    }
}

?>