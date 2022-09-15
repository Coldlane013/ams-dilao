<?php
	error_reporting(0);
	include '../../libs/phpqrcode/qrlib.php';
	require_once "../model/class_model.php";
	$pathDir ="../../qrcode_images/";
	if(ISSET($_POST)){
		$conn = new class_model();
		$options = ['cost' => 15];

		$employee_idno = trim($_POST['employee_idno']);
		$email = trim($_POST['email']);
		$password = trim(password_hash($_POST['password'], PASSWORD_BCRYPT,$options));
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
	    $qr_code = trim($_POST['qr_code']);
	     function rand_string( $length ) {
		    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		    return substr(str_shuffle($chars),0,$length);
	    }

        $codeContents = ''.rand_string(8); 
        QRcode::png($codeContents, $pathDir.''.$employee_idno.'.png', QR_ECLEVEL_L, 5);

		
		$add = $conn->add_employee($employee_idno, $email, $password, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation, $codeContents);
		if($add == TRUE){
		      echo '<div class="alert alert-success">Add User Successfully!</div><script> setTimeout(function() {  location.replace("manage_employee"); }, 1000); </script>';
		    

		  }else{
		    echo '<div class="alert alert-danger">Add User Failed!</div><script> setTimeout(function() {  location.replace("manage_employee"); }, 1000); </script>';

	
		}
	}
