<?php include "perm/header.php"; ?>
<?php include "perm/navbar.php"; ?>
<?php include "perm/main_side_bar.php"; ?>
<?php include "js/js.php"; ?>

<div class="container-fluid page-body-wrapper">
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-end">
            <li class="breadcrumb-item"><a href="user">Home</a></li>
          </ol>
        </div>
      </div>

      <div class="row">
        <div class="splash-container">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <center>
                      <th>QR Image and User ID</th>
                    </center>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $employee_id = $_SESSION['employee_id'];
                  $conn = new class_model();
                  $emp = $conn->fetchindividual_employee($employee_id);
                  ?>
                  <?php foreach ($emp as $row) { ?>
                    <tr>
                      <td>

                        <center><a href="../../qrcode_images/<?= $row['employee_idno']; ?>.png" download />
                          <div class="wrapper">
                            <img src="../../qrcode_images/<?= $row['employee_idno']; ?>.png" width="400" height="200"></a>
                        </center>
            </div>
            </td>
            </tr>
            <tr>
              <td>
                <center>
                  Click image to download
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center><strong><?= $row['employee_idno']; ?></strong>
              </td>
              </center>
            </tr>
          <?php } ?>
          </table>
          </div>
        </div>
      </div>
      </section>
    </div>
  </div>
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