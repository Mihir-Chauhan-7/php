<?php

namespace App\Controllers;

use App\Models\Category;
use Core\View;

class Home extends \Core\Controller {

    public function index(){
        View::renderTemplate('Home/index.html',[
            'categoryList' => Category::getAll()
        ]);
    }
    
}

?>