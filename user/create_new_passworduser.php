<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dist/css/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>AMS | Reset Password</title>
    <style>
        .btn:hover {
            background-color: #2AA2EF;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">

                <?php
                $selector = $_GET["select"];
                $validator = $_GET["validator"];
                if (empty($selector) || empty($validator)) {
                    echo "Cannot validate your request!";
                } else {
                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator)) {
                ?>

                        <form method="post" action="../init/controllers/reset-passworduser.php" class="sign-in-form">
                            <input type="hidden" name="selector" value="<?php echo $selector ?>">
                            <input type="hidden" name="validator" value="<?php echo $validator ?>">
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input class="form-control form-control-lg" id="admin-reset" name="pwd" alt="passwordadmin-reset" type="password" placeholder="Enter New Password..." autocomplete="off" required>
                            </div>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input class="form-control form-control-lg" id="admin-reset" name="pwd-repeat" alt="passwordadmin-reset" type="password" placeholder="Confirm Password..." autocomplete="off" required>
                            </div>
                            <button class="btn btn-lg btn-block button1" type="submit" value="Reset Password" id="btn-admin-reset" name="reset-password-submit">Reset Password</button>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                    </div>
                    <img src="dist/img/usercreate.svg" class="image" alt="" />
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end login page  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

</body>

</html>