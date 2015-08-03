<?php
 $db_hostname='localhost'; // Server IP Address Or Name
 $db_database='labtools'; // Database Name
 $db_username='root'; // User ID
 $db_password='lab123';// Password
 
 $db_server = mysql_connect($db_hostname,$db_username,$db_password); //Create connection
 if (!$db_server) die ("unable to connect to MySQL: " . mysql_error()); // check connection
 $database = mysql_select_db($db_database) 
    or die("unable to select database: " . mysql_error());
?>