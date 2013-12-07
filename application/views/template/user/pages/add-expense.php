<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Add Expense</h1>
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
                <form class="form-horizontal" role="form" method="post" action="/dashboard/save-expense">
                    <div class="form-group">
                        <label for="date" class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="create_date" id="date" placeholder="Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="projectName" class="col-sm-2 control-label">Particulars</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="particulars" id="particulars" placeholder="Particulars">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="workName" class="col-sm-2 control-label">Voucher No.</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="voucher_no" id="voucher_no" placeholder="Voucher No.">
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo $data['id']; ?>">
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
    $('#date').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>