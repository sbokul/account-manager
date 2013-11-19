<div class="panel panel-warning">
    <!-- Default panel contents -->
    <div class="panel-heading"><span style="color: #000;font-weight: bold;"><?php echo $title; ?></span></div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>SL No.</th>
                <th>User Name</th>
                <th>Tracking No.</th>
                <th>Name</th>
                <th>Entry Date</th>
                <th>Status</th>
                <th>Qualify Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = $data['donation_numbers'];
            foreach ($data['donation_list'] as $donation_list) {
                $status = '<span class="text-danger">Pending</span>';

                if ($donation_list['status']) {
                    $status = '<span class="text-success">Qualified</span>';
                }

                $class = '';
                if ($i%2 == 0) {
                    $class = 'warning';
                }

                $qualify_date = $donation_list['qualify_date'];
                if ($donation_list['qualify_date'] == '0000-00-00') {
                    $qualify_date = '---';
                }
                echo '<tr class="' . $class . '">';
                echo '<td>' . $i . '</td>
                              <td>' . $data['user_name'] . '</td>
                              <td>' . $donation_list['tracking_id'] . '</td>
                              <td>' . $data['user_full_name'] . '</td>
                              <td>' . $donation_list['create_date'] . '</td>
                              <td>' . $status . '</td>
                              <td>' . $qualify_date . '</td>';
                echo '</tr>';
                --$i;
            }

            ?>
            </tbody>
        </table>
        <div><?php echo $this->pagination->create_links(); ?></div>
    </div>
</div>
