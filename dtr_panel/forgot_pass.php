<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dist/css/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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

                <form method="post" action="verify_email" class="sign-in-form">
                    <h2 class="title">Enter Your Email Address:</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input class="form-control form-control-lg" id="admin-reset" name="email" alt="email-reset" type="text" placeholder="Enter your Email Address here..." autocomplete="off" required>
                    </div>
                    <button class="btn btn-lg btn-block button1" type="submit" value="submit" id="submit" name="submit">Submit</button>
                    <div class="form-group" id="alert-msg">
                    </div>
                </form>
                <?php
                if (isset($_GET['reset'])) {
                    if ($_GET['reset'] == 'success') {
                        echo '<center><p>Success! Email Sent.</p></center>';
                    }
                }

                ?>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Changed your mind?</h3>
                    <p>Click here to go back.</p>

                    <button type="button" class="btn transparent" id="redirectbtn"><span class="material-symbols-outlined">
                            arrow_back
                        </span></button>

                </div>
                <img src="dist/img/forgot.svg" class="image" alt="" />
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
    <script>
        var btn = document.getElementById('redirectbtn');
        btn.addEventListener('click', function() {
            document.location.href = 'index';
        });
    </script>
</body>

</html>