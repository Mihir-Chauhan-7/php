<?php 

echo "Before Die Function<br>";

//die("<br>Page Died");

//echo "<br>After Die Function";

@mysqli_connect("localhost","root1","") or die("Not Connected");

echo "Connected";
?>