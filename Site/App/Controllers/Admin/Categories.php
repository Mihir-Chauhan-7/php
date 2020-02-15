<?php

namespace App\Controllers\Admin;

use App\Models\Product as ProductModel;
use Core\View;
use App\Config;

class Categories extends \Core\Controller {

    public function index(){
        View::renderTemplate('base.html',[
            'name' => 'Mihir',
            'productList' => ProductModel::getProductList()
        ]);
    }
    
}

?>