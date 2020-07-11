<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?erro=1');
	}
	require_once('db.class.php');
	$name_people = $_POST['name_people'];
	$id = $_SESSION['id'];
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " SELECT u.*, uf.* ";
	$sql.= " FROM users AS u ";
	$sql.= " LEFT JOIN users_followers AS uf ";
	$sql.= " ON (uf.user_id = $id AND u.id = uf.user_id_follow) ";
	$sql.= " WHERE u.user like '%$name_people%' AND u.id <> $id ";
	$result = mysqli_query($link, $sql);
	if($result){
		while($register = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo '<a href="#" class="list-group-item">';
				echo '<strong>'.$register['user'].'</strong> <small> - '.$register['email'].'</small>';
				echo '<p class="list-group-item-text pull-right">';
					$is_following_yn = isset($register['user_id_follow']) && !empty($register['user_id_follow']) ? 'Y' : 'N';
					$btn_follow_display = 'block';
					$btn_unfollow_display = 'block';
					if($is_following_yn == 'N'){
						$btn_unfollow_display = 'none';
					} else {
						$btn_follow_display = 'none';
					}
					echo '<button type="button" id="btn_follow_'.$register['id'].'" style="display: '.$btn_follow_display.'" class="btn btn-default btn_follow" data-id_user="'.$register['id'].'">Follow</button>';
					echo '<button type="button" id="btn_unfollow_'.$register['id'].'" style="display: '.$bbtn_unfollow_display.'" class="btn btn-primary btn_unfollow" data-id_user="'.$register['id'].'">Unfollow</button>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '</a>';
		}
	} else {
		echo 'Error in people query!';
	}
?>