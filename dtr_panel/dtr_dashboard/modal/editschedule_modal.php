<div class="modal fade" id="edit-schedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-building"></i> Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="emp_edit"></div>
                <form method="POST" autocomplete="off">

                    <div class="form-group">
                        <label>Schedule Name:</label>
                        <input type="text" id="edit_eventname" alt="event_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Event Date:</label>
                        <input type="date" id="edit_event_date" alt="edit_event_date" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Start Time:</label>
                        <input type="time" id="edit_timein" alt="time_in" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>End Time:</label>
                        <input type="time" id="edit_timeout" alt="time_out" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Select Participant:</label>
                        <select class="js-example-basic-multiple" id="edit_employeeqrcode" style="width:20em;">
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
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="edit_scheduleid">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit-sched">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#edit-sched');
        btn.addEventListener('click', () => {

            const event_name = document.querySelector('input[id=edit_eventname]').value;
            const event_date = document.querySelector('input[id=edit_event_date]').value;
            const time_in = document.querySelector('input[id=edit_timein]').value;
            const time_out = document.querySelector('input[id=edit_timeout]').value;
            const employee_qrcode = $('#edit_employeeqrcode option:selected').val();
            const schedule_id = document.querySelector('input[id=edit_scheduleid]').value;


            var data = new FormData(this.form);

            data.append('event_name', event_name);
            data.append('event_date', event_date);
            data.append('time_in', time_in);
            data.append('time_out', time_out);
            data.append('employee_qrcode', employee_qrcode);
            data.append('schedule_id', schedule_id);



            $.ajax({
                url: '../../init/controllers/edit_schedule.php',
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                success: function(response) {
                    $("#emp_edit").html(response);
                    window.scrollTo(0, 0);
                },
                error: function(response) {
                    console.log("Failed");
                }
            });
            //   }

        });
    });
</script>
