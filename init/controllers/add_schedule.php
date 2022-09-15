<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();
		$employee_qrcode= trim($_POST['employee_qrcode']);
		$schedule_name = trim($_POST['event_name']);
		$date = trim($_POST['event_date']);
        $time_in = trim($_POST['time_in']);
        $time_out = trim($_POST['time_out']);

		$add = $conn->add_schedule($employee_qrcode,$schedule_name,$date, $time_in, $time_out);
		if($add == TRUE){
		      echo '<div class="alert alert-success">Add Schedule Successfully!</div><script> setTimeout(function() {  location.replace("manage_schedule"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Add Schedule Failed!</div><script> setTimeout(function() {  location.replace("manage_schedule"); }, 1000); </script>';

	
		}
	}
