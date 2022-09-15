<?php
    error_reporting(0);
    if(isset($_POST['reset-password-submit'])){
    $options = ['cost' => 15];
    $selector =  $_POST['selector'];
    $validator = $_POST['validator'];
    $password = trim($_POST['pwd']);
    $passwordRepeat = trim($_POST['pwd-repeat']);

    if(empty($password)||empty($passwordRepeat)){
        echo "Cannot validate your request at the moment. Please try again";
        header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
        exit();
    } else if($password != $passwordRepeat){
        echo "Password not the same. Please request again";
        header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
        exit();
    }

    $currentDte = date("U");

    require("../model/config/connection2.php");

    $sql = "SELECT * FROM tbl_forgotpass WHERE selector = ? AND expire >= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "Connection Error!";
        header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
        exit();
       
    }
    else {
        mysqli_stmt_bind_param($stmt,'ss',$selector,$currentDte);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)){
            echo "EXPIRED LINK! Please re-submit your reset request.";
            header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
            exit();
           
        }
        else{
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin,$row['token']);
            If($tokenCheck === false){
                echo "Something happened! Please re-submit your reset request.";
                header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
                exit(); 
                
            }elseif($tokenCheck === true) {

                $tokenEmail = $row['email'];
                $sql = "SELECT * FROM tbl_admin WHERE email = ?;";

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "Connection Error!";
                header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
                exit();
                
                }
                else{
                   
                 mysqli_stmt_bind_param($stmt,'s',$tokenEmail);  
                 mysqli_stmt_execute($stmt); 
                 $result = mysqli_stmt_get_result($stmt);
                 if(!$row = mysqli_fetch_assoc($result)){
                     echo "Error detected! Please re-submit your reset request.";
                    header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
                     exit();
                 }
                 else {

                    $sql = "UPDATE tbl_admin SET password = ? WHERE email = ? ";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "Connection Error!";
                    header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
                    exit();
                    }
                    else{
                     $newhash = password_hash($password, PASSWORD_BCRYPT, $options);  
                     mysqli_stmt_bind_param($stmt,'ss',$newhash,$tokenEmail);  
                     mysqli_stmt_execute($stmt); 
                     
                     
                     $sql = "DELETE FROM tbl_forgotpass WHERE email = ?";
                     $stmt = mysqli_stmt_init($conn);
                     if(!mysqli_stmt_prepare($stmt,$sql)){
                         echo "Connection Error!";
                         header('Refresh: 3; URL= ../../dtr_panel/forgot_pass');
                         exit();
                        
                     }
                     else {
                         mysqli_stmt_bind_param($stmt,'s',$tokenEmail);
                         mysqli_stmt_execute($stmt);
                         header("Location:../../dtr_panel/?newpwd=passwordupdated");
                     }
             


                    }
                 }   
                }


            }
        }
    }


    }else{
        header("Location: ../../dtr_panel/");
    }




?>
