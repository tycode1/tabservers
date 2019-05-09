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
	<h2>Admin Page</h2>
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

	?>
	<!-- Some data-->
	<p>List of The Tabware community:</p>
	
	<?php 
	
	$mysqli = mysqli_connect('139.99.168.116', 'websiteadmin', 'websitetest123', 'registration');
	
	// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
	
$result = $mysqli ->query("SELECT * FROM users");
$number_of_rows = mysqli_num_rows($result);
echo "Number of rows fetched are : ". $number_of_rows;

//while($row = mysqli_fetch_array($result)) { 
//	  echo "username ". $row['username']. "\n";
//	}
?> 

	<!-- end of Some data-->
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>