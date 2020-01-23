<?php

$no=10;
	for($i=1;$i<$no+1;$i++)
	{
		
		if($i==1)
		{
			printStar();
			printSpaces((($no*2)-2)/2);
			printStar();
			printSpaces((($no*2)-2)/2);	
			printStar();	
		}
		if($i>1 && $i<$no-1)
		{
		printStar();
		printSpaces($no-$i);
		printStar();
		printSpaces($i-1);
		//printStar();	
		
		printSpaces($i);
		printStar();
		printSpaces($no-$i);
		printStar();	
		}
		if($i==$no-1)
		{
			printStar();
			printSpaces(($no*2)-2);	
			printStar();	
		}
		
		echo "<br>";
	}
function printStar()
{
	echo "*";
}
function printSpaces($no)
{
	$j=1;
	while ($j < $no) {
		echo "&nbsp&nbsp";
		$j++;
	}
	// for ($j=1; $j <$no ; $j++) { 
	// 			echo "&nbsp&nbsp";
	// 		}
}
?>