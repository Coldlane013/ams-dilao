<?php
  require_once "../model/class_model.php";
	   
          
	if(ISSET($_POST)){
		$conn = new class_model();

	    $admin_id = trim($_POST['admin_id']);

		$del = $conn->delete_admin($admin_id);
		if($del == TRUE){
		      echo '<div class="alert alert-success">Delete Admin Successfully!</div><script> setTimeout(function() {  location.replace("manage_admin"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Delete Admin Failed!</div><script> setTimeout(function() {  location.replace("manage_admin"); }, 1000); </script>';

	
		}
	}
