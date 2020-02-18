<?php

namespace Core;
use Twig;

// use Twig_Loader_Filesystem;
// use Twig_Environment;

class View{

    public static function render($view,$args){
        extract($args,EXTR_SKIP);

        $file = "../App/Views/$view";

        if(is_readable($file)){
            require $file;
        }
        else{
            //echo "$file not found";
            throw new \Exception("$file Not Found");
        }
    }
    public static function renderTemplate($template,$args = []){
        static $twig = null;

        if($twig === null){
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
            isset($_SESSION['message']) ? $twig->addGlobal('session',$_SESSION['message']):"";
            unset($_SESSION['message']);
        }
        echo $twig->render($template,$args);
    }
} 
?>


