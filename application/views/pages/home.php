<div class="row" style="margin-top: 20px;">
    <div class="col-lg-3 col-sm-2"></div>
    <div class="col-lg-6 col-sm-4">
        <?php
        $msg = $this->session->flashdata('msg');
        if (!empty($msg)) {
            $msg = json_decode($msg, 1);
            echo '<div class="' . $msg['class'] . '"><button type="button" class="close" data-dismiss="alert">×</button>' . $msg['msg'] . '</div>';
        }
        ?>
        <div style="width:60%;margin: 70px auto 0;">
            <form role="form" action="/login/login_check" method="post">
                <div class="form-group">
                    <label for="inputUserName">User Name</label>
                    <input type="text" class="form-control" name="user_name" id="inputUserName" placeholder="Enter User Name">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" name="user_password" id="inputPassword" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
    <div class="col-lg-3 col-sm-2"></div>
</div>