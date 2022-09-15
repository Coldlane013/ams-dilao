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
                      <h1>Manage Report</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-end">
                          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                          <li class="breadcrumb-item">Manage Report</li>
                      </ol>
                  </div>
              </div>
        <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body" style="overflow-x:auto">
                        <div class="form-inline" style="margin-left: 10px">
                            <label>Date:</label>&nbsp;&nbsp;
                            <input type="text" class="form-control" placeholder="Start" id="date1" autocomplete="off" />
                            <label>&nbsp; To &nbsp;</label>
                           <input type="text" class="form-control" placeholder="End" id="date2" autocomplete="off" />&nbsp;&nbsp;
                           <button type="button" class="btn btn-primary" style="border: 1px solid #ECAB1E;background-color:#ECAB1E" id="btn_search">
                           <i class="fa fa-search"></i></button>&nbsp;&nbsp; <button type="button" id="reset" class="btn btn-warning"><i class="fa fa-sync"></i></button>
                             </div>
                             <br>
                            <div class="table-responsive" style = "overflow-x:auto">
                                <table id="example1" class=" table table-dark">
                                    <thead>
                                    <tr>
                                    <th>Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Log Date</th>
                                    <th>Status</th>
                                   </tr>
                                    </thead>
                                    <tbody id="load_data">
                    <?php
                    $conn = new class_model();
                    $emp = $conn->fetchAll_empAttendance();
                    ?>
                    <?php foreach ($emp as $row) { ?>
                      <tr>
                        <td><?= htmlentities($row['last_name'] . ', ' . $row['first_name']); ?></td>
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


<script src="../../assets/plugins/jquery/jquery.min.js"></script>
  <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


  <script src="js/jquery-3.1.1.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#date1').datepicker();
      $('#date2').datepicker();
      $('#btn_search').on('click', function() {
        if ($('#date1').val() == "" || $('#date2').val() == "") {
          alert("Please enter Date 'From' and 'To' before submit");
        } else {
          $date1 = $('#date1').val();
          $date2 = $('#date2').val();
          $('#load_data').empty();
          $loader = $('<tr ><td colspan = "5"><center>Searching....</center></td></tr>');
          $loader.appendTo('#load_data');
          setTimeout(function() {
            $loader.remove();
            $.ajax({
              url: '../../init/controllers/attendance_report.php',
              type: 'POST',
              data: {
                date1: $date1,
                date2: $date2
              },
              success: function(res) {
                $('#load_data').html(res);
              }
            });
          }, 1000);
        }
      });

      $('#reset').on('click', function() {
        location.reload();
      });
    });
  </script>

  <script>
    $(function() {
      $("#date1").datepicker();
    });
  </script>
  <script>
    $(function() {
      $("#date2").datepicker();
    });
  </script>

  <!-- <script>
  $(function () {
    $("#example1").DataTable({
    });

  });

</script> -->
  </body>

  </html>