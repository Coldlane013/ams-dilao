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
            <h1>Manage Attendance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-end">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item">Manage Attendance</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body" style="overflow-x:auto">
                <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#modal-default">
                  <i class="mdi mdi-clipboard"></i> Add Attendance
                </button>
                <h4 class="card-title">Manage Attendance</h4>
                <div class="table-responsive" style="overflow-x:auto">
                  <table id="example1" class=" table table-dark">
                    <thead>
                      <tr>
                        <th>UserID No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Log Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $conn = new class_model();
                      $emp = $conn->fetchAll_empAttendance();
                      ?>
                      <?php foreach ($emp as $row) { ?>
                        <tr>
                          <td><?= htmlentities($row['employee_idno']); ?></td>
                          <td><?= htmlentities($row['first_name']); ?></td>
                          <td><?= htmlentities($row['last_name']); ?></td>
                          <td><?php if ($row['time_in'] == '') {
                                echo '';
                              } else {
                                echo htmlentities(date('h:i:A', strtotime($row['time_in'])));
                              }
                              ?></td>
                          <td><?php if ($row['time_out'] == '') {
                                echo '';
                              } else {
                                echo htmlentities(date('h:i:A', strtotime($row['time_out'])));
                              }
                              ?></td>
                          <td><?= htmlentities(date("M d, Y", strtotime($row['logdate']))); ?></td>
                          <td><?= htmlentities($row['time_stat']); ?></td>
                          <td> <button type="button" class="btn btn-danger delete_E" data-toggle="modal" data-target="#delete-attendance" data-del="<?= htmlentities($row['attendance_id']); ?>">Delete</button>
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
  <?php include 'modal/addattendance_modal.php'; ?>
  </div>
  <div>
    <?php include 'modal/deleteattendance_modal.php'; ?>
  </div>
  <script>
    $(document).ready(function() {
      load_data();
      var count = 1;

      function load_data() {
        $(document).on('click', '.delete_E', function() {
          var attendance_id = $(this).data("del");
          console.log(attendance_id);
          get_delId(attendance_id); //argument    

        });
      }

      function get_delId(attendance_id) {
        $.ajax({
          type: 'POST',
          url: 'fetch_row/attendance_row.php',
          data: {
            attendance_id: attendance_id
          },
          dataType: 'json',
          success: function(response2) {
            $('#delete_attendanceid').val(response2.attendance_id);
            $('#delete_attendance').val(response2.employee_qrcode);

          }
        });
      }

    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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