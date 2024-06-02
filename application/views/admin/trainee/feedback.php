<!-- PAGE HEADER-->
<div class="row">
    <div class="col-sm-12">
        <div class="page-header">
            <!-- STYLER -->
            <?php
            $query = "SELECT trainings.*
                FROM `training_nominations`
                INNER JOIN trainings ON(trainings.training_id = training_nominations.training_id) 
                WHERE training_nominations.training_id = '" . $training_id . "'
                AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
            $training = $this->db->query($query)->row();
            ?>
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
                <li>
                    <i class="fa fa-list"></i>
                    <a href="<?php echo site_url(ADMIN_DIR . "trainee/training_detail/" . $training_id . "/" . $batch_id); ?>">#<?php echo $training->code; ?> </a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h4><?php echo $title; ?></h4>
                        <h5 class="content-ti tle">
                            <?php
                            $query = "SELECT trainings.*
                            FROM `training_nominations`
                            INNER JOIN trainings ON(trainings.training_id = training_nominations.training_id) 
                            WHERE training_nominations.training_id = '" . $training_id . "'
                            AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
                            $training = $this->db->query($query)->row();
                            ?>
                            <?php echo $training->title ?>

                        </h5>
                        <?php
                        $query = "SELECT training_batches.*
                                FROM `training_nominations`
                                INNER JOIN training_batches ON(training_batches.batch_id = training_nominations.batch_id)
                                WHERE training_nominations.batch_id = '" . $batch_id . "'
                                AND training_nominations.training_id = '" . $training->training_id . "'
                                AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'";
                        $batch = $this->db->query($query)->row();
                        ?>
                        <h5>T-Code: <?php echo $training->code; ?> : <?php echo $batch->batch_title; ?></h5>


                    </div>
                </div>


            </div>


        </div>
    </div>
</div>

<?php
$facilitators_evaluations = array(
    'subject_knowledge' => 'Subject Knowledge',
    'lecture_contents' => 'Lecture Contents',
    'teaching_methodology' => 'Teaching Methodology',
    'time_utilization' => 'Time Utilization',
    'participants_engagement' => 'Participants Engagement'
);
$training_evaluations = array(
    'trainings_hall_environment' => 'Trainings Hall Environment',
    'food' => 'Food',
    'hostel' => 'hostel',
    'extra_physical_activities' => 'Extra Physical Activities'
);
$ratings = array(
    1 => 'Poor',
    2 => 'Fair',
    3 => 'Good',
    4 => 'Very Good',
    5 => 'Excellent'
);
?>
<div class="row">

    <div class="col-md-12">
        <div class="box border blue" id="messenger" style="background-color: white!important;">
            <div class="box-title">
                <h4><i class="fa fa-comments-o"></i> Feedback</h4>
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <form action="<?php echo site_url(ADMIN_DIR . 'trainee/submit_feedback'); ?>" method="post">
                        <input type="hidden" value="<?php echo $batch_id; ?>" name="training[batch_id]" />
                        <input type="hidden" value="<?php echo $training_id; ?>" name="training[training_id]" />

                        <h4>Training Facilities Feebback</h4>
                        <table class=" table table-bordered">
                            <tr>
                                <th>Feedback</th>
                                <?php foreach ($ratings as $rating) { ?>
                                    <th><?php echo $rating; ?></th>
                                <?php } ?>
                            </tr>
                            <?php foreach ($training_evaluations as $index => $training_evaluation) { ?>
                                <tr>
                                    <th><?php echo $training_evaluation; ?></th>
                                    <?php foreach ($ratings as $r_value => $rating) { ?>
                                        <td style="text-align: center;"><input required type="radio" value="<?php echo $r_value  ?>" name="training[<?php echo $index; ?>]" /></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th>Any Other Comments/ Suggestions</th>
                                <td colspan="5" style="text-align: center;">
                                    <textarea style="width: 100%;" name="training[remarks]"></textarea>
                                </td>

                            </tr>

                        </table>

                        <h4>Facilitators Evaluation</h4>
                        <table class="table" id="db_table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Facilitator</th>
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
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <h4>
                                                Name: <?php echo $nomination->name; ?><br />
                                                Designation: <?php echo $nomination->designation; ?><br />
                                                Qualification: <?php echo $nomination->qualification; ?>
                                            </h4>
                                            <input type="hidden" value="<?php echo $training_id; ?>" name="facilitators[<?php echo $nomination->user_id ?>][training_id]" />
                                            <input type="hidden" value="<?php echo $batch_id; ?>" name="facilitators[<?php echo $nomination->user_id ?>][batch_id]" />

                                            <table class=" table table-bordered">

                                                <tr>
                                                    <th>Feedback</th>
                                                    <?php foreach ($ratings as $rating) { ?>
                                                        <th><?php echo $rating; ?></th>
                                                    <?php } ?>
                                                </tr>
                                                <?php foreach ($facilitators_evaluations as $index => $facilitators_evaluation) { ?>
                                                    <tr>
                                                        <th><?php echo $facilitators_evaluation; ?></th>
                                                        <?php foreach ($ratings as $r_value => $rating) { ?>
                                                            <td style="text-align: center;"><input required type="radio" value="<?php echo $r_value  ?>" name="facilitators[<?php echo $nomination->user_id ?>][<?php echo $index; ?>]" /></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>Any Other Comments/ Suggestions</th>
                                                    <td colspan="5" style="text-align: center;">
                                                        <textarea style="width: 100%;" name="facilitators[<?php echo $nomination->user_id ?>][remarks]"></textarea>
                                                    </td>

                                                </tr>

                                            </table>
                                        </td>
                                    </tr>


                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div style="text-align: center;">
                            <input class="btn btn-success" type="submit" value="submit feedback" name="submit feedback" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>