<!-- PAGE HEADER-->

<div class="row">
  <div class="col-sm-12">
    <div class="page-header"> 
      <!-- STYLER --> 
      
      <!-- /STYLER --> 
      <!-- BREADCRUMBS -->
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a> </li>
        <li> <i class="fa fa-table"></i> <a href="<?php echo site_url(ADMIN_DIR . "trainings/view/"); ?>"><?php echo $this->lang->line('Trainings'); ?></a> </li>
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
        <h4><i class="fa fa-info" aria-hidden="true"></i>Training Detail .. </h4>
      </div>
      <div class="box-body">
     
         <a href="<?php echo base_url("admin/trainings/view"); ?>" target="_blank" class="btn btn-success btn-sm">Back</a>
      
        <div class="tabbable header-tabs">
    
          <div class="tab-content">
              <!-- TAB 1 -->
              <div class="row">
                <div class="col-md-12">
                  <br />
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr>
                        <th>#</th>
                        <th>Question</th>
                      </tr>
                      <?php
                                            $query = "SELECT * FROM `remarks_view` where training_id = $training->training_id";
                                            $s_mcqs = $this->db->query($query)->result();
                                            $count = 1;
                                            foreach ($s_mcqs as $s_mcq) { ?>
                      <tr>
                        <td><?php echo $count++; ?></td>
                        <td ><?php echo $s_mcq->remarks; ?></td>
                       
                       
                      </tr>
                      <?php } ?>
                    </table>
                   
                     
                  </div>
                </div>
              </div>
              <hr class="margin-bottom-0">
              <!-- /TAB 1 --> 
            </div>
              <!-- TAB 1 -->
             
       
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
<script>
    <?php $table_title = "For Training " . $training->title . "(Code: " . $training->code . ") " . date('d-m-Y h:m:s'); ?>
    title = 'Nominated Trainees list ';
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