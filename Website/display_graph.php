<?PHP
//  This code will deal with displaying the selection options and then querry the DB and display the corresponding graph. 

//require_once("./include/jpgraph.php");
//require_once("./include/jpgraph_line.php");
require_once('include/tc_calendar.php');

// Examples: http://jpgraph.net/features/src/show-example.php?target=new_line1.php
// http://jpgraph.net/features/gallery.php#line1


//Select last entry from table, to know which time has been put into the database already. 

// mysql_querry (SELECT Time_Stamp FROM gwp_medway_campus_chp_data ORDER BY id DESC LIMIT 1);


// If the values have been selected, then the button is pressed to send them to the server, retrieve them and send them as an array to the client for plotting. 
if(isset($_POST['submitted'])){
	$Start_time = date("Y-m-d H:i:s", strtotime("Start_Year" . 'Start_Month' . 'Start_Day' . 'Start_Hour' . 'Start_Minutes' . '00'));
	
	echo $Start_Year;
	echo $Start_Month;
	





	
}


/**
*
* @Create dropdown of years
*
* @param int $start_year
*
* @param int $end_year
*
* @param string $id The name and id of the select object
*
* @param int $selected
*
* @return string
*
*/
function createYears($start_year, $id='year_select', $selected=null)
{

	/*** the current year ***/
	$selected = is_null($selected) ? date('Y') : $selected;

	/*** range of years ***/
	$r = range($start_year, date("Y"));

	/*** create the select ***/
	$select = '<select name="'.$id.'" id="'.$id.'">';
	foreach( $r as $year )
	{
		$select .= "<option value=\"$year\"";
		$select .= ($year==$selected) ? ' selected="selected"' : '';
		$select .= ">$year</option>\n";
	}
	$select .= '</select>';
	return $select;
}

/*
*
* @Create dropdown list of months
*
* @param string $id The name and id of the select object
*
* @param int $selected
*
* @return string
*
*/
function createMonths($id='month_select', $selected=null)
{
	/*** array of months ***/
	$months = array(
					1=>'January',
					2=>'February',
					3=>'March',
					4=>'April',
					5=>'May',
					6=>'June',
					7=>'July',
					8=>'August',
					9=>'September',
					10=>'October',
					11=>'November',
					12=>'December');

	/*** current month ***/
	$selected = is_null($selected) ? date('m') : $selected;

	$select = '<select name="'.$id.'" id="'.$id.'">'."\n";
	foreach($months as $key=>$mon)
	{
		$select .= "<option value=\"$key\"";
		$select .= ($key==$selected) ? ' selected="selected"' : '';
		$select .= ">$mon</option>\n";
	}
	$select .= '</select>';
	return $select;
}


/**
*
* @Create dropdown list of days
*
* @param string $id The name and id of the select object
*
* @param int $selected
*
* @return string
*
*/
function createDays($id='day_select', $selected=null)
{
	/*** range of days ***/
	$r = range(1, 31);

	/*** current day ***/
	$selected = is_null($selected) ? date('d') : $selected;

	$select = "<select name=\"$id\" id=\"$id\">\n";
	foreach ($r as $day)
	{
		$select .= "<option value=\"$day\"";
		$select .= ($day==$selected) ? ' selected="selected"' : '';
		$select .= ">$day</option>\n";
	}
	$select .= '</select>';
	return $select;
}


/**
*
* @create dropdown list of hours
*
* @param string $id The name and id of the select object
*
* @param int $selected
*
* @return string
*
*/
function createHours($id='hours_select', $selected=null)
    {
	/*** range of hours ***/
	$r = range(0, 23);

	/*** current hour ***/
	$selected = is_null($selected) ? date('h') : $selected;

	$select = "<select name=\"$id\" id=\"$id\">\n";
	foreach ($r as $hour)
	{
		$select .= "<option value=\"$hour\"";
		$select .= ($hour==$selected) ? ' selected="selected"' : '';
		$select .= ">$hour</option>\n";
	}
	$select .= '</select>';
	return $select;
}

/**
*
* @create dropdown list of minutes
*
* @param string $id The name and id of the select object
*
* @param int $selected
*
* @return string
*
*/
function createMinutes($id='minute_select', $selected=null)
{
	/*** array of mins ***/
	$minutes = range(0, 59);

    $selected = in_array($selected, $minutes) ? $selected : 0;

	$select = "<select name=\"$id\" id=\"$id\">\n";
	foreach($minutes as $min)
	{
		$select .= "<option value=\"$min\"";
		$select .= ($min==$selected) ? ' selected="selected"' : '';
		$select .= ">$min</option>\n";
	}
    $select .= '</select>';
    return $select;
}

/**
*
* @create a dropdown list of AM or PM
*
* @param string $id The name and id of the select object
*
* @param string $selected
*
* @return string
*
*/
function createAmPm($id='select_ampm', $selected=null)
{
    $r = array('AM', 'PM');

    /*** set the select minute ***/
    $selected = is_null($selected) ? date('A') : strtoupper($selected);

    $select = "<select name=\"$id\" id=\"$id\">\n";
    foreach($r as $ampm)
    {
        $select .= "<option value=\"$ampm\"";
        $select .= ($ampm==$selected) ? ' selected="selected"' : '';
        $select .= ">$ampm</option>\n";
    }
    $select .= '</select>';
    return $select;
}


/*
*
* @Create dropdown list of resolution
*
* @param string $id The name and id of the select object
*
* @param int $selected
*
* @return string
*
*/
function createResolution($id='resolution_select', $selected=null)
{
	/*** array of months ***/
	$resolution = array(
					1=>'1 sec',
					2=>'1 min',
					3=>'5 min',
					4=>'30 min',
					5=>'1 hour',
					6=>'1 day');

	/*** current month ***/
//	$selected = is_null($selected) ? date('m') : $selected;

	$select = '<select name="'.$id.'" id="'.$id.'">'."\n";
	foreach($resolution as $key=>$resol)
	{
		$select .= "<option value=\"$key\"";
		$select .= ($key==$selected) ? ' selected="selected"' : '';
		$select .= ">$resol</option>\n";
	}
	$select .= '</select>';
	return $select;
}



/*
*
* @Create dropdown list of resolution
*
* @param string $id The name and id of the select object
*
* @param int $selected
*
* @return string
*
*/
function createActAvg($id='actavg_select', $selected=null)
{
	/*** array of months ***/
	$actualaverage = array(
					1=>'Actual Value',
					2=>'Average',);

	/*** current month ***/
//	$selected = is_null($selected) ? date('m') : $selected;

	$select = '<select name="'.$id.'" id="'.$id.'">'."\n";
	foreach($actualaverage as $key=>$actavg)
	{
		$select .= "<option value=\"$key\"";
		$select .= ($key==$selected) ? ' selected="selected"' : '';
		$select .= ">$actavg</option>\n";
	}
	$select .= '</select>';
	return $select;
}



/**
*
* @create a dropdown list of Values that can be selected for graph
*
* @param string $id The name and id of the select object
*
* @param string $selected
*
* @return string
*
*/
function createValues($id='select_value', $selected=null)
{
    $val = array (	'None',
					'Engine_RPM',
    				'Engine_Power_kWe',
    				'Oil_Pressure',
    				'Oil_Temperature',
    				'Primary_Coolant_Temperature',
    				'Primary_Coolant_Pressure',
					'Water_Temperature_Pre_After_Cooler',
					'Water_Temperature_Post_After_Cooler',					
					'Inlet_Air_Temperature_Pre_Turbocharger_Left',
					'Inlet_Air_Temperature_Pre_Turbocharger_Right',
					'Inlet_Air_Temperature_Pre_After_Cooler_Left',
					'Inlet_Air_Temperature_Pre_After_Cooler_Right',
					'Inlet_Air_Temperature_Post_After_Cooler_Left',
					'Inlet_Air_Temperature_Post_After_Cooler_Right',
					'Inlet_Air_Manifold_Pressure_Left',
					'Inlet_Air_Manifold_Pressure_Right',
					'Exhaust_Temperature_Pre_Turbo_Left',
					'Exhaust_Temperature_Pre_Turbo_Right',
					'Exhaust_Temperature_Post_Turbo_Left',
					'Exhaust_Temperature_Post_Turbo_Right',
					'Exhaust_Temperature_Post_Heat_Exchanger',
					'Exhaust_Back_Pressure',
					'Pre_SCR_Temperature',
					'Fuel_Pressure_Pre_Filter',
					'Fuel_Pressure_Post_Filter',
					'Fuel_Temperature_Pre_Fuel_Heater',
					'Fuel_Temperature_Post_Fuel_Heater',
					'Fuel_Tank_Temperature',
					'Main_Fuel_Tank_Level',
					'Start_Fuel_Tank_Level',
					'Total_kWh',
					'Tariff_1_kWh',
					'Tariff_2_kWh',
					'Tariff_3_kWh',
					'Mains_Voltage_L1',
					'Mains_Voltage_L2',
					'Mains_Voltage_L3',
					'Mains_Frequency',
					'Generator_Voltage_L1',
					'Generator_Voltage_L2',
					'Generator_Voltage_L3',
					'Generator_Frequency',
					'Generator_Amperage_L1',
					'Generator_Amperage_L2',
					'Generator_Amperage_L3',
					'Power_Factor_L1',
					'Power_Factor_L2',
					'Power_Factor_L3',
					'Secondary_Coolant_Pressure',
					'Secondary_Coolant_Post_Site_Heat_Exchanger_Temperature',
					'Secondary_Coolant_Pre_Exhaust_Gas_Heat_Exchanger_Temperature',
					'Secondary_Coolant_Post_Exhaust Gas_Heat_Exchanger_Temperature',
					'Kamstrup_kW',
					'Site_Flow_Temperature',
					'Site_Return_Temperature',
					'Site_Flow_Rate',
					'Acoustic_Chamber_N1_Temperature_Enclosure_1',
					'Acoustic_Chamber_N2_Temperature_Enclosure_1',
					'Acoustic_Chamber_Temperature_Enclosure_2'
			);

    $select = "<select name=\"$id\" id=\"$id\">\n";
    foreach($val as $values)
    {
        $select .= "<option value=\"$values\"";
        $select .= ($values==$selected) ? ' selected="selected"' : '';
        $select .= ">$values</option>\n";
    }
    $select .= '</select>';
    return $select;
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
<script language="javascript" src="calendar/calendar.js"></script>






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
	
		 <br>

      
		<strong>Time Range: </strong>
        <table>
        	<form name="form1" method="post" action="">
        	<tr><td><strong>From:</strong></td></tr>
            <tr><td></td><td>Hour</td><td>Minutes</td></tr>
            <tr><td><?php
					  $myCalendar = new tc_calendar("Start_Date", true, true);
					  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setDatePair('Start_Date', 'End_Date');
					  $myCalendar->dateAllow('2014-11-01', '', false);
					  $myCalendar->writeScript();
					  $Start_Date = $myCalendar->getDate();
					  ?></td><td><?php echo createHours('Start_Hour'); ?></td><td><?php echo createMinutes('Start_Minutes'); ?></td></tr>
            <tr><td><strong>To: </strong></td></tr>
            <tr><td></td><td>Hour</td><td>Minutes</td></tr>
			<tr><td><?php
					  $myCalendar = new tc_calendar("End_Date", true, true);
					  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setDatePair('Start_Date', 'End_Date');
					  $myCalendar->dateAllow('2014-11-01', '', false);
					  $myCalendar->writeScript();
					  $End_Date = $myCalendar->getDate();
					  ?></td><td><?php echo createHours('End_Hour'); ?></td><td><?php echo createMinutes('End_Minutes'); ?></td></tr>
		</table> <br>
        
               
        Sampling resolution: <?php echo createResolution('resol', 3); ?>  Value for resolution: <?php echo createActAvg('actavg', 1); ?> <br> <br>
        
        <strong>NOTE:</strong> Smaller resolutions and/or the requirement to average values will take considerably more time for graph generation ! <br> <br>
    
        <strong>Graph 1: </strong> <?php echo createValues('graph_1', 'Engine_Power_kWe'); ?> <br>
      
       	<strong>Graph 2: </strong> <?php echo createValues('graph_2', 'None'); ?> <br>
              
       	<strong>Graph 3: </strong> <?php echo createValues('graph_3', 'None'); ?> <br>
        
        <strong>Graph 4: </strong> <?php echo createValues('graph_4', 'None'); ?> <br>
        
        <strong>Graph 5: </strong> <?php echo createValues('graph_5', 'None'); ?> <br> <br> <br>
        
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
	        <input type='hidden' name='submitted' id='submitted' value='1'/>
    		<input type="submit" name="Plot Graphs" value="Submit" />
		</form>tc_calendar
        
        
        
        

		<!-- InstanceEndEditable -->
    </div>
	<div id="footerblock">
		<div class="up">
        	<div align="center"> <a href="#top" class="up" ><b>- - - - - - - -</b>[UP] <b>- - - - - - - -</b></a></div>
      	</div><div id="footer" align="center" class="copyright"><b>&copy;</b><strong> </strong>Green-w(h)ich - Power</div></td>
	</div>
  </div>
</body>
<!-- InstanceEnd -->

<script src="./scripts/jquery.js"></script>
<script src="./scripts/jquery.datetimepicker.js"></script>
<script>
$('#startDateTime').datetimepicker({
	dayOfWeekStart : 1,
	lang:'en',
	format: 'd/m/Y H:i',
	startDate: '01/11/2014',
	maxDate: 0, //This should really link to the last values stored from the database !
	step:10
});

$('#endDateTime').datetimepicker({
	dayOfWeekStart : 1,
	lang:'en',
	format: 'd/m/Y H:i',
	startDate: '01/11/2014',
	maxDate: 0,  //This should really link to the last values stored from the database !
	step:10
});

</script>
</html>
