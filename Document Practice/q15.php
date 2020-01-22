<?php

$numberArray = array(-100,-10,-50,-80,-20);
$num = range(1, 100);
findMax($numberArray);
findMax($num);
function findMax($array)
{
	$max = $array[0];
	for ($i = 0; $i < sizeof($array) ; $i++) 
	{	 
		if($array[$i] > $max)
		{
			$max = $array[$i];
		}
	}
	echo "<br>Biggest No From Array is : ".$max ;
}



?>