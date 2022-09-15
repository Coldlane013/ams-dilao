<?php
?>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user"></i>Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" id="admin_fullname" alt="admin_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" id="email" alt="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" id="username" alt="username" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" id="password" alt="password" minlength="6" maxlength="15" class="form-control" placeholder="atleast 6 digit" />
                        <input type="checkbox" onclick="myFunction()"> Show Password
                    </div>

                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="Number" minlength="11" maxlength="12" id="cnumber" alt="cnumber" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Gender:</label>
                        <select class="form-control" id="gender">
                            <option value="">&larr; Select Gender &rarr;</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
            </div>
            <div id="emp"></div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-admin">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let btn = document.querySelector('#add-admin');
        btn.addEventListener('click', () => {

            const fullname = document.querySelector('input[alt=admin_name]').value;
            const email = document.querySelector('input[alt=email]').value;
            const username = document.querySelector('input[alt=username]').value;
            const password = document.querySelector('input[alt=password]').value;
            const cnumber = document.querySelector('input[alt=cnumber]').value;
            const gender = $('#gender option:selected').val();


            var data = new FormData(this.form);

            data.append('full_name', fullname);
            data.append('email', email);
            data.append('username', username);
            data.append('password', password);
            data.append('cnumber', cnumber);
            data.append('gender', gender);



            if (fullname === '' || email === '' || username === '' || password === '' || cnumber === '') {
                $('#emp').html('<div class="alert alert-danger"> Required All Fields!</div>');
            } else {
                $.ajax({
                    url: '../../init/controllers/add_admin.php',
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