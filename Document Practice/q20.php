<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	function printStar($num)
	{
		for ($i = 1; $i <= $num ; $i++) 
		{ 
			echo "*";
		}
	}
	function printSpaces($spaces)
	{
		for ($j = 1; $j <= $spaces; $j++) 
		{ 
			echo "&nbsp&nbsp";
		}
	}
	for($i = 1; $i <= $no; $i++)
	{
		if($i == 1 || $i == $no)
		{
			printStar($no);	
		}
		else
		{
			printStar(1);
			printSpaces($no-2);
			printStar(1);
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