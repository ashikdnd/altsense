<?php

ob_start();
session_start();

unset($_SESSION['has_error']);

unset($_SESSION['has_success']);


include('config.php');

$userid = $_SESSION['userid'];
$time = time();

if(isset($_POST)) {
	// add task
	$title = $_POST['task_title'];

	if(strlen($title) < 5) {
		$_SESSION['has_error'] = 'Task title should be 5 characters long';
		header("location: tasks.php");
	} else {
		$sql = "INSERT INTO tasks(user_id, task_title, created_at)

				VALUES('$userid', '$title', '$time')";

		$result = mysqli_query($conn, $sql);

		if($result) {
			$_SESSION['has_success'] = 'Tasks added';
			header('location: tasks.php');
		}
	}
}

?>