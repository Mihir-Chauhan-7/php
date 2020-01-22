<?php
if(isset($_GET['no']) && !empty($_GET['no']))
{
	$no = $_GET['no'];
	for ($i = 1; $i <= 10; $i++) { 
			echo $no." x ".$i." = ".( $no * $i )."<br>";
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