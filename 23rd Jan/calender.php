<style type="text/css">
	table { border: 2px solid }
	table th { padding: 3px;border: 1px solid; border-color: black; background-color: rgb(77, 77, 255); color: rgb(230, 230, 255) }
	tr:first-child th { background-color: rgb(0, 0, 77); color: rgb(230, 230, 255)  }
	table td {border: 1px solid; border-color: black; background-color: rgb(214, 214, 245); }
</style>

<?php
	session_start();
	
	if(isset($_GET['year']) && isset($_GET['smonth']) && isset($_GET['emonth']))
	{
		if (!empty($_GET['year']) && !empty($_GET['smonth']) && !empty($_GET['emonth']) ) {
			
			$year = $_GET['year'];
			$startMonth = $_GET['smonth'];
			$endMonth = $_GET['emonth'];
			$_SESSION['year'] = $year;
			$_SESSION['smonth'] = $startMonth;
			$_SESSION['emonth'] = $endMonth;
			printMonth($year,$startMonth,$endMonth);
		}
		else
		{
			echo "Enter Valid Year And Month";
		}
	}
	else
	{
		if(isset($_SESSION['year']) && isset($_SESSION['smonth']) && isset($_SESSION['emonth']))
			{
				printMonth($_SESSION['year'],$_SESSION['smonth'],$_SESSION['emonth']);
			}
			else
			{
				echo "Enter Valid Year And Month";
			}
	}

	
function printMonth($year,$startMonth,$endMonth)
{
	for ($i = $startMonth; $i <= $endMonth ; $i++) { 
		
		displayCalender($year,$i);
	}
	
}
function displayCalender($year,$month)
{
			$number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
			$arr = (getdate(strtotime($year."-".$month."-"."1")));
			$weekDay = $arr['wday'];
			echo "<table style='display :inline-flex; margin:10px'>
			<tr><th colspan=7>" . $arr['month'] . " " . $year ."</th></tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th><tr>";
			startPrinting($weekDay);
			$no = 7 - ($weekDay - 2);
			if($no > 7)
			{
				$no = 8;
			}
			for ($i = 1; $i <= $number ; $i++) {

					if($i == $no || $i == ($no + 7))
					{
						echo "</tr><tr>";
						$no = $i;
					}
					echo "<td align='center'>" . $i . "</td>";
			}
			while ($no % 7 != 0) {
					$no++;
					echo "<td></td>";
				}
			echo "</tr></table>";
		}
function startPrinting($weekDay)
{
	for ($j = 1; $j < $weekDay ; $j++) { 
		echo "<td></td>";
	}
}
function sendCalender()
{
	echo "Send";
}

?>
<fieldset><legend>Calender</legend>
<form>
	<input type="text" name="year" placeholder="Year"><br><br>
	<input type="text" name="smonth" placeholder="Start Month"><br><br>
	<input type="text" name="emonth" placeholder="End Month"><br><br>
	<input type="submit" value="Show">
	<input type="button" onclick="<?php sendCalender(); ?>" value="Send">	
</form>
</fieldset>