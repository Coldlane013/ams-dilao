<?php include "perm/navbar.php"; ?>
<?php include "perm/main_side_bar.php"; ?>
<?php include "js/js.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DILAO PARISH AMS | Secret</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>


    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable_1').DataTable();
        });
    </script>

    <title>Attendance</title>
</head>

<body onload="startTime()"><br>
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Check Attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-end">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Check Attendance</li>
                        </ol>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <center>
                                            <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                                                <label class="btn btn-primary active" style="border: 1px solid #ECAB1E;background-color:#ECAB1E">
                                                    <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                                                </label>
                                                <label class="btn btn-secondary">
                                                    <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
                                                </label>
                                            </div>
                                            <p style="border: 1px solid #ECAB1E;background-color: #ECAB1E;color: #fff"><i class="fas fa-qrcode"></i> QR HERE</p>
                                        </center>
                                        <video id="preview" width="100%"></video>
                                        <?php include 'attendance_process.php'; ?>
                                        <hr>
                                        </hr>
                                    </div>
                                    <div class="col-md-8">
                                        <center>
                                            <div id="clockdate" style="border: 1px solid #ECAB1E;background-color: #ECAB1E">
                                                <div class="clockdate-wrapper">
                                                    <div id="clock" style="font-weight: bold; color: #fff;font-size: 40px"></div>
                                                    <div id="date" style="color: #fff"><i class="fas fa-calendar"></i> <?php echo date('l, F j, Y'); ?></div>
                                                </div>
                                            </div>
                                        </center>
                                        <form action="" method="POST" class="form-harizontal">

                                            <label><b>SCAN QR CODE</b></label>
                                            <input type="text" name="employee_qrcode" id="employee_qrcode" readonly="" placeholder="scan qrcode" class="form-control">
                                        </form>
                                        <hr>
                                        </hr>
                                        <div class="table-responsive" style="overflow-x:auto">
                                            <table id="dataTable_1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>NAME</th>
                                                        <th>TIME IN</th>
                                                        <th>TIME OUT</th>
                                                        <th>LOGDATE</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: white;">
                                                    <?php
                                                    $conn = new class_model();
                                                    $dtr = $conn->fetchAll_empAttendance();
                                                    ?>
                                                    <?php foreach ($dtr as $row) { ?>
                                                        <tr align="center" style="color: white;">
                                                            <td><?php echo htmlentities($row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name']); ?></td>
                                                            <td><?php
                                                                $time = $row['time_in'];
                                                                if ($time === '') {
                                                                    echo '';
                                                                } else {
                                                                    echo htmlentities(date("h:i:A", strtotime($row['time_in'])));
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                $time = $row['time_out'];
                                                                if ($time === '') {
                                                                    echo '';
                                                                } else {
                                                                    echo htmlentities(date("h:i:A", strtotime($row['time_out'])));
                                                                }
                                                                ?>

                                                            </td>
                                                            <td><?= htmlentities(date("M d, Y", strtotime($row['logdate']))); ?></td>

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

            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
            <script type="text/javascript">
                let scanner = new Instascan.Scanner({
                    video: document.getElementById('preview')
                });
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                        $('[name="options"]').on('change', function() {
                            if ($(this).val() == 1) {
                                if (cameras[0] != "") {
                                    scanner.start(cameras[0]);
                                } else {
                                    alert('No Front camera found!');
                                }
                            } else if ($(this).val() == 2) {
                                if (cameras[1] != "") {
                                    scanner.start(cameras[1]);
                                } else {
                                    alert('No Back camera found!');
                                }
                            }
                        });
                    } else {
                        console.error('No cameras found.');
                        alert('No cameras found.');
                    }
                }).catch(function(e) {
                    console.error(e);
                });

                scanner.addListener('scan', function(c) {
                    document.getElementById('employee_qrcode').value = c;
                    document.forms[0].submit();
                });
            </script>

</body>