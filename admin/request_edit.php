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
	
	if (isset($_POST['name'])) {
		$id    = (int)$_GET['id'];
		$name  = mysqli_real_escape_string($db, $_POST['name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$number = mysqli_real_escape_string($db, $_POST['phonenumber']); 
		$date = mysqli_real_escape_string($db, $_POST['requestdate']);
		$message = mysqli_real_escape_string($db, $_POST['message']);
		if ($_POST['checked'] == "on") {
			$checked = 1; 
		} else {
			$checked = 0; 
		};
		echo $name . '<br>' . $email . '<br>' . $number . '<br>' . $date . '<br>' . $message . '<br>' . $checked; 
		$query = mysqli_query($db, '
			SELECT user_id 
			FROM user 
			WHERE user_email = "' . $email . '";
		');
		$found = mysqli_fetch_assoc($query);
		$user_id = $found['user_id']; 
		echo $user_id;
		mysqli_query($db, '
			UPDATE user 
			SET user_name = "' . $name . '", 
				user_email = "' . $email . '", 
				user_number = "' . $number . '",
			WHERE author_id = ' . $user_id . ';
		');		
		mysqli_query($db, '
			UPDATE request 
			SET request_user_id = "' . $user_id . '", 
				request_date = "' . $date . '", 
				request_text = "' . $message . '",
				request_is_checked = "' . $checked . '"
			WHERE request_id = ' . $id . ';
		');	
		header('Location: http://localhost/photographer/main/admin/request.php');
/*		mysqli_query($db, '
				UPDATE user 
				SET user_name = "' . $name . '", 
					user_email = "' . $email . '", 
					user_number = "' . $number . '"


				WHERE author_id = ' . $id . ';
		');*/

/*		header('Location: http://localhost/photographer/main/admin/request.php');*/
/*		$check = mysqli_query($db, '
			SELECT 1 FROM author 
			WHERE author_name = "' . $name . '"
			AND author_id <> ' . $id . ';
		');
		
		if (mysqli_num_rows($check)) {
			$err =  'Такой автор уже существует';
		}
		else {
			mysqli_query($db, '
				UPDATE author 
				SET author_name = "' . $name . '"
				WHERE author_id = ' . $id . ';
			');
			header('Location: http://localhost/shop/author.php');
		}*/
	}
	elseif (isset($_GET['id'])) {
		$id   = (int)$_GET['id'];
		$info = mysqli_query($db, '
			SELECT 
				request_id       AS id, 
				user_name     AS name,
				user_email AS email,  
				user_number AS phonenumber, 
				request_date AS requestdate,
				request_text     AS message,
				request_is_checked    AS checked
			FROM request
    		LEFT JOIN user ON request_user_id   = user.user_id
			WHERE request_is_deleted = 0
				AND request_id = "' . $id . '";
		');
		$info = mysqli_fetch_assoc($info);
		$name = $info['name'];
		$email = $info['email'];
		$number = $info['phonenumber']; 
		$date = $info['requestdate'];
		$message = $info['message'];
		$checked = $info['checked'];
	}
	view('view/main/head', ['title' => 'Редактирование запроса № '. $id, 'css' => ['../css/bootstrap.css', '../css/icomoon.css', './css/admin.css']]);
	view('view/request/add', ['error' => $err, 'name' => $name, 'id' => $id, 'email' => $email, 'number' => $number, 'date' => $date, 'message' => $message, 'checked' => $checked]);
?>