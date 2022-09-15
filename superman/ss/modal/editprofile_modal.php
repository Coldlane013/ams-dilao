<div class="modal fade" id="edit-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="emp_edit"></div>
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" id="edit_name" alt="edit_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Username: <strong style="color: green" ;>(Used in login, please remember after changed.)</strong></label>
                        <input type="text" id="edit_username" alt="edit_username" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" id="edit_email" alt="edit_email" class="form-control" />
                    </div>




            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="edit_superid">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-super">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#update-super');
        btn.addEventListener('click', () => {
            const fullname = document.querySelector('input[id=edit_name]').value;
            const username = document.querySelector('input[id=edit_username]').value;
            const email = document.querySelector('input[id=edit_email]').value;
            const super_id = document.querySelector('input[id=edit_superid]').value;


            var data = new FormData(this.form);

            data.append('name', fullname);
            data.append('username', username);
            data.append('email', email);
            data.append('super_id', super_id);


            $.ajax({
                url: '../../init/controllers/edit_profiless.php',
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