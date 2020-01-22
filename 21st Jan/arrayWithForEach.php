<?php

$charArray = range('A', 'Z');//range function to generate array of A to Z
$asciiArray = Array();
print_r($charArray);//prints array element with index

echo "<br>Print Array Using For Loop<br>";
for ($i = 0; $i < sizeof($charArray); $i++) 
{ 	
	echo $charArray[$i]."<br>";
	$asciiArray[$charArray[$i]]=ord($charArray[$i]);//to store ascii value and char as key

	//ord for converting chat into its ascii value
}
foreach ($charArray as $key => $value)//Using For Each Loop 
{
	echo "[".$key."]=>".$value;
}

print_r($asciiArray);//associative array

$userArray=array(array("name" => "Abc","age" => 21),array("name" => "Xyz","age" => 22));
echo "<br>Multi-Dimensional Array<br>";
print_r($userArray);
foreach ($userArray as $userArray => $value) { //value is single array from User Array
	echo "<br>User : ".$userArray;
	foreach ($value as $userAttribute => $userAttributeVal) {//userAttribute is key and userAttributeVal is value of that key.
			echo "<br>"." ".$userAttribute." ".$userAttributeVal;
	}
}
?>