<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	for($i = 1; $i <= $no; $i++)
	{
		echo "<table border=1><tr>";
		for($j = 1; $j <= $no; $j++)
		{
			echo "<td style='width : 25px'>".($i * $j)."</td>";
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