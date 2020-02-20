<?php

namespace App\Controllers;

use App\Config;
use App\Models\Category;
use Core\View;

class Home extends \Core\Controller {
    public function index(){
        View::renderTemplate('Home/index.html',[
            'controller_action' => 'category/view/',
            'loginStatus' => Config::checkLogin(0),
            'categoryList' => Category::getParentChild(),
        ]);
    }
    
}

?>