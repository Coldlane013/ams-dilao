<div class="modal fade" id="edit-admin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="emp_edit"></div>
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Fullname:</label>
                        <input type="text" id="edit_fullname" alt="admin_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" id="edit_email" alt="edit_email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" id="edit_username" alt="username" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="Number" minlength="11" maxlength="12" id="edit_cnumber" alt="cnumber" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Gender:</label>
                        <select class="form-control" id="edit_gender">
                            <option value="">&larr; Select Gender &rarr;</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="edit_adminid">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-admin">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#update-admin');
        btn.addEventListener('click', () => {
            const fullname = document.querySelector('input[id=edit_fullname]').value;
            const email = document.querySelector('input[id=edit_email]').value;
            const username = document.querySelector('input[id=edit_username]').value;
            const cnumber = document.querySelector('input[id=edit_cnumber]').value;
            const gender = $('#edit_gender option:selected').val();
            const admin_id = document.querySelector('input[id=edit_adminid]').value;


            var data = new FormData(this.form);

            data.append('full_name', fullname);
            data.append('email', email);
            data.append('username', username);
            data.append('cnumber', cnumber);
            data.append('gender', gender);
            data.append('admin_id',admin_id);


            $.ajax({
                url: '../../init/controllers/edit_admin.php',
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
            // }

        });
    });
</script>