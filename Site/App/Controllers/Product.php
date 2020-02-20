<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;
use App\Models\Category;
use Core\View;
use App\Config;
use App\Models\ProductCategory;

class Product extends \Core\Controller {

    public function index(){
        
        View::renderTemplate('Product/index.html');
    }
    public function view(){
        $product = ProductModel::fetchData("url='".explode('.',$this->route_params['url'])[0]
            ."'");
        if(sizeof($product)>0){
            $id = $product[0]['pid'];
            View::renderTemplate('Product/product.html',[
                'controller_action' => 'category/view/',
                'categoryList' => Category::getParentChild(),
                'singleProduct' => ProductModel::getData($id)[0]
            ]);
        }
        else{
            View::renderTemplate('Product/product.html',['controller_action' => 'category/view/']);
            
        }
    }
    
}

?>