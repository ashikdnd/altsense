<?php

include('config.php');

if(isset($_GET)) {
	$tid = $_GET['taskid'];
	$userid = $_GET['userid'];
	$type = $_GET['method'];

	if($type == 'delete') {
		$sql = "DELETE FROM tasks where `id` = '$tid' && `user_id` = '$userid'";
		$result = mysqli_query($conn, $sql);
		if($result) {
			$response = ['success' => true, 'message' => 'Task has been deleted'];
			echo json_encode($response);
		}
	}

	if($type == 'update') {
		$sql = "UPDATE tasks set `status` = '1' where `id` = '$tid' && `user_id` = '$userid'";
		$result = mysqli_query($conn, $sql);
		if($result) {
			$response = ['success' => true, 'message' => 'Task has been updated'];
			echo json_encode($response);
		}
	}
} else {
	echo 'else';
}