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
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "trainings/view/"); ?>"><?php echo $this->lang->line('Trainings'); ?></a>
                </li>
                <li>
                    <i class="fa fa-table"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "trainings/view_training/" . $training->training_id); ?>?tab=training"><?php echo $training->code; ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $sub_title; ?></div>
                </div>



            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->
<?php
$startDate = new DateTime($batch->batch_start_date);
$endDate = new DateTime($batch->batch_end_date);

$currentDate = clone $startDate; ?>
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-12">



        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-calendar"></i>Training Batch Detail</h4>

            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">
                        <li <?php if ($this->input->get('tab') == 'test_result') { ?>class="active" <?php } ?>>
                            <a href="#box_tab4" data-toggle="tab"><i class="fa fa-check" aria-hidden="true"></i>
                                <span class="hidden-inline-mobile">Pre / Post Test Results</span></a>
                        </li>
                        <li <?php if ($this->input->get('tab') == 'attandance') { ?>class="active" <?php } ?>>
                            <a href="#box_tab3" data-toggle="tab"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span class="hidden-inline-mobile">Attendance</span></a>
                        </li>
                        <li <?php if ($this->input->get('tab') == 'trainees') { ?>class="active" <?php } ?>>
                            <a href="#box_tab2" data-toggle="tab">
                                <i class="fa fa-users"></i>
                                <span class="hidden-inline-mobile">Trainees</span></a>
                        </li>
                        <li <?php if ($this->input->get('tab') == 'session') { ?>class="active" <?php } ?>>
                            <a href="#box_tab1" data-toggle="tab"><i class="fa fa-calendar" aria-hidden="true"></i>
                                <span class="hidden-inline-mobile">Day Wise Sessions and Schedule</span></a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'session') { ?> in active <?php } ?>" id="box_tab1">
                            <div class="table-responsive">
                                <?php
                                while ($currentDate <= $endDate) {
                                    $currentDate->modify('+1 day');
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
                                                    <button onclick="get_session_edit_form(<?php echo $batch_session->training_batch_session_id; ?>)">Edit</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center;">
                                                <button style="padding: 2px 10px; font-size:11px;" onclick="get_session_add_form('<?php echo $currentDate->format('Y-m-d'); ?>')" class="btn btn-primary btn-sm ">Add Session Schedule</button>

                                            </td>
                                        </tr>
                                    </table>

                                <?php  }
                                ?>



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
                            <hr class="margin-bottom-0">
                            <!-- /TAB 1 -->
                        </div>

                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'trainees') { ?> in active <?php } ?>" id="box_tab2">
                            <div class="col-md-12">
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>CNIC</th>
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
                                            AND training_nominations.training_id = " . $training->training_id;
                                            $nominations = $this->db->query($query)->result();
                                            $count = 1;
                                            foreach ($nominations as $nomination) : ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $nomination->name; ?></td>
                                                    <td><?php echo $nomination->father_name; ?></td>
                                                    <td><?php echo $nomination->cnic; ?></td>
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
                            <!-- /TAB 1 -->
                        </div>


                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'attendance') { ?> in active <?php } ?>" id="box_tab3">
                            <div class="col-md-12">
                                <div class="table-responsive">

                                    <table class="table table-bordered" style="font-size: 9px;">
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
                                            $query = "SELECT users.*, training_nominations.nomination_type,  training_nominations.id
                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND training_nominations.training_id = " . $training->training_id;
                                            $nominations = $this->db->query($query)->result();
                                            $count = 1;
                                            foreach ($nominations as $nomination) : ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
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
                                                            <th style="text-align: center;">A</th>
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
                                                            <th style="text-align: center;">A</th>
                                                        <?php } ?>



                                                    <?php } ?>
                                                </tr>


                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>

                            <hr class="margin-bottom-0">
                            <!-- /TAB 1 -->
                        </div>

                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'test_result') { ?> in active <?php } ?>" id="box_tab4">
                            <div class="col-md-12">
                                <div class="table-responsive">

                                    <table class="table table-bordered" style="font-size: 9px;">
                                        <thead>
                                            <tr>
                                                <th colspan="8"></th>
                                                <th colspan="4">Pre Test Result</th>
                                                <th colspan="4">Post Test Result</th>

                                            </tr>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>CNIC</th>
                                                <th>Designation</th>
                                                <th>District</th>
                                                <th>Qualification</th>
                                                <th>Mobile No.</th>

                                                <th>Total Question</th>
                                                <th>Wrong Answers</th>
                                                <th>Correct Answers</th>
                                                <th>Percentage (%)</th>

                                                <th>Total Question</th>
                                                <th>Wrong Answers</th>
                                                <th>Correct Answers</th>
                                                <th>Percentage (%)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT users.*, training_nominations.nomination_type,  training_nominations.id
                                            FROM training_nominations 
                                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                                            AND training_nominations.training_id = " . $training->training_id;
                                            $nominations = $this->db->query($query)->result();
                                            $count = 1;
                                            foreach ($nominations as $nomination) : ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $nomination->name; ?></td>
                                                    <td><?php echo $nomination->father_name; ?></td>
                                                    <td><?php echo $nomination->cnic; ?></td>
                                                    <td><?php echo $nomination->designation; ?></td>
                                                    <td><?php echo $nomination->district; ?></td>
                                                    <td><?php echo $nomination->qualification; ?></td>
                                                    <td><?php echo $nomination->user_mobile_number; ?></td>

                                                    <?php
                                                    $trainee_id = $this->session->userdata('userId');
                                                    $query = "SELECT COUNT(*) as total, 
                                                        SUM(IF(pre_test_result=1,1,0)) as correct_ans,
                                                                    SUM(IF(pre_test_result=0,1,0)) as wrong_ans 
                                                                    FROM training_tests
                                                                        WHERE training_id = " . $training->training_id . "
                                                                        AND batch_id = " . $batch->batch_id . "
                                                                        AND trainee_id = " . $nomination->user_id . "";
                                                    $summary = $this->db->query($query)->row();
                                                    ?>

                                                    <td><?php echo $summary->total; ?></td>
                                                    <td><?php echo $summary->wrong_ans; ?></td>
                                                    <td><?php echo $summary->correct_ans; ?></td>
                                                    <td><?php
                                                        if ($summary->total) {
                                                            echo @round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                                                        }
                                                        ?></td>

                                                    <?php
                                                    $trainee_id = $this->session->userdata('userId');
                                                    $query = "SELECT COUNT(*) as total, 
                                                                SUM(IF(post_test_result=1,1,0)) as correct_ans,
                                                                    SUM(IF(post_test_result=0,1,0)) as wrong_ans 
                                                                    FROM training_tests
                                                                WHERE training_id = " . $training->training_id . "
                                                                        AND batch_id = " . $batch->batch_id . "
                                                                        AND trainee_id = " . $nomination->user_id . "";
                                                    $summary = $this->db->query($query)->row(); ?>
                                                    <td><?php echo $summary->total; ?></td>
                                                    <td><?php echo $summary->wrong_ans; ?></td>
                                                    <td><?php echo $summary->correct_ans; ?></td>
                                                    <td><?php
                                                        if ($summary->total) {
                                                            echo @round(($summary->correct_ans * 100) / $summary->total, 2) . " %";
                                                        }
                                                        ?></td>



                                                </tr>


                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>

                            <hr class="margin-bottom-0">
                            <!-- /TAB 1 -->
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>


</div>

<script>
    function get_nomination_list(nomination_type) {
        $('#modal').html('Please Wait .....');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(ADMIN_DIR . "/trainings/get_nomination_list"); ?>",
            data: {
                nomination_type: nomination_type,
                training_id: '<?php echo $training->training_id; ?>',
                batch_id: <?php echo $batch->batch_id; ?>
            }
        }).done(function(data) {
            $('#g_modal_body').html(data);
        });

        $('#g_modal').modal('show');
    }
</script>
<script language="javascript">
    function nic_dash1(t)

    {
        var donepatt = /^(\d{5})\/(\d{7})\/(\d{1})$/;

        var patt = /(\d{5}).*(\d{7}).*(\d{1})/;

        var str = t.value;

        if (!str.match(donepatt))

        {
            result = str.match(patt);

            if (result != null)

            {
                t.value = t.value.replace(/[^\d]/gi, '');

                str = result[1] + '-' + result[2] + '-' + result[3];

                t.value = str;

            } else {

                if (t.value.match(/[^\d]/gi))

                    t.value = t.value.replace(/[^\d]/gi, '');

            }
        }
    }
</script>