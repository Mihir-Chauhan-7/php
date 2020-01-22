<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	$sum = 1;
	for($i = 1; $i <= $no; $i++)
	{
		for($j = 0; $j < $i; $j++)
		{
			echo $sum;
			$sum++;	
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