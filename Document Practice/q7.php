<?php

if(isset($_GET['no1']) && isset($_GET['no2']))
{
	if(!empty($_GET['no1']) && !empty($_GET['no2']))
	{
		$no1=$_GET['no1'];
		$no2=$_GET['no2'];
		echo "HCF of ".$no1." and ".$no2." is : ".calculateHCF($no1,$no2);
	}
}
function calculateHCF($number1,$number2)
{
	if($number1==0)
	{
		return $number2;
	}
	else if($number2==0)
	{
		return $number1;
	}
	else if($number1==$number2)
	{
		return $number1;
	}
	else if($number1>$number2)
	{
		return calculateHCF($number1-$number2,$number2);
	}
	else if($number2>$number1)
	{
		return calculateHCF($number1,$number2-$number1);
	}
}



//lcm=a*b/hcf(a,b);
?>
<form>
	<input type="text" name="no1">
	<input type="text" name="no2">
	<input type="submit" name="Calculate">
</form>