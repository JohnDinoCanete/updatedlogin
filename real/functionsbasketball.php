<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['bet'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $team; 

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$team       =  e($_POST['team']);
	$bet  =  e($_POST['bet']);

	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($team)) { 
		array_push($errors, "Team is required"); 
	}
	if (empty($bet)) { 
		array_push($errors, "Bet is required"); 
	}
	// register user if there are no errors in the form
		if (isset($_POST['basketball'])) {
			$user_type = e($_POST['basketball']);
			$query = "INSERT INTO basketball (username, team, bet) 
					  VALUES('$username', '$team', '$bet')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO basketball (username, team, bet) 
					  VALUES('$username', '$team','$bet')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
    $password = e($_POST['team']);
    $bet = e($_POST['bet']);
    

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($team)) {
		array_push($errors, "Team is required");
    }
    if (empty($bet)) {
		array_push($errors, "Bet is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM basketball WHERE username='$username' team='$team' AND bet='$bet' LIMIT 1";
		$results = mysqli_query($db, $query);
