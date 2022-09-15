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
                      <h1>Manage  Schedule</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-end">
                      <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                      <li class="breadcrumb-item">Manage Schedule</li>
                      </ol>
                  </div>
              </div>
        <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body" style="overflow-x:auto">
                        <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#modal-default">
                                  <i class="mdi mdi-clipboard"></i> Add Schedule
                              </button>
                            <h4 class="card-title">Manage  Schedule</h4>
                            <div class="table-responsive" style = "overflow-x:auto">
                                <table id="example1" class=" table table-dark">
                                    <thead>
                                    <tr>
                                    <th>Event name</th>
                                    <th>Event Date</th>
                                    <th>Time Start</th>
                                    <th>Time End</th>
                                    <th>Participants</th>
                                    <th>Action</th>
                                   </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    $conn = new class_model();
                    $emp = $conn->fetchAll_schedule();
                    ?>
                    <?php foreach ($emp as $row) { ?>
                      <tr>
                        <td><?= $row['event_name']; ?></td>

                        <td><?php
                            $date = $row['event_date'];
                            echo date("F d, Y", strtotime($date));
                            ?></td>
                        <td><?php $time_start = $row['time_in'];
                            echo
                            date('h:i:A', strtotime($time_start));
                            ?></td>
                        <td><?php $time_end = $row['time_out'];
                            echo
                            date('h:i:A', strtotime($time_end));
                            ?></td>
                        <td>

                           <?php
                              $conn = new class_model();
                              $em = $conn->fetchindividual_employeeviaQR($row['employee_qrcode']);
                              foreach ($em as $r)
                              ?>
                          <?php if ($r == ''){
                            echo "No Participants";
                          }
                          else{
                            echo $r['last_name'];
                          }
                            ?>
                        </td>
                        <td class="align-right">
                                        <button type="button" class="btn btn-warning edit_E" data-toggle="modal" data-target="#edit-schedule" data-id="<?= htmlentities($row['schedule_id']); ?>">Edit</button> |
                                        <button type="button" class="btn btn-danger delete_E" data-toggle="modal" data-target="#delete-schedule" data-del="<?= htmlentities($row['schedule_id']); ?>">Delete</button>
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
<?php include 'modal/addschedule_modal.php'; ?>
  </div>
  <div>
    <?php include 'modal/editschedule_modal.php';
    ?>
  </div>
  <?php include 'modal/deleteschedule_modal.php'; ?>
  <script>
    $(document).ready(function() {
      load_data();
      var count = 1;

      function load_data() {
        $(document).on('click', '.edit_E', function() {
          var schedule_id = $(this).data("id");
          console.log(schedule_id);
          get_Id(schedule_id); //argument    

        });
      }

      function get_Id(schedule_id) {
        $.ajax({
          type: 'POST',
          url: 'fetch_row/schedule_row.php',
          data: {
            schedule_id: schedule_id
          },
          dataType: 'json',
          success: function(response) {
            $('#edit_scheduleid').val(response.schedule_id);
            $('#edit_eventname').val(response.event_name);
            $('#edit_event_date').val(response.event_date);
            $('#edit_timein').val(response.time_in);
            $('#edit_timeout').val(response.time_out);
            $('#edit_employeeqrcode').val(response.employee_qrcode);
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
          var schedule_id = $(this).data("del");
          console.log(schedule_id);
          get_delId(schedule_id); //argument    

        });
      }

      function get_delId(schedule_id) {
        $.ajax({
          type: 'POST',
          url: 'fetch_row/schedule_row.php',
          data: {
            schedule_id: schedule_id
          },
          dataType: 'json',
          success: function(response2) {
            $('#delete_scheduleid').val(response2.schedule_id);
            $('#delete_eventname').val(response2.event_name);

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