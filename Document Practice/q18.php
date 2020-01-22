<?php

$numberArray = array(2,10,50,-80,2);
$num = range(1, 100);
findMin($numberArray);
findMin($num);
function findMin($array)
{
	$min = $array[0];
	for ($i = 0; $i <sizeof($array) ; $i++) 
	{	 
		if($array[$i] < $min)
		{
			$min = $array[$i];
		}
	}
	echo "<br>Smallest No From Array is : ".$min ;
}



?>