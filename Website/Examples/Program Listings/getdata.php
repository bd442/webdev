<?php
 //header("Refresh: 5;");
 include("dbcon.php");
 //retrieve values from database
 $query= "SELECT * FROM temp_values ORDER BY `Time` DESC LIMIT 1";
 $result = mysql_query($query);
 $rows = mysql_num_rows($result); 
 
 //insert values into the variables 
 for ($j= 0 ; $j < $rows ; ++$j)
{
	$New_power = mysql_result($result,$j, 'New_power');
	$New_temp = mysql_result($result,$j, 'New_temp');
	$Target_temp = mysql_result($result,$j, 'Target_temp');
	$Measured_temp = mysql_result($result,$j, 'Measured_temp');
if (!$result) die ("Database access failed:" . mysql_error());// check database access
}
?>