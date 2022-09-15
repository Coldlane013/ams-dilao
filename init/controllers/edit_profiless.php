<?php
require_once "../model/class_model.php";

if (isset($_POST)) {
    $conn = new class_model();
   

    $name = trim(ucfirst($_POST['name']));
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $super_id = trim($_POST['super_id']);
    $edit = $conn->edit_superprofile($name, $username,$email,$super_id);
    if ($edit == TRUE) {
        echo '<div class="alert alert-success">Update Profile Successfully!</div><script> setTimeout(function() {  location.replace("manage_profile"); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Update Profile Failed!</div><script> setTimeout(function() {  location.replace("manage_profile"); }, 1000); </script>';
    }
}
