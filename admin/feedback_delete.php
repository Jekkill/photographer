<?php
	include_once '../config/db.ini';
	include_once '../function.php';
	
	$err  = '';
	$name = '';
	
	$db = mysqli_connect(HOST, USER, PASS, BASE);
	
	if (mysqli_connect_errno()) {
		exit(mysqli_connect_error());
	}
	
	mysqli_set_charset($db, 'UTF8');
	
	if (isset($_GET['id'])) {
		$id   = (int)$_GET['id'];
		$info = mysqli_query($db, '
			UPDATE feedback
			SET feedback_is_deleted = 1
			WHERE feedback_id = ' . $id . ';'
		);
	}
	
	header('Location: http://localhost/photographer/main/admin/feedback.php');
?>