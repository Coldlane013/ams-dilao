<?php 

	include '../../../init/model/config/connection2.php';

	if(isset($_POST['admin_id'])){
		$id = $_POST['admin_id'];

	    $sql = "SELECT * FROM `tbl_admin` WHERE admin_id = ?";
	    $stmt = $conn->prepare($sql); 
	    $stmt->bind_param("i", $id);
	    $stmt->execute();
	    $result = $stmt->get_result();
        $row = $result->fetch_assoc();
	    echo json_encode($row);

	 }
