<?php
	session_start();
	require_once('db.class.php');
	$user = $_POST['user'];
	$password = md5($_POST['password']);
	$sql = " SELECT user, email FROM users WHERE user = '$user' AND password = '$password'";
	$objDb = new db();
	$link = $objDb->connectMysql();
	$result_id = mysqli_query($link, $sql);
	if ($result_id) {
		$user_data = mysqli_fetch_array($result_id);
		if(isset($user_data['user'])){
			$_SESSION['user'] = $user_data['user'];
			$_SESSION['email'] = $user_data['email'];
			header('Location: home.php');
		} else {
			header('Location: index.php?error=1');
		}
	} else {
		echo 'Error in query execution. Please, contact the site administrator!';
	}
	
?>