<?php 

ob_start();
session_start();

unset($_SESSION['has_error']);
unset($_SESSION['has_success']);

include('config.php');

$username = $_POST['username'];
$pass = $_POST['password'];

$password = md5($pass);

$sql = "SELECT * FROM users where `username` = '$username' && `password` = '$password'";

$result = mysqli_query($conn, $sql);

if($result->num_rows > 0) {
	$user = mysqli_fetch_assoc($result);
	$_SESSION['userid'] = $user['id'];
	$_SESSION['full_name'] = $user['full_name'];
	$_SESSION['authenticated'] = true;
	header('location: tasks.php');

} else {
	$_SESSION['has_error'] = 'Invalid Credentials';
	header('location: login.php');
}

?>