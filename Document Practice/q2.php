<?php

$prev = 1;
$next = 0;
	if(isset($_GET['no']) && !empty($_GET['no']))
	{
		$no = $_GET['no'];
		echo "Fibonacci Series";
		for ($i = 0; $i < $no ; $i++) 
		{ 
			$tmp = $next;
			$next = $prev + $next;
			$prev = $tmp;
			echo "<br>".$prev;
		}
	}
	else {
		echo "Please Enter Valid No";
	}


?>
<form>
	<input type="text" name="no">
	<input type="submit" value="Print">
</form>