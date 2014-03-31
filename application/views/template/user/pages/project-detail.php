<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Project Detail</h1>
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
                        <td><strong><?php echo $data['project_detail']['project_name']; ?><?php if(!empty($data['project_detail']['address'])) echo ', '.$data['project_detail']['address']; ?></strong> </td>
                    </tr>
                    <tr>
                        <td><strong>Name Of Work</strong></td>
                        <td><strong><?php echo $data['project_detail']['work_name']; ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Work Order Amount</strong></td>
                        <td><strong class="text-primary"><?php echo number_format($data['project_detail']['work_order_amount'], 2); ?></strong></td>
                    </tr>
                </table>
            </div>
            <div style="width: 49%;float: left;">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                            <th>Voucher No.</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_bill = 0;
                        foreach ($data['project_bill'] as $bill) {
                            $total_bill = $total_bill + $bill['amount'];
                            echo '<tr>';
                            echo '<td>'.$bill['create_date'].'</td>';
                            echo '<td>'.$bill['particulars'].'</td>';
                            echo '<td align="right">'.number_format($bill['amount'], 2).'</td>';
                            echo '<td>'.$bill['voucher_no'].'</td>';
                            echo '<td>
                                    <a href="/dashboard/modify-bill/'.$bill['id'].'" title="Edit/Modify"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;
                                    <a href="/dashboard/delete-bill/'.$bill['id'].'/'.$data['id'].'" title="Remove"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                                  </td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td align="right"><strong class="text-primary"><?php echo number_format($total_bill, 2); ?></strong></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="width: 49%;float: right;">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                            <th>Voucher No.</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_expense = 0;
                        foreach ($data['project_expense'] as $expense) {
                            $total_expense = $total_expense + $expense['amount'];
                            echo '<tr>';
                            echo '<td>'.$expense['create_date'].'</td>';
                            echo '<td><a class="particulars" href="#">'.$expense['particulars'].'</a></td>';
                            echo '<td align="right">'.number_format($expense['amount'], 2).'</td>';
                            echo '<td>'.$expense['voucher_no'].'</td>';
                            echo '<td>
                                    <a href="/dashboard/modify-expense/'.$expense['id'].'" title="Edit/Modify"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;
                                    <a href="/dashboard/delete-expense/'.$expense['id'].'/'.$data['id'].'" title="Remove"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                                  </td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td align="right"><strong class="text-primary"><?php echo number_format($total_expense, 2); ?></strong></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('.particulars').click(function() {
        //alert(this.text);
        $.get( "/dashboard", { particulars: this.text }, function( data ) {
            $( ".result" ).html( data );
            //alert( data );
        });
        $('#particulars').modal('show');
    });
</script>
<!-- Modal -->
<div class="modal fade" id="particulars" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Particulars Total</h4>
            </div>
            <div class="modal-body result">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->