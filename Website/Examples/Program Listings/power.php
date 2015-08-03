<?php
	include("dbcon.php");
	if (isset($_POST['Submit']) ) ;// when submit button is pressed
	{
		$New_power= $_POST['New_power'];
		$query1= "SELECT * FROM temp_values ORDER BY `Time` DESC LIMIT 1"; //retrieve latest value from database table
		$result1 = mysql_query($query1);
		$rows = mysql_num_rows($result1);   
 		
		//insert database values into variables
 		for ($j= 0 ; $j < $rows ; ++$j)
		{
			$New_temp = mysql_result($result1,$j, 'New_temp');
			$Target_temp = mysql_result($result1,$j, 'Target_temp');
			$Measured_temp=mysql_result($result1,$j, 'Measured_temp');
			if (!$result1) die ("Database access failed:" . mysql_error());
		}
		
		// Insert values into the database
		$query= "INSERT INTO temp_values (New_power,New_temp,Target_temp,Measured_temp) VALUES ('$New_power','$New_temp','$Target_temp','$Measured_temp')";
		$result = mysql_query($query);
		//Remain on the main page
		header("location:index.php");
	}
?>