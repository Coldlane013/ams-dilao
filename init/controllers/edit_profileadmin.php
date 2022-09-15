<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();
		$options = ['cost' => 15];

		$full_name = trim(ucfirst($_POST['full_name']));
		$email = trim($_POST['email']);
		$password = trim(password_hash($_POST['password'], PASSWORD_BCRYPT, $options));
		$cnumber = trim($_POST['cnumber']);
		$gender = trim($_POST['gender']);
        $admin_id = trim($_POST['admin_id']);
		

		$edit = $conn->edit_adminprofile($email, $password, $cnumber, $full_name, $gender, $admin_id);
		if($edit == TRUE){
		      echo '<div class="alert alert-success">Update Profile Successfully!</div><script> setTimeout(function() {  location.replace("manage_profile"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Update Profile Failed!</div><script> setTimeout(function() {  location.replace("manage_profile"); }, 1000); </script>';

	
		}
	}
