<?php

$str = "This is String";
$strLength = strlen($str);

for ($i = 0; $i < $strLength; $i++) { 
	echo $str[$i]."<br>";
}

echo "<br>".strtoupper($str);
echo "<br>".strtolower($str);

echo "<br>Position of is : ".strpos($str, "is",3);//Third argument is for offset from where searching starts

?>
