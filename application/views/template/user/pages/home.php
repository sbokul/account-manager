<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Projects</h1>
            </div>
            <div class="clearfix"></div>
            <?php if($data['user_type'] == 1): ?>
            <div style="margin: 0 0 10px 0;width: 100%">
                <a href="/dashboard/add-new-project" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Project</a>
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
                        <th>Project Name</th>
                        <th>Work Name</th>
                        <th>Work Order Amount</th>
                        <th>Create Date</th>
                        <th>View Details</th>
                        <?php if($data['user_type'] == 1): ?>
                        <th>Add Bill</th>
                        <th>Add Expense</th>
                        <th>Action</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['projects'] as $project) {
                        echo '<tr>';
                        echo '<td>'.$project['project_name'].'</td>';
                        echo '<td>'.$project['work_name'].'</td>';
                        echo '<td>'.number_format($project['work_order_amount'], 2).'</td>';
                        echo '<td>'.$project['create_date'].'</td>';
                        echo '<td align="center"><a href="/dashboard/project-details/'.$project['id'].'">View Details</td>';
                        if($data['user_type'] == 1):
                        echo '<td align="center"><a href="/dashboard/add-bill/'.$project['id'].'">Add Bill</td>';
                        echo '<td align="center"><a href="/dashboard/add-expense/'.$project['id'].'">Add Expense</td>';
                        //echo '<td align="center"><a href="/dashboard/edit/'.$project['id'].'"><span class="glyphicon glyphicon-pencil text-primary"></span></a>&nbsp;&nbsp;&nbsp;<a href="/dashboard/delete/'.$project['id'].'"><span class="glyphicon glyphicon-remove text-danger"></span></a></td>';
                        echo '<td align="center"><a href="/dashboard/delete/'.$project['id'].'" title="Delete"><span class="glyphicon glyphicon-remove text-danger"></span></a></td>';
                        endif;
                        echo '</tr>';
                    }

                    ?>
                    </tbody>
                </table>
                <div><?php echo $this->pagination->create_links(); ?></div>
            </div>

        </div>
    </div>
</div>