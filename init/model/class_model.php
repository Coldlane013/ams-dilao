<?php

require 'config/connection.php';

class class_model
{

	public $host = db_host;
	public $user = db_user;
	public $pass = db_pass;
	public $dbname = db_name;
	public $conn;
	public $error;

	public function __construct()
	{
		$this->connect();
	}

	private function connect()
	{
		date_default_timezone_set("asia/manila");
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
		if (!$this->conn) {
			$this->error = "Fatal Error: Can't connect to database" . $this->conn->connect_error;
			return false;
		}
	}

//////////// SUPER ///////////////////////////////////////////////////////////////////////////////////////////////////



	public function login_super($username, $password,$key)
	{
		$stmt = $this->conn->prepare("SELECT * FROM `tbl_superman` WHERE `username` = ?")  or die($this->conn->error);
		$stmt->bind_param("s", $username);
		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$valid = $result->num_rows;
			$fetch = $result->fetch_array();
			if (
				$fetch && password_verify($password, $fetch['password']) && password_verify($key,$fetch['secretd'])){
				return array(
					'super_id' => htmlentities($fetch['super_id']),
					'count' => $valid
				);
			}
			 else {
				return 0;
			}
		}
	}
	public function super_account($super_id)
	{
		$stmt = $this->conn->prepare("SELECT * FROM `tbl_superman` WHERE `super_id` = ?") or die($this->conn->error);
		$stmt->bind_param("i", $super_id);
		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$fetch = $result->fetch_array();
			return array(
				'name' => $fetch['name']

			);
		}
	}
	public function fetchindividual_super($super_id){

		$sql = "SELECT * FROM  tbl_superman WHERE `super_id` = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $super_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;


	}
	public function edit_superprofile($name, $username, $email,$super_id){
		$sql = "UPDATE `tbl_superman` SET `email` = ?, `username` = ?, `name` = ?  WHERE super_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssi",$email,$username, $name, $super_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}


	}
//////////// ADMIN ///////////////////////////////////////////////////////////////////////////////////////////////////
	public function login_admin($username, $password)
	{
		$stmt = $this->conn->prepare("SELECT * FROM `tbl_admin` WHERE `username` = ?")  or die($this->conn->error);
		$stmt->bind_param("s", $username);
		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$valid = $result->num_rows;
			$fetch = $result->fetch_array();
			if (
				$fetch && password_verify($password, $fetch['password'])
			) {
				return array(
					'admin_id' => htmlentities($fetch['admin_id']),
					'count' => $valid
				);
			} else {
				return 0;
			}
		}
	}

	public function admin_account($admin_id)
	{
		$stmt = $this->conn->prepare("SELECT * FROM `tbl_admin` WHERE `admin_id` = ?") or die($this->conn->error);
		$stmt->bind_param("i", $admin_id);
		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$fetch = $result->fetch_array();
			return array(
				'full_name' => $fetch['full_name'],
				'gender' => $fetch['gender']

			);
		}
	}
	public function fetchAll_admin()
	{
		$sql = "SELECT * FROM  tbl_admin";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}
	public function add_admin($email, $cnumber, $full_name, $gender, $username, $password)
	{
		$stmt = $this->conn->prepare("INSERT INTO `tbl_admin` (`email`, `cnumber`, `full_name`, `gender`, `username`, `password`) VALUES(?, ?, ?, ?, ?, ?)") or die($this->conn->error);
		$stmt->bind_param("ssssss",$email, $cnumber, $full_name, $gender, $username, $password);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}

	public function edit_admin($email, $cnumber, $full_name, $gender, $username, $admin_id)
	{

		$sql = "UPDATE `tbl_admin` SET `email`= ?, `cnumber` = ?, `full_name` = ? , `gender`= ?, `username` = ? WHERE admin_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssssi", $email, $cnumber, $full_name, $gender, $username, $admin_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}

	public function delete_admin($admin_id)
	{
		$sql = "DELETE FROM tbl_admin WHERE admin_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $admin_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}


	public function fetchindividual_admin($admin_id)
	{
		$sql = "SELECT * FROM  tbl_admin WHERE `admin_id` = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $admin_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

	public function edit_adminprofile($email, $password, $cnumber, $full_name, $gender, $admin_id)
	{

		$sql = "UPDATE `tbl_admin` SET `email`= ?, `cnumber` = ?, `full_name` = ? , `gender`= ?,  `password` = ? WHERE admin_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssssi", $email, $cnumber, $full_name, $gender, $password, $admin_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}

	/////////// CRUD USER ///////////////////////////////////////////////////////////////////////////////////////

	public function fetchAll_employees()
	{
		$sql = "SELECT * FROM  tbl_employee";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

	public function add_employee($employee_idno, $email, $password, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation, $codeContents)
	{
		$stmt = $this->conn->prepare("INSERT INTO `tbl_employee` (`employee_idno`,`email`, `password`, `first_name`, `middle_name`, `last_name`, `bdate`, `complete_address`, `cnumber`,  `gender`, `civilstatus`, `datehire`, `designation`, `qr_code`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)") or die($this->conn->error);
		$stmt->bind_param("ssssssssssssss", $employee_idno, $email,$password, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation, $codeContents);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}

	public function edit_employeeuser($employee_idno, $email, $password, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation, $employee_id)
	{

		$sql = "UPDATE `tbl_employee` SET  `employee_idno` = ?, `email` = ?,  `password` = ? , `first_name` = ?, `middle_name` = ?,  `last_name` = ? ,  `bdate` = ?,  `complete_address` = ?,  `cnumber` = ?,  `gender` = ?,  `civilstatus` = ?,  `datehire` = ?,  `designation` = ? WHERE employee_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("issssssssssssi", $employee_idno, $email, $password, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation,  $employee_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}
	public function edit_employee($employee_idno, $email, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation, $employee_id)
	{

		$sql = "UPDATE `tbl_employee` SET  `employee_idno` = ?,`email` = ?, `first_name` = ?, `middle_name` = ?,  `last_name` = ? ,  `bdate` = ?,  `complete_address` = ?,  `cnumber` = ?,  `gender` = ?,  `civilstatus` = ?,  `datehire` = ?,  `designation` = ?  WHERE employee_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("isssssssssssi", $employee_idno, $email, $first_name, $middle_name, $last_name, $bdate, $caddress, $cnumber,  $gender, $civilstatus, $datehire, $designation, $employee_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}

	public function delete_employee($employee_id)
	{
		error_reporting(0);
		$sql = "SELECT employee_idno FROM tbl_employee WHERE employee_id = ?";
		$stmt2 = $this->conn->prepare($sql);
		$stmt2->bind_param("i", $employee_id);
		$stmt2->execute();
		$result2 = $stmt2->get_result();
		$row = $result2->fetch_assoc();
		$imagepath = "../../qrcode_images/" . $row['employee_idno'] . '.png'; //delete the image inside a folder path
		unlink($imagepath);

		$sql = "DELETE FROM tbl_employee WHERE employee_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $employee_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}


	

	/////////// CRUD ATTENDANCE//////////////////////////////////////////////////////////////////////////////////
	public function fetchAll_attendance()
	{
		$sql = "SELECT * FROM tbl_attendance a INNER JOIN tbl_employee b ON a.employee_qrcode = b.qr_code  WHERE DATE(a.logdate) = CURDATE() ORDER BY a.attendance_id DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

	public function fetchAll_empAttendance()
	{
		$sql = "SELECT * FROM tbl_attendance a INNER JOIN tbl_employee b ON a.employee_qrcode = b.qr_code ORDER BY a.attendance_id DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}
	public function fetchAll_empAttendancecount()
	{
		$sql = "SELECT COUNT(*)as log_date FROM tbl_attendance a INNER JOIN tbl_employee b ON a.employee_qrcode = b.qr_code ORDER BY a.employee_qrcode  DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}
	public function add_attendance($employee_qrcode, $time_in, $time_out, $logdate, $time_stat)
	{
		$stats = 1;
		$stmt = $this->conn->prepare("INSERT INTO `tbl_attendance` (`employee_qrcode`,`time_in`,`time_out`,`logdate`, `time_stat`,`status`) VALUES(?,?,?,?,?,?)") or die($this->conn->error);
		$stmt->bind_param("ssssss",$employee_qrcode, $time_in, $time_out, $logdate, $time_stat, $stats);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}
	public function delete_attendance($attendance_id)
	{

		$sql = "DELETE FROM tbl_attendance WHERE attendance_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $attendance_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}


	/////////// CRUD SCHEDULE //////////////////////////////////////////////////////////////////////////////////
	public function add_schedule($employee_qrcode, $event_name, $event_date, $time_in, $time_out)
	{
		$stmt = $this->conn->prepare("INSERT INTO `tbl_schedule` (`employee_qrcode`,`event_name`,`time_in`, `time_out`,`event_date`) VALUES(?,?,?,?,?)") or die($this->conn->error);
		$stmt->bind_param("sssss",	$employee_qrcode, $event_name, $time_in, $time_out, $event_date);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}

	public function edit_schedule($employee_qrcode, $event_name, $date, $time_in, $time_out, $schedule_id)
	{
		$sql = "UPDATE `tbl_schedule` SET  `employee_qrcode` = ?, `event_name` = ?, `time_in` = ?,  `time_out` = ? , `event_date` = ? WHERE schedule_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssssi", $employee_qrcode, $event_name, $date, $time_in, $time_out, $schedule_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}
	public function delete_schedule($schedule_id)
	{

		$sql = "DELETE FROM tbl_schedule WHERE schedule_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $schedule_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}
	public function fetchAll_schedule()
	{
		$sql = "SELECT * FROM tbl_schedule ORDER BY schedule_id DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

//////////////////////// USER ///////////////////////////////////////////////////////////////////////////////////

	public function login_employee($employee_idno, $password)
	{
		$stmt = $this->conn->prepare("SELECT * FROM `tbl_employee` WHERE `employee_idno` = ?") or die($this->conn->error);
		$stmt->bind_param("i", $employee_idno);
		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$valid = $result->num_rows;
			$fetch = $result->fetch_array();
			if ($fetch && password_verify($password, $fetch['password'])
			) {
				return array(
					'employee_id' => htmlentities($fetch['employee_id']),
					'count' => $valid
				);
			} else {
				return 0;
			}
		}
	}

	public function employee_account($employee_id)
	{
		$stmt = $this->conn->prepare("SELECT * FROM `tbl_employee` WHERE `employee_id` = ?") or die($this->conn->error);
		$stmt->bind_param("i", $employee_id);
		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$fetch = $result->fetch_array();
			return array(
				'first_name' => $fetch['first_name'],
				'last_name' => $fetch['last_name'],
				'gender' => $fetch['gender']

			);
		}
	}

			public function fetchindividual_employeeviaQR($employee_qrcode)
			{
				$sql = "SELECT * FROM tbl_employee WHERE `qr_code` = '$employee_qrcode'";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
				$data = array();
				while ($row = $result->fetch_assoc()) {
				$data[] = $row;
				}
				return $data;
				}

	    public function fetchindividual_employee($employee_id){ 
	            $sql = "SELECT * FROM  tbl_employee WHERE `employee_id` = ?";
					$stmt = $this->conn->prepare($sql);
					$stmt->bind_param("i", $employee_id);
					$stmt->execute();
					$result = $stmt->get_result();
			        $data = array();
			         while ($row = $result->fetch_assoc()) {
			                   $data[] = $row;
			            }
			         return $data;

			  }

         public function fetchindividual_empAttendance($employee_id){ 
            $sql = "SELECT * FROM tbl_attendance a INNER JOIN tbl_employee b ON a.employee_qrcode = b.qr_code WHERE b.employee_id = ? ORDER BY a.attendance_id DESC";
				$stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $employee_id);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }
////////////////////////// COUNT ////////////////////////////////////////////////////////////////////////////////
		   public function count_numberofdepartment(){ 
            $sql = "SELECT COUNT(department_id) as department_id FROM tbl_department ORDER BY department_id DESC";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }


		  public function count_numberofemployees(){ 
            $sql = "SELECT COUNT(employee_id) as employee_id FROM tbl_employee ORDER BY employee_id DESC";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function count_numberofattendance(){ 
            $sql = "SELECT COUNT(attendance_id) as attendance_id FROM tbl_attendance ORDER BY attendance_id DESC";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		    public function count_numberoftimeInOutToday(){ 
            $sql = "SELECT COUNT(attendance_id) as attendance_ids  FROM tbl_attendance  WHERE DATE(logdate) = CURDATE() ORDER BY attendance_id DESC";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		   public function count_numberofattendanceIndividualEmp($employee_id){ 
            $sql = "SELECT COUNT(a.attendance_id) as attendance_ids  FROM tbl_attendance a INNER JOIN tbl_employee b ON a.employee_qrcode = b.qr_code WHERE b.employee_id = ? ORDER BY a.attendance_id DESC";
				$stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $employee_id);
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	public function count_numberofattendancelateIndividualEmp($employee_id)
	{
		$late = "Late";
		$absent = "Absent";
		$sql = "SELECT COUNT(a.attendance_id) as lates FROM tbl_attendance a INNER JOIN tbl_employee b ON a.employee_qrcode = b.qr_code WHERE b.employee_id = ? AND time_stat = '$late' OR time_stat = '$absent' ORDER BY a.attendance_id DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $employee_id);
		$stmt->execute();
		$result = $stmt->get_result();
		 $data = array();
			 while ($row = $result->fetch_assoc()) {
					   $data[] = $row;
				}
			 return $data;
		  }
		  public function count_numberofemployeesIndividualEmp($employee_id){ 
            $sql = "SELECT COUNT(employee_id) as employee_id FROM tbl_employee WHERE employee_id = ? ORDER BY employee_id DESC";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $employee_id);
			$stmt->execute();
			$result = $stmt->get_result();
		     $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;
				}

	public function fetchAll_department()
	{
		$sql = "SELECT * FROM tbl_department ORDER BY department_id DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

	public function add_department($department_name, $description)
	{
		$stmt = $this->conn->prepare("INSERT INTO `tbl_department` (`department_name`, `description`) VALUES(?, ?)") or die($this->conn->error);
		$stmt->bind_param("ss", $department_name, $description);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}



	public function edit_department($department_name, $description, $employee_id)
	{

		$sql = "UPDATE `tbl_department` SET  `department_name` = ?, `description` = ? WHERE department_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ssi", $department_name, $description, $employee_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}


	public function delete_department($department_id)
	{

		$sql = "DELETE FROM tbl_department WHERE department_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $department_id);
		if ($stmt->execute()) {
			$stmt->close();
			$this->conn->close();
			return true;
		}
	}
}
