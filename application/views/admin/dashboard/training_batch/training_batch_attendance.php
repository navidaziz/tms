<div class="col-md-12">
    <div class="table-responsive" style="overflow-y: auto;">
        <table class="table table-bordered" style="font-size: 9px;" id="db_table">
            <thead>
                <tr>
                    <th colspan="8"></th>
                    <?php
                    $startDate = new DateTime($batch->batch_start_date);
                    $endDate = new DateTime($batch->batch_end_date);
                    $currentDate = clone $startDate;
                    while ($currentDate <= $endDate) {
                        $currentDate->modify('+1 day');
                    ?>
                        <th colspan="2" style="text-align: center;">
                            <strong><?php echo date('D d M y', strtotime($currentDate->format('Y-m-d'))); ?></strong>
                        </th>

                    <?php } ?>

                </tr>
                <tr>
                    <th>S.No</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>CNIC</th>
                    <th>Designation</th>
                    <th>District</th>
                    <th>Qualification</th>
                    <th>Mobile No.</th>
                    <?php
                    $startDate = new DateTime($batch->batch_start_date);
                    $endDate = new DateTime($batch->batch_end_date);
                    $currentDate = clone $startDate;
                    while ($currentDate <= $endDate) {
                        $currentDate->modify('+1 day');
                    ?>
                        <th style="text-align: center;"> <i class="fa fa-sun-o" aria-hidden="true"></i> M</th>
                        <th style="text-align: center;"> <i class="fa fa-moon-o" aria-hidden="true"></i> E</th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT users.*, roles.role_title, training_nominations.nomination_type,  training_nominations.id
                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            INNER JOIN roles ON(roles.role_id = users.role_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND training_nominations.training_id = " . $training->training_id;
                $nominations = $this->db->query($query)->result();
                $count = 1;
                foreach ($nominations as $nomination) : ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $nomination->role_title; ?></td>
                        <td><?php echo $nomination->name; ?></td>
                        <td><?php echo $nomination->father_name; ?></td>
                        <td><?php echo $nomination->cnic; ?></td>
                        <td><?php echo $nomination->designation; ?></td>
                        <td><?php echo $nomination->district; ?></td>
                        <td><?php echo $nomination->qualification; ?></td>
                        <td><?php echo $nomination->user_mobile_number; ?></td>
                        <?php
                        $startDate = new DateTime($batch->batch_start_date);
                        $endDate = new DateTime($batch->batch_end_date);
                        $currentDate = clone $startDate;
                        while ($currentDate <= $endDate) {
                            $currentDate->modify('+1 day');
                            $attendance_date = $currentDate->format('Y-m-d');
                            $query = "SELECT morning_time FROM `attendances`
                                                                WHERE training_id = '" . $training->training_id . "'
                                                                AND batch_id = '" . $batch->batch_id . "'
                                                                AND user_id = '" . $nomination->user_id . "'
                                                                AND attendance_date = '" . $attendance_date . "'
                                                                AND morning_time IS NOT NULL";
                            $morning_attendance = $this->db->query($query)->row();
                            if ($morning_attendance) { ?>
                                <th style="text-align: center;"><?php echo $morning_attendance->morning_time; ?> </th>
                            <?php } else { ?>
                                <th style="text-align: center;">-</th>
                            <?php } ?>

                            <?php $query = "SELECT evening_time FROM `attendances`
                                                                WHERE training_id = '" . $training->training_id . "'
                                                                AND batch_id = '" . $batch->batch_id . "'
                                                                AND user_id = '" . $nomination->user_id . "'
                                                                AND attendance_date = '" . $attendance_date . "'
                                                                AND evening_time IS NOT NULL";
                            $evening_time = $this->db->query($query)->row();
                            if ($evening_time) { ?>
                                <th style="text-align: center;"><?php echo $evening_time->morning_time; ?> </th>
                            <?php } else { ?>
                                <th style="text-align: center;">-</th>
                            <?php } ?>



                        <?php } ?>
                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</div>

<hr class="margin-bottom-0">

<script>
    <?php $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . " Batch: " . $title . " " . date('d-m-Y h:m:s'); ?>
    title = '<?php echo 'T-Code:(' . $training->code . ") - " . $title; ?> Traniees Attendance List';
    $(document).ready(function() {
        $('#db_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": true,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'

                }
            ]
        });
    });
</script>