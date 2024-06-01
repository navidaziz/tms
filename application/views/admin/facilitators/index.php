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

                <div class="col-md-6">
                    <div class="clearfix">
                        <h3 class="content-ti tle pull-left"><?php echo $title; ?></h3>
                    </div>

                    <div class="description"><?php echo $description; ?></div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <button onclick="add_nomination_form('resource_person');" class="btn btn-primary btn-sm"> Add New Facilitator</button>
                    </div>
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
                <h4><i class="fa fa-users"></i>Facilitators</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">

                    <table class="table" style="font-size: 11px;" id="d_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Gender</th>
                                <th>CNIC</th>
                                <th>User Name</th>
                                <th>Passowrd</th>
                                <th>Designation</th>
                                <th>District</th>
                                <th>Qualification</th>
                                <th>Mobile No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT users.* FROM users WHERE role_id = 3";
                            $nominations = $this->db->query($query)->result();
                            $count = 1;
                            foreach ($nominations as $nomination) : ?>


                                <tr>

                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $nomination->name; ?></td>
                                    <td><?php echo $nomination->father_name; ?></td>
                                    <td><?php echo $nomination->gender; ?></td>
                                    <td><?php echo $nomination->cnic; ?></td>
                                    <td><?php echo $nomination->user_name; ?></td>
                                    <td><?php echo $nomination->user_password; ?></td>
                                    <td><?php echo $nomination->designation; ?></td>
                                    <td><?php echo $nomination->district; ?></td>
                                    <td><?php echo $nomination->qualification; ?></td>
                                    <td><?php echo $nomination->user_mobile_number; ?></td>
                                    <td><button class="btn btn-link btn-sm" onclick="edit_nomination_profile(<?php echo $nomination->user_id ?>)">Edit</button></td>
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
    function edit_nomination_profile(user_id) {
        $('#modal').html('Please Wait .....');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(ADMIN_DIR . "facilitators/edit_facilitator_profile"); ?>",
            data: {
                user_id: user_id
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
            url: "<?php echo site_url(ADMIN_DIR . "facilitators/add_facilitator_form"); ?>",
            data: {
                nomination_type: nomination_type
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

<script>
    <?php $table_title = 'Facilitators List'; ?>
    title = 'Facilitators List';
    $(document).ready(function() {
        $('#d_table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            title: title,
            "order": [],
            "ordering": true,
            searching: true,
            buttons: [

                {
                    extend: 'print',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'excelHtml5',
                    title: title,
                    messageTop: '<?php echo $table_title; ?>'

                },
                {
                    extend: 'pdfHtml5',
                    title: title,
                    pageSize: 'A4',
                    orientation: 'landscape',
                    messageTop: '<?php echo $table_title; ?>'

                }
            ]
        });
    });
</script>