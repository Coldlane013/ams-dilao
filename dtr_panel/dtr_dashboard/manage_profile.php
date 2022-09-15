<?php include "perm/header.php"; ?>
<?php include "perm/navbar.php"; ?>
<?php include "perm/main_side_bar.php"; ?>
<?php include "js/js.php"; ?>

<body>
  <div class="container-fluid page-body-wrapper">
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-end">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item">Manage Profile</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <?php
          $admin_id = $_SESSION['admin_id'];
          $conn = new class_model();
          $emp = $conn->fetchindividual_admin($admin_id);
          ?>
          <?php foreach ($emp as $row) { ?>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <button type="button" class="btn btn-primary float-end edit_E" data-toggle="modal" data-target="#edit-profile" data-id="<?= htmlentities($row['admin_id']); ?>">
                    <i class="mdi mdi-account-plus"></i>Edit Profile
                  </button>
                  <h4 class="card-title">User Profile</h4>
                  <form class="forms-sample">
                    <div class="form-group">

                      <label>Name</label>
                      <input type="text" class="form-control" value="<?= $row['full_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Username <strong style="color: green;" >(Used in login, please remember after changed.)</strong></label>
                      <input type="user" class="form-control" value="<?= $row['username']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Email address</label>
                      <input type="email" class="form-control" value="<?= $row['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <input type="text" class="form-control" value="<?= $row['cnumber']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Gender</label>
                      <input type="text" class="form-control" value="<?= $row['gender']; ?>" readonly>

                      </select>
                    </div>
                    <!-----
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
           ------> <?php } ?>
                  </form>
                </div>
              </div>
            </div>
        </div>
        <?php include 'modal/editprofile_modal.php'; ?>
        <script>
          $(document).ready(function() {
            load_data();
            var count = 1;

            function load_data() {
              $(document).on('click', '.edit_E', function() {
                var admin_id = $(this).data("id");
                console.log(admin_id);
                get_Id(admin_id); //argument    

              });
            }

            function get_Id(admin_id) {
              $.ajax({
                type: 'POST',
                url: 'fetch_row/admin_row.php',
                data: {
                  admin_id: admin_id
                },
                dataType: 'json',
                success: function(response) {
                  $('#edit_adminid').val(response.admin_id);
                  $('#edit_fullname').val(response.full_name);
                  $('#edit_email').val(response.email);
                  $('#edit_cnumber').val(response.cnumber);
                  $('#edit_gender').val(response.gender);
                }
              });
            }

          });
        </script>
        <script src="../../assets/plugins/jquery/jquery.min.js"></script>
        <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script>
          $(function() {
            $("#example1").DataTable({});

          });
        </script>
</body>

</html>