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

                <li><?php echo $training->code; ?></li>
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-12">
                    <div class="clearfix">
                        <h4 class=" pull-left"><?php echo $training->title; ?></h4>
                    </div>
                    <div class="description">Training Code: <?php echo $training->code; ?></div>
                </div>



            </div>


        </div>
    </div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">

    <div class="col-md-12">
        <!-- BOX -->
        <div class="box border blue">
            <div class="box-title">
                <h4><i class="fa fa-info" aria-hidden="true"></i>Training Detail</h4>
            </div>
            <div class="box-body">
                <div class="tabbable header-tabs">
                    <ul class="nav nav-tabs">
                        <li <?php if ($this->input->get('tab') == 'nomination') { ?>class="active" <?php } ?>>
                            <a href="#box_tab2" data-toggle="tab">
                                <i class="fa fa-users"></i>
                                <span class="hidden-inline-mobile">Nominations</span></a>
                        </li>
                        <li <?php if ($this->input->get('tab') != 'nomination') { ?>class="active" <?php } ?>>
                            <a href="#box_tab1" data-toggle="tab"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-inline-mobile">Training Batches</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in <?php if ($this->input->get('tab') != 'nomination') { ?> in active <?php } ?>" id="box_tab1">
                            <!-- TAB 1 -->
                            <div class="row">
                                <div class="col-md-4">


                                    <div class="table-responsive">

                                        <table style="font-size:11px; width: 100%; border-collapse: separate; border-spacing: 2px; margin-bottom:10px; border:1px solid lightgray; border-radius:5px;">
                                            <thead>

                                            </thead>
                                            <tbody>


                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('level'); ?></th>
                                                    <td>
                                                        <?php echo $training->level; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('category'); ?></th>
                                                    <td>
                                                        <?php echo $training->category; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('sub_category'); ?></th>
                                                    <td>
                                                        <?php echo $training->sub_category; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('type'); ?></th>
                                                    <td>
                                                        <?php echo $training->type; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('training_for'); ?></th>
                                                    <td>
                                                        <?php echo $training->training_for; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('location'); ?></th>
                                                    <td>
                                                        <?php echo $training->location; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('start_date'); ?></th>
                                                    <td>
                                                        <strong><?php echo date('l j F Y', strtotime($training->start_date)); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 2px solid gray; padding-left:5px; "><?php echo $this->lang->line('end_date'); ?></th>
                                                    <td>
                                                        <strong><?php echo date('l j F Y', strtotime($training->end_date)); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="border-left: 2px solid gray; padding-left:5px; ">
                                                        <hr />
                                                        <strong><?php echo $this->lang->line('detail'); ?></strong><br />
                                                        <?php echo $training->detail; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line('Status'); ?></th>
                                                    <td>
                                                        <?php echo status($training->status); ?>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>




                                    </div>


                                </div>
                                <div class="col-md-8">
                                    <div class="box border blue" id="messenger">
                                        <div class="box-title">
                                            <h4><i class="fa fa-tasks" aria-hidden="true"></i>Training Batches</h4>
                                        </div>
                                        <div class="box-body">

                                            <div class="table-responsive">

                                                <table class="table" style="font-size: 11px;">
                                                    <thead>
                                                        <th></th>
                                                        <th>S.No.</th>
                                                        <th>Batch</th>
                                                        <th colspan="2" style="text-align: center;">Start and End Date</th>
                                                        <th>Venue</th>
                                                        <th>info</th>
                                                        <th style="text-align: center;">Facilitators</th>
                                                        <th style="text-align: center;">Trainees</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $query = "SELECT * FROM training_batches WHERE training_id = " . $training->training_id;
                                                        $batches = $this->db->query($query)->result();
                                                        $count = 1;
                                                        foreach ($batches as $batch) : ?>
                                                            <tr <?php if ($batch->status == 2) { ?> style="text-decoration:line-through" <?php } ?>>
                                                                <td>
                                                                    <?php if ($batch->status == 1) { ?>
                                                                        <a href="<?php echo site_url(ADMIN_DIR . "trainings/remove_batch/" . $training->training_id . "/" . $batch->batch_id); ?>" onclick="return confirm('Are you sure? you want to remove')"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td><?php echo $count++; ?></td>
                                                                <td><?php echo $batch->batch_title; ?></td>
                                                                <td>
                                                                    <strong><?php echo date('D j M Y', strtotime($batch->batch_start_date)); ?></strong>
                                                                </td>
                                                                <td><strong><?php echo date('D j M Y', strtotime($batch->batch_end_date)); ?></stron>
                                                                </td>
                                                                <td><?php echo $batch->location; ?></td>
                                                                <td>
                                                                    <smal><i class="fa fa-info pop-hover" data-title="Detail" data-content="<?php echo $batch->batch_detail; ?>" data-original-title="" title="" aria-hidden="true"></i></smal>
                                                                </td>
                                                                <td style="text-align: center;">

                                                                    <?php
                                                                    $query = "SELECT COUNT(DISTINCT facilitator_id) as total FROM training_batch_sessions WHERE facilitator_id != '0' AND batch_id='" . $batch->batch_id . "'";
                                                                    echo $this->db->query($query)->row()->total;
                                                                    ?>

                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <?php
                                                                    $query = "SELECT COUNT(*) as total FROM training_nominations WHERE batch_id='" . $batch->batch_id . "'";
                                                                    echo $this->db->query($query)->row()->total;
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($batch->status == 2) { ?>
                                                                        <a href="<?php echo site_url(ADMIN_DIR . "trainings/batch_restore/" . $training->training_id . "/" . $batch->batch_id); ?>" onclick="return confirm('Are you sure? you want to remove')"><i class="fa fa-undo" aria-hidden="true"></i></a>
                                                                    <?php } ?>
                                                                    <?php if ($batch->status == 1) { ?>
                                                                        <button style="padding: 1px;" onclick="get_batch_edit_form(<?php echo $batch->batch_id; ?>)" class="btn btn-link btn-sm">Edit</button>
                                                                        <span style="margin: 2px;"></span>
                                                                        <a style="padding: 1px;" href="<?php echo site_url(ADMIN_DIR . "trainings/training_batch/" . $training->training_id . "/" . $batch->batch_id); ?>" class="btn btn-link btn-sm">Manage</a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>


                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <div style="text-align: center;">
                                                    <button onclick="get_batch_add_form()" class="btn btn-primary">Create New Batch For Training</button>
                                                </div>
                                                <script>
                                                    function get_batch_edit_form(batch_id) {
                                                        $('#modal').html('Please Wait .....');
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo site_url(ADMIN_DIR . "/trainings/get_batch_edit_form"); ?>",
                                                            data: {
                                                                training_id: '<?php echo $training->training_id; ?>',
                                                                batch_id: batch_id

                                                            }
                                                        }).done(function(data) {
                                                            $('#g_modal_body').html(data);
                                                        });

                                                        $('#g_modal').modal('show');
                                                    }

                                                    function get_batch_add_form() {
                                                        $('#modal').html('Please Wait .....');
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo site_url(ADMIN_DIR . "/trainings/get_batch_add_form"); ?>",
                                                            data: {
                                                                training_id: '<?php echo $training->training_id; ?>'
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
                            </div>
                            <hr class="margin-bottom-0">
                            <!-- /TAB 1 -->
                        </div>
                        <div class="tab-pane fade <?php if ($this->input->get('tab') == 'nomination') { ?> active in<?php } ?>" id="box_tab2">
                            <div class="col-md-12">
                                <div class="box border blue" id="messenger">
                                    <div class="box-title">
                                        <h4><i class="fa fa-users"></i>Facilitators</h4>
                                    </div>
                                    <div class="box-body">

                                        <div class="table-responsive">

                                            <table class="table" style="font-size: 11px;">
                                                <thead>
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>S.No</th>
                                                            <th>Name</th>
                                                            <th>Father Name</th>
                                                            <th>Gender</th>
                                                            <th>CNIC</th>
                                                            <th>Designation</th>
                                                            <th>District</th>
                                                            <th>Qualification</th>
                                                            <th>Mobile No.</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT users.*, training_nominations.nomination_type, 
                                                    training_nominations.id  FROM training_nominations 
                                                    INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                                    AND training_nominations.nomination_type = 'Facilitator'
                                                    WHERE training_nominations.training_id = " . $training->training_id;
                                                    $nominations = $this->db->query($query)->result();
                                                    $count = 1;
                                                    foreach ($nominations as $nomination) : ?>


                                                        <tr>
                                                            <td> <a href="<?php echo site_url(ADMIN_DIR . "trainings/remove_nomination/" . $training->training_id . "/" . $nomination->id); ?>" onclick="return confirm('Are you sure? you want to remove')">
                                                                    <i class="fa fa-times" aria-hidden="true"></i></a>
                                                            </td>
                                                            <td><?php echo $count++; ?></td>
                                                            <td><?php echo $nomination->name; ?></td>
                                                            <td><?php echo $nomination->father_name; ?></td>
                                                            <td><?php echo $nomination->gender; ?></td>
                                                            <td><?php echo $nomination->cnic; ?></td>
                                                            <td><?php echo $nomination->designation; ?></td>
                                                            <td><?php echo $nomination->district; ?></td>
                                                            <td><?php echo $nomination->qualification; ?></td>
                                                            <td><?php echo $nomination->user_mobile_number; ?></td>
                                                            <td><button class="btn btn-link btn-sm" onclick="edit_nomination_profile(<?php echo $nomination->user_id ?>)">Edit</button></td>
                                                        </tr>


                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                            <div style="text-align: center;">
                                                <button onclick="add_nomination_form('resource_person');" class="btn btn-primary btn-sm"> Add New Facilitator</button>
                                            </div>


                                        </div>


                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box border blue" id="messenger">
                                    <div class="box-title">
                                        <h4><i class="fa fa-users"></i>Trainees</h4>
                                    </div>
                                    <div class="box-body">

                                        <div class="table-responsive">

                                            <table class="table" style="font-size: 11px;">
                                                <thead>
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>S.No</th>
                                                            <th>Name</th>
                                                            <th>Father Name</th>
                                                            <th>Gender</th>
                                                            <th>CNIC</th>
                                                            <th>Designation</th>
                                                            <th>District</th>
                                                            <th>Qualification</th>
                                                            <th>Mobile No.</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = "SELECT users.*, training_nominations.nomination_type, 
                                                    training_nominations.id  FROM training_nominations 
                                                    INNER JOIN users ON(users.user_id = training_nominations.user_id)
                                                    AND training_nominations.nomination_type = 'Trainee'
                                                    WHERE training_nominations.training_id = " . $training->training_id;
                                                    $nominations = $this->db->query($query)->result();
                                                    $count = 1;
                                                    foreach ($nominations as $nomination) : ?>


                                                        <tr>
                                                            <td> <a href="<?php echo site_url(ADMIN_DIR . "trainings/remove_nomination/" . $training->training_id . "/" . $nomination->id); ?>" onclick="return confirm('Are you sure? you want to remove')">
                                                                    <i class="fa fa-times" aria-hidden="true"></i></a>
                                                            </td>
                                                            <td><?php echo $count++; ?></td>
                                                            <td><?php echo $nomination->name; ?></td>
                                                            <td><?php echo $nomination->father_name; ?></td>
                                                            <td><?php echo $nomination->gender; ?></td>
                                                            <td><?php echo $nomination->cnic; ?></td>
                                                            <td><?php echo $nomination->designation; ?></td>
                                                            <td><?php echo $nomination->district; ?></td>
                                                            <td><?php echo $nomination->qualification; ?></td>
                                                            <td><?php echo $nomination->user_mobile_number; ?></td>
                                                            <td><button class="btn btn-link btn-sm" onclick="edit_nomination_profile(<?php echo $nomination->user_id ?>)">Edit</button></td>
                                                        </tr>


                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <div style="text-align: center;">
                                                <button onclick="add_nomination_form('trainee');" class="btn btn-primary btn-sm"> Add New Trainee</button>

                                            </div>



                                        </div>


                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /BOX -->
    </div>


</div>

<script>
    function edit_nomination_profile(user_id) {
        $('#modal').html('Please Wait .....');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(ADMIN_DIR . "/trainings/edit_nomination_profile"); ?>",
            data: {
                user_id: user_id,
                training_id: '<?php echo $training->training_id; ?>'
            }
        }).done(function(data) {
            $('#g_modal_body').html(data);
        });

        $('#g_modal').modal('show');
    }

    function add_nomination_form(nomination_type) {
        $('#modal').html('Please Wait .....');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(ADMIN_DIR . "/trainings/add_nomination_form"); ?>",
            data: {
                nomination_type: nomination_type,
                training_id: '<?php echo $training->training_id; ?>'
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