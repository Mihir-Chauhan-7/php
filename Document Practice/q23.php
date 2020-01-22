<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	for($i = 0; $i < $no; $i++)
	{
		echo "<table border=1><tr>";
		for($j = 0; $j < $no; $j++)
		{
			if($j % 2 == 0)
			{
				echo "<td>&nbsp&nbsp&nbsp&nbsp</td>";
			}	
			else
			{
				echo "<td style='background-color: black'>W</td>";
			}
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