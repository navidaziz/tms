<div class="col-md-12">
    <div class="table-responsive">

        <div style="text-align: right;">
            <button onclick="get_nomination_list('Facilitators')" class="btn btn-warning btn-sm" style="padding: 2px 10px; font-size:11px;">Add Facilitators to this batch</button>
        </div>
        <br />
        <table class="table" id="db_table">
            <thead>
                <tr>
                    <th></th>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>CNIC</th>
                    <th>Designation</th>
                    <th>District</th>
                    <th>Qualification</th>
                    <th>Mobile No.</th>
                    <th>Biomatric ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT users.*, training_nominations.nomination_type,  training_nominations.id
                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND training_nominations.nomination_type = 'Facilitator'
                                            AND training_nominations.training_id = " . $training->training_id;
                $nominations = $this->db->query($query)->result();
                $count = 1;
                foreach ($nominations as $nomination) : ?>
                    <tr>
                        <td><a href="<?php echo site_url(ADMIN_DIR . "trainings/remove_nonimation_from_batch/" . $training->training_id . "/" . $batch->batch_id . "/" . $nomination->id . "/facilitators"); ?>" onclick="return confirm('Are you sure? you want to remove')"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $nomination->name; ?></td>
                        <td><?php echo $nomination->father_name; ?></td>
                        <td><?php echo $nomination->cnic; ?></td>
                        <td><?php echo $nomination->designation; ?></td>
                        <td><?php echo $nomination->district; ?></td>
                        <td><?php echo $nomination->qualification; ?></td>
                        <td><?php echo $nomination->user_mobile_number; ?></td>
                        <td><?php echo $nomination->biometric_id; ?></td>
                        <td>
                            <?php

                            $query = "SELECT COUNT(*) as total FROM facilitators_certificates 
                                WHERE training_id = '" . $training_id . "'
                                AND batch_id = '" . $batch_id . "'
                                AND trainee_id = '" . $nomination->user_id . "' ";
                            $facilitator_certificate = $this->db->query($query)->row()->total;
                            ?>
                            <?php
                            if ($facilitator_certificate == 0) { ?>
                                <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . 'trainings/facilitator_generate_certificate/' . $training_id . '/' . $batch_id . '/' . $nomination->user_id) ?>">Generate Certificate</a>
                            <?php } else { ?>
                                <a target="_blank" class="btn btn-success btn-sm" href="<?php echo site_url(ADMIN_DIR . 'trainings/facilitator_print_certificate/' . $training_id . '/' . $batch_id . '/' . $nomination->user_id) ?>">Print Certificate</a>
                                <?php $query = "SELECT certificate_id FROM facilitators_certificates 
                                                    WHERE training_id = '" . $training_id . "'
                                                    AND batch_id = '" . $batch_id . "'
                                                    AND trainee_id = '" . $nomination->user_id . "' ";
                                $certificate = $this->db->query($query)->row();
                                ?>
                                <button class="btn btn-warning btn-sm" onclick="get_facilitator_certificate_form('<?php echo $certificate->certificate_id; ?>')">Edit<botton>
                                    <?php } ?>
                        </td>
                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: center;">
            <button onclick="get_nomination_list('Facilitators')" class="btn btn-primary btn-sm" style="padding: 2px 10px; font-size:11px;">Add Facilitators</button>
        </div>
    </div>
</div>
<hr class="margin-bottom-0">
<script>
    function get_facilitator_certificate_form(certificate_id) {
        $.ajax({
                method: "POST",
                url: "<?php echo site_url(ADMIN_DIR . 'trainings/get_facilitator_certificate_form'); ?>",
                data: {
                    certificate_id: certificate_id
                },
            })
            .done(function(respose) {
                $('#g_modal').modal('show');
                $('#modal_title').html('Training Certificates');
                $('#g_modal_body').html(respose);
            });
    }
</script>
<script>
    <?php $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . " Batch: " . $title . " " . date('d-m-Y h:m:s'); ?>
    title = '<?php echo 'T-Code:(' . $training->code . ") - " . $title; ?> Facilitators List';
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

<!-- Include CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>