<?php 
	if(isset($_GET['no1']) && isset($_GET['no2']))
	{
		if( !empty($_GET['no1']) && !empty($_GET['no2']))
		{
			$no1 = $_GET['no1'];
			$no2 = $_GET['no2'];
			echo "Before Swapping<br> No 1 : ".$no1."<br> No 2 : ".$no2;

			$tmp = $no1;
			$no1 = $no2;
			$no2 = $tmp;

			echo "<br><br>After Swapping<br> No 1 : ".$no1."<br> No 2 : ".$no2;	
		}
	}
	else
	{
		echo "Please Enter Valid Numbers";
	}	
?>
<form>
	<input type="text" name="no1">
	<input type="text" name="no2">
	<input type="submit" name="submit" value="Print">
</form>