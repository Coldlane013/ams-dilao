<div class="modal fade" id="delete-attendance">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-trash"></i> Delete Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div id="msg-del"></div>
                    <div class="form-group">
                        <label for="department" class="control-label">Attendance of:</label>
                        <td>

                            <?php
                            $conn = new class_model();
                            $em = $conn->fetchindividual_employeeviaQR($row['employee_qrcode']);
                            foreach ($em as $r){
                            ?>
                        </td>
                        <input type="text" id="delete_attendance" class="form-control form-control-sm" placeholder="<?php
                                                                                                                        echo $r['last_name'];?>" readonly="">
                    </div>
                    <?php } ?>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                <input type="hidden" id="delete_attendid" class="form-control form-control-sm">
                <button type="button" class="btn btn-primary" id="delete_attend">YES</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#delete_attend');
        btn.addEventListener('click', () => {

            const attendance_id = document.querySelector('input[id=delete_attendid]').value;

            var data = new FormData(this.form);

            data.append('attendance_id', attendance_id);

            $.ajax({
                url: '../../init/controllers/delete_attendance.php',
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                success: function(response) {
                    $("#msg-del").html(response);
                    console.log(response);
                    window.scrollTo(0, 0);
                },
                error: function(response) {
                    console.log("Failed");
                }
            });
            // }

        });
    });
</script>