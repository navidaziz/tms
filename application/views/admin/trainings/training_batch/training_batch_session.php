<div class="col-md-12">
    <div class="table-responsive">
        <?php
        $startDate = new DateTime($batch->batch_start_date);
        $endDate = new DateTime($batch->batch_end_date);

        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {

        ?>
            <table style=" width: 100%; border-collapse: separate; border-spacing: 2px; margin-bottom:10px; border:1px solid lightgray; border-radius:5px;">
                <tr>

                    <td colspan="5">
                        <strong><?php echo date('l j F Y', strtotime($currentDate->format('Y-m-d'))); ?></strong>
                        <hr style="margin: 2px !important;" />
                    </td>
                </tr>
                <?php
                $query = "SELECT * FROM `training_batch_sessions` 
                                            WHERE training_id = '" . $training->training_id . "' 
                                            AND batch_id = '" . $batch->batch_id . "'
                                            AND session_date = '" . $currentDate->format('Y-m-d') . "'
                                            ORDER BY start_time ASC";
                $batch_sessions = $this->db->query($query)->result();
                foreach ($batch_sessions as $batch_session) {
                ?>
                    <tr style="border-bottom: 2px solid red;">
                        <td> <a href="<?php echo site_url(ADMIN_DIR . "trainings/remove_session/" . $batch_session->training_id . "/" . $batch_session->batch_id . "/" . $batch_session->training_batch_session_id); ?>" onclick="return confirm('Are you sure? you want to remove')">
                                <i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td style="border-left: 2px solid gray; ">
                            <?php echo strtoupper(date('g:i a', strtotime($batch_session->start_time))); ?>
                            -
                            <?php echo strtoupper(date('g:i a', strtotime($batch_session->end_time))); ?>
                        </td>
                        <td>
                            <?php if ($batch_session->activity_type = 'Activity') { ?>
                                <?php echo $batch_session->course_title; ?>
                            <?php } ?>
                            <?php if ($batch_session->activity_type = 'Break') { ?>
                                <strong><?php echo $batch_session->break_detail; ?></strong>
                            <?php } ?>
                        </td>
                        <td><?php if ($batch_session->facilitator_id) {
                                $query = "SELECT * FROM users WHERE user_id = $batch_session->facilitator_id";
                                $facilitator = $this->db->query($query)->row();
                                if ($facilitator) {
                                    echo $facilitator->name . " (<small><i>" . $facilitator->designation . "</i></small>)";
                                }
                            } ?></td>
                        <td>
                            <button onclick="get_session_edit_form(<?php echo $batch_session->training_batch_session_id; ?>, '<?php echo $currentDate->format('Y-m-d'); ?>')">Edit</button>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <button style="padding: 2px 10px; font-size:11px;" onclick="get_session_add_form('<?php echo $currentDate->format('Y-m-d'); ?>')" class="btn btn-primary btn-sm ">Add Session Schedule</button>

                    </td>
                </tr>
            </table>
            

        <?php

            $currentDate->modify('+1 day');
        }
        ?>
<div style="text-align:center">
                <a target="new" class="btn btn-warning btn-sm"  href="<?php echo site_url(ADMIN_DIR . "trainings/print_training_batch_schedule/" . $batch_session->training_id . "/" . $batch_session->batch_id); ?>" ><i class="fa fa-print" aria-hidden="true"></i> Day Wise Sessions and Schedule</a>
            </div>


        <script>
            function get_session_edit_form(training_batch_session_id, batch_day) {
                $('#modal').html('Please Wait .....');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(ADMIN_DIR . "/trainings/get_session_edit_form"); ?>",
                    data: {
                        training_id: '<?php echo $training->training_id; ?>',
                        batch_id: <?php echo $batch->batch_id; ?>,
                        training_batch_session_id: training_batch_session_id,
                        batch_day: batch_day

                    }
                }).done(function(data) {
                    $('#g_modal_body').html(data);
                });

                $('#g_modal').modal('show');
            }

            function get_session_add_form(batch_day) {
                $('#modal').html('Please Wait .....');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(ADMIN_DIR . "/trainings/get_session_add_form"); ?>",
                    data: {
                        training_id: '<?php echo $training->training_id; ?>',
                        batch_id: <?php echo $batch->batch_id; ?>,
                        batch_day: batch_day

                    }
                }).done(function(data) {
                    $('#g_modal_body').html(data);
                });

                $('#g_modal').modal('show');
            }
        </script>


    </div>
    <hr class="margin-bottom-0">
</div>