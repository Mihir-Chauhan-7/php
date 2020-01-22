<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	for($i = 1; $i <= $no + 1; $i++)
	{
		echo "<table border=1><tr>";
		for($j = 1; $j <= $no; $j++)
		{
			echo "<td style='width :60px'>".$i." * ".$j."=".($i * $j)."</td>";
		}
		echo "</tr></table>";
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