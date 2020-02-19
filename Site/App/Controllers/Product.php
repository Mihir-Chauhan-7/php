<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;
use App\Models\Category;
use Core\View;
use App\Config;
use App\Models\ProductCategory;

class Product extends \Core\Controller {

    public function index(){
        
        View::renderTemplate('Product/index.html',[
            'name' => 'Mihir'
        ]);
    }
    public function view(){
        $product = ProductModel::fetchData("url='".$this->route_params['url']."'");
        if(sizeof($product)>0){
            $id = $product[0]['pid'];
            View::renderTemplate('Product/product.html',[
                'categoryList' => Category::getAll(),
                'singleProduct' => ProductModel::getData($id)[0]
            ]);
        }
        else{
            die("Product Not Found");
            
        }
    }
    
}

?>