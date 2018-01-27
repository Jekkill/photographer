<?php
	session_start();
	include_once '../config/db.ini';
	include_once '../function.php';
	
	$session = isset($_COOKIE['PHPSESSID']) ? $_COOKIE['PHPSESSID'] : '';
	$token   = isset($_COOKIE['_ab']) ? $_COOKIE['_ab'] : '';
	
	$db  = mysqli_connect(HOST, USER, PASS, BASE);
	
	if (mysqli_connect_errno()) {
		return false;
	}
	else {
		mysqli_query($db, '
			DELETE FROM connection
			WHERE connection_session_id = "' . $session . '"
			AND   connecion_token   = "' . $token   . '"
			LIMIT 1;
		');
		
		setcookie('PHPSESSID', '', time(), '/');
		setcookie('_ab', '', time(), '/');
	}
	
	header('Location: request.php');
?>