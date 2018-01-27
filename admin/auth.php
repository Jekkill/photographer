<?php
	session_start();
	include_once '../config/db.ini';
	include_once '../function.php';
	
	$err = '';
	
	if (isset($_POST['email']) AND isset($_POST['pass'])) {
		$db  = mysqli_connect(HOST, USER, PASS, BASE);
		if (mysqli_connect_errno()) {
			$err = mysqli_connect_error();
		}
		else {
			mysqli_set_charset($db, 'UTF8');
			$email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
			$password = md5($_POST['pass']); 
			$pass = rtrim($password); 
			$check = mysqli_query($db, '
				SELECT user_id AS id 
				FROM user 
					WHERE user_email="' . $email . '"
						AND user_password="' . $pass . '"
						AND user_is_admin=1; 
			');

			if (mysqli_num_rows($check) == "1") {
				// как вернуть значение id выбранной строки. 
				$id = mysqli_fetch_assoc($check);
				$id = $id['id'];
				$expire = time() + 10000; 
				$session = $_COOKIE['PHPSESSID']; 
				$token = generator();
				echo $expire;

				mysqli_query($db, '
					INSERT INTO connection 
					SET connection_session_id = "' . $session . '",
						connection_token   = "' . $token   . '",
						connection_user_id = "' . $id      . '",
						connection_expire  = FROM_UNIXTIME(' . $expire . ');
				'); 

				setcookie('_ab', $token, time() + 60 * 60 * 24, '/');
				header('Location: request.php');
			} else {
				$err = 'Связка email/пароль не соответствует!';
			}
		}
	}
?>

<? if ($err): ?>
	<script>alert("<?= $err ?>")</script>
	Вернутся на <a href="index.php"> главную. </a>
<? endif ?>

