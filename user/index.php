<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AMS | Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        .btn:hover {
            background-color: #2AA2EF;
            color: white;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="container sign-up-mode">

        <div class="forms-container">
            <div class="signin-signup">
                <form method="post" name="login_sform">
                    <h2 class="title">Welcome Back User!</h2>
                    <?php
                    if (isset($_GET['newpwd'])) {
                        if ($_GET['newpwd'] == 'passwordupdated') {
                            echo '<p>Success! Your password has been reset!</p>';
                        }
                    }
                    ?>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input class="form-control form-control-lg" id="employee_idno" alt="employee_idno" type="text" placeholder="User ID" autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input class="form-control form-control-lg" id="password" type="password" alt="password" placeholder="Password" autocomplete="off">
                    </div>
                    <a href="forgotpass_user.php" style="align-items:left;">Forgot password</a>

                    <button class="btn btn-lg btn-block button1" value="Sign in" id="btn-employee" name="btn-employee">
                        Sign in
                    </button>
                    <div class="load" id="loading">
                    </div>
                    <div class="form-group" id="alert-msg">
                </form>
            </div>

        </div>

        <div class="panels-container">
            <div class="panel left-panel">

            </div>
            <div class="panel right-panel">
                <div class="content">
                    <form>
                        <div class="content">
                            <h3>Changed your mind?</h3>
                            <p>Click here to go back.</p>
                            <button type="button" class="btn btn-warning btn-rounded transparent" id="homebtn"><span class="material-symbols-outlined">
                                    arrow_forward
                                </span></button>
                        </div>
                    </form>
                </div>
                <img src="dist/img/register.svg" class="image" alt="" />
                <link rel="stylesheet" href="assets/css/login.css">

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
    <script type="text/javascript">
        document.oncontextmenu = document.body.oncontextmenu = function() {
            return false;
        } //disable right click
    </script>
    <script type="text/javascript">
        jQuery(function() {
            $('form[name="login_sform"]').on('submit', function(e) {
                e.preventDefault();

                var employee_idno = $(this).find('input[alt="employee_idno"]').val();
                var p_password = $(this).find('input[alt="password"]').val();
                // var s_status = 1;
                if (employee_idno === '' && p_password === '') {
                    $('#loading').html('<img src="../assets/images/loading.gif" /> &nbsp; Verifying...</div>').delay(100).fadeOut(30);
                    $('#alert-msg').html('<div class="alert alert-danger"> Required User ID and Password!</div>');
                } else {
                    $.ajax({
                            type: 'POST',
                            url: '../init/controllers/loginemp_process.php',
                            data: {
                                employee_idno: employee_idno,
                                password: p_password
                                // status: s_status
                            },
                            beforeSend: function() {
                                $('#alert-msg').html('');
                            }
                        })
                        .done(function(t) {
                            if (t == 1) {
                                $('#loading').html('<img src="../assets/images/loading.gif" /> &nbsp; Verifying...</div>').delay(500).fadeOut(50);
                                $("#btn-employee").html('Signing In ...');
                                setTimeout(' window.location.href = "Dashboard/user"; ', 2000);
                            } else {
                                $('#loading').html('<img src="../assets/images/loading.gif" /> &nbsp; Verifying...</div>').delay(300).fadeOut(10);
                                $('#alert-msg').html('Incorrect User ID or password!');
                            }
                        });
                }
            });
        });
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script>
        var btn = document.getElementById('homebtn');
        btn.addEventListener('click', function() {
            document.location.href = '../';
        });
    </script>
</body>

</html>