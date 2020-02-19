<?php

namespace App\Controllers;
use Core\View;

class Cart extends \Core\Controller {

    public function index(){
        $cartObj=(array) json_decode($_POST['cartObj']);
        print_r($cartObj);
    }
    
}

?>