<div class="col-md-12">
    <div class="table-responsive" style="overflow-y: auto;">


        <div style="text-align: right;">
            <button onclick="get_nomination_list('Trainee')" class="btn btn-warning btn-sm" style="padding: 2px 10px; font-size:11px;">Add Trainees</button>
        </div>
        <br />

        <table class="table" id="db_table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Gender</th>
                    <th>CNIC/User Name</th>
                    <th>Passowrd</th>
                    <th>Biometric ID</th>
                    <th>Department</th>
                    <th>Duty Station</th>
                    <th>Designation</th>
                    <th>District</th>
                    <th>Qualification</th>
                    <th>Mobile No.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT users.*, training_nominations.nomination_type,  training_nominations.id
                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND training_nominations.nomination_type = 'Trainee'
                                            AND training_nominations.training_id = " . $training->training_id;
                $nominations = $this->db->query($query)->result();
                $count = 1;
                foreach ($nominations as $nomination) : ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $nomination->name; ?></td>
                        <td><?php echo $nomination->father_name; ?></td>
                        <td><?php echo $nomination->gender; ?></td>
                        <td><?php echo $nomination->cnic; ?></td>
                        <td><?php echo $nomination->user_password; ?></td>
                        <td><?php echo $nomination->biometric_id; ?></td>
                        <td><?php echo $nomination->department; ?></td>
                        <td><?php echo $nomination->duty_station; ?></td>
                        <td><?php echo $nomination->designation; ?></td>
                        <td><?php echo $nomination->district; ?></td>
                        <td><?php echo $nomination->qualification; ?></td>
                        <td><?php echo $nomination->user_mobile_number; ?></td>
                        <td><a href="<?php echo site_url(ADMIN_DIR . "trainings/remove_nonimation_from_batch/" . $training->training_id . "/" . $batch->batch_id . "/" . $nomination->id); ?>" onclick="return confirm('Are you sure? you want to remove')"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: center;">
            <button onclick="get_nomination_list('Trainee')" class="btn btn-primary btn-sm" style="padding: 2px 10px; font-size:11px;">Add Trainees</button>
        </div>
    </div>
</div>

<hr class="margin-bottom-0">

<script>
    <?php $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . " Batch: " . $title . " " . date('d-m-Y h:m:s'); ?>
    title = '<?php echo 'T-Code:(' . $training->code . ") - " . $title; ?> Trainees List';
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