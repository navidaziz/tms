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
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-graduation-cap"></i> Training List</h4>
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Training</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT trainings.*
                              FROM `training_nominations`
                              INNER JOIN trainings ON(trainings.training_id = training_nominations.training_id) 
                              WHERE training_nominations.user_id = '" . $this->session->userdata('userId') . "'
                              GROUP BY training_nominations.training_id";
                            $trainings = $this->db->query($query)->result();
                            foreach ($trainings as $training) { ?>
                                <tr>


                                    <td>
                                        (<?php echo $training->code; ?>): <?php echo $training->title ?><br />
                                        <small>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            Location: <?php echo $training->location; ?>
                                            <!-- <span style="margin-left: 10px;"></span><br />
                                            <strong>
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                From <?php echo date('D, j M Y', strtotime($training->start_date)); ?>
                                                To <?php echo date('D, j M Y', strtotime($training->end_date)); ?>
                                            </strong> -->
                                        </small>

                                        <?php
                                        $query = "SELECT training_batches.*
                                FROM `training_nominations`
                                INNER JOIN training_batches ON(training_batches.batch_id = training_nominations.batch_id)
                                WHERE training_nominations.training_id = '" . $training->training_id . "'
                                AND training_nominations.user_id = '" . $this->session->userdata('userId') . "'
                                GROUP BY training_batches.batch_id";
                                        $batch = $this->db->query($query)->row();
                                        ?>
                                        <h4><strong><?php echo $batch->batch_title; ?></strong></h4>
                                        <small>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            Training Venue: <?php echo $batch->location; ?><br />

                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            From
                                            <b><?php echo date('D j M Y', strtotime($batch->batch_start_date)); ?></b>
                                            To <b><?php echo date('D j M Y', strtotime($batch->batch_end_date)); ?></b>

                                            <div style="text-align: center;">
                                                <a class="btn btn-success" href="<?php echo site_url(ADMIN_DIR . 'trainee/training_detail/' . $training->training_id . '/' . $batch->batch_id) ?>">Open Training </a>
                                            </div>

                                    </td>

                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>