<?php
	session_start();
	include_once '../config/db.ini';
	include_once '../function.php';
	$db   = mysqli_connect(HOST, USER, PASS, BASE);
	$admin = checkAdmin();

	view('view/main/head', ['title' => 'Cписок запросов', 'css' => ['../css/bootstrap.css', '../css/icomoon.css', './css/admin.css']]);
	view('view/main/menu', ['type'  => 'request', 'admin' => $admin]);



//	$user = checkUser();
	
	if (mysqli_connect_errno()) {
		exit(mysqli_connect_error());
	}
	
	mysqli_set_charset($db, 'UTF8');
	if ($admin) {
		$requests = mysqli_query($db, '
			SELECT
				request_id       AS id, 
				user_name     AS name,
				user_email AS email,  
				user_number AS phonenumber, 
				request_text     AS message,
				request_date AS requestdate,
				request_is_checked    AS checked
			FROM request
    		LEFT JOIN user ON request_user_id   = user.user_id
			WHERE request_is_deleted = 0;
		');
		view('widget/table/start'); 
		$request_head = ['ID', 'Имя', 'Email', 'Телефон', 'Дата съёмки', 'Сообщение', 'Прочитано', 'Управление'];
		view('widget/table/th', ['head'  => $request_head]);
		while ($request = mysqli_fetch_assoc($requests)) {
			view('widget/table/request', ['row' => $request, 'control' => true]);
		}
		view('widget/table/end'); 
		view('view/main/script_side', ['js' => ['../script/jquery.js', 'js/request.js', 'js/main.js']]);
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