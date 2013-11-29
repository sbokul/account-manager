<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Add New Projects</h1>
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
                <form class="form-horizontal" role="form" method="post" action="/dashboard/save-project">
                    <div class="form-group">
                        <label for="projectName" class="col-sm-2 control-label">Project Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="project_name" id="projectName" placeholder="Project Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="workName" class="col-sm-2 control-label">Name Of Work</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="work_name" id="workName" placeholder="Name Of Work">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="workOrderAmount" class="col-sm-2 control-label">Work Order Amount</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="work_order_amount" id="workOrderAmount" placeholder="Work Order Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="create_date" id="date" placeholder="Date">
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