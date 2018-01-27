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
		$date = mysqli_real_escape_string($db, $_POST['feedbackdate']);
		$message = mysqli_real_escape_string($db, $_POST['message']);
		if ($_POST['checked'] == "on") {
			$checked = 1; 
		} else {
			$checked = 0; 
		};
		if ($_POST['visible'] == "on") {
			$visible = 1; 
		} else {
			$visible = 0; 
		};
		echo $name . '<br>' . $email . '<br>' . $date . '<br>' . $message . '<br>' . $checked . '<br> ' . $visible; 
		$query = mysqli_query($db, '
			SELECT user_id 
			FROM user 
			WHERE user_email = "' . $email . '";
		');
		$found = mysqli_fetch_assoc($query);
		$user_id = $found['user_id']; 
		mysqli_query($db, '
			UPDATE user 
			SET user_name = "' . $name . '", 
				user_email = "' . $email . '"
			WHERE author_id = ' . $user_id . ';
		');		
		mysqli_query($db, '
			UPDATE feedback 
			SET feedback_user_id = "' . $user_id . '", 
				feedback_date = "' . $date . '", 
				feedback_text = "' . $message . '",
				feedback_is_checked = "' . $checked . '", 
				feedback_is_visible = "' . $visible . '"
			WHERE feedback_id = ' . $id . ';
		');	
		header('Location: http://localhost/photographer/main/admin/feedback.php');
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
				feedback_id       AS id, 
				user_name     AS name,
				user_email AS email,  
				feedback_text     AS message,
				feedback_date AS feedbackdate, 
				feedback_is_checked    AS checked, 
				feedback_is_visible AS visible
			FROM feedback
    		LEFT JOIN user ON feedback_user_id   = user.user_id
			WHERE feedback_is_deleted = 0 
				AND feedback_id = "' . $id . '";
		');
		$info = mysqli_fetch_assoc($info);
		$name = $info['name'];
		$email = $info['email'];
		$message = $info['message'];
		$date = $info['feedbackdate'];
		$checked = $info['checked'];
		$visible = $info['visible'];
	}
	view('view/main/head', ['title' => 'Редактировать отзыв № '. $id, 'css' => ['../css/bootstrap.css', '../css/icomoon.css', './css/admin.css']]);
	view('view/feedback/add', ['error' => $err, 'name' => $name, 'id' => $id, 'email' => $email, 'message' => $message , 'date' => $date, 'visible' => $visible, 'checked' => $checked]);
?>