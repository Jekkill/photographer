<?php
function view($page, $data = []) {
	extract($data);
	
	if (preg_match('/([.a-z_\/0-9]*)\.?\w*/i', $page, $result)) {
		if(file_exists($result[1] . '.html')) {
			include './' . $result[1] . '.html';
		}
	}
}

function generator($size = 32) {
	$alphabet = '0123456789abcdefghijklmnopqrstuvwxyz';
	$code     = '';
	
	for ($i = 0; $i < $size; $i++) {
		$num  = rand(0, strlen($alphabet) - 1);
		$code.= $alphabet[$num];
	}
	
	return $code;
}

function checkAdmin() {
	$session = isset($_COOKIE['PHPSESSID']) ? $_COOKIE['PHPSESSID'] : '';
	$token   = isset($_COOKIE['_ab']) ? $_COOKIE['_ab'] : '';
	
	$db  = mysqli_connect(HOST, USER, PASS, BASE);
	
	if (mysqli_connect_errno()) {
		return false;
	}
	else {
		mysqli_set_charset($db, 'UTF8');
		$query = mysqli_query($db, '
			SELECT 
				user.user_id             AS id, 
				user_is_admin            AS admin, 
				user_email               AS email,
				IF(NOW() > connection_expire, 1, 0) AS rebuild
			FROM user
			LEFT JOIN connection ON user.user_id = connection_user_id
			WHERE connection_session_id = "' . mysqli_real_escape_string($db, $session) . '"
			AND   connection_token   = "' . mysqli_real_escape_string($db, $token)   . '";
		');
//echo mysqli_error($db);
		$admin = mysqli_fetch_assoc($query);
		
		if ($admin AND $admin['rebuild'] == 0) {
			$expire  = time() + 300;
			$session = $_COOKIE['PHPSESSID'];
			$token   = generator();
			mysqli_query($db, '
				UPDATE connection SET 
					connection_token   = "' . $token . '",
					connection_expire  = FROM_UNIXTIME(' . $expire . ')
				WHERE connection_session_id = "' . $session . '";
			');
			setcookie('_ab', $token, time() + 60 * 60 * 24, '/');
		}
		
		return $admin;
	}
}
?>