<?php
require_once "../model/class_model.php";
if (isset($_POST)) {
    $conn = new class_model();

    $employee_qrcode = trim($_POST['employee_qrcode']);
    $time_in = trim($_POST['time_in']);
    $time_out = trim($_POST['time_out']);
    $logdate = trim($_POST['logdate']);
    $time_stat = trim($_POST['time_stat']);
  

    $add = $conn->add_attendance($employee_qrcode,$time_in, $time_out,$logdate,$time_stat);
    if ($add == TRUE) {
        echo '<div class="alert alert-success">Added Attendance Successfully!</div><script> setTimeout(function() {  location.replace("manage_attendance"); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Added Attendance Failed!</div><script> setTimeout(function() {  location.replace("manage_attendance"); }, 1000); </script>';
    }
}
