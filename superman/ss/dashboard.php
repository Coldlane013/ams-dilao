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
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $conn = new class_model();
                            $emp = $conn->count_numberofemployees();
                            ?>
                            <h4>Number of Users</h4>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <i class="icon-lg mdi mdi-face-profile text-primary ms-auto">&nbsp;</i>
                                        <div style=color:gray>
                                            <h1> | </h1>
                                        </div>
                                        <?php foreach ($emp as $row) : ?>
                                            <h1 class="col-4 col-sm-12 col-xl-4 text-center"><?= $row['employee_id']; ?></h1>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $conn = new class_model();
                            $att = $conn->count_numberofattendance();
                            ?>
                            <h4>Number of Attendance</h4>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <i class="icon-lg mdi mdi mdi-archive text-warning ms-auto">&nbsp;</i>
                                        <div style=color:gray>
                                            <h1> | </h1>
                                        </div>
                                        <?php foreach ($att as $row) : ?>
                                            <h1 class="col-4 col-sm-12 col-xl-4 text-center"><?= $row['attendance_id']; ?></h1>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $conn = new class_model();
                            $att = $conn->count_numberoftimeInOutToday();
                            ?>
                            <h4>Number of In/Out Today</h4>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <i class="icon-lg mdi mdi-walk text-success ms-auto">&nbsp;</i>
                                        <div style=color:gray>
                                            <h1> | </h1>
                                        </div>
                                        <?php foreach ($att as $row) : ?>
                                            <h1 class="col-4 col-sm-12 col-xl-4 text-center"><?= $row['attendance_ids']; ?></h1>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card" style="overflow-x:auto">
                            <div class="card-body">
                                <h4 class="card-title">Attendance Performance Summary</h4>
                                <div class="table-responsive">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Total Days Attended </th>
                                                <th>Attendance Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody id="load_data">
                                            <?php
                                            $conn = new class_model();
                                            $emp = $conn->fetchAll_employees();
                                            ?>
                                            <?php foreach ($emp as $row) { ?>
                                                <tr>
                                                    <td><?= htmlentities($row['first_name'] . ", " . $row['last_name']); ?></td>
                                                    <td>
                                                        <?php
                                                        $conn = new class_model();
                                                        $mp = $conn->count_numberofattendanceIndividualEmp($row['employee_id']);
                                                        foreach ($mp as $log) :
                                                        ?>
                                                            <?= htmlentities($log['attendance_ids']); ?>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $conn = new class_model();
                                                        $mp = $conn->count_numberofattendancelateIndividualEmp($row['employee_id']);
                                                        foreach ($mp as $row) :
                                                        ?>
                                                            <?php
                                                            $date = $row['lates'];
                                                            $num = 100;
                                                            $dif1 = $num - 25;
                                                            $dif2 = $num - 50;
                                                            $dif3 = $num - 75;
                                                            $dif4 = 0;
                                                            if ($date == 1) {
                                                                echo "<button class='btn btn-warning btn-xs'><i class='fa fa-user-clock'></i>$dif1</button>";
                                                            } elseif ($date == 2) {
                                                                echo "<button class='btn btn-warning btn-xs'><i class='fa fa-user-clock'></i>$dif2</button>";
                                                            } elseif ($date == 3) {
                                                                echo "<button class='btn btn-warning btn-xs'><i class='fa fa-user-clock'></i>$dif3</button>";
                                                            } elseif ($date >= 4) {
                                                                echo "<button class='btn btn-danger btn-xs'><i class='fa fa-user-clock'></i>$dif4</button>";
                                                            } else {
                                                                echo "<button class='btn btn-success btn-xs'><i class='fa fa-user-clock'></i>$num</button>";
                                                            }
                                                            ?>
                                                        <?php endforeach; ?>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    <?php } ?>
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
<!-- partial:partials/_footer.html -->


<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
</div>
<!-- container-scroller -->
<!-- plugins:js -->