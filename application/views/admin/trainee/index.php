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
                              FROM `training_nominations`
                              INNER JOIN trainings ON(trainings.training_id = training_nominations.training_id) 
                              WHERE training_nominations.user_id = '" . $this->session->userdata('userId') . "'
                              GROUP BY training_nominations.training_id";
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
                                FROM `training_nominations`
                                INNER JOIN training_batches ON(training_batches.batch_id = training_nominations.batch_id)
                                WHERE training_nominations.training_id = '" . $training->training_id . "'
                                AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'
                                GROUP BY training_batches.batch_id";
                        $batch = $this->db->query($query)->row();
                        ?>
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

                            <a class="btn btn-link btn-sm" href="<?php echo site_url(ADMIN_DIR . 'trainee/training_detail/' . $training->training_id . '/' . $batch->batch_id) ?>">Manage </a>

                        </small>

                    </div>


                </div>
            <?php } ?>
        </div>
    </div>

</div>