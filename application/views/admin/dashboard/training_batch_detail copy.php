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
                        <li <?php if ($this->input->get('tab') == 'facilitators') { ?>class="active" <?php } ?>>
                            <a href="#box_tab5" data-toggle="tab"><i class="fa fa-calendar" aria-hidden="true"></i>
                                <span class="hidden-inline-mobile">Facilitators</span></a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'session') { ?> in active <?php } ?>" id="box_tab1">
                            <?php $this->load->view(ADMIN_DIR . "trainings/training_batch/training_batch_session", $this->data); ?>
                        </div>
                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'facilitators') { ?> in active <?php } ?>" id="box_tab5">
                            <?php $this->load->view(ADMIN_DIR . "trainings/training_batch/training_batch_facilitators", $this->data); ?>

                        </div>
                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'trainees') { ?> in active <?php } ?>" id="box_tab2">

                            <?php $this->load->view(ADMIN_DIR . "trainings/training_batch/training_batch_trainees", $this->data); ?>

                        </div>


                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'attendance') { ?> in active <?php } ?>" id="box_tab3">
                            <?php $this->load->view(ADMIN_DIR . "trainings/training_batch/training_batch_attendance", $this->data); ?>


                        </div>

                        <div class="tab-pane fade in <?php if ($this->input->get('tab') == 'test_result') { ?> in active <?php } ?>" id="box_tab4">
                            <?php $this->load->view(ADMIN_DIR . "trainings/training_batch/training_batch_test_results", $this->data); ?>

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