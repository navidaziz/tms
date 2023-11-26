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
                    <a href="<?php echo site_url(ADMIN_DIR . "trainings/view_training/" . $training->training_id); ?>"><?php echo $training->code; ?></a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $sub_title; ?></div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <button onclick="add_nomination_form('resource_person');" class="btn btn-primary btn-sm"> Add Resource Person</button>
                        <button onclick="add_nomination_form('trainee');" class="btn btn-primary btn-sm"> Add Trainee</button>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->
<?php
$start_date = $batch->batch_start_date;
$end_date = $batch->batch_end_date;

// Convert string dates to DateTime objects
$start_date = new DateTime($start_date);
$end_date = new DateTime($end_date);

// Create a DatePeriod object to iterate over the dates
$date_interval = new DateInterval('P1D'); // 1 day interval
$date_range = new DatePeriod($start_date, $date_interval, $end_date);
?>
<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-4">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-calendar"></i>Day Wise Sessions and Schedule</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <?php
                    foreach ($date_range as $date) { ?>
                        <table style="font-size:11px; width: 100%; border-collapse: separate; border-spacing: 2px; margin-bottom:10px; border:1px solid lightgray; border-radius:5px;">
                            <tr>
                                <td colspan="4">
                                    <strong><?php echo date('l j F Y', strtotime($date->format('Y-m-d'))); ?></strong>
                                    <hr style="margin: 2px !important;" />
                                </td>
                            </tr>
                            <?php
                            $query = "SELECT * FROM `training_batch_sessions` 
                            WHERE training_id = '" . $training->training_id . "' 
                            AND batch_id = '" . $batch->batch_id . "'
                            AND session_date = '" . $date->format('Y-m-d') . "'";
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
                                            echo $facilitator->name . "(" . $facilitator->designation . ")";
                                        } ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" style="text-align: center;">
                                    <button style="padding: 2px 10px; font-size:11px;" onclick="get_session_add_form('<?php echo $date->format('Y-m-d'); ?>')" class="btn btn-primary btn-sm ">Add Session Schedule</button>

                                </td>
                            </tr>
                        </table>

                    <?php  }
                    ?>



                    <script>
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
    </div>

    <div class="col-md-8">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-users"></i>Trainees</h4>
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT users.*, training_nominations.nomination_type  
                            FROM training_nominations 
                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                            WHERE training_nominations.batch_id = " . $batch->batch_id . "
                            AND training_nominations.training_id = " . $training->training_id;
                            $nominations = $this->db->query($query)->result();


                            foreach ($nominations as $nomination) : ?>


                                <tr>
                                    <td><?php echo $nomination->nomination_type; ?></td>
                                    <td><?php echo $nomination->name; ?></td>
                                    <td><?php echo $nomination->father_name; ?></td>
                                    <td><?php echo $nomination->cnic; ?></td>
                                    <td><?php echo $nomination->user_mobile_number; ?></td>
                                </tr>


                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div style="text-align: center;">
                        <button onclick="get_nomination_list('Trainee')" class="btn btn-primary btn-sm">Add Trainees</button>
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