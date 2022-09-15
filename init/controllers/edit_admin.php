<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();

		$full_name = trim(ucfirst($_POST['full_name']));
		$email = trim($_POST['email']);
	    $username = trim($_POST['username']);
		$cnumber = trim($_POST['cnumber']);
        $gender = trim($_POST['gender']);
	    $admin_id = trim($_POST['admin_id']);

		$edit = $conn->edit_admin($email, $cnumber,$full_name, $gender, $username,$admin_id);
		if($edit == TRUE){
		      echo '<div class="alert alert-success">Update Admin Successfully!</div><script> setTimeout(function() {  location.replace("manage_admin"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Update Admin Failed!</div><script> setTimeout(function() {  location.replace("manage_admin"); }, 1000); </script>';

	
		}
	}
