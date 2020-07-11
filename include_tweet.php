<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?error=1');
	}
	require_once('db.class.php');
	$tweet_text = $_POST['tweet_text'];
	$id = $_SESSION['id'];
	if ($tweet_text == '' || $id == ''){
		die();
	}
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " INSERT INTO tweet(id_user, tweet) VALUES($id, '$tweet_text') ";
	mysqli_query($link, $sql);
?>