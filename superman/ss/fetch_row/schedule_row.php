<?php 

	include '../../../init/model/config/connection2.php';

	if(isset($_POST['schedule_id'])){
		$id = $_POST['schedule_id'];

	    $sql = "SELECT * FROM `tbl_schedule` WHERE schedule_id = ?";
	    $stmt = $conn->prepare($sql); 
	    $stmt->bind_param("i", $id);
	    $stmt->execute();
	    $result = $stmt->get_result();
        $row = $result->fetch_assoc();

	    echo json_encode($row);

	 }
?>