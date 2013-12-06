<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Projects</h1>
            </div>
            <div class="clearfix"></div>
            <div style="margin: 0 0 10px 0;width: 100%">
                <a href="/dashboard/add-new-project" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Project</a>
            </div>
            <div class="clearfix"></div>
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
                    <?php
                    foreach ($data['projects'] as $project) {
                        echo '<tr>';
                        echo '<td>'.$project['project_name'].'</td>';
                        echo '<td>'.$project['work_name'].'</td>';
                        echo '<td>'.$project['work_order_amount'].'</td>';
                        echo '<td>'.$project['create_date'].'</td>';
                        echo '<td align="center"><a href="/dashboard/project-details/'.$project['id'].'">View Details</td>';
                        echo '<td align="center"><a href="/dashboard/add-bill/'.$project['id'].'">Add Bill</td>';
                        echo '<td align="center"><a href="/dashboard/add-expense/'.$project['id'].'">Add Bill</td>';
                        echo '<td align="center"><a href="/dashboard/edit/'.$project['id'].'"><span class="glyphicon glyphicon-pencil text-primary"></span></a>&nbsp;&nbsp;&nbsp;<a href="/dashboard/delete/'.$project['id'].'"><span class="glyphicon glyphicon-remove text-danger"></span></a></td>';
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