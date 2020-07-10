<?php
	require_once('db.class.php');
	$user = $_POST['user'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$objDb = new db();
	$link = $objDb->connectMysql();
	$user_exist = false;
	$email_exist = false;
	//Check if the user already exist
	$sql = " SELECT * FROM users WHERE user = '$user' ";
	if ($result_id = mysqli_query($link, $sql)){
		$user_data = mysqli_fetch_array($result_id);
		if(isset($user_data['user'])){
			$user_exist = true;
		}
	} else {
		echo "Error trying to locate the user's regiter.";
	}
	//check if the email is already registered
	$sql = " SELECT * FROM users WHERE email = '$email' ";
	if ($result_id = mysqli_query($link, $sql)){
		$user_data = mysqli_fetch_array($result_id);
		if(isset($user_data['email'])){
			$email_exist = true;
		} 
	} else {
		echo "Error trying to locate the email.";
	}
	if ($user_exist || $email_exist){
		$return_get = '';
		if ($user_exist) {
			$return_get.= 'error_user=1&';
		}
		if ($email_exist) {
			$return_get.= 'error_email=1&';
		}
		header('Location: subscribe.php?'.$return_get);
		die();
	}
	$sql = " insert into users(user, email, password) values ('$user', '$email', '$password')";
	//execute query
	if (mysqli_query($link, $sql)){
		echo 'Register made successfully!';
	} else {
		echo 'Register unseccessfull...';
	}
?>