<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Add New User</h1>
            </div>
            <div class="clearfix"></div>
            <div style="margin-top: 20px;">
                <?php
                $msg = $this->session->flashdata('msg');
                if (!empty($msg)) {
                    $msg = json_decode($msg, 1);
                    echo '<div class="' . $msg['class'] . '"><button type="button" class="close" data-dismiss="alert">×</button>' . $msg['msg'] . '</div>';
                }
                ?>
                <form class="form-horizontal" id="add_new_user" role="form" method="post" action="/dashboard/save-user">
                    <div class="form-group">
                        <label for="user_full_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_full_name" id="user_full_name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_name" class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_address" id="user_address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_mobile" class="col-sm-2 control-label">Mobile No</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_mobile" id="user_mobile" placeholder="Mobile No">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#add_new_user").validate({
            rules: {
                user_full_name: {required:true},
                user_name: {required:true, minlength:4, remote:"/dashboard" },
                email: {required:true, email:true},
                user_password: { required:true, maxlength: 32 }
            },
            messages:{
                user_full_name:{ required:"Please Enter Name"},
                user_name:{ required:"Please Enter User Name",remote:"User Name Already Taken"},
                user_password:{ required:"Please Enter Password"}
            }
        });

    });
</script>