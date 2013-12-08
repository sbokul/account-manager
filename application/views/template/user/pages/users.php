<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Projects</h1>
            </div>
            <div class="clearfix"></div>
            <?php if($data['user_type'] == 1): ?>
            <div style="margin: 0 0 10px 0;width: 100%">
                <a href="/dashboard/add-new-user" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New User</a>
            </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php
            $msg = $this->session->flashdata('msg');
            if (!empty($msg)) {
                $msg = json_decode($msg, 1);
                echo '<div class="' . $msg['class'] . '"><button type="button" class="close" data-dismiss="alert">×</button>' . $msg['msg'] . '</div>';
            }
            ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Create Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['users'] as $user) {
                        echo '<tr>';
                        echo '<td>'.$user['user_full_name'].'</td>';
                        echo '<td>'.$user['user_name'].'</td>';
                        echo '<td>'.$user['user_address'].'</td>';
                        echo '<td>'.$user['user_mobile'].'</td>';
                        echo '<td>'.$user['email'].'</td>';
                        echo '<td>'.$user['create_date'].'</td>';
                        echo '</tr>';
                    }

                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>