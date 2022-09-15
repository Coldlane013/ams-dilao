<?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$conn = new mysqli("localhost", "root", "", "dtr_system");
	if($conn->connect_error) {
	  die('Error connecting to database'); //Should be a message for normal peeps
	}

?>
