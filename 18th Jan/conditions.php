<?php 
	if(1)
	{
		//1 or >1 or string with 1 char
		echo "True";
	}
	else
	{
		//Null or 0 or empty string 
		echo "False";
	}


?><br>
<?php 
	
	if(/* 1 === 1.0 */1 === '1' )
	{
		//if datatype and both sides are same
		echo "True";
	}
	else
	{	
		//if datatype is diffrent or both side are diffrent
		echo "False";
	}


?><br>
<?php 
	
	$uname = 'Mihir';
	$upass = 'mihir@123';
	if($uname == 'Mihir' && $upass == 'mihir@123')
	{
		//if datatype and both sides are same
		echo "Success";
	}
	else
	{	
		//if datatype is diffrent or both side are diffrent
		echo "Failed";
	}


?>
<br>
<?php 
	$no = 10;
	if($no == 1)
	{

		echo "No is 1";
	}
	else if($no == 2)
	{
	
		echo "No is 2";
	}
	else
	{
		echo "No Not Found";
	}
?>
