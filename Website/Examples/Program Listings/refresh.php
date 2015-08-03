<?php
 include("getdata.php"); 
?>
<html>
	<head>
	  <!-- refresh every 5 seconds -->
	  <meta http-equiv="refresh" content="5">
	  <link rel="stylesheet" href="iframe.css" />
	</head>
	<body>
		Real-Time Values: <br/>
		<table>	
  			<tr>        	
	            <td>Measured Temperature: </td>
	            <td> <?php echo $Measured_temp; ?></td> 
        	
	            <td>Set Temperature:</td>
	            <td> <?php  echo $New_temp; ?></td> 
	        
	            <td>Target Temperature:</td> 
	            <td> <?php   echo $Target_temp; ?></td>
	       
	            <td>Set Power/Current:</td> 
	            <td> <?php  echo $New_power; ?></td>
	            
	        </tr>
	    </table>
	</body>  
</html>
</body>
</html>
