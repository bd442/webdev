<?PHP
//  This code will deal with importing the CSV file data into the actual database

ini_set('auto_detect_line_endings', true);

// Connect to the database (server, user, password)
$connect = mysql_connect('localhost','gwp-admin','p');

if(!$connect) {   
	echo "Database Login failed! Please make sure that the DB login credentials provided are correct \n";
}

// Select the appropriate database
if (!mysql_select_db('gwp',$connect)){
	echo "DB not selected \n";
}
	
$fields = array(	"Time_Stamp",
    				"Engine_RPM",
    				"Engine_Power_kWe",
    				"Oil_Pressure",
    				"Oil_Temperature",
    				"Primary_Coolant_Temperature",
    				"Primary_Coolant_Pressure",
					"Water_Temperature_Pre_After_Cooler",
					"Water_Temperature_Post_After_Cooler",					
					"Inlet_Air_Temperature_Pre_Turbocharger_Left",
					"Inlet_Air_Temperature_Pre_Turbocharger_Right",
					"Inlet_Air_Temperature_Pre_After_Cooler_Left",
					"Inlet_Air_Temperature_Pre_After_Cooler_Right",
					"Inlet_Air_Temperature_Post_After_Cooler_Left",
					"Inlet_Air_Temperature_Post_After_Cooler_Right",
					"Inlet_Air_Manifold_Pressure_Left",
					"Inlet_Air_Manifold_Pressure_Right",
					"Exhaust_Temperature_Pre_Turbo_Left",
					"Exhaust_Temperature_Pre_Turbo_Right",
					"Exhaust_Temperature_Post_Turbo_Left",
					"Exhaust_Temperature_Post_Turbo_Right",
					"Exhaust_Temperature_Post_Heat_Exchanger",
					"Exhaust_Back_Pressure",
					"Pre_SCR_Temperature",
					"Fuel_Pressure_Pre_Filter",
					"Fuel_Pressure_Post_Filter",
					"Fuel_Temperature_Pre_Fuel_Heater",
					"Fuel_Temperature_Post_Fuel_Heater",
					"Fuel_Tank_Temperature",
					"Main_Fuel_Tank_Level",
					"Start_Fuel_Tank_Level",
					"Total_kWh",
					"Tariff_1_kWh",
					"Tariff_2_kWh",
					"Tariff_3_kWh",
					"Mains_Voltage_L1",
					"Mains_Voltage_L2",
					"Mains_Voltage_L3",
					"Mains_Frequency",
					"Generator_Voltage_L1",
					"Generator_Voltage_L2",
					"Generator_Voltage_L3",
					"Generator_Frequency",
					"Generator_Amperage_L1",
					"Generator_Amperage_L2",
					"Generator_Amperage_L3",
					"Power_Factor_L1",
					"Power_Factor_L2",
					"Power_Factor_L3",
					"Secondary_Coolant_Pressure",
					"Secondary_Coolant_Post_Site_Heat_Exchanger_Temperature",
					"Secondary_Coolant_Pre_Exhaust_Gas_Heat_Exchanger_Temperature",
					"Secondary_Coolant_Post_Exhaust Gas_Heat_Exchanger_Temperature",
					"Kamstrup_kW",
					"Site_Flow_Temperature",
					"Site_Return_Temperature",
					"Site_Flow_Rate",
					"Acoustic_Chamber_N1_Temperature_Enclosure_1",
					"Acoustic_Chamber_N2_Temperature_Enclosure_1",
					"Acoustic_Chamber_Temperature_Enclosure_2",
			);
$buffer = array();

if(isset($_POST['submitted'])){
	if ($_FILES["csv_file_name"]["size"] > 0) {

    	//get the csv file
    	$file = $_FILES["csv_file_name"]["tmp_name"];
		$handle = fopen($file,"r");
		$columns = fgetcsv($handle,0,",");
		$i = 0;
		
	   	//loop through the csv file and insert into database
    	while ($data = fgetcsv($handle,0,",")) {
        	if ($data[0]) {
				// Check the values within the line to see whether they are in order (of correct type)
				$numbers = array(	$fields[0] 	=> Convert_Time_Format($data[0]),		/* Time_Stamp DATETIME NOT NULL */
									$fields[1]	=> Check_Int($data[1]),					/* Engine_RPM INT */
									$fields[2] 	=> Check_Float($data[2]),				/* Engine_Power_kWe FLOAT  */
									$fields[3]	=> Check_Float($data[3]),				/* Oil_Pressure FLOAT   */
									$fields[4]	=> Check_Int($data[4]),					/* Oil_Temperature INT  */
									$fields[5]	=> Check_Int($data[5]),					/* Primary_Coolant_Temperature INT */
									$fields[6]	=> Check_Float($data[6]),				/* Primary_Coolant_Pressure FLOAT */
									$fields[7]	=> Check_Float($data[7]),				/* Water_Temperature_Pre_After_Cooler FLOAT */
									$fields[8]	=> Check_Float($data[8]),				/* Water_Temperature_Post_After_Cooler FLOAT */
   									$fields[9] 	=> Check_Float($data[9]),				/* Inlet_Air_Temperature_Pre_Turbocharger_Left FLOAT */			
									$fields[10] => Check_Float($data[10]),				/* Inlet_Air_Temperature_Pre_Turbocharger_Right FLOAT */
									$fields[11] => Check_Float($data[11]),				/* Inlet_Air_Temperature_Pre_After_Cooler_Left FLOAT */
									$fields[12] => Check_Float($data[12]),				/* Inlet_Air_Temperature_Pre_After_Cooler_Right FLOAT */
									$fields[13] => Check_Float($data[13]),				/* Inlet_Air_Temperature_Post_After_Cooler_Left FLOAT */
									$fields[14] => Check_Float($data[14]),				/* Inlet_Air_Temperature_Post_After_Cooler_Right FLOAT */
									$fields[15] => Check_Float($data[15]),				/* Inlet_Air_Manifold_Pressure_Left FLOAT */
									$fields[16] => Check_Float($data[16]),				/* Inlet_Air_Manifold_Pressure_Right FLOAT */
									$fields[17] => Check_Int($data[17]),				/* Exhaust_Temperature_Pre_Turbo_Left INT */
									$fields[18] => Check_Int($data[18]),				/* Exhaust_Temperature_Pre_Turbo_Right INT */
									$fields[19] => Check_Int($data[19]),				/* Exhaust_Temperature_Post_Turbo_Left INT */
									$fields[20] => Check_Int($data[20]),				/* Exhaust_Temperature_Post_Turbo_Right INT */
									$fields[21] => Check_Float($data[21]),				/* Exhaust_Temperature_Post_Heat_Exchanger FLOAT */
									$fields[22] => Check_Float($data[22]),				/* Exhaust_Back_Pressure FLOAT */
									$fields[23] => Check_Int($data[23]),				/* Pre_SCR_Temperature INT */
									$fields[24] => Check_Float($data[24]),				/* Fuel_Pressure_Pre_Filter FLOAT */
									$fields[25] => Check_Float($data[25]),				/* Fuel_Pressure_Post_Filter FLOAT */
									$fields[26] => Check_Int($data[26]),				/* Fuel_Temperature_Pre_Fuel_Heater INT */
									$fields[27] => Check_Int($data[27]),				/* Fuel_Temperature_Post_Fuel_Heater INT */
									$fields[28] => Check_Int($data[28]),				/* Fuel_Tank_Temperature INT */
									$fields[29] => Check_Int($data[29]),				/* Main_Fuel_Tank_Level INT */
									$fields[30] => Check_Int($data[30]),				/* Start_Fuel_Tank_Level INT */
									$fields[31] => Check_Int($data[31]),				/* Total_kWh INT */
									$fields[32]	=> Check_Int($data[32]),				/* Tariff_1_kWh INT */
									$fields[33]	=> Check_Int($data[33]),				/* Tariff_2_kWh INT */
									$fields[34]	=> Check_Int($data[34]),				/* Tariff_3_kWh INT */
									$fields[35]	=> Check_Int($data[35]),				/* Mains_Voltage_L1 INT */
									$fields[36]	=> Check_Int($data[36]),				/* Mains_Voltage_L2 INT */
									$fields[37]	=> Check_Int($data[37]),				/* Mains_Voltage_L3 INT */
									$fields[38]	=> Check_Float($data[38]),				/* Mains_Frequency FLOAT */
									$fields[39]	=> Check_Int($data[39]),				/* Generator_Voltage_L1 INT */
									$fields[40]	=> Check_Int($data[40]),				/* Generator_Voltage_L2 INT */
									$fields[41]	=> Check_Int($data[41]),				/* Generator_Voltage_L3 INT */
									$fields[42]	=> Check_Float($data[42]),				/* Generator_Frequency FLOAT */
									$fields[43]	=> Check_Int($data[43]),				/* Generator_Amperage_L1 INT */
									$fields[44]	=> Check_Int($data[44]),				/* Generator_Amperage_L2 INT */
									$fields[45]	=> Check_Int($data[45]),				/* Generator_Amperage_L3 INT */
									$fields[46]	=> Check_Float($data[46]),				/* Power_Factor_L1 FLOAT */
									$fields[47]	=> Check_Float($data[47]),				/* Power_Factor_L2 FLOAT */
									$fields[48]	=> Check_Float($data[48]),				/* Power_Factor_L3 FLOAT */
									$fields[49]	=> Check_Float($data[49]),				/* Secondary_Coolant_Pressure FLOAT */
									$fields[50]	=> Check_Float($data[50]),				/* Secondary_Coolant_Post_Site_Heat_Exchanger_Temperature FLOAT */
									$fields[51]	=> Check_Float($data[51]),				/* Secondary_Coolant_Pre_Exhaust_Gas_Heat_Exchanger_Temperature FLOAT */
									$fields[52]	=> Check_Float($data[52]),				/* Secondary_Coolant_Post_Exhaust_Gas_Heat_Exchanger_Temperature FLOAT */
									$fields[53]	=> Check_Int($data[53]),				/* Kamstrup_kW INT */
									$fields[54]	=> Check_Float($data[54]),				/* Site_Flow_Temperature FLOAT */
									$fields[55]	=> Check_Float($data[55]),				/* Site_Return_Temperature FLOAT */
									$fields[56]	=> Check_Int($data[56]),				/* Site_Flow_Rate INT */
									$fields[57]	=> Check_Int($data[57]),				/* Acoustic_Chamber_N1_Temperature_Enclosure_1 INT */
									$fields[58]	=> Check_Int($data[58]),				/* Acoustic_Chamber_N2_Temperature_Enclosure_1 INT */
									$fields[59]	=> Check_Int($data[59]),				/* Acoustic_Chamber_Temperature_Enclosure_2 INT */
									);
				$buffer[$i++] = $numbers;
			}
    	} 
    	// If all lines are read in, then insert them all in one go into the database
				
		//Setting the options for the bulk insert
		if (!isset($options['query_handler'])) {
      		$options['query_handler'] = 'mysql_query';
  		}
  		if (!isset($options['trigger_errors'])) {
      		$options['trigger_errors'] = true;
  		}
  		if (!isset($options['trigger_notices'])) {
      		$options['trigger_notices'] = true;
  		}
  		if (!isset($options['eat_away'])) {
      		$options['eat_away'] = false;
  		}
  		if (!isset($options['in_file'])) {
      		// AppArmor may prevent MySQL to read this file.
      		// Remember to check /etc/apparmor.d/usr.sbin.mysqld
      		$options['in_file'] = '/dev/shm/infile.txt';
  		}
  		if (!isset($options['link_identifier'])) {
      		$options['link_identifier'] = null;
  		}
		
		// Make options local
  		extract($options);
		
		// Validation
  		if (!is_array($buffer)) {
      		if ($trigger_errors) {
          		trigger_error('First argument "queries" must be an array', E_USER_ERROR);
      		}
      		return false;
  		}
  		if (count($buffer) > 10000) {
      		if ($trigger_notices) {
          		trigger_error('It\'s recommended to use <= 10000 queries/bulk', E_USER_NOTICE);
      		}
  		}
  		if (empty($buffer)) {
      		return 0;
  		}
		
		// Inserts data only
        // Use array instead of queries
        $buf    = '';
        foreach($buffer as $i=>$row) {
			$buf .= implode(':::,', $row)."^^^\n";
        }

        //$fields = implode(', ', array_keys($row));

        if (!@file_put_contents($in_file, $buf)) {
        	$trigger_errors && trigger_error('Cant write to buffer file: "'.$in_file.'"', E_USER_ERROR);
            return false;
        }

		// Load the data into the database in one go !
		mysql_query("LOAD DATA LOCAL INFILE '${in_file}'
					INTO TABLE `gwp_medway_campus_chp_data`
					FIELDS TERMINATED BY ':::,'
             		LINES TERMINATED BY '^^^\\n'
             		(Time_Stamp,
    				Engine_RPM,
    				Engine_Power_kWe,
    				Oil_Pressure,
    				Oil_Temperature,
    				Primary_Coolant_Temperature,
    				Primary_Coolant_Pressure,
					Water_Temperature_Pre_After_Cooler,
					Water_Temperature_Post_After_Cooler,					
					Inlet_Air_Temperature_Pre_Turbocharger_Left,
					Inlet_Air_Temperature_Pre_Turbocharger_Right,
					Inlet_Air_Temperature_Pre_After_Cooler_Left,
					Inlet_Air_Temperature_Pre_After_Cooler_Right,
					Inlet_Air_Temperature_Post_After_Cooler_Left,
					Inlet_Air_Temperature_Post_After_Cooler_Right,
					Inlet_Air_Manifold_Pressure_Left,
					Inlet_Air_Manifold_Pressure_Right,
					Exhaust_Temperature_Pre_Turbo_Left,
					Exhaust_Temperature_Pre_Turbo_Right,
					Exhaust_Temperature_Post_Turbo_Left,
					Exhaust_Temperature_Post_Turbo_Right,
					Exhaust_Temperature_Post_Heat_Exchanger,
					Exhaust_Back_Pressure,
					Pre_SCR_Temperature,
					Fuel_Pressure_Pre_Filter,
					Fuel_Pressure_Post_Filter,
					Fuel_Temperature_Pre_Fuel_Heater,
					Fuel_Temperature_Post_Fuel_Heater,
					Fuel_Tank_Temperature,
					Main_Fuel_Tank_Level,
					Start_Fuel_Tank_Level,
					Total_kWh,
					Tariff_1_kWh,
					Tariff_2_kWh,
					Tariff_3_kWh,
					Mains_Voltage_L1,
					Mains_Voltage_L2,
					Mains_Voltage_L3,
					Mains_Frequency,
					Generator_Voltage_L1,
					Generator_Voltage_L2,
					Generator_Voltage_L3,
					Generator_Frequency,
					Generator_Amperage_L1,
					Generator_Amperage_L2,
					Generator_Amperage_L3,
					Power_Factor_L1,
					Power_Factor_L2,
					Power_Factor_L3,
					Secondary_Coolant_Pressure,
					Secondary_Coolant_Post_Site_Heat_Exchanger_Temperature,
					Secondary_Coolant_Pre_Exhaust_Gas_Heat_Exchanger_Temperature,
					Secondary_Coolant_Post_Exhaust_Gas_Heat_Exchanger_Temperature,
					Kamstrup_kW,
					Site_Flow_Temperature,
					Site_Return_Temperature,
					Site_Flow_Rate,
					Acoustic_Chamber_N1_Temperature_Enclosure_1,
					Acoustic_Chamber_N2_Temperature_Enclosure_1,
					Acoustic_Chamber_Temperature_Enclosure_2)
					") or die("A MySQL error has occurred, Error: (" . mysql_errno() . ") " . mysql_error());
		
		//Finish of parts for bulk write
		@unlink($options['in_file']);
			
		fclose($handle);	

    	//redirect
    	header('Location: csv_import.php?success=1'); 
		die;
	}
}

	

Function Check_Int($int_val){
	if (!is_int($int_val)) {
		return intval($int_val);
	}
	else {
		return $int_val;	
	}
}

Function Check_Float($float_val){
	if (!is_float($float_val)) {
		// Return as a float, rounded to one decimal digit. 
		return round(floatval($float_val),1);
	}
	else {
		return $float_val;	
	}
}

Function Convert_Time_Format ($time_val){
	$newdate = date("Y-m-d H:i:s", strtotime($time_val));
	//echo $newdate;
	return $newdate;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Put PhP here for Restricted Pages -->
<html><!-- InstanceBegin template="/Templates/Site_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Green-w(h)ich - Power</title>
<meta name="Green-w(h)ich - Power" content="Green-w(h)ich - Power">
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
	<link rel="stylesheet" type="text/css" href="css/style.css" title="normal" />
	<link rel="alternate stylesheet" type="text/css" href="css/xsmall.css" title="xsmall" />
	<link rel="alternate stylesheet" type="text/css" href="css/medium.css" title="medium" />
	<link rel="alternate stylesheet" type="text/css" href="css/large.css" title="large" />
	<link rel="alternate stylesheet" type="text/css" href="css/xlarge.css" title="xlarge" />
	<script language="JavaScript" src="top_menu.js" type="text/javascript"></script>
	<script language="JavaScript1.2" src="javascript/mm_menu.js" type="text/javascript"></script>
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>
</head>

<body>
<script language="JavaScript1.2">mmLoadMenus();</script>
  <a name="top"></a>
  <div id="outer">
  	<div id="header_login">
    	<?php
        	require_once("./include/membersite_config.php");
        	if (session_status() == PHP_SESSION_NONE) {
    			session_start();
			}
			if(!$fgmembersite->CheckLogin())
				{
				echo '<a href="login.php"><b>Log In</b></a>';
				}
			else 
				{
                echo  '<a href="logout.php"><b>Log Out</b></a>';
				}
		?>
  	</div>
  	<div id="header_banner"><!-- InstanceBeginEditable name="Location_image" --><!-- InstanceEndEditable -->
  	</div>
    	<div id="left">
        <ul id="l_menu_nav">
        	<li class="sub"><a href=" ">Account >></a>
           		<?php
        			require_once("./include/membersite_config.php");
        			if (session_status() == PHP_SESSION_NONE) {
    					session_start();
					}
					if(!$fgmembersite->CheckLogin()) {?>
                    	<ul>
                    		<li><a href="login.php">Log In</a></li>
                    	</ul>
                   <?php } else { ?>
              			<ul>
                        	<li><a href="login-home.php">User Home</a></li>
                        	<?php if($fgmembersite->ExtraUserRights()) {?>
                            <li><a href="register.php">Add User</a></li>	
                            <?php } ?>
                			<li><a href="change-pwd.php">Change Password</a></li>
							<li><a href="logout.php">Log Out</a></li>
                        </ul>
				<?php }  ?>
          <li><a href="news/index.htm">News</a></li>
          <li class="sub"><a href="chp/index.htm">CHP >></a>
              <ul>
                <li><a href="chp/info.htm">Info</a></li>
				<li><a href="chp/data.htm">Data</a></li>
              <!--Comment out this section
                <li class="sub"><a href="../chp/.htm">With Subs >></a>
					<ul>
                      <li><a href="../chp/.htm">Sub1</a></li>
			          <li><a href="../chp/.htm">Sub2</a></li>
                      <li><a href="../chp/.htm">Sub3</a></li>
                    </ul>
				</li>
                -->
              </ul>
          </li>
          <li class="sub"><a href="solar/index.htm">Solar >></a>
              <ul>
                <li><a href="solar/info.htm">Info</a></li>
                <li><a href="solar/data.htm">Data</a></li>
              </ul>
          </li>
          <li class="sub"><a href="wind/index.htm">Wind >></a>
              <ul>
                <li><a href="wind/info.htm">Info</a></li>
                <li><a href="wind/data.htm">Data</a></li>
              </ul>
          </li> 
                   
      </ul>
      </div>
      <div id="left_extra">
      <!-- InstanceBeginEditable name="Extra Left Column" -->
       
      
      
      <!-- InstanceEndEditable -->
      </div>
      <div id="wideright"><!-- InstanceBeginEditable name="Content" -->
		<?php if (!empty($_GET["success"])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?>

		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
	        <input type='hidden' name='submitted' id='submitted' value='1'/>
  			Choose your file: <br />
  			<input name="csv_file_name" type="file" id="csv_file_name" />
    		<input type="submit" name="Submit" value="Submit" />
		</form>

		<!-- InstanceEndEditable -->
    </div>
	<div id="footerblock">
		<div class="up">
        	<div align="center"> <a href="#top" class="up" ><b>- - - - - - - -</b>[UP] <b>- - - - - - - -</b></a></div>
      	</div><div id="footer" align="center" class="copyright"><b>&copy;</b><strong> </strong>Green-w(h)ich - Power</div></td>
	</div>
  </div>
</body>
<!-- InstanceEnd --></html>
