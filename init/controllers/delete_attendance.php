<?php
require_once "../model/class_model.php";


if (isset($_POST)) {
    $conn = new class_model();

    $attendance_id = trim($_POST['attendance_id']);

    $del = $conn->delete_attendance($attendance_id);
    if ($del == TRUE) {
        echo '<div class="alert alert-success">Deleted Attendance Successfully!</div><script> setTimeout(function() {  location.replace("manage_attendance"); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Deleted Attendance Failed!</div><script> setTimeout(function() {  location.replace("manage_attendance"); }, 1000); </script>';
    }
}
