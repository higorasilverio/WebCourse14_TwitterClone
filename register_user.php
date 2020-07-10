<?php
	require_once('db.class.php');
	$user = $_POST['user'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$objDb = new db();
	$link = $objDb->connectMysql();
	//Check if the user already exist
	$sql = " SELECT * FROM users WHERE user = '$user' ";
	if ($result_id = mysqli_query($link, $sql)){
		$user_data = mysqli_fetch_array($result_id);
		if(isset($user_data['user'])){
			echo 'User already registered.';
		} else {
			echo 'User not registered.';
		}
	} else {
		echo "Error trying to locate the user's regiter.";
	}
	//check if the email is already registered
	$sql = " SELECT * FROM users WHERE email = '$email' ";
	if ($result_id = mysqli_query($link, $sql)){
		$user_data = mysqli_fetch_array($result_id);
		if(isset($user_data['email'])){
			echo 'Email already registered.';
		} else {
			echo 'Email not registered.';
		}
	} else {
		echo "Error trying to locate the email.";
	}
	die();
	$sql = " insert into users(user, email, password) values ('$user', '$email', '$password')";
	//execute query
	if (mysqli_query($link, $sql)){
		echo 'Register made successfully!';
	} else {
		echo 'Register unseccessfull...';
	}
?>