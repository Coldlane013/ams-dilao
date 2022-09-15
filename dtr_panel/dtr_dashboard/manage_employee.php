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
                      <h1>Manage  Users</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-end">
                          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                          <li class="breadcrumb-item">Manage Users</li>
                      </ol>
                  </div>
              </div>
        <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body" style="overflow-x:auto">
                        <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#modal-default">
                                  <i class="mdi mdi-account-plus"></i> Add User
                              </button>
                            <h4 class="card-title">Manage  Users</h4>
                            <div class="table-responsive" style = "overflow-x:auto">
                                <table id="example1" class=" table table-dark">
                                    <thead>
                                    <tr>
                                         <th>QR Image</th>
                                         <th>UserID No.</th>
                                         <th>First Name</th>
                                         <th>Last Name</th>
                                        <th>Designation</th>
                                            <th>Action</th>
                                   </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                    $conn = new class_model();
                    $emp = $conn->fetchAll_employees();
                    ?>
                    <?php foreach ($emp as $row) { ?>
                      <tr>
                        <td>
                          <center><img src="../../qrcode_images/<?= $row['employee_idno']; ?>.png" width="50px" height="50px"></center>
                        </td>
                        <td><?= htmlentities($row['employee_idno']); ?></td>
                        <td><?= htmlentities($row['first_name']); ?></td>
                        <td><?= htmlentities($row['last_name']); ?></td>
                        <td><?= htmlentities($row['designation']); ?></td>

                        <td class="align-right">
                                        <button type="button" class="btn btn-warning edit_E" data-toggle="modal" data-target="#edit-employee" data-id="<?= htmlentities($row['employee_id']); ?>">Edit</button> |
                                        <button type="button" class="btn btn-danger delete_E" data-toggle="modal" data-target="#delete-employee" data-del="<?= htmlentities($row['employee_id']); ?>">Delete</button>
                          </td>
                      </tr>
                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
<?php include 'modal/addemployee_modal.php'; ?>
  <?php include 'modal/editemployee_modal.php'; ?>
  <?php include 'modal/deleteemployee_modal.php'; ?>
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
            $('#edit_email').val(response.email);
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
  <script>
    $(document).ready(function() {
      load_data();
      var count = 1;

      function load_data() {
        $(document).on('click', '.delete_E', function() {
          var employee_id = $(this).data("del");
          console.log(employee_id);
          get_delId(employee_id); //argument    

        });
      }

      function get_delId(employee_id) {
        $.ajax({
          type: 'POST',
          url: 'fetch_row/employee_row.php',
          data: {
            employee_id: employee_id
          },
          dataType: 'json',
          success: function(response2) {
            $('#delete_employeeid').val(response2.employee_id);
            $('#delete_fullname').val(response2.first_name + ' ' + response2.last_name);

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