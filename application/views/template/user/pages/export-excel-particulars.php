<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=particulars.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div class="table-responsive">
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
        $total_expense = 0;
        foreach ($particulars as $expense) {
        $total_expense = $total_expense + $expense['amount'];
        echo '<tr>';
            echo '<td>' . $expense['create_date'] . '</td>';
            echo '<td>' . $expense['particulars'] . '</td>';
            echo '<td align="right">' . number_format($expense['amount'], 2) . '</td>';
            echo '<td>' . $expense['voucher_no'] . '</td>';
            echo '</tr>';
        }
        echo '<tr>
            <td></td>
            <td><strong>Total</strong></td>
            <td align="right"><strong class="text-primary">';
                    echo number_format($total_expense, 2);
                    echo '</strong></td>
            <td></td>
        </tr>';
?>
        </tbody>
    </table>
</div>