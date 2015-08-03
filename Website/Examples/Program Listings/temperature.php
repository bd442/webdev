<?php
	include("dbcon.php");
	if (isset($_POST['Submit']) ) ;// when submit button is pressed
	{
		$New_temp= $_POST['New_temp'];
		$query2= "SELECT * FROM temp_values ORDER BY `Time` DESC LIMIT 1"; //retrieve latest value from database table
		$result1 = mysql_query($query2);
		$rows = mysql_num_rows($result1); 
  
  		//insert database values into variables
 		for ($j= 0 ; $j < $rows ; ++$j)
		{
			$New_power = mysql_result($result1,$j, 'New_power');
			$Target_temp = mysql_result($result1,$j, 'Target_temp');
			$Measured_temp=mysql_result($result1,$j, 'Measured_temp');
			if (!$result1) die ("Database access failed:" . mysql_error());
		}
		
		// Insert values into the database
		$query= "INSERT INTO temp_values (New_power,New_temp,Target_temp,Measured_temp) VALUES ('$New_power','$New_temp','$Target_temp','$Measured_temp')";
		$result = mysql_query($query);
		//Go back to the main page
		header("location:index.php");
	}
?>