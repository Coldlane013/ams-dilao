<?php
		require_once "../model/class_model.php";;
	if(ISSET($_POST)){
		$conn = new class_model();
		$username = trim($_POST['username']);
		$password = trim(($_POST['password']));
		$key =trim($_POST['key']);

		$get_superID = $conn->login_super($username, $password,$key);
		if($get_superID['count'] > 0){
			session_start();
			$_SESSION['super_id'] = $get_superID['super_id'];
			echo 1;
		}else{
			echo 0;
		}
	}
