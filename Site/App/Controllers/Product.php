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

        print_r($product = ProductModel::fetchData("url='".$this->route_params['url']."'"));
        $id = $product[0]['pid'];
        View::renderTemplate('Product/product.html',[
            'name' => 'Mihir',
            'categoryList' => Category::getAll(),
            'singleProduct' => ProductModel::getData($id)[0]
        ]);
    }
    
}

?>