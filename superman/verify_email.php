<?php
    include('../init/model/config/connection2.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\OAuth;
    //Alias the League Google OAuth2 provider class
    use League\OAuth2\Client\Provider\Google;
    require '../vendor/autoload.php';

   
    if (isset($_POST['submit'])) {
        
        $select = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = "https://*******/create_new_password.php?select=".$select."&validator=".bin2hex($token);
       
        $expires = date("U") + 1800;


        $userEmail = $_POST["email"];

        $sql = "DELETE FROM tbl_forgotpass WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "Connection Error!";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,'s',$userEmail);
            mysqli_stmt_execute($stmt);
        }

        $sql = "INSERT INTO tbl_forgotpass (`email`, `selector`, `token`, `expire`) VALUES(?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Connection Error!";
        exit();
        } else {
        $hashedToken = password_hash($token,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'ssss', $userEmail,$select,$hashedToken,$expires);
        mysqli_stmt_execute($stmt);
         }
         mysqli_stmt_close($stmt);
         $conn->close();

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->AuthType = 'XOAUTH2';

    $email = '********************************';
    $clientId = "*****************************************";
    $clientSecret = "*************************";
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $refreshToken =  '********************';


    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]
    );


    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]
        )
    );

    $to = $userEmail;
    $mail->setFrom($email, '@********@gmail.com');
    $mail->addAddress($to);



    $mail->isHTML(true);

    $subject = "Password Reset for DILAO PARISH AMS";
    $headers = "From: AMS <**********@gmail.com>\r\n";
    $headers .= "Reply-To:*********@gmail.comr\n";
    $headers .= "Content-type:text/html\r\n";  
    $message = '<p>Received Password Reset Request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p></br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';
    //Set the subject line
    $mail->Subject = $subject;
    $mail->Header =$headers;
    $mail->Body = $message;


    if (!$mail->send()) {
        echo 'Mailer Error: ' .
        $mail->SMTPDebug = 4;
    } else {
        echo 'Message sent!';
        header("Location:forgot_pass.php?reset=success");
    }
        }
    else{
        header("Location:index.php");
    }
?>
