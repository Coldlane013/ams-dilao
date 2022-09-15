<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user"></i>Add Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="emp"></div>
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Log Date:</label>
                        <input type="date" id="date" alt="date" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Time-In:</label>
                        <input type="time" id="time_in" alt="time_in" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Time-Out:</label>
                        <input type="time" name="time_out" id="time_out" alt="time_out" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Select Status:</label>
                        <select class="js-example-basic-multiple" id="time_stat" style="width:20em;">
                            <option value="On Time">On Time</option>
                            <option value="Late">Late</option>
                            <option value="Absent">Absent</option>
                            <option value="Excused">Excused</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Participant:</label>
                        <select class="js-example-basic-multiple" id="employee_qrcode" style="width:20em;">
                            <?php
                            $conn = new class_model();
                            $emp = $conn->fetchAll_employees();

                            if ($emp > 0) {
                                foreach ($emp as $row) {
                            ?>
                                    <option value="<?= $row['qr_code'] ?>"><?= $row['last_name'] ?></option>
                                <?php

                                }
                            } else {
                                ?>
                                <option value="">No Participants Found</option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="add-attend">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let btn = document.querySelector('#add-attend');
            btn.addEventListener('click', () => {

                const logdate = document.querySelector('input[alt=date]').value;
                const time_in = document.querySelector('input[alt=time_in]').value;
                const time_out = document.querySelector('input[alt=time_out]').value;
                const time_stat = $('#time_stat option:selected').val();
                const employee_qrcode = $('#employee_qrcode option:selected').val();

                var data = new FormData(this.form);

                data.append('logdate', logdate);
                data.append('time_in', time_in);
                data.append('time_out', time_out);
                data.append('time_stat', time_stat);
                data.append('employee_qrcode', employee_qrcode);


                if (logdate === '' || time_stat === '' || employee_qrcode === '') {
                    $('#emp').html('<div class="alert alert-danger"> Required Status, Date and Participant Fields!</div>');
                } else {
                    $.ajax({
                        url: '../../init/controllers/add_attendance.php',
                        type: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        async: false,
                        cache: false,
                        success: function(response) {
                            $("#emp").html(response);
                            window.scrollTo(0, 0);
                        },
                        error: function(response) {
                            console.log("Failed");
                        }
                    });
                }

            });
        });
    </script>