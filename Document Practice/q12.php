<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	for($i = 0; $i < $no; $i++)
	{
		for($j = 0; $j <= $i; $j++)
		{
			echo $j + 1;
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