<?php

ob_start();
session_start();

unset($_SESSION['has_error']);
unset($_SESSION['has_success']);

include('config.php');


$name = $_POST['full_name'];
$username = $_POST['username'];
$password = $_POST['password'];

if($conn) {
	// create a query to be executed
	$sql = "SELECT * from users where username = '$username'";

	// execute the query
	$result = mysqli_query($conn, $sql);

	if($result->num_rows > 0) {
		// create a session to remember that an error has been set for user
		$_SESSION['has_error'] = 'This username has been taken';
		// redirect to login page if username already exists
		header("location: login.php");
	} else {
		// Write a query to insert in to DB
		if(strlen($name) < 1) {
			$_SESSION['has_error'] = 'Your name is required';
			header("location: login.php");
		}
		if(strlen($username) < 6) {
			$_SESSION['has_error'] = 'Username must be atleast 6 characters long';
			header("location: login.php");
		}
		if(strlen($password) < 8) {
			$_SESSION['has_error'] = 'Password must be 8 characters long';
			header("location: login.php");
		}

		$newpassword = md5($password);

		$sql1 = "INSERT INTO users(full_name, username, password) VALUES('$name', '$username', '$newpassword')";

		$result = mysqli_query($conn, $sql1);

		try {

			if($result) {
				$_SESSION['has_success'] = 'Registration successful';
				// optionally you can send a welcome email to the user
				header("location: login.php");
			} else {
				echo 'no action';
			}

		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

} else {
	echo 'Error';
}

?>