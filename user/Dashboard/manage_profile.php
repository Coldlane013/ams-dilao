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
              <li class="breadcrumb-item"><a href="user">Home</a></li>
              <li class="breadcrumb-item">Manage Profile</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <?php
          $employee_id = $_SESSION['employee_id'];
          $conn = new class_model();
          $emp = $conn->fetchindividual_employee($employee_id);
          ?>
          <?php foreach ($emp as $row) { ?>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <button type="button" class="btn btn-primary float-end edit_E" data-toggle="modal" data-target="#edit-profile" data-id="<?= htmlentities($row['employee_id']); ?>">
                    <i class="mdi mdi-account-plus"></i>Edit Profile
                  </button>
                  <h4 class="card-title">User Profile</h4>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" value="<?= $row['first_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input type="text" class="form-control" value="<?= $row['middle_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" value="<?= $row['last_name']; ?>" readonly>
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
                    <div class="form-group">
                      <label>Civil Status</label>
                      <input type="text" class="form-control" value="<?= $row['civilstatus']; ?>" readonly>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Date Joined</label>
                      <input type="text" class="form-control" value="<?= $row['datehire']; ?>" readonly>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Designation</label>
                      <input type="text" class="form-control" value="<?= $row['designation']; ?>" readonly>
                      </select>
                    </div>
                  <?php } ?>
                  </form>
                </div>
              </div>
            </div>
        </div>
        <?php include 'modal/editemployee_modal.php'; ?>
        <script>
          $(document).ready(function() {
            load_data();
            var count = 1;

            function load_data() {
              $(document).on('click', '.edit_E', function() {
                var employee_id = $(this).data("id");
                console.log(employee_id);
                get_Id(employee_id); //argument    

              });
            }

            function get_Id(employee_id) {
              $.ajax({
                type: 'POST',
                url: 'fetch_row/employee_row.php',
                data: {
                  employee_id: employee_id
                },
                dataType: 'json',
                success: function(response) {
                  $('#edit_employeeid').val(response.employee_id);
                  $('#edit_employeeidno').val(response.employee_idno);
                  $('#email').val(response.email);
                  $('#edit_password').val(response.password);
                  $('#edit_firstname').val(response.first_name);
                  $('#edit_middlename').val(response.middle_name);
                  $('#edit_lastname').val(response.last_name);
                  $('#edit_bdate').val(response.bdate);
                  $('#edit_completeaddress').val(response.complete_address);
                  $('#edit_cnumber').val(response.cnumber);
                  $('#edit_gender').val(response.gender);
                  $('#edit_civilstatus').val(response.civilstatus);
                  $('#edit_datehire').val(response.datehire);
                  $('#edit_designation').val(response.designation);

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