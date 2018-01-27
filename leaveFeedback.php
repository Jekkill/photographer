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
			SELECT user_id as id FROM user 
			WHERE user_email = "' . $email . '";
		');

		$firstName = mysqli_real_escape_string($db, $_POST['firstName']);  
		$date = date('Y-m-d'); 
		$textFeedback = mysqli_real_escape_string($db, $_POST['yourFeedback']);
		$photoName = $_FILES['photo']['name']; 

		if ($photoName == '') { 
			$newPhotoName = 'noPhoto.jpg';
		} else {
			$allowedExtensions = array('jpg', 'jpeg', 'gif', 'bmp', 'png'); 
			$allowedExtPhoto = false; 

			$photoDir = "./feedback_images/"; 

			$photoExt = strtolower(substr($photoName, strrpos($photoName, '.') + 1));
			$newPhotoName = time() . '.' . $photoExt;
			if (in_array($photoExt, $allowedExtensions)) {
				$allowedExtPhoto = true;
			} else {
				$err .= 'Поддерживаемые форматы фотографии: ' . implode(',', $allowedExtensions); 
			}
			if ($allowedExtPhoto) {
				$pathToPhoto = $photoDir . $newPhotoName; 
				if ($_FILES['photo']['error'] == 0) {
					move_uploaded_file($_FILES['photo']['tmp_name'], $pathToPhoto);
				}
			}
		};
		if (mysqli_num_rows($check)) {
			$id = mysqli_fetch_assoc($check);
			$id = $id['id'];
			mysqli_query($db, '
			INSERT INTO feedback 
			SET feedback_user_id = "' . $id . '",
			 	feedback_text = "' . $textFeedback . '",
			 	feedback_path_to_image = "' . $newPhotoName . '",
				feedback_date = "' . $date . '";
			');
		}
		else {
			mysqli_query($db, '
				INSERT INTO user 
				SET user_name = "' . $firstName . '", 
					user_email = "' . $email . '";
			');
			$id = mysqli_insert_id($db); 
			mysqli_query($db, '
				INSERT INTO feedback 
				SET feedback_user_id = "' . $id . '",
			 		feedback_text = "' . $textFeedback . '",
			 		feedback_path_to_image = "' . $newPhotoName . '",
					feedback_date = "' . $date . '";
			'); 
			echo "Ваш отзыв отправлен! Он станет видным как только пройдет проверку модератором. Вернуться на страницу <a href='./about.php'> обо мне </a> ";
		} 
	};

?> 