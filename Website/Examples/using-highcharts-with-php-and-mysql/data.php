<?php
$con = mysqli_connect("localhost","root","Badinka","gwp");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$minDate = $_GET["firstdate"];
$maxDate = $_GET["seconddate"];

$query = "SELECT * FROM `gwp_medway_campus_chp_data` where `Time_Stamp` BETWEEN ". "'" . $minDate . "'" . " AND ". "'" . $maxDate . "'" . "";
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

