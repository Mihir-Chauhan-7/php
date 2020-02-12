<?php

namespace Core;

class Error{

    public static function errorHandler($level,$message,$file,$line){
        if(error_reporting() !== 0){
            throw new \ErrorException($message,0,$level,$file,$line);
        }
    }

    public static function exceptionHandler($exception){
        $code = $exception->getCode();
        if($code != 404){
            $code = 500;
        }
        http_response_code($code);

        if(\App\Config::SHOW_ERROR){
            echo "<h1>Fatal Error</h1>";
            echo "<p>Uncaught Exception : '" . get_class($exception) . "'</p>";
            echo "<p>Message : " . $exception->getMessage() . "</p>";
            echo "<p>Stack Trace : <pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in : " . $exception->getFile() . " On Line "
                . $exception->getLine() . "</p>";
        }
        else{
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log',$log);
            $message = "Uncaught Exception : '" . get_class($exception)."'";
            $message .= "Message : '" . $exception->getMessage()."'";
            $message .= "\nStack Trace : " . $exception->getTraceAsString();
            $message .= "\nThrown in : " . $exception->getFile() . " On Line "
                .$exception->getLine();
            $message .= "\n" . str_repeat("_",135) . "\n";
            error_log($message);
            
            //echo $code == 404 ? "<h1>Page Not Found</h1>" : "<h1>An Error Occured</h1>"; 
            View::renderTemplate("$code.html");
        }
        
        
    }
}

?>