<?php

namespace App\Controllers;

use Core\View;

class Home extends \Core\Controller {

    public function index(){
        //echo "<br>Hello From The Index Action in Home Controller";
        // View :: render('Home/index.php',[
        //     'name' => 'Mihir',
        //     'colours' => ['red','green','blue']
        // ]);
        View::renderTemplate('Home/index.html',[
            'name' => 'Mihir',
            'colours' => ['red','green','blue']
        ]);
    }
    
}

?>