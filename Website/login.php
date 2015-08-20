<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Put PhP here for Restricted Pages -->
<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("login-home.php");
   }
}

?>
<html><!-- InstanceBegin template="/Templates/Site_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Green-w(h)ich - Power</title>
<meta name="Green w(h)ich - Power" content="Green-w(h)ich - Power">
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
				<li><a href="chp/data.php">Data</a></li>
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
      <div id='fg_membersite'>
      <form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
		<fieldset >
			<legend>Login</legend>

			<input type='hidden' name='submitted' id='submitted' value='1'/>

			<div class='short_explanation'>* Required Fields</div>

			<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
			<div class='container'>
    			<label for='username' >UserName*:</label><br/>
    			<input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    			<span id='login_username_errorloc' class='error'></span>
            </div>
			<div class='container'>
    			<label for='password' >Password*:</label><br/>
    			<input type='password' name='password' id='password' maxlength="50" /><br/>
    			<span id='login_password_errorloc' class='error'></span>
			</div>

			<div class='container'>
    			<input type='submit' name='Submit' value='Submit' />
			</div>
			<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
		</fieldset>
	</form>
	<script type='text/javascript'>
		// <![CDATA[
    	var frmvalidator  = new Validator("login");
    	frmvalidator.EnableOnPageErrorDisplay();
    	frmvalidator.EnableMsgsTogether();

    	frmvalidator.addValidation("username","req","Please provide your username");
    
    	frmvalidator.addValidation("password","req","Please provide the password");
		// ]]>
	</script>
    </div>
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
