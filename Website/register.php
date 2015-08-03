<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Put PhP here for Restricted Pages -->
<?PHP
require_once("./include/membersite_config.php");

//Check whether someone is looged on and has the appropriate rights.
if(!($fgmembersite->CheckLogin() and $fgmembersite->ExtraUserRights()))
{
    $fgmembersite->RedirectToURL("no-access.php");
    exit;
}
//If the person is logged on and has the correct rights, then he can submit the form and move on.
else {
	if(isset($_POST['submitted']))
	{
   		if($fgmembersite->RegisterUser())
   		{
        	$fgmembersite->RedirectToURL("thank-you.htm");
   		}
	}
}
?>
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
      <!-- Form Code Start -->
		<div id='fg_membersite'>
			<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
			<fieldset >
				<legend>Register</legend>

				<input type='hidden' name='submitted' id='submitted' value='1'/>

				<div class='short_explanation'>* required fields</div>
				<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

				<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				<div class='container'>
    				<label for='name' >User's Full Name*: </label><br/>
    				<input type='text' name='name' id='name' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
    				<span id='register_name_errorloc' class='error'></span>
				</div>
				<div class='container'>
    				<label for='email' >Email Address*:</label><br/>
    				<input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    				<span id='register_email_errorloc' class='error'></span>
				</div>
				<div class='container'>
    				<label for='username' >UserName*:</label><br/>
    				<input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    				<span id='register_username_errorloc' class='error'></span>
				</div>
				<div class='container'>
    				<label for='password' >Password*:</label><br/>
    				<div class='pwdwidgetdiv' id='thepwddiv' ></div>
    				<noscript>
    				<input type='password' name='password' id='password' maxlength="50" />
    				</noscript>    
    				<div id='register_password_errorloc' class='error' style='clear:both'></div>
				</div>
                <div class='container' style='height:60px;'>
                	<label for='adminrights' >Do you want this user to be able to create new users ?</label><br/>
    				<input type="checkbox" id="adminrights" name="adminrights" value="y" >
					<label for="newsletter">Extra User Rights</label>
                </div>
				<div class='container'>
    				<input type='submit' name='Submit' value='Submit' />
				</div>
			</fieldset>
			</form>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[
    			var pwdwidget = new PasswordWidget('thepwddiv','password');
    			pwdwidget.MakePWDWidget();
    
    			var frmvalidator  = new Validator("register");
    			frmvalidator.EnableOnPageErrorDisplay();
    			frmvalidator.EnableMsgsTogether();
    			frmvalidator.addValidation("name","req","Please provide your name");

    			frmvalidator.addValidation("email","req","Please provide your email address");

    			frmvalidator.addValidation("email","email","Please provide a valid email address");

    			frmvalidator.addValidation("username","req","Please provide a username");
    
    			frmvalidator.addValidation("password","req","Please provide a password");

			// ]]>
			</script>
		</div>
		<!--
		Form Code End (see html-form-guide.com for more info.)
		-->
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
