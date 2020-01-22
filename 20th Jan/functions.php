<?php 

function printName($name)
{
	//echo "Abc";
	echo "Your Name is ".$name;
}

printName("Mihir");

function calculation($num1,$num2)
{
	$sum = $num1 + $num2;
	return $sum;
}

echo "<br>Ans is :".calculation(10,20);

$max = 10;
function recursion($no)
{
	global $max;//use of global variable inside function
	if($no <= $max)
	{
		echo "<br>No ".$no;
		recursion($no + 1);
	}
	
}
recursion(1);

?>
