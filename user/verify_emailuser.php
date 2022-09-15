<?php
    error_reporting(0);
    include('../init/model/config/connection2.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\OAuth;
    //Alias the League Google OAuth2 provider class
    use League\OAuth2\Client\Provider\Google;
   
    require '../vendor/autoload.php';

    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "../../init/model/config");
    $dotenv->load();

    if (isset($_POST['submit'])) {
        
        $select = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $url = "https://**********/user/create_new_passworduser?select=".$select."&validator=".bin2hex($token);
       
        $expires = date("U") + 1800;


        $userInput= trim($_POST["email"]);

        $sql = "SELECT email FROM `tbl_employee` WHERE `employee_idno` = ?";

        $stmt = mysqli_stmt_init($conn);
         

         if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Connection Error!";
        exit();
         } else {
        mysqli_stmt_bind_param($stmt, 's', $userInput);
        mysqli_stmt_execute($stmt);
        }


         $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {
             $useremail = $row["email"];
             }

        if($useremail<1)
       {
         echo "No email associated with given User ID. Redirecting....";
        header('Refresh: 3; URL= forgotpass_user');
           exit();
        }

        $sql = "DELETE FROM tbl_forgotpass WHERE email = ?";
       
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "Connection Error!";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,'s', $useremail);
            mysqli_stmt_execute($stmt);
        }
   
        $sql = "INSERT INTO tbl_forgotpass (`email`, `selector`, `token`, `expire`) VALUES(?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Connection Error!";
        exit();
        } else {
        $hashedToken = password_hash($token,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'ssss', $useremail,$select,$hashedToken,$expires);
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

    $email = $_ENV['EMAIL_NAME'];
    $clientId = $_ENV['C_ID'];
    $clientSecret = $_ENV['C_SECRET'];
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $refreshToken = $_ENV['R_TOKEN'];


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

    $to = $useremail;
    $mail->setFrom($email, '**********.com');
    $mail->addAddress($to);



    $mail->isHTML(true);

    $subject = "Password Reset for DILAO PARISH AMS";
    $headers = "From: AMS <@********@gmail.com>\r\n";
    $headers .= "Reply-To:*******@gmail.com\r\n";
    $headers .= "Content-type:text/html\r\n";  
    $message = '<p>Received Password Reset Request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p></br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';
    //Set the subject line
    $mail->Subject = $subject;
    $mail->Header = $headers;
    $mail->Body = $message;


    if (!$mail->send()) {
        echo 'Mailer Error: ' .
        $mail->SMTPDebug = 4;
    } else {
        echo 'Message sent!';
        header("Location:forgotpass_user?reset=success");
    }
        }
    else{
        header("Location:index");
    }
?>
