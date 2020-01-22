<?php 
	if(isset($_GET['no']) && !empty($_GET['no']))
	{
		$sum = 0;
		$originalNo=$_GET['no'];
		$no = $_GET['no'];
		while($no > 1) {
			$d = $no % 10;
			$sum = $sum + $d * $d * $d;
			$no = $no / 10;
		}
		if(strcmp($sum,$no))
		{
			echo $originalNo." is Armstrong No ";
		}
		else
		{
			echo $originalNo." is Not Armstrong No ";	
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