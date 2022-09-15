<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dist/css/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>AMS | Login</title>
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
                <form method="post" name="login_sform" class="sign-in-form">
                    <h2 class="title">Welcome back Admin!</h2>
                    <?php
                    if (isset($_GET['newpwd'])) {
                        if ($_GET['newpwd'] == 'passwordupdated') {
                            echo '<p>Success! Your password has been reset!</p>';
                        }
                    }
                    ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input class="form-control form-control-lg" id="username" alt="employee_idno" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input class="form-control form-control-lg" id="password" type="password" alt="password" placeholder="Password" autocomplete="off">
                    </div>
                    <a href="forgot_pass" style="align-items:left;">Forgot password</a>
                    <button class="btn btn-lg btn-block button1" value="Sign in" id="btn-admin" name="btn-admin">Login</button>
                    <div class="form-group" id="alert-msg">
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Changed your mind?</h3>
                    <p>Click here to go back.</p>
                    <button type="button" class="btn transparent" id="homebtn"><span class="material-symbols-outlined">
                            arrow_back
                        </span></button>
                </div>
                <img src="dist/img/log.svg" class="image" alt="" />
            </div>
        </div>
    </div>
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
                    $('#alert-msg').html('<div class="alert alert-danger"> Required Username and Password!</div>');
                } else {
                    $.ajax({
                            type: 'POST',
                            url: '../init/controllers/login_process.php',
                            data: {
                                username: employee_idno,
                                password: p_password
                                // status: s_status
                            },
                            beforeSend: function() {
                                $('#alert-msg').html('');
                            }
                        })
                        .done(function(t) {
                            if (t == 1) {
                                $("#btn-admin").html('<img src="../assets/images/loading.gif" /> &nbsp; Signing In ...');
                                setTimeout(' window.location.href = "dtr_dashboard/dashboard"; ', 2000);
                            } else {
                                $('#alert-msg').html('<div class="alert alert-danger">Incorrect Credentials</div>');
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