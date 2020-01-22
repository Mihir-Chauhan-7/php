<?php 
	if(isset($_GET['no']) && !empty($_GET['no']))
	{
		$no = $_GET['no'];
		echo "Factors of ".$no."<br>";
		for ($i = 1; $i <= $no; $i++) 
		{
			if($no % $i == 0)
			{
				echo $i.",";		
			}
			
		}
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