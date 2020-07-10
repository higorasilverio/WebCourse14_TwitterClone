<?php
	require_once('db.class.php');
	$user = $_POST['user'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " insert into users(user, email, password) values ('$user', '$email', '$password')";
	//execute query
	if (mysqli_query($link, $sql)){
		echo 'Register made successfully!';
	} else {
		echo 'Register unseccessfull...';
	}
?>