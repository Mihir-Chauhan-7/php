<?php 
	if(isset($_GET['year']) && !empty($_GET['year']))
	{
		$year = $_GET['year'];
		if($year % 4 == 0)
		{
			echo $year." is Leap Year ....";
		}
		else
		{
			echo $year." is Not Leap Year ....";			
		}
	}
	else
	{
		echo "Please Enter Valid Year";
	}	
?>
<form>
	<input type="text" name="year">
	<input type="submit" name="submit" value="Print">
</form>