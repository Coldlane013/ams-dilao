  <?php

  error_reporting(0);

  include '../../init/model/config/connection2.php';
  if (isset($_POST['employee_qrcode'])) {

    date_default_timezone_set("asia/manila");
    $emp = trim($_POST['employee_qrcode']);
    $date = date('Y-m-d');
    //$time = date('h:i A');
    $time =  date('H:i:s', strtotime("+0 HOURS"));
    $stat = 0;
    $stat2 = 1;
    

    // find person with sched today
    $stmt1 = "SELECT event_date, employee_qrcode FROM tbl_schedule WHERE employee_qrcode = '$emp' AND event_date ='$date'";
    $query = $conn->query($stmt1);
    $result1 = $query;


    // get time in from sched with same date as today
    $stmt3 = "SELECT time_in FROM tbl_schedule WHERE employee_qrcode = '$emp' AND event_date ='$date'";
    $query = $conn->query($stmt3);
    $result3 = $query->fetch_assoc();



    

    if ($result1->num_rows <= 0) {
      echo "<div class='alert alert-warning' role='alert' style='font-size:18px'><p><b><i class='fas fa-exclamation-triangle'></i>  Your QR Code is not registered for today's schedule</b></p></div>";
    } else {
      $id = $emp;
      $stmt2 = "SELECT * FROM tbl_attendance WHERE employee_qrcode = '$id' AND logdate = '$date' AND status = '0'";
      $query = $conn->query($stmt2);
      $result2 = $query;
      
      if ($result2->num_rows > 0) {

        $sql = "UPDATE tbl_attendance SET time_out='$time',  status = '1' WHERE employee_qrcode = '$id' AND logdate = '$date'";
        $query = $conn->query($sql);
      } else {

        $stmt = $conn->prepare("INSERT INTO tbl_attendance(employee_qrcode,time_in,logdate, status) VALUES (?, ?, ?, ?) ");
        $stmt->bind_param("sssi", $emp, $time, $date, $stat);
        $result = $stmt->execute();
       
        $duration = '+15 minutes';
        $leeway =  date('H:i:s', strtotime($duration, strtotime($result3['time_in'])));

        if ($time <= $leeway) {
          $t = "On Time";
        } else {
          $t = "Late";
        }
        $sql = "UPDATE tbl_attendance SET time_stat='$t' WHERE employee_qrcode = '$id' AND logdate = '$date' AND status = '0'";
        $query = $conn->query($sql);       

        if ($result === TRUE) {
          echo "<div class='alert alert-success' role='alert' style='font-size:22px'><h4><i class='fa fa-clock'></i>  Time In</h4><b>Your Time In: </b> " . $time . "</div>";
        } else {
          echo "<div class='alert alert-danger' role='alert'>Error</div>";
        }
      }
    }
  }
  $conn->close();

  ?>