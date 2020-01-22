<?php

preg_match('/(preg)(_)(match)/', "This is Example of preg_match",$result);
print_r($result);
echo "<br>";
preg_match('/(preg)(_)(match)/', "This is Example PCRE of preg_match",$result,PREG_OFFSET_CAPTURE);
print_r($result);//With Offset
echo "<br>";
preg_match("/pcre/i", "This is Example PCRE of preg_match",$result,PREG_OFFSET_CAPTURE);
print_r($result);//Case insensitive Match
echo "<br>";
preg_match("/\bscript\b/", "Php is contains script it is scripting lang",$result,PREG_OFFSET_CAPTURE);
print_r($result);//To find specif word like "script" not "script ing"
echo "<br>";

?>