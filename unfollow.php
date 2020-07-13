<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?error=1');
	}
	require_once('db.class.php');
	$id = $_SESSION['id'];
	$unfollow_id_user = $_POST['unfollow_id_user'];
	if($id == '' || $unfollow_id_user == ''){
		die();
	}
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " DELETE FROM users_followers WHERE id_user = $id AND following_id_user = $unfollow_id_user ";
	mysqli_query($link, $sql);
?>