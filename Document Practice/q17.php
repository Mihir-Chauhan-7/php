<?php
$numArray = array(1,3,5,2,7,4,6);
$n = sizeof($numArray);

for ($i = 0; $i < $n - 1 ; $i++) 
{ 
	for ($j = 0; $j < $n - $i - 1 ; $j++) 
	{
		if($numArray[$j] > $numArray[$j + 1])
		{
			$tmp = $numArray[$j];
			$numArray[$j] = $numArray[$j+1];
			$numArray[$j + 1] = $tmp;
		}	
	}
}
echo "pre";
print_r($numArray);

?>