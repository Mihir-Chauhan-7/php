<?php

namespace Core;

class Error{

    public static function errorHandler($level,$message,$file,$line){
        if(error_reporting() !== 0){
            throw new \ErrorException($message,0,$level,$file,$line);
        }
    }

    public static function exceptionHandler($exception){
        echo "<h1>Fatal Error</h1>";
        echo "<p>Uncaught Exception : '".get_class($exception)."'</p>";
        echo "<p>Message : ".$exception->getMessage()."</p>";
        echo "<p>Stack Trace : <pre>".$exception->getTraceAsString()."</pre></p>";
        echo "<p>Thrown in : ".$exception->getFile()." On Line "
            .$exception->getLine()."</p>";
    }
}

?>