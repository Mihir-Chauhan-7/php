<?php

$no=10;
	for($i=1;$i<$no;$i++)
	{
		if($i==1)
		{
			printStar();
			printSpaces(($no+$no)-($i+$i)+2);	
			printStar();
		}
		if($i>1 && $i<$no-1)
		{
			printStar();
			printStars($i);
			printStar();	
			printSpaces(($no+$no)-($i+$i));
			printStar();
			printStars($i);
			printStar();
		}
		if($i==$no-1)
		{
			printStar();

			printStars(($no-3)+3);
			printStar();
			printStars(($no-3)+3);
			printStar();
		}
		
		echo "<br>";
	}
	
	for($i=1;$i<$no+1;$i++)
	{
		
		if($i==1)
		{
			printStar();
			printStars((($no*2)-1)/2);
			printStar();
			printStars((($no*2)-1)/2);	
			printStar();	
		}
		if($i>1 && $i<$no-1)
		{
		printStar();
		printStars($no-$i);
		printStar();
		printSpaces($i+1);
		//printStar();	
		
		printSpaces($i);
		printStar();
		printStars($no-$i);
		printStar();	
		}
		if($i==$no-1)
		{
			printStar();
			printSpaces(($no*2));	
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
function printStars($no)
{
	$j=1;
	while ($j < $no) {
		echo "*";
		$j++;
	}
	// for ($j=1; $j <$no ; $j++) { 
	// 			echo "&nbsp&nbsp";
	// 		}
}


?>