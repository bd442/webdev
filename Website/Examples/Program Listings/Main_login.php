<?php
if( isset( $_SESSION['errormsg'] ) ) {
  // do the output
  echo $_SESSION['errormsg'];
  // delete the message from the session, so that it is shown only once
  unset( $_SESSION['errormsg'] );
}
echo <<<_END

<html>
	<head>
		<title> Login to access the instrument portal	</title>
	</head>
	<body>
		<div id="image">
			<img src="LabTools.bmp">
		</div>
		<!-- login form -->
		<div id="login">
			<form method="post" action="checklogin.php">
				<h2> Login <small>enter your credentials</small></h2>
	
	
				<p>
					<label ="name">Username: </label>
					<input type="text" name="username"/>
				</p>
				
				<p>
					<label ="pwd">Password: </label>
					<input type="password" name="password"/>
				</p>
				
				<p>
					<input type="submit" id="submit" value="Login" name="submit" />
				</p>
			</form>
		</div>
	</body>
	
</html>
_END;
?>