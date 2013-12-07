<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Project Detail</h1>
            </div>
            <div class="clearfix"></div>
            <div style="margin: 0 0 10px 0;width: 100%">
                <a href="/dashboard/add-new-project" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Project</a>
            </div>
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
                    <tr>
                        <td><strong>Project Name</strong></td>
                        <td><strong><?php echo $data['project_detail']['project_name']; ?></strong></td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Work Name</th>
                        <th>Work Order Amount</th>
                        <th>Create Date</th>
                        <th>View Details</th>
                        <th>Add Bill</th>
                        <th>Add Expense</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>