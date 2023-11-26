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
                <li><?php echo $title; ?></li>
            </ul>
            <!-- /BREADCRUMBS -->
            <div class="row">

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-title pull-left"><?php echo $title; ?></h3>
                    </div>
                    <div class="description"><?php echo $title; ?></div>
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

<!-- PAGE MAIN CONTENT -->
<div class="row">
    <!-- MESSENGER -->
    <div class="col-md-4">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
                <!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>-->
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <?php foreach ($trainings as $training) : ?>


                                <tr>
                                    <th><?php echo $this->lang->line('code'); ?></th>
                                    <td>
                                        <?php echo $training->code; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('title'); ?></th>
                                    <td>
                                        <?php echo $training->title; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('level'); ?></th>
                                    <td>
                                        <?php echo $training->level; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('category'); ?></th>
                                    <td>
                                        <?php echo $training->category; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('sub_category'); ?></th>
                                    <td>
                                        <?php echo $training->sub_category; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('type'); ?></th>
                                    <td>
                                        <?php echo $training->type; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('training_for'); ?></th>
                                    <td>
                                        <?php echo $training->training_for; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('location'); ?></th>
                                    <td>
                                        <?php echo $training->location; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('start_date'); ?></th>
                                    <td>
                                        <?php echo $training->start_date; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('end_date'); ?></th>
                                    <td>
                                        <?php echo $training->end_date; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('detail'); ?></th>
                                    <td>
                                        <?php echo $training->detail; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo $this->lang->line('Status'); ?></th>
                                    <td>
                                        <?php echo status($training->status); ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>




                </div>


            </div>

        </div>
    </div>
    <div class="col-md-8">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i>Training Batches</h4>
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM training_batches WHERE training_id = " . $trainings[0]->training_id;
                            $batches = $this->db->query($query)->result();


                            foreach ($batches as $batche) : ?>


                                <tr>
                                    <td><?php echo $batche->batch_title; ?></td>
                                    <td><?php echo $batche->batch_start_date; ?></td>
                                    <td><?php echo $batche->batch_end_date; ?></td>
                                    <td><?php echo $batche->location; ?></td>
                                    <td><?php echo $batche->batch_detail; ?></td>
                                    <td>
                                        <button onclick="get_batch_edit_form(<?php echo $batche->batch_id; ?>)" class="btn btn-link btn-sm">Edit</button>
                                        <a href="<?php echo site_url(ADMIN_DIR . "trainings/training_batch/" . $trainings[0]->training_id . "/" . $batche->batch_id); ?>" class="btn btn-link btn-sm">View Batch</a>
                                    </td>
                                </tr>


                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <button onclick="get_batch_edit_form()" class="btn btn-primary">Create New Batch For Training</button>
                    </div>
                    <script>
                        function get_batch_edit_form(batch_id) {
                            $('#modal').html('Please Wait .....');
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url(ADMIN_DIR . "/trainings/get_batch_edit_form"); ?>",
                                data: {
                                    training_id: '<?php echo $trainings[0]->training_id; ?>',
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
                                    training_id: '<?php echo $trainings[0]->training_id; ?>'
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
                <h4><i class="fa fa-bell"></i>Nominations</h4>
            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table">
                        <thead>

                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT users.*, training_nominations.nomination_type  FROM training_nominations 
                            INNER JOIN users ON(users.user_id = training_nominations.user_id)
                            WHERE training_nominations.training_id = " . $trainings[0]->training_id;
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




                </div>


            </div>

        </div>
    </div>
</div>

<script>
    function add_nomination_form(nomination_type) {
        $('#modal').html('Please Wait .....');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(ADMIN_DIR . "/trainings/add_nomination_form"); ?>",
            data: {
                nomination_type: nomination_type,
                training_id: '<?php echo $trainings[0]->training_id; ?>'
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