<div class="modal-header">
    <h5 style="display: inline;" class="modal-title" id="g_modal_title"><?php echo $title; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="table-responsive" style="overflow-y: auto;">
        <script>
            function select_all_check_boxes() {
                var myCheckbox = document.getElementById('main_checkbox');
                if (myCheckbox.checked) {
                    $('.nomination_id').prop('checked', true);
                } else {
                    $('.nomination_id').prop('checked', false);
                }

            }
        </script>
        <form action="<?php echo site_url(ADMIN_DIR . "trainings/add_nomination_to_batch") ?>" method="post">
            <input type="hidden" name="training_id" value="<?php echo $training_id; ?>" />
            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>" />
            <table class="table" style="font-size: 11px;" id="n_list">
                <thead>
                    <tr>
                        <th><input id="main_checkbox" onclick="select_all_check_boxes()" type="checkbox" /></th>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>CNIC</th>
                        <th>Mobile No.</th>
                        <th>Department</th>
                        <th>District</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT users.*, training_nominations.nomination_type, training_nominations.id  FROM training_nominations 
                    INNER JOIN users ON(users.user_id = training_nominations.user_id)
                    WHERE training_nominations.batch_id = 0
                    AND training_nominations.nomination_type = " . $this->db->escape($nomination_type) . "
                    AND training_nominations.training_id = " . $training_id;
                    $nominations = $this->db->query($query)->result();
                    $count = 1;
                    foreach ($nominations as $nomination) : ?>
                        <tr>
                            <td><input class="nomination_id" type="checkbox" name="nominations[<?php echo $nomination->id; ?>]" /></td>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $nomination->name; ?></td>
                            <td><?php echo $nomination->father_name; ?></td>
                            <td><?php echo $nomination->cnic; ?></td>
                            <td><?php echo $nomination->user_mobile_number; ?></td>
                            <td><?php echo $nomination->department; ?></td>
                            <td><?php echo $nomination->district; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div style="text-align: center;">
                <button class="btn btn-primary btn-sm">Add Trainees to this batch</button>
            </div>

        </form>


    </div>

    <script>
        $('#batch_add_form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url(ADMIN_DIR . "/trainings/add_training_batch"); ?>',
                data: formData,
                success: function(data) {
                    var jsonData = JSON.parse(data);
                    if (jsonData.error) {
                        $('#message_form').html(jsonData.error);
                    }
                    if (jsonData.success) {
                        $('#message_form').html('<div class="text-success">Record Update Successfully.</div>');
                        //location.reload();
                    }

                },
                error: function(error) {
                    // Handle the error
                    console.error('Error:', error);
                }
            });
        });
    </script>
</div>

<script>
    <?php

    $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . " Batch: " . $batch->batch_title . " " . date('d-m-Y h:m:s'); ?>
    title = '<?php echo 'T-Code:(' . $training->code . ") - " . $batch->batch_title; ?> Traniees Attendance List';

    $('#n_list').DataTable({
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
</script>