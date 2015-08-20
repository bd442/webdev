<?PHP
require_once("../include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("login-home.php");
   }
}

?>

<html lang="en">
	<!-- CSS Style sheet link below -->
	<link rel="stylesheet" type="text/css" href="/gwp/css/style.css" title="normal"/>
	<head>
		<script language="JavaScript" src="top_menu.js" type="text/javascript"></script>
		<script language="JavaScript1.2" src="javascript/mm_menu.js" type="text/javascript"></script>
   		<script type="text/javascript" src="scripts/gen_validatorv31.js"></script>
    	<script src="scripts/pwdwidget.js" type="text/javascript"></script>
		<meta charset="utf-8">
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>Data</title>
		<meta name="description" content="">
		<meta name="author" content="">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		-->
	</head>
	
	<body>
		<div>
		<script language="JavaScript1.2">mmLoadMenus();</script>
  		<a name="top"></a>
  		<div id="outer">
  			<div id="header_login">
  			<?php
        	require_once("../include/membersite_config.php");
        	if (session_status() == PHP_SESSION_NONE) {
    			session_start();
			}
			if(!$fgmembersite->CheckLogin())
				{
				echo '<a href="../login.php"><b>Log In</b></a>';
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
        			require_once("../include/membersite_config.php");
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
                <li><a href="/gwp/chp/info.htm">Info</a></li>
				<li><a href="/gwp/chp/data.htm">Data</a></li>
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
      <div id="left_submenu">
      <!-- InstanceBeginEditable name="Extra Left Column" -->
       
      
      
      <!-- InstanceEndEditable -->
      </div>
      <div id="wideright">
      </div>
      <header>
      <h1>Data</h1>
	  </header>
	  <!-- Intro -->
	  This page will retrieve data from a MySQL database and display it onto a graph. Currently, the only supported graph is line graph.
	  For more information, click <a href="/gwp/chp/info.htm">here</a>.
			
      <center>
      <p>
	  <div class="generator">
		
	      <!-- generates the graph -->
		  Select the date and time you would like to view your data between:
		  <div>

				<p>
			      <form action="../Examples/using-highcharts-with-php-and-mysql/data.php" method="post">
				      <input id="datetimemin" type="text" value="" name="firstDate" placeholder="YYYY-MM-DD HH:mm:SS"></input>
					  and
					  <input id="datetimemax" type="text" value="" name="secondDate" placeholder="YYYY-MM-DD HH:mm:SS"></input>
					  <br>
					  <!-- Type of graph*:
					  <select id="graphtype" name="graphType">
					      <option value="" name="emptyField"> -- Select --</option>
					      <option value="Bar Chart" name="field_bar">Bar Chart</option>
					      <option value="Line Graph" name="field_line">Line Graph</option>							
						  <option value="Scatter Graph" name="field_scatter">Scatter Graph</option>
					  </select>-->
					  <input type="submit">
				   </form>
			</p>
			<button name="generateGraph" type="submit" onClick="parent.location='/gwp/Examples/using-highcharts-with-php-and-mysql'">Generate Graph</button>
			<pre>* = required</pre>
			</div>
	  </div>
	  </p>
	  </center>
	  <nav>
	      <p>
	          <a href="/gwp/login.php">Home</a>
	      </p>
	  </nav>
	  </div>
	  <center>
	      <div id="footerblock">
	      <div class="up">
          <div align="center"> <a href="#top" class="up" ><b>- - - - - - - -</b>[UP] <b>- - - - - - - -</b></a></div>
      </div><div id="footer" align="center" class="copyright"><b>&copy;</b><strong> </strong>Green-w(h)ich - Power</div></td>
	  </center>
	</div>
	</body>
</html>
