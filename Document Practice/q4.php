<?php 
	if(isset($_GET['no']) && !empty($_GET['no']))
	{
		$rev=0;
		$no = $_GET['no'];
		while($no > 1) {
			$d=$no % 10;
			$rev=($rev*10) +$d;
			$no =$no/10;
		}
		echo $rev;
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