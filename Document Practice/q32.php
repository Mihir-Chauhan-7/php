<?php

$numberArray = range(1, 100);

$max = $numberArray[0];
$secondMax = $max;

for ($i = 0; $i < sizeof($numberArray); $i++)
{ 
	if($numberArray[$i] > $secondMax)
	{
		$secondMax = $numberArray[$i];
		if($secondMax > $max)
		{
			$tmp = $max;
			$max = $secondMax;
			$secondMax = $tmp;
		}
	}
}
echo "Second Max ".$secondMax;

?>