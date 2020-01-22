<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	for($i = 1; $i <= $no; $i++)
	{
		$sum = $i;
		echo $sum." ";
		for($j = 1; $j < $no - 1; $j++)
		{
			echo ($sum += 4)." ";	
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