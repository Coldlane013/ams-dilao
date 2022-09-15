<?php
  require_once "../model/class_model.php";


	if(ISSET($_POST)){
		$conn = new class_model();

	    $schedule_id = trim($_POST['schedule_id']);

		$del = $conn->delete_schedule($schedule_id);
		if($del == TRUE){
		      echo '<div class="alert alert-success">Delete Schedule Successfully!</div><script> setTimeout(function() {  location.replace("manage_schedule"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Delete Schedule Failed!</div><script> setTimeout(function() {  location.replace("manage_schedule"); }, 1000); </script>';

	
		}
	}
