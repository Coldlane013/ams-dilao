<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user"></i>Add Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="emp"></div>
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Event Name:</label>
                        <input type="text" id="event_name" alt="event_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" id="event_date" alt="event_date" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Time-In:</label>
                        <input type="time" name="time_in" id="time_in" alt="time_in" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Time-Out:</label>
                        <input type="time" name="time_out" id="time_out" alt="time_out" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Select Participant:</label>
                        <select class="form-control js-example-basic-multiple" id="employee_qrcode" style="width:20em;">
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
                        <button type="button" class="btn btn-primary" id="add-schedule">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let btn = document.querySelector('#add-schedule');
            btn.addEventListener('click', () => {

                const event_name = document.querySelector('input[alt=event_name]').value;
                const event_date = document.querySelector('input[alt=event_date]').value;
                const time_in = document.querySelector('input[alt=time_in]').value;
                const time_out = document.querySelector('input[alt=time_out]').value;
                const employee_qrcode = $('#employee_qrcode option:selected').val();

                var data = new FormData(this.form);

                data.append('event_name', event_name);
                data.append('event_date', event_date);
                data.append('time_in', time_in);
                data.append('time_out', time_out);
                data.append('employee_qrcode', employee_qrcode);


                if (event_name === '' || event_date === '' || time_in === '') {
                    $('#emp').html('<div class="alert alert-danger"> Required All Fields!</div>');
                } else {
                    $.ajax({
                        url: '../../init/controllers/add_schedule.php',
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