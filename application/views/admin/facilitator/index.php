<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->

            <!-- /STYLER -->
            <!-- BREADCRUMBS -->
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h3 class="content-ti tle pull-left"><?php echo $title; ?></h3>
                    </div>
                    <?php
                    $query = "SELECT * FROM users WHERE user_id = '" . $this->session->userdata('userId') . "'";
                    $facilitator = $this->db->query($query)->row();
                    $facilitator->name;
                    //var_dump($facilitator);
                    ?>
                    <div class="description"><?php echo $facilitator->name; ?> (<?php echo $facilitator->designation; ?>)</div>
                </div>



            </div>


        </div>
    </div>
</div>

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">


        <div class="table-responsive">
            <?php
            $query = "SELECT trainings.*
                              FROM `training_batch_sessions`
                              INNER JOIN trainings ON(trainings.training_id = training_batch_sessions.training_id) 
                              WHERE training_batch_sessions.facilitator_id = '" . $this->session->userdata('userId') . "'
                              GROUP BY training_batch_sessions.training_id";
            $trainings = $this->db->query($query)->result();
            foreach ($trainings as $training) { ?>
                <div class="box border blue" id="messenger">

                    <div class="box-body">
                        <h4>#<?php echo $training->code; ?>: <?php echo $training->title ?></h4>
                        <smal> <?php echo $training->level; ?> /
                            <?php echo $training->category; ?> /
                            <?php echo $training->sub_category; ?> /
                            <?php echo $training->type; ?> /
                            <?php echo $training->training_for; ?>
                            <br />
                            <strong>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                Location: <?php echo $training->location; ?>
                                <span style="margin-left: 10px;"></span>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                From <?php echo date('D, j M Y', strtotime($training->start_date)); ?>
                                To <?php echo date('D, j M Y', strtotime($training->end_date)); ?>
                            </strong>
                        </smal>
                        <hr />
                        <?php
                        $query = "SELECT training_batches.*
                                FROM `training_batch_sessions`
                                INNER JOIN training_batches ON(training_batches.batch_id = training_batch_sessions.batch_id)
                                WHERE training_batch_sessions.training_id = '" . $training->training_id . "'
                                AND training_batch_sessions.facilitator_id = '" . $this->session->userdata('userId') . "'
                                GROUP BY training_batches.batch_id";
                        $batchs = $this->db->query($query)->result();
                        // echo "<pre>";
                        // var_dump($batchs);
                        // echo "</pre>";
                        foreach ($batchs as $batch) { ?>
                            <h4><?php echo $batch->batch_title; ?></h4>
                            <small>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                Venue: <?php echo $batch->location; ?>
                                <span style="margin-left: 10px;"></span>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                From
                                <b><?php echo date('D j M Y', strtotime($batch->batch_start_date)); ?></b>
                                To <b><?php echo date('D j M Y', strtotime($batch->batch_end_date)); ?></b>
                                <span style="margin-left: 10px;"></span>
                                <i class="fa fa-users"></i> Facilitators: <?php
                                                                            $query = "SELECT COUNT(DISTINCT facilitator_id) as total FROM training_batch_sessions WHERE facilitator_id != '0' AND batch_id='" . $batch->batch_id . "'";
                                                                            echo $this->db->query($query)->row()->total;
                                                                            ?>
                                <span style="margin-left: 5px;"></span>
                                <i class="fa fa-users"></i>
                                Trainees:
                                <?php
                                $query = "SELECT COUNT(*) as total FROM training_nominations WHERE batch_id='" . $batch->batch_id . "'";
                                echo $this->db->query($query)->row()->total;
                                ?>
                                <span style="margin-left: 15px;"></span>
                                <i style="color: pink;" class="fa fa-female" aria-hidden="true"></i>
                                <?php
                                $query = "SELECT COUNT(*) as total FROM training_nominations 
                                INNER JOIN users ON (users.user_id = training_nominations.user_id)
                                WHERE training_nominations.batch_id='" . $batch->batch_id . "'
                                AND users.gender = 'Female'";
                                echo $this->db->query($query)->row()->total;
                                ?>
                                <span style="margin-left: 5px;"></span>
                                <i style="color: blue;" class="fa fa-male" aria-hidden="true"></i>
                                <?php
                                $query = "SELECT COUNT(*) as total FROM training_nominations 
                                INNER JOIN users ON (users.user_id = training_nominations.user_id)
                                WHERE training_nominations.batch_id='" . $batch->batch_id . "'
                                AND users.gender = 'Male'";
                                echo $this->db->query($query)->row()->total;
                                ?>
                            </small>


                            <?php
                            $query = "SELECT training_batch_sessions.session_date  
                            FROM `training_batch_sessions` 
                            WHERE training_batch_sessions.training_id = '" . $training->training_id . "'
                            AND training_batch_sessions.batch_id = '" . $batch->batch_id . "'
                            AND training_batch_sessions.facilitator_id = '" . $this->session->userdata('userId') . "'
                            GROUP BY training_batch_sessions.session_date";
                            $session_dates = $this->db->query($query)->result();
                            foreach ($session_dates as $date) { ?>

                                <table style=" width: 100%; border-collapse: separate; border-spacing: 2px; margin-bottom:30px; border:1px solid lightgray; border-radius:5px;">
                                    <tr>

                                        <td colspan="7">
                                            <strong><?php echo date('l j F Y', strtotime($date->session_date)); ?></strong>
                                            <hr style="margin: 2px !important;" />
                                        </td>
                                    </tr>
                                    <?php

                                    $query = "SELECT training_batch_sessions.* FROM `training_batch_sessions`
                                    WHERE training_batch_sessions.training_id = '" . $training->training_id . "'
                                    AND training_batch_sessions.batch_id = '" . $batch->batch_id . "'
                                    AND training_batch_sessions.facilitator_id = '" . $this->session->userdata('userId') . "'
                                    AND training_batch_sessions.session_date = '" . $date->session_date . "'
                                    ORDER BY start_time ASC";
                                    $batch_sessions = $this->db->query($query)->result();
                                    foreach ($batch_sessions as $batch_session) {
                                    ?>
                                        <tr style="border-bottom: 2px solid red;">

                                            <td style="border-left: 2px solid gray; ">
                                                <?php echo strtoupper(date('g:i a', strtotime($batch_session->start_time))); ?>
                                                -
                                                <?php echo strtoupper(date('g:i a', strtotime($batch_session->end_time))); ?>
                                            </td>

                                            <?php if ($batch_session->activity_type = 'Activity') { ?>
                                                <td>
                                                    <?php echo $batch_session->course_category; ?>
                                                </td>
                                                <td>
                                                    <?php echo $batch_session->course_type; ?>
                                                </td>
                                                <td>
                                                    <?php echo $batch_session->course_title; ?>
                                                </td>
                                            <?php } ?>
                                            <?php if ($batch_session->activity_type = 'Break') { ?>
                                                <td>
                                                    <strong><?php echo $batch_session->break_detail; ?></strong>
                                                </td>
                                            <?php } ?>

                                            <td><?php if ($batch_session->facilitator_id) {
                                                    $query = "SELECT * FROM users WHERE user_id = $batch_session->facilitator_id";
                                                    $facilitator = $this->db->query($query)->row();
                                                    if ($facilitator) {
                                                        echo $facilitator->name . " (<small><i>" . $facilitator->designation . "</i></small>)";
                                                    }
                                                } ?></td>
                                            <td>
                                                <a class="btn btn-link btn-sm" href="<?php echo site_url(ADMIN_DIR . 'facilitator/training_batch_session/' . $batch_session->training_batch_session_id) ?>">Manage </a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </table>

                            <?php } ?>
                        <?php } ?>
                    </div>


                </div>
            <?php } ?>







            <script>
                function get_session_edit_form(training_batch_session_id) {
                    $('#modal').html('Please Wait .....');
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(ADMIN_DIR . "/trainings/get_session_edit_form"); ?>",
                        data: {
                            training_id: '<?php echo $training->training_id; ?>',
                            batch_id: <?php echo $batch->batch_id; ?>,
                            training_batch_session_id: training_batch_session_id

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
    </div>

</div>