<?php 
	include_once './config/db.ini';
	
	$err = ''; 
	$name = '';

	if (isset($_POST['firstName'])) {

		$db = mysqli_connect(HOST, USER, PASS, BASE);

		if (mysqli_connect_errno()) {
			exit(mysqli_connect_error());
		}

		mysqli_set_charset($db, 'UTF8');

		$email = mysqli_real_escape_string($db, $_POST['Email']);

		$check = mysqli_query($db, '
			SELECT 1 FROM user 
			WHERE user_email = "' . $email . '";
		');

		$firstName = mysqli_real_escape_string($db, $_POST['firstName']); 
		 
		$date = $_POST['date']; 

		$telNumberRaw = mysqli_real_escape_string($db, $_POST['telNumber']);
		$textRequest = mysqli_real_escape_string($db, $_POST['request']);
		$telNumber = preg_replace('/[^0-9]/', '', $telNumberRaw); 
		if (mysqli_num_rows($check)) {
			$id = mysqli_fetch_assoc($check);
			$id = $id['id'];
			mysqli_query($db, '
				INSERT INTO request 
				SET request_user_id = "' . $id . '", 
					request_date = "' . $date . '",
					request_text = "' . $textRequest . '";
				');
		} else {
			mysqli_query($db, '
				INSERT INTO user 
				SET user_name = "' . $firstName . '", 
					user_email = "' . $email . '",
					user_number = "' . $telNumber . '";
			');

			$id = mysqli_insert_id($db); 

			mysqli_query($db, '
				INSERT INTO request 
				SET request_user_id = "' . $id . '", 
					request_date = "' . $date . '", 
					request_text = "' . $textRequest . '";
			'); 
			echo 'Ваш запрос принят. Я свяжусь с Вами как только смогу. Вернутся на страницу <a href="./contacts.html"> контактов </a>';
		} 
	}

?> 