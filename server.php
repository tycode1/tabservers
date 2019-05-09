<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$spass = "";
$errors = array(); 
//$ip = ($ipaddress);
$captcha = "";
date_default_timezone_set('America/Los_Angeles');
$date = date("Y-m-d");
$mastersalt = "OhHeyDogLordMcTee";



// connect to the database
$db = mysqli_connect('139.99.168.116', 'websiteadmin', 'websitetest123', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $spass = mysqli_real_escape_string($db, $_POST['spass']);
  $captcha = $_POST['g-recaptcha-response'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($spass)) { array_push($errors, "Server Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
	
  if ($spass != "dog") {
	array_push($errors, "The Server Password is incorrect");
  }
	
	
if(!$captcha){
	array_push($errors, "Please Check the Recaptcha");
}
	
	
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
	// Set hash
	
	
	

  // Finally, register user if there are no errors in the form
	
  if (count($errors) == 0) {
	  
	$usersalt = crypt ($username, $mastersalt); //Create new salt with username and master salt
	$hashreg = crypt ($password_1, $usersalt); //Create password hash using usersalt as salt
  	$password = ($hashreg); //Set new crypt as encrypeted password
      
	 //count how users int the database then +1 for ID  
//
	  
	  
$result = $db ->query("SELECT * FROM users");
$number_of_rows = mysqli_num_rows($result);
echo "Number of rows fetched are : ". $number_of_rows;

$newid = $number_of_rows + 1; 
$user = 'user';
$coins = 200;
$invitesleft = 3;
//
	  
	  
	  $stmt = $db->prepare("INSERT INTO users (id, username, email, password, user_type, date, coins, invitesleft) VALUES (?,?,?,?,?,?,?,?)");
	  $stmt->bind_param("isssssii", $newid, $username, $email, $password, $user, $date, $coins, $invitesleft);
	  $stmt->execute();


	  
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}


// LOGIN USER // LOGIN USER // LOGIN USER //
// LOGIN USER // LOGIN USER // LOGIN USER //
// LOGIN USER // LOGIN USER // LOGIN USER //
// LOGIN USER // LOGIN USER // LOGIN USER //

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $captcha = $_POST['g-recaptcha-response'];
	
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
	
if(!$captcha){
	array_push($errors, "Please Check the Recaptcha");
}
	
	
	//
  if (count($errors) == 0) {
	  	//decrypt the password
	$usersalt = crypt ($username, $mastersalt); //Create new salt with username and master salt
	$hashlog = crypt ($password, $usersalt); //Create password hash using usersalt as salt
  	$password = ($hashlog); //Set new crypt as encrypeted password
	  //
	  
      
	  
	  //
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>