<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Welcome to Tabware!</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
	
	<!-- Data Base connect -->
	<?php
	//$conn = new mysqli('localhost', 'root', 'usbw', 'registration');
	?>
	<!-- Some data-->
	<p>List of The Tabware community:</p>
	
	<?php 

?> 

	<!-- end of Some data-->
	<!-- Check if Admin-->
	
	<?php
	$db = new mysqli('localhost', 'root', 'usbw', 'registration');
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username='$username' AND user_type='admin'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {

		echo "you are a admin";
		echo '<a href="adminpage.php"> Click here to go to the admin page</a>';
		
  	}else {
  		echo "You are a user";
  	}
	
	?>
	
	<!-- End Check if admin -->
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>