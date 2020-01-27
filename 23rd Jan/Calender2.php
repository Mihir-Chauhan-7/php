<?php
	session_start();
	if(isset($_POST['btnsend']))
	{
		ob_start();
		calender();
		$buffer=ob_get_clean();
		echo "Send Email";
			$to="chauhanmihir51@gmail.com";
			$subject="Calender";
			$body=$buffer;
			$headers = "MIME-Version: 1.0" . "\r\n"; 
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
			$headers .='Cc: chauhanmihir51@gmail.com';
			if(mail($to,$subject,$body,$headers))
			{
				echo "<br><strong>Email Send Successful</strong>";
			}
			else 
			{
				echo "<br>Failed";
			}
	}
	else
	{
		calender();
	}

	function calender()
	{
		echo "<!DOCTYPE html>
		<html lang='en'>

		<head>
			<title>Calender</title>
			<style>
				table th {
					padding: 5px;
					background-color: rgb(77, 77, 255);
					color: rgb(230, 230, 255)
				}

				tr:first-child th {
					background-color: rgb(0, 0, 77);
					color: rgb(230, 230, 255)
				}

				table td {
					border-color: black;
					background-color: rgb(214, 214, 245);
					width: 35px;
				}

				table td:last-child {
					font-weight: bold
				}
			</style>
		</head><body>
		";
		if (isset($_POST['year']) && isset($_POST['smonth']) && isset($_POST['emonth'])) 
		{
			if (!empty($_POST['year']) && !empty($_POST['smonth']) && !empty($_POST['emonth'])) 
			{
			$year = $_POST['year'];
			$startMonth = $_POST['smonth'];
			$endMonth = $_POST['emonth'];
			$_SESSION['year'] = $year;
			$_SESSION['smonth'] = $startMonth;
			$_SESSION['emonth'] = $endMonth;
			unset($_SESSION['imagePath']);
			if (isset($_FILES['image'])) 
			{
				$name = $_FILES['image']['name'];
				$size = $_FILES['image']['size'];
				$type = $_FILES['image']['type'];
				$tmpname = $_FILES['image']['tmp_name'];
				$extension = substr($name, strpos($name, '.') + 1);

				if (!empty($name) && $extension == 'jpg') 
				{
					if (move_uploaded_file($tmpname, 'uploads/' . $name))
					 {
						$path = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/uploads/" . $name;
						echo "<img style=' display: block; margin: auto; width: 50%; height: auto;' src='" . $path . "' /><hr>";
						$_SESSION['imagePath'] = $path;
					} 
					else 
					{
						echo "Upload Failed";
					}
				} 
				else 
				{
					echo "<br><strong>Please Select jpeg File</strong><br>";
				}
			}
			printMonth($year, $startMonth, $endMonth);
		}
		else
		{
			if (isset($_SESSION['year']) && isset($_SESSION['smonth']) && isset($_SESSION['emonth']))
			{	
				if(isset($_SESSION['imagePath']))
				{
					echo "<img style=' display: block; margin: auto; width: 50%; height: auto;' src='" . $_SESSION['imagePath'] . "' alt='img' /><hr>";
				}
				printMonth($_SESSION['year'], $_SESSION['smonth'], $_SESSION['emonth']);
			}
		else
		{
			echo "Year And Month Not Found";
		}		
	}
}

	echo "</body></html>";
	}


	function printMonth($year, $startMonth, $endMonth)
	{
		echo "<h1 style='text-align: center; '>Calender " . $year . "</h1>";
		echo "<div style='text-align : center;'>";
		for ($i = $startMonth; $i <= $endMonth; $i++) {

			displayCalender($year, $i);
		}
		echo "</div>";
	}
	function displayCalender($year, $month)
	{
		$number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
		$arr = (getdate(strtotime($year . "-" . $month . "-" . "1")));
		$offset = $arr['wday'] - 1;
		if ($offset < 0) {
			$offset += 7;
		}


		echo "<div style='display: inline-flex; '>";
		echo "<table style='margin:10px;'>";
		echo "<thead>";
		echo "<tr><th colspan=7>" . $arr['month'] . " - " . $year . "</th></tr>";
		echo "<tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>";
		echo "</thead>";
		echo "<tbody><tr>";
		for ($j = 0; $j < $offset; $j++) {
			echo "<td></td>";
		}
		for ($i = 1; $i <= $number; $i++) {
			$offset++;
			echo "<td>" . $i . "</td>";
			if ($offset % 7 == 0 && $number != $i) {
				echo "</tr><tr>";
			}
		}
		while ($offset % 7 != 0) {
			$offset++;
			echo "<td></td>";
		}
		echo "</tr></tbody></table></div>";
	}
?>

<form method="POST" enctype="multipart/form-data">
	<fieldset>
		<legend>Calender</legend>
			<input type="text" name="year" placeholder="Year"><br><br>
			<input type="text" name="smonth" placeholder="Start Month"><br><br>
			<input type="text" name="emonth" placeholder="End Month"><br><br>
			<input type="file" name="image"><br><br>
			<input type="submit" value="Show" name="btnshow">
			<input type="submit" value="Send" name="btnsend">
	</fieldset>
</form>
