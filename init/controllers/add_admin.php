<?php
require_once "../model/class_model.php";
	if(ISSET($_POST)){
		$conn = new class_model();
		$options = ['cost' => 15];

		$full_name = trim(ucfirst($_POST['full_name']));
		$email = trim($_POST['email']);
        $username = trim($_POST['username']);
		$password = trim(password_hash($_POST['password'], PASSWORD_BCRYPT,$options));
		$cnumber = trim($_POST['cnumber']);
	    $gender = trim($_POST['gender']);
	
    
		
		$add = $conn->add_admin($email, $cnumber,$full_name, $gender, $username, $password);
		if($add == TRUE){
		      echo '<div class="alert alert-success">Add Admin Successfully!</div><script> setTimeout(function() {  location.replace("manage_admin"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Add Admin Failed!</div><script> setTimeout(function() {  location.replace("manage_admin"); }, 1000); </script>';

	
		}
	}
