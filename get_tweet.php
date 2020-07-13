<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?error=1');
	}
	require_once('db.class.php');
	$id = $_SESSION['id'];
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " SELECT DATE_FORMAT(t.include_date, '%d %b %Y %T') AS include_date_formated, t.tweet, u.user ";
	$sql.= " FROM tweet AS t JOIN users AS u ON (t.id_user = u.id) ";
	$sql.= " WHERE id_user = $id ";
	$sql.= " OR id_user IN (select following_id_user from users_followers where id_user = $id) ";
	$sql.= " ORDER BY include_date DESC ";
	$result_id = mysqli_query($link, $sql);
	if($result_id){
		while($register = mysqli_fetch_array($result_id, MYSQLI_ASSOC)){
			echo '<a href="#" class="list-group-item">';
				echo '<h4 class="list-group-item-heading">'.$register['user'].' <small> - '.$register['include_date_formated'].'</small></h4>';
				echo '<p class="list-group-item-text">'.$register['tweet'].'</p>';
			echo '</a>';
		}

	} else {
		echo 'Error in query!';
	}

?>