<?php 

$str = ".&nbspThis is Example String.&nbsp&nbsp.";
echo "Shuffled String : ".str_shuffle($str);

$half_str = substr($str, 0,strlen($str) / 2);

echo "<br>Half String : ".$half_str;

echo "<br>Reversed : ".strrev($str);


$str1 = "This is Another String";

similar_text($str, $str1,$result);
echo "<br>Similar Text : ".$result;

echo "<br>Trim :".trim($str,".");

echo "<br>String length : ".strlen($str);

$str_slashes = htmlentities(addslashes("<img src='abc.jpg'>"));
echo "<br>".$str_slashes;
$str_slashes = htmlentities(addcslashes("<img src='abc.jpg'>","g"));
echo "<br>".$str_slashes;
?>