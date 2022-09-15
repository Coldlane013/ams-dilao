<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AMS | Login </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/logo.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Welcome back Maintainer!</h3>
              <form method="post" name="login_sform" class="sign-in-form">
                <div class="form-group">
                  <label>Username</label>
                  <input class="form-control p_input" id="username" alt="username" type="text" autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control p_input" id="password" type="password" alt="password" autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Key</label>
                  <input class="form-control p_input" id="key" type="password" alt="key" autocomplete="off">
                </div>
                <div class="text-center">
                  <button class="btn btn-primary btn-block enter-btn" value="Sign in" id="btn-super" name="btn-super">Login</button>
                </div>
                <div class="form-group" id="alert-msg">
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- endinject -->
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

        var username = $(this).find('input[alt="username"]').val();
        var s_password = $(this).find('input[alt="password"]').val();
        var p_key = $(this).find('input[alt="key"]').val();
        // var s_status = 1;

        if (username === '' && s_password === '' && p_key === '') {
          $('#alert-msg').html('<div class="alert alert-danger"> Required All Fields!</div>');
        } else {
          $.ajax({
              type: 'POST',
              url: '../init/controllers/login_ss.php',
              data: {
                username: username,
                password: s_password,
                key: p_key
                // status: s_status
              },
              beforeSend: function() {
                $('#alert-msg').html('');
              }
            })
            .done(function(t) {
              if (t == 1) {
                $("#btn-super").html('<img src="../assets/images/loading.gif" /> &nbsp; Signing In ...');
                setTimeout(' window.location.href = "ss/dashboard"; ', 2000);
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
</body>

</html>
</body>

</html>