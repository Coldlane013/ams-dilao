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
            <h1>Attendance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-end">
              <li class="breadcrumb-item"><a href="user">Home</a></li>
              <li class="breadcrumb-item">Attendance</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body" style="overflow-x:auto">
                <h4 class="card-title"> Attendance List</h4>
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $employee_id = $_SESSION['employee_id'];
                      $conn = new class_model();
                      $emp = $conn->fetchindividual_empAttendance($employee_id);
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
                          <td><?php
                              $Timein = $row['time_stat'];

                              if ($Timein == 'On Time') {
                                echo "<button class='btn btn-success btn-xs'><i class='fa fa-user-clock'></i> On Time</button>";
                              } elseif ($Timein == 'Late') {
                                echo "<button  class='btn btn-warning btn-xs'><i class='fa fa-user-clock'></i> Late</button>";
                              } else {
                                echo "<button  class='btn btn-danger btn-xs'><i class='fa fa-user-clock'></i> Late</button>";
                              }

                              ?></td>
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
  <div>
  </div>
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