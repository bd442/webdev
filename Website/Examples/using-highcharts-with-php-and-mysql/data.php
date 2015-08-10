<?php
$con = mysqli_connect("localhost","root","Badinka","gwp");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$query = "SELECT * FROM `gwp_medway_campus_chp_data` where `Time_Stamp` BETWEEN '2013-04-12 04:00:00' AND '2013-04-12 04:01:00'";
$result = mysqli_query($con, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

while($row = mysqli_fetch_array($result)) {
  echo $row['Time_Stamp'] . "\t" . $row['Total_kWh']. "\n";
}

mysqli_close($con);
?> 
