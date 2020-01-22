<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	$sum = 0;
	for($i = 1; $i <= $no; $i++)
	{
		$sum = $i + $sum;
		for($j = 1; $j <= $sum; $j++)
		{
			echo "*";
				
		}
		for ($k = 1; $k <= $i; $k++) { 
			echo "0";
		}
		echo "<br>";
	}	
}
else
{
	echo "Please Enter Any No";
}



?>
<form>
	<input type="text" name="no">
	<input type="submit" value="Print">
</form>