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
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "trainee"); ?>">Dashboard (Training List)</a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h3 class="content-ti tle">
                            <?php
                            $query = "SELECT trainings.*
                            FROM `training_nominations`
                            INNER JOIN trainings ON(trainings.training_id = training_nominations.training_id) 
                            WHERE training_nominations.training_id = '" . $training_id . "'
                            AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
                            $training = $this->db->query($query)->row();
                            ?>
                            <?php echo $training->title ?>

                        </h3>
                        <?php
                        $query = "SELECT training_batches.*
                                FROM `training_nominations`
                                INNER JOIN training_batches ON(training_batches.batch_id = training_nominations.batch_id)
                                WHERE training_nominations.batch_id = '" . $batch_id . "'
                                AND training_nominations.training_id = '" . $training->training_id . "'
                                AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
                        $batch = $this->db->query($query)->row();
                        ?>
                        <h4>T-Code: <?php echo $training->code; ?> : <?php echo $batch->batch_title; ?></h4>
                        <small>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>

                            Venue: <?php echo $batch->location; ?>
                            <span style="margin-left: 10px;"></span>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            From
                            <b><?php echo date('D j M Y', strtotime($batch->batch_start_date)); ?></b>
                            To <b><?php echo date('D j M Y', strtotime($batch->batch_end_date)); ?></b>


                        </small>

                    </div>
                </div>



            </div>


        </div>
    </div>
</div>

<!-- PAGE MAIN CONTENT -->
<div class="row">

    <div class="col-md-8">
        <div class="table-responsive">

            <div class="box border blue" id="messenger">

                <div class="box-body">
                    <div class="table-responsive">
                        <h4>Training <?php echo $batch->batch_title; ?> Schedule</h4>
                        <?php
                        $day = 1;
                        date_default_timezone_set("Asia/Karachi");
                        $startDate = new DateTime($batch->batch_start_date);
                        $endDate = new DateTime($batch->batch_end_date);
                        $currentDate = new DateTime();
                        $date = clone $startDate;
                        $count = 1;
                        while ($date <= $endDate) {

                        ?>
                            <table style=" width: 100%; border-collapse: separate; border-spacing: 2px; margin-bottom:10px; border:1px solid lightgray; border-radius:5px;">

                                <tr>
                                    <td colspan="5">
                                        <h5><strong>Day <?php echo $day++; ?>. <?php echo date('l j F Y', strtotime($date->format('Y-m-d'))); ?></strong></h5>
                                        <hr style="margin: 2px !important;" />
                                    </td>
                                </tr>
                                <?php if (strtotime($date->format('Y-m-d')) == strtotime($startDate->format('Y-m-d'))) {
                                ?>
                                    <tr>
                                        <td colspan="5">
                                            <?php
                                            //echo $currentDate->format('Y-m-d') . " >= " . $startDate->format('Y-m-d');
                                            if ($currentDate >= $startDate) { ?>

                                                <?php
                                                $trainee_id = $this->session->userdata('userId');
                                                $query = "SELECT COUNT(*) as total, 
                                                SUM(IF(pre_test_result=1,1,0)) as correct_ans,
                                                SUM(IF(pre_test_result=0,1,0)) as wrong_ans 
                                                FROM training_tests
                                                WHERE training_id = " . $training->training_id . "
                                                AND batch_id = " . $batch_id . "
                                                AND trainee_id = " . $trainee_id . "";
                                                $summary = $this->db->query($query)->row();
                                                ?>
                                                <?php if ($summary->total > 0 and $summary->total == ($summary->correct_ans + $summary->wrong_ans)) { ?>
                                                    <strong>Pre Test Summary</strong>
                                                    <table class="table" style="background-color: #F5F6F6;">
                                                        <tr>
                                                            <th>Total Question</th>
                                                            <th>Wrong Answers</th>
                                                            <th>Correct Answers</th>
                                                            <th>Percentage (%)</th>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $summary->total; ?></td>
                                                            <td><?php echo $summary->wrong_ans; ?></td>
                                                            <td><?php echo $summary->correct_ans; ?></td>
                                                            <td><?php
                                                                if ($summary->total) {
                                                                    echo round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                                                                } ?></td>
                                                        </tr>
                                                    </table>
                                                <?php } else { ?>
                                                    <div style="text-align: center;">
                                                        <a class="btn btn-danger btn-sm" style="width: 50%;" href="<?php echo site_url(ADMIN_DIR . "trainee/pre_test/" . $training_id . "/" . $batch_id) ?>">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i> Pre Test Assessment
                                                            <?php if ($summary->total > 0) {
                                                                echo ' (Not Complete Yet!) ';
                                                            } ?>
                                                            <?php if ($summary->total == 0) {
                                                                echo ' (Start Please)';
                                                            } ?>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <h4 style="text-align: center; color:red;">
                                                    <strong>
                                                        The Training Pre Test will be available online on <?php echo date('l, j F Y', strtotime($date->format('Y-m-d'))); ?>.
                                                    </strong>
                                                </h4>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php
                                $query = "SELECT * FROM `training_batch_sessions` 
                                            WHERE training_id = '" . $training->training_id . "' 
                                            AND batch_id = '" . $batch->batch_id . "'
                                            AND session_date = '" . $date->format('Y-m-d') . "'
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

                                    </tr>

                                <?php } ?>
                                <?php

                                if (strtotime($date->format('Y-m-d')) == strtotime($endDate->format('Y-m-d'))) { ?>

                                    <tr>
                                        <td colspan="5">
                                            <?php
                                            $query = "SELECT COUNT(*) as total FROM  facilities_evaluations
                                            WHERE training_id = '" . $training_id . "'
                                            AND batch_id = '" . $batch_id . "'
                                            AND created_by = '" . $this->session->userdata('userId') . "'";
                                            $feedback = $this->db->query($query)->row()->total;
                                            ?>

                                            <?php
                                            // echo $currentDate->format('Y-m-d') . " >= " . $endDate->format('Y-m-d');
                                            if ($currentDate->format('Y-m-d') >= $endDate->format('Y-m-d')) {
                                                if ($feedback > 0) {
                                            ?>

                                                    <?php

                                                    $trainee_id = $this->session->userdata('userId');
                                                    $query = "SELECT COUNT(*) as total, 
                                                SUM(IF(post_test_result=1,1,0)) as correct_ans,
                                                            SUM(IF(post_test_result=0,1,0)) as wrong_ans 
                                                            FROM training_tests
                                                WHERE training_id = " . $training->training_id . "
                                                AND batch_id = " . $batch_id . "
                                                    AND trainee_id = " . $trainee_id . "";
                                                    $summary = $this->db->query($query)->row();
                                                    ?>
                                                    <?php if ($summary->total > 0 and $summary->total == ($summary->correct_ans + $summary->wrong_ans)) { ?>
                                                        <strong>Post Test Summary</strong>
                                                        <table class="table" style="background-color: #F5F6F6;">
                                                            <tr>
                                                                <th>Total Question</th>
                                                                <th>Wrong Answers</th>
                                                                <th>Correct Answers</th>
                                                                <th>Percentage (%)</th>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $summary->total; ?></td>
                                                                <td><?php echo $summary->wrong_ans; ?></td>
                                                                <td><?php echo $summary->correct_ans; ?></td>
                                                                <td><?php
                                                                    if ($summary->total) {
                                                                        echo round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                                                                    } ?></td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        <div style="text-align: center;">
                                                            <a class="btn btn-danger btn-sm" style="width: 50%;" href="<?php echo site_url(ADMIN_DIR . "trainee/post_test/" . $training_id . "/" . $batch_id) ?>">
                                                                <i class="fa fa-check-square-o" aria-hidden="true"></i> Post Test Assessment
                                                                <?php if ($summary->total > 0) {
                                                                    echo ' (Not Complete Yet!) ';
                                                                } ?>
                                                                <?php if ($summary->total == 0) {
                                                                    echo ' (Start Please)';
                                                                } ?>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div style="text-align: center;">
                                                        <h4>Post Test will be open after Feedback </h4>
                                                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "trainee/feedback/" . $training_id . "/" . $batch_id) ?>">
                                                            <i class="fa fa-comments-o" aria-hidden="true"></i> Feedback </a>


                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <h4 style="text-align: center; color:red;">
                                                    <strong>
                                                        The Training Post Test will be available online on <?php echo date('l, j F Y', strtotime($date->format('Y-m-d'))); ?>.
                                                    </strong>
                                                </h4>
                                            <?php } ?>
                                        </td>
                                    </tr>


                                <?php } ?>
                            </table>

                        <?php
                            $date->modify('+1 day');
                        }
                        ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>