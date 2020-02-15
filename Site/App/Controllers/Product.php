<?php

namespace App\Controllers;

use App\Models\Product as ProductModel;
use Core\View;
use App\Config;

class Product extends \Core\Controller {

    public function index(){
        
        View::renderTemplate('Product/index.html',[
            'name' => 'Mihir',
            'productList' => ProductModel::getProductList()
        ]);
    }
    
}

?>