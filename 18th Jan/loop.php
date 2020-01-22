<?php 
	$count = 1;
	echo "Simple While <br>";
	while($count <= 10)
	{
		echo " ".$count;
		$count += 1;
	}
	$count = 1;
	echo "<br> Do While <br>";
	do{
		echo " ".$count;
		$count += 1;	
	}while ($count <= 10)
?><br>
<?php
	$no = 10;
	echo "<br> For Loop <br>";
	for($i = 1;$i <= 10;$i++)
	{
		$ans = $no * $i;
		echo $ans.'	<br>';
	}
?>
<br>
<?php 
	$num = 4;
	echo "<br>Switch Case<br>";
	switch($num)
	{
		case 1 :
			echo "No 1";
		break;
		case 2 :
			echo "No 2";
		break;
		case 3 :
			echo "No 3";
		break;
		case 4 :
			echo "No 4";
		break;
		default :
			echo "No Not Found";
		break;
	}
?>