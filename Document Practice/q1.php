<?php 
	if(isset($_GET['no']) && !empty($_GET['no']))
	{
		$no = $_GET['no'];
		$fact = 1;
		for ($i = $no; $i > 0; $i--) {
			$fact = $fact * $i;	
		}
		
		echo "Factorial of ".$no." is : ".$fact;
	}
	else
	{
		echo "Please Enter Valid Number";
	}	
?>
<form>
	<input type="text" name="no">
	<input type="submit" name="submit" value="Print">
</form>