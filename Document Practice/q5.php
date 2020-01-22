<?php

	if(isset($_GET['no']) && !empty($_GET['no']))
	{
		$factor = 0;
		$no = $_GET['no'];
		for($i = 1; $i <= $no; $i++)
		{
			if($no % $i == 0)
			{
				$factor++;
			}
		}	

		if($factor == 2)
		{
			echo $no." is Prime No";
		}
		else
		{
			echo $no." is Not a Prime No";	
		}
	}
	else 
	{
		echo "Please Enter Valid No";
	}


?>
<form>
	<input type="text" name="no">
	<input type="submit" value="Print">
</form>