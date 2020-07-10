<?php

	class db {
		//host
		private $host = 'localhost';
		//user
		private $user = 'root';
		//password
		private $password = '';
		//database
		private $database = 'twitter_clone';

		public function connectMysql(){
			//create connection
			$con = mysqli_connect($this -> host, $this -> user, $this -> password, $this -> database);
			//adjust charset
			mysqli_set_charset($con, 'utf8');
			//check for errors
			if(mysqli_connect_errno()){
				echo 'Error connecting to database: '.mysqli_connect_error();
			}
			return $con;
		}
	}

?>