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
                      <h1>Manage Admin Users</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-end">
                          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                          <li class="breadcrumb-item">Manage Admin</li>
                      </ol>
                  </div>
              </div>
        <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body" style="overflow-x:auto">
                        <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#modal-default">
                                  <i class="mdi mdi-account-plus"></i> Add Admin
                              </button>
                            <h4 class="card-title">Manage Admin Users</h4>
                            <div class="table-responsive" style = "overflow-x:auto">
                                <table id="example1" class=" table table-dark">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                          <th>Email</th>
                                          <th>Contact Number:</th>
                                          <th>Action</th>
                                   </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $conn = new class_model();
                                        $emp = $conn->fetchAll_admin();
                                        ?>
                                      <?php foreach ($emp as $row) { ?>
                                          <tr>
                                              <td><?= htmlentities($row['full_name']); ?></td>
                                              <td><?= htmlentities($row['email']); ?></td>
                                              <td><?= htmlentities($row['cnumber']); ?></td>
                                              <td class="align-right">
                                        <button type="button" class="btn btn-warning edit_E" data-toggle="modal" data-target="#edit-admin" data-id="<?= htmlentities($row['admin_id']); ?>">Edit</button> |
                                        <button type="button" class="btn btn-danger delete_E" data-toggle="modal" data-target="#delete-admin" data-del="<?= htmlentities($row['admin_id']); ?>">Delete</button>
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

  </div>
  <?php include 'modal/addadmin_modal.php'; ?>
  <?php include 'modal/editadmin_modal.php'; ?>
  <?php include 'modal/deleteadmin_modal.php'; ?>
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
                      $('#edit_fullname').val(response.full_name);
                      $('#edit_email').val(response.email);
                      $('#edit_username').val(response.username);
                      $('#edit_cnumber').val(response.cnumber);
                      $('#edit_gender').val(response.gender);
                      $('#edit_adminid').val(response.admin_id);
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
                  var admin_id = $(this).data("del");
                  console.log(admin_id);
                  get_delId(admin_id); //argument    

              });
          }

          function get_delId(admin_id) {
              $.ajax({
                  type: 'POST',
                  url: 'fetch_row/admin_row.php',
                  data: {
                      admin_id: admin_id
                  },
                  dataType: 'json',
                  success: function(response2) {
                      $('#delete_adminid').val(response2.admin_id);
                      $('#delete_fullname').val(response2.full_name);

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