<?php include('server.php');

$public_key = "6LeAiYoUAAAAAPk-5fGH3Y-uJq23J9BWerteHAqp"; /* Your reCaptcha public key */
$private_key = "6LeAiYoUAAAAADJIBl6NEihFxp58Izjekq3iuUZD"; /* Enter your reCaptcha private key */
$url = "https://www.google.com/recaptcha/api/siteverify"; /* Default end-point, please verify this before using it */

	//* Check if the form has been submitted */
	if(array_key_exists('submit_form',$_POST))
	 {
		//* The response given by the form being submitted */
		$response_key = $_POST['g-recaptcha-response'];
		//* Send the data to the API for a response */
		$response = file_get_contents($url.'?secret='.$private_key.'&response='.$response_key.'&remoteip='.$_SERVER['REMOTE_ADDR']);
		//* json decode the response to an object */
		$response = json_decode($response);
		/* if success */
		if($response->success == 1)
		{
			echo "You passed validation!";
		}
		else
		{
			echo "You are a robot and we don't like robots.";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Tycode's Tabware</title>
  <link rel="stylesheet" type="text/css" href="style.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
	  
	  	  <l>Captcha</label>
	
 <div class="g-recaptcha" data-sitekey="6LeAiYoUAAAAAPk-5fGH3Y-uJq23J9BWerteHAqp"></div>

  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
	  

	  
	  
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>