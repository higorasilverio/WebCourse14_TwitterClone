<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php?error=1');
	}
	require_once('db.class.php');
	$objDb = new db();
	$link = $objDb->connectMysql();
	$id = $_SESSION['id'];
	//--qtt tweets
	$sql = " SELECT COUNT(*) AS qtt_tweets FROM tweet WHERE id_user = $id ";
	$result_id = mysqli_query($link, $sql);
	$qtt_tweets = 0;
	if($result_id){
		$register = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
		$qtt_tweets = $register['qtt_tweets'];
	} else {
		echo 'Error execulting query';
	}
	//--qtt followers
	$sql = " SELECT COUNT(*) AS qtt_followers FROM users_followers WHERE following_id_user = $id ";
	$result_id = mysqli_query($link, $sql);
	$qtt_followers = 0;
	if($result_id){
		$register = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
		$qtt_followers = $register['qtt_followers'];
	} else {
		echo 'Error execulting query';
	}
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
		<script type="text/javascript">
			$(document).ready( function(){
				//associate click event
				$('#btn_search_person').click( function(){					
					if($('#person_name').val().length > 0){
						$.ajax({
							url: 'get_people.php',
							method: 'post',
							data: $('#form_search_people').serialize(),
							success: function(data) {
								$('#people').html(data);
								$('.btn_follow').click( function(){
									var id = $(this).data('id');

									$('#btn_follow_'+id).hide();
									$('#btn_unfollow_'+id).show();

									$.ajax({
										url: 'follow.php',
										method: 'post',
										data: { follow_id_user: id },
										success: function(data){
											alert('Register made successfuly!');
										}
									});

								});

								$('.btn_unfollow').click( function(){
									var id = $(this).data('id');

									$('#btn_follow_'+id).show();
									$('#btn_unfollow_'+id).hide();

									$.ajax({
										url: 'unfollow.php',
										method: 'post',
										data: { unfollow_id_user: id },
										success: function(data){
											alert('Register removal made successfuly!');
										}
									});
								});
							}
						});
					}
				});
			});
		</script>

	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="img/icon_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	          	<li><a href="home.php">Home</a></li>
	            <li><a href="logoff.php">Logoff</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	<div class="col-md-3">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?= $_SESSION['user'] ?></h4>

	    				<hr />
	    				<div class="col-md-6">
	    					TWEETS <br /> <?= $qtt_tweets ?>
	    				</div>
	    				<div class="col-md-6">
	    					FOLLOWERS <br /> <?= $qtt_followers ?>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	
	    	<div class="col-md-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<form id="form_search_people" class="input-group">
	    					<input type="text" id="person_name" name="person_name" class="form-control" placeholder="Who are you searching for?" maxlength="140" />
	    					<span class="input-group-btn">
	    						<button class="btn btn-default" id="btn_search_person" type="button">Search</button>
	    					</span>
	    				</form>
	    			</div>
	    		</div>

	    		<div id="people" class="list-group"></div>

			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>