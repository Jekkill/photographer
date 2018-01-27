<?php
	session_start();
	include_once '../config/db.ini';
	include_once '../function.php';
	$db   = mysqli_connect(HOST, USER, PASS, BASE);
	$admin = checkAdmin();

	view('view/main/head', ['title' => 'Cписок отзывов', 'css' => ['../css/bootstrap.css', '../css/icomoon.css', './css/admin.css']]);
	view('view/main/menu', ['type'  => 'feedback', 'admin' => $admin]);



	
	if (mysqli_connect_errno()) {
		exit(mysqli_connect_error());
	}
	
	mysqli_set_charset($db, 'UTF8');
	if ($admin) {
		$feedbacks = mysqli_query($db, '
			SELECT 
				feedback_id       AS id, 
				user_name     AS name,
				user_email AS email,  
				feedback_text     AS message,
				feedback_path_to_image AS image,
				feedback_date AS feedbackdate, 
				feedback_is_checked    AS checked, 
				feedback_is_visible AS visible
			FROM feedback
    		LEFT JOIN user ON feedback_user_id   = user.user_id
			WHERE feedback_is_deleted = 0;
		');
		view('widget/table/start'); 
		$feedback_head = ['ID', 'Имя', 'Email', 'Сообщение', 'Фотография', 'Дата', 'Просмотрен', 'Отобразить'];
		view('widget/table/th', ['head'  => $feedback_head]);
		while ($feedback = mysqli_fetch_assoc($feedbacks)) {
			view('widget/table/feedback', ['row' => $feedback, 'control' => true]);
		}
		view('widget/table/end'); 
		view('view/main/script_side', ['js' => ['../script/jquery.js', 'js/feedback.js', 'js/main.js']]);
	} else {
		echo "<h1> Чтобы просматривать содержимое, необходимо войти! </h1> ";
	}

/*	if ($user) { 
		
/*		$query = mysqli_query($db, '
			SELECT SQL_CALC_FOUND_ROWS
				book_id       AS id, 
				book_name     AS name, 
				book_isbn     AS isbn,
				book_price    AS price,
				book_avg_mark AS mark,
				mark_id       AS star,
				GROUP_CONCAT(author_name SEPARATOR ", ") AS author
			FROM book
	    		LEFT JOIN book_author ON book_id   = book_author_book_id
	    		LEFT JOIN author      ON author_id = book_author_author_id
				LEFT JOIN mark        ON book_id   = mark_book_id ' . $and  . '
				GROUP BY book_id
				ORDER BY book_name;
		');
		
		$books = mysqli_fetch_all($query, MYSQLI_ASSOC);
		
		view('view/main/head', ['title' => 'Список книг', 'css' => ['./core/css/main.css', './core/css/font-awesome.min.css']]);
		view('view/main/menu', ['type'  => 'book']);
		view('view/book/list', ['books' => $books]);

		view('view/main/script_side', ['js' => ['js/jquery-1.11.0.min.js', 'js/book.js']]);
		view('view/main/footer');)
	} else {
		view('view/main/auth'); 
	}
*/
?>