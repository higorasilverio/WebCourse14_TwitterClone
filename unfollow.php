<?php
	
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?error=1');
	}
	require_once('db.class.php');
	$id = $_SESSION['id'];
	$unfollow_user_id = $_POST['unfollow_user_id'];
	if($id == '' || $unfollow_user_id == ''){
		die();
	}
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " DELETE FROM users_followers WHERE user_id = $id AND user_id_follow = $unfollow_user_id ";
	mysqli_query($link, $sql);
?>