<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?error=1');
	}
	require_once('db.class.php');
	$id = $_SESSION['id'];
	$follow_id_user = $_POST['follow_id_user'];
	if($id == '' || $follow_id_user == ''){
		die();
	}
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " INSERT INTO users_followers(id_user, following_id_user)values($id, $follow_id_user) ";
	mysqli_query($link, $sql);
?>