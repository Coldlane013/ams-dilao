<?php
  require_once "../model/class_model.php";

	if(ISSET($_POST)){
		$conn = new class_model();

		$employee_idno = trim($_POST['employee_idno']);
		$email = trim($_POST['email']);
	    $first_name = trim(ucfirst($_POST['first_name']));
		$middle_name = trim(ucfirst($_POST['middle_name']));
	    $last_name = trim(ucfirst($_POST['last_name']));
		$bdate = trim($_POST['bdate']);
	    $caddress = trim($_POST['complete_address']);
		$cnumber = trim($_POST['cnumber']);
	    $gender = trim($_POST['gender']);
		$civilstatus = trim($_POST['civilstatus']);
	    $datehire = trim($_POST['datehire']);
		$designation = trim($_POST['designation']);
	    $employee_id = trim($_POST['employee_id']);

		$edit = $conn->edit_employee($employee_idno, $email, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation, $employee_id);
		if($edit == TRUE){
		      echo '<div class="alert alert-success">Update User Successfully!</div><script> setTimeout(function() {  location.replace("manage_employee"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Update User Failed!</div><script> setTimeout(function() {  location.replace("manage_employee"); }, 1000); </script>';

	
		}
	}

?>

