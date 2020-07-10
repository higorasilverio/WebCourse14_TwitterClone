<?php
	require_once('db.class.php');
	$user = $_POST['user'];
	$password = $_POST['password'];
	$sql = " SELECT * FROM users WHERE user = '$user' AND password = '$password'";
	$objDb = new db();
	$link = $objDb->connectMysql();
	$result_id = mysqli_query($link, $sql);
	if ($result_id) {
		$user_data = mysqli_fetch_array($result_id);
		var_dump($user_data);
	} else {
		echo 'Error in query execution. Please, contact the site administrator!';
	}
	
?>