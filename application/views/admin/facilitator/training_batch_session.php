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
                        <h3 class="content-t itle pull-left">
                            <?php
                            $query = "SELECT trainings.*
                            FROM `training_batch_sessions`
                            INNER JOIN trainings ON(trainings.training_id = training_batch_sessions.training_id) 
                            WHERE training_batch_sessions.training_batch_session_id = '" . $training_batch_session_id . "'
                            AND training_batch_sessions.facilitator_id = '" . $this->session->userdata('userId') . "'
                            GROUP BY training_batch_sessions.training_id";
                            $training = $this->db->query($query)->row();
                            ?>
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
                        </h3>
                    </div>
                </div>



            </div>


        </div>
    </div>
</div>

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-4">


        <div class="table-responsive">

            <div class="box border blue" id="messenger">

                <div class="box-body">


                    <?php
                    $query = "SELECT training_batches.*
                                FROM `training_batch_sessions`
                                INNER JOIN training_batches ON(training_batches.batch_id = training_batch_sessions.batch_id)
                                WHERE training_batch_sessions.training_batch_session_id = '" . $training_batch_session_id . "'
                                AND training_batch_sessions.training_id = '" . $training->training_id . "'
                                AND training_batch_sessions.facilitator_id = '" . $this->session->userdata('userId') . "'
                                GROUP BY training_batches.batch_id";
                    $batch = $this->db->query($query)->row();
                    ?>
                    <h4><?php echo $batch->batch_title; ?></h4>
                    <small>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>

                        Venue: <?php echo $batch->location; ?>
                        <br />
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        From
                        <b><?php echo date('D j M Y', strtotime($batch->batch_start_date)); ?></b>
                        To <b><?php echo date('D j M Y', strtotime($batch->batch_end_date)); ?></b>
                        <br />

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
                    <hr />

                    <?php
                    $query = "SELECT training_batch_sessions.* FROM `training_batch_sessions`
                    WHERE training_batch_sessions.training_id = '" . $training->training_id . "'
                    AND training_batch_sessions.batch_id = '" . $batch->batch_id . "'
                    AND training_batch_sessions.facilitator_id = '" . $this->session->userdata('userId') . "'
                    ORDER BY start_time ASC";
                    $batch_session = $this->db->query($query)->row();
                    ?>

                    <table style=" width: 100%; border-collapse: separate; border-spacing: 2px; margin-bottom:30px; border:1px solid lightgray; border-radius:5px;">
                        <tr>
                            <td>
                                <strong><?php echo date('l j F Y', strtotime($batch_session->session_date)); ?></strong>
                                <hr style="margin: 2px !important;" />
                            </td>
                        </tr>
                        <tr style="border-bottom: 2px solid red;">

                            <td style="border-left: 2px solid gray; ">
                                <?php echo strtoupper(date('g:i a', strtotime($batch_session->start_time))); ?>
                                -
                                <?php echo strtoupper(date('g:i a', strtotime($batch_session->end_time))); ?>


                                <?php if ($batch_session->activity_type = 'Activity') { ?>
                                    <br />
                                    <?php echo $batch_session->course_title; ?>
                                    <br />
                                    <small>
                                        # <?php echo $batch_session->course_category; ?>
                                        / <?php echo $batch_session->course_type; ?>
                                    </small>

                                <?php } ?>
                                <?php if ($batch_session->activity_type = 'Break') { ?>

                                    <?php echo $batch_session->break_detail; ?>

                                <?php } ?>
                                <br />
                                <?php if ($batch_session->facilitator_id) {
                                    $query = "SELECT * FROM users WHERE user_id = $batch_session->facilitator_id";
                                    $facilitator = $this->db->query($query)->row();
                                    if ($facilitator) {
                                        echo $facilitator->name . " (<small><i>" . $facilitator->designation . "</i></small>)";
                                    }
                                } ?>

                            </td>
                        </tr>
                    </table>
                    <div>
                        <div>
                            <ul class="list-group">
                                <?php
                                $query = "SELECT a.*,tbsa.training_batch_session_attachment_id FROM training_batch_session_attachments as tbsa
                            INNER JOIN attachments as a ON(a.attachment_id = tbsa.attachment_id)
                            WHERE tbsa.training_batch_session_id = $training_batch_session_id";
                                $session_attachments = $this->db->query($query)->result();
                                foreach ($session_attachments as $session_attachment) { ?>
                                    <?php
                                    $downloadLink = base_url('uploads/' . $session_attachment->folder . '/' . $session_attachment->file_name);
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="<?php echo site_url(ADMIN_DIR . "facilitator/remove_session_attachment/" . $training_batch_session_id . "/" . $session_attachment->training_batch_session_attachment_id); ?>" onclick="return confirm('Are you sure? you want to remove')">
                                            <i class="fa fa-times" aria-hidden="true"></i></a>
                                        <span style="margin-left: 5px;"></span>
                                        <?php echo $session_attachment->file_detail; ?>
                                        <span class="badge badge-primary badge-pill">
                                            <a style="color: white;" href="<?php echo $downloadLink; ?>" target="_blank">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <small>
                                                    Download (<?php echo $session_attachment->file_ext; ?>)
                                                </small>
                                            </a>
                                        </span>
                                    </li>
                                <?php   }  ?>
                            </ul>
                            <ul class="list-group">
                                <?php
                                $query = "SELECT tbsa.* FROM training_batch_session_attachments as tbsa
                                WHERE tbsa.training_batch_session_id = $training_batch_session_id
                                AND tbsa.attachment_id IS NULL";
                                $session_attachments = $this->db->query($query)->result();
                                foreach ($session_attachments as $session_attachment) { ?>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="<?php echo site_url(ADMIN_DIR . "facilitator/remove_session_attachment/" . $training_batch_session_id . "/" . $session_attachment->training_batch_session_attachment_id); ?>" onclick="return confirm('Are you sure? you want to remove')">
                                            <i class="fa fa-times" aria-hidden="true"></i></a>
                                        <span style="margin-left: 5px;"></span>
                                        <?php echo $session_attachment->url_link_detail; ?>
                                        <span class="badge badge-primary badge-pill">
                                            <a style="color: white;" href="<?php echo $session_attachment->url_link; ?>" target="_blank">
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                                <small>
                                                    View
                                                </small>
                                            </a>
                                        </span>
                                    </li>
                                <?php   }  ?>
                            </ul>
                        </div>
                        <form action="<?php echo site_url(ADMIN_DIR . "facilitator/upload_session_file"); ?>" id="batch_add_form" method="post" enctype="multipart/form-data" style="font-size: 11px !important;">
                            <strong>Upload Course Study Meterials</strong><br />
                            Study Meterial <input required onclick="$('.file').show();$('.link').hide();" type="radio" name="study_meterial" value="file" /> Audio / Doc
                            <span style="margin-left: 5px;"></span>
                            <input required onclick="$('.file').hide();$('.link').show();" type="radio" name="study_meterial" value="youtube" /> Youtube Video
                            <br />
                            <br />
                            <input name="training_batch_session_id" type="hidden" value="<?php echo $training_batch_session_id; ?>" />
                            <input name="training_id" type="hidden" value="<?php echo $training->training_id; ?>" />
                            <input name="batch_id" type="hidden" value="<?php echo $batch->batch_id; ?>" />
                            <div class="form-group row file">

                                <div class="col-sm-12">
                                    <label for="document_detail" class="col-form-label">Document Detail</label>
                                    <input type="text" class="form-control" id="document_detail" name="document_detail" placeholder="Write About Document">
                                    <?php echo form_error("document_detail", "<p class=\"text-danger\">", "</p>"); ?>
                                </div>
                            </div>
                            <div class="form-group row file">

                                <div class="col-sm-12">
                                    <label for="document" class="col-form-label">Document (File)</label>
                                    <input type="file" class="form-control" id="document" name="document">
                                    <?php echo form_error("document", "<p class=\"text-danger\">", "</p>"); ?>
                                </div>
                            </div>


                            <div class="form-group row link" style="display: none;">
                                <div class="col-sm-12">
                                    <label for="url_link_detail" class="col-form-label">YouTube Video Detail</label>
                                    <input type="text" class="form-control" id="url_link_detail" name="url_link_detail">
                                    <?php echo form_error("url_link", "<p class=\"text-danger\">", "</p>"); ?>
                                </div>
                            </div>


                            <div class="form-group row link" style="display: none;">

                                <div class="col-sm-12">
                                    <label for="url_link" class="col-form-label">YouTube Video Link (URL)</label>
                                    <input type="url" class="form-control" id="url_link" name="url_link">
                                    <?php echo form_error("url_link", "<p class=\"text-danger\">", "</p>"); ?>
                                </div>
                            </div>

                            <div style="text-align: center;">
                                <button class="btn btn-success btn-sm"><i class="fa fa-upload" aria-hidden="true"></i> Upload File</button>
                            </div>
                        </form>

                    </div>


                </div>


            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="table-responsive">

            <div class="box border blue" id="messenger">

                <div class="box-body">
                    <button onclick="get_mcq_add_form()">Add MCQ</button>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function get_mcq_add_form(nomination_type) {
        $('#modal').html('Please Wait .....');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(ADMIN_DIR . "/facilitator/get_mcq_add_form"); ?>",
            data: {
                training_batch_session_id: <?php echo $training_batch_session_id; ?>,
                training_id: '<?php echo $training->training_id; ?>',
                batch_id: <?php echo $batch->batch_id; ?>
            }
        }).done(function(data) {
            $('#g_modal_body').html(data);
        });

        $('#g_modal').modal('show');
    }
</script>