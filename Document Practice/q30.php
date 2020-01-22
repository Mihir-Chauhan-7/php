<?php

$nameFirst = "JOHN";
$nameSecond = "SMITH";
$len = strlen($nameFirst) > strlen($nameSecond) ? strlen($nameFirst) : strlen($nameSecond);
$str = "";
	for ($i = 0; $i < $len; $i++) 
	{ 
		if($i >= strlen($nameFirst))
		{
			$str = $str.$nameSecond[$i];
		}
		else if($i >= strlen($nameSecond))
		{
			$str = $str.$nameFirst[$i];
		}
		else
		{
			$str = $str.($nameFirst[$i].$nameSecond[$i]);
		}	
				
	}
	echo "String : ".$str;

?>
<form>
	<input type="text" name="stringOne">
	<input type="text" name="stringTwo">
	<input type="submit" name="Concate">
</form>