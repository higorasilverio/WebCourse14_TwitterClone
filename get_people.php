<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?error=1');
	}
	require_once('db.class.php');
	$person_name = $_POST['person_name'];
	$id = $_SESSION['id'];
	$objDb = new db();
	$link = $objDb->connectMysql();
	$sql = " SELECT u.*, us.* ";
	$sql.= " FROM users AS u ";
	$sql.= " LEFT JOIN users_followers AS us ";
	$sql.= " ON (us.id_user = $id AND u.id = us.following_id_user) ";
	$sql.= " WHERE u.user like '%$person_name%' AND u.id <> $id ";

	$result_id = mysqli_query($link, $sql);

	if($result_id){

		while($register = mysqli_fetch_array($result_id, MYSQLI_ASSOC)){
			echo '<a href="#" class="list-group-item">';
				echo '<strong>'.$register['user'].'</strong> <small> - '.$register['email'].'</small>';
				echo '<p class="list-group-item-text pull-right">';

					$following_usuario_yn = isset($register['id_user_follower']) && !empty($register['id_user_follower']) ? 'Y' : 'N';

					$btn_follow_display = 'block';
					$btn_unfollow_display = 'block';

					if($following_usuario_yn == 'N'){
						$btn_unfollow_display = 'none';
					} else {
						$btn_follow_display = 'none';
					}

					echo '<button type="button" id="btn_follow_'.$register['id'].'" style="display: '.$btn_follow_display.'" class="btn btn-default btn_follow" data-id="'.$register['id'].'">Follow</button>';
					echo '<button type="button" id="btn_unfollow_'.$register['id'].'" style="display: '.$btn_unfollow_display.'" class="btn btn-primary btn_unfollow" data-id="'.$register['id'].'">Unfollow</button>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '</a>';
		}

	} else {
		echo 'Error in query!';
	}

?>