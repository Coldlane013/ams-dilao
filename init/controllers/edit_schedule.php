<?php
require_once "../model/class_model.php";

if (isset($_POST)) {
    $conn = new class_model();
    $employee_qrcode = trim($_POST['employee_qrcode']);
    $schedule_name = trim($_POST['event_name']);
    $time_in = trim($_POST['time_in']);
    $time_out = trim($_POST['time_out']);
    $date = trim($_POST['event_date']);
    $schedule_id = trim($_POST['schedule_id']);

    $add = $conn->edit_schedule($employee_qrcode, $schedule_name, $time_in, $time_out, $date, $schedule_id);
    if ($add == TRUE) {
        echo '<div class="alert alert-success">Update Schedule Successfully!</div><script> setTimeout(function() {  location.replace("manage_schedule"); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Update Schedule Failed!</div><script> setTimeout(function() {  location.replace("manage_schedule"); }, 1000); </script>';
    }
}
