<?php
	$error = isset($_GET['error']) ? $_GET['error'] : 0;

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
	
		<script>
			$(document).ready( function(){
				//verify fields user and password correctly filled
				$('#btn_login').click(function(){
					var blank_field = false;
					if ($('#field_user').val() == ''){
						blank_field = true;
						$('#field_user').css({'border-color': '#A94442'});
					} else {
						$('#field_user').css({'border-color': '#CCC'});
					}
					if ($('#field_password').val() == ''){
						blank_field = true;
						$('#field_password').css({'border-color': '#A94442'});
					} else {
						$('#field_password').css({'border-color': '#CCC'});
					}
					if (blank_field) return false;
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
	            <li><a href="subscribe.php">Register</a></li>
	            <li class="<?= $error == 1 ? 'open' : '' ?>">
	            	<a id="login" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
					<ul class="dropdown-menu" aria-labelledby="entrar">
						<div class="col-md-12">
				    		<p>Do you have a account already?</p>
				    		<br />
							<form method="post" action="validate_access.php" id="formLogin">
								<div class="form-group">
									<input type="text" class="form-control" id="field_user" name="user" placeholder="User" />
								</div>
								
								<div class="form-group">
									<input type="password" class="form-control red" id="field_password" name="password" placeholder="Password" />
								</div>
								
								<button type="buttom" class="btn btn-primary" id="btn_login">Login</button>

								<br /><br />
							</form>
							<?php
								if ($error == 1) {
									echo '<font color="#FF0000">User/password invalid!</font>';
								}
							?>
						</div>
				  	</ul>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	      <!-- Main component for a primary marketing message or call to action -->
	      <div class="jumbotron">
	        <h1>Welcome to Twitter clone</h1>
	        <p>See what is happening now...</p>
	      </div>

	      <div class="clearfix"></div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>