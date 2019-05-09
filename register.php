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
  <title>Register to Tabware</title>
  <link rel="stylesheet" type="text/css" href="style.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
	  <div class="input-group">
	 <label>Server Password</label>
	  <p>
	   
	   </p>
  	  <input type="password" name="spass">
  	</div>
<div class="input-group">
	
<l>Captcha</label>
	
 <div class="g-recaptcha" data-sitekey="6LeAiYoUAAAAAPk-5fGH3Y-uJq23J9BWerteHAqp"></div>

  	<div>
			<button id="submitBtn" type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>