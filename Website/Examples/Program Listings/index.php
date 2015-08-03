<?php
session_start();
ini_set('session.gc_maxlifelime',60*60);
// Check if user has logged in
if(!$_SESSION ['username']){
	header("location:Main_login.php");
}
if (isset($_POST['Plot']))
{
	header("location:LabTools.php");
}

?>
<HTML>

    <head>
     
        <title>
            Temperature Controller for Nuclear Magnetic Resonance (NMR) Test Instrument
        </title>
        <!-- Link Stylesheet -->
        <link rel="stylesheet" href="style.css" />
    </head>
	<body>
		<!-- Insert Greenwich logo -->
		<div id="green">
			<img src="greenwich.gif">			
		</div>
		<!-- Logout page -->
		<div id="logout">
			<a href="logout.php">logout</a>			
		</div>
		<!-- Insert Labtools logo -->
		<div id="image">
			<img src="LabTools.bmp">
		</div>
		<div id="log">
		<h2> Temperature Controller for Nuclear Magnetic Resonance (NMR) Test Instrument</h2>
		
		<!-- Insert temperature and power values-->   
       	<p> Set Control Value:</p>	      	  
	    	<table>       
	        	<tr>
	            	<form action="temperature.php" method="post">
	            	<td> Set New Temperature Value:</td>
	            	<td> <input type="text" name="New_temp" size="3"/></td>
		            <td><button type = "submit" name= "submit" Value= "submit"> Update</button></td>
		            </form>
		            <form action="power.php" method="post">
		            <td>Set New Power Value:  </td>
		            <td> <input type="" name="New_power" size="3"/></td>
		            <td><button type = "submit" name= "submit" Value= "submit"> Update</button></td>
		            </form>
	        	</tr>         	
		    </table>
	  </div>
	    	<!-- insert the real-time values using  -->
	    	<iframe id='dynamic-content' src='refresh.php' scrolling="no" ></iframe>	    	
	   
	    <div id="graph">
	    	<!-- graph plot -->
	    	Graph Plot:<br/>
	    	<form action="graph.php" method="post">
				New Power:<input type="checkbox" name="Temp[]" value="New_power"/> 
				New Temperature:<input type="checkbox" name="Temp[]" value="New_temp"/> 
				Measured Temperature:<input type="checkbox" name="Temp[]" value="Measured_temp"/> 
			<input type="Submit" value="Plot" />
			</form>
			<!-- insert graph -->
	    	<img src="img/graph.png?dummy=\'.now().'">
	    </div>

	</body>  
</html>