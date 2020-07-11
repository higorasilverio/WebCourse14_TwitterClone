<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?erro=1');
	}
	require_once('db.class.php');
	$id = $_SESSION['id'];
	$follow_user_id = $_POST['follow_user_id'];
	if($id == '' || $follow_user_id == ''){
		die();
	}
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " INSERT INTO users_followers(user_id, user_id_follow)values($id, $follow_user_id) ";
	mysqli_query($link, $sql);
?>