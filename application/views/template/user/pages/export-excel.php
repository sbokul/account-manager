<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div class="row" style="margin-top: 20px;">
    <div class="col-xs-12">
        <div style="width:90%;margin: 0px auto 0;">
            <div>
                <h1 class="text-success">Project Details</h1>
            </div>
            <div class="clearfix"></div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Project Name</strong></td>
                        <td><strong><?php echo $project_detail['project_name']; ?><?php if(!empty($data['project_detail']['address'])) echo ', '.$data['project_detail']['address']; ?></strong> </td>
                    </tr>
                    <tr>
                        <td><strong>Name Of Work</strong></td>
                        <td><strong><?php echo $project_detail['work_name']; ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Work Order Amount</strong></td>
                        <td><strong class="text-primary"><?php echo number_format($project_detail['work_order_amount'], 2); ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Total Bill</strong></td>
                        <td><strong><?php echo number_format($total_bill, 2); ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Total Expense</strong></td>
                        <td><strong><?php echo number_format($total_expense, 2); ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Profit</strong></td>
                        <td><strong><?php echo number_format(($total_bill - $total_expense), 2); ?></strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div style="width: 49%;float: left;">
                <div class="table-responsive">
                    <table>
                        <tr>
                            <td><strong>Bills</strong></td>
                            <td></td>
                            <td><strong>Expenses</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th>Amount</th>
                                        <th>Voucher No.</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total_bill = 0;
                                    foreach ($project_bill as $bill) {
                                        $total_bill = $total_bill + $bill['amount'];
                                        echo '<tr>';
                                        echo '<td>'.$bill['create_date'].'</td>';
                                        echo '<td>'.$bill['particulars'].'</td>';
                                        echo '<td align="right">'.number_format($bill['amount'], 2).'</td>';
                                        echo '<td>'.$bill['voucher_no'].'</td>';
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
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Voucher No.</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total_expense = 0;
                                    foreach ($project_expense as $expense) {
                                        $total_expense = $total_expense + $expense['amount'];
                                        echo '<tr>';
                                        echo '<td>'.$expense['create_date'].'</td>';
                                        echo '<td>'.$expense['particulars'].'</td>';
                                        echo '<td>'.$expense['reference'].'</td>';
                                        echo '<td align="right">'.number_format($expense['amount'], 2).'</td>';
                                        echo '<td>'.$expense['voucher_no'].'</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><strong>Total</strong></td>
                                        <td></td>
                                        <td align="right"><strong class="text-primary"><?php echo number_format($total_expense, 2); ?></strong></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>