<!-- PAGE HEADER-->

<div class="row">
  <div class="col-sm-12">
    <div class="page-header"> 
      <!-- STYLER --> 
      
      <!-- /STYLER --> 
      <!-- BREADCRUMBS -->
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo site_url($this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a> </li>
        <li><?php echo $title; ?></li>
      </ul>
      <!-- /BREADCRUMBS -->
      <div class="row">
        <div class="col-md-6">
          <div class="clearfix">
            <h3 class="content-title pull-left">
              <?php //echo $department_name; ?>
            </h3>
          </div>
          <div class="description">Training Dashboard</div>
        </div>
        <div class="col-md-6">
          <div class="pull-right"> <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "dashboard"); ?>"><i class="fa fa-plus"></i> Dashboard</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /PAGE HEADER --> 

<!-- PAGE MAIN CONTENT -->
<div class="row"> 
  <!-- MESSENGER -->
  <div class="col-md-12">
    <div class="box border blue" id="messenger">
      <div class="box-title">
        <h4> <i class="fa fa-list"></i> <?php echo $title; ?> </h4>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table" style="font-size: 12px;">
            <thead>
              <tr>
                <th></th>
                <th>S.No.</th>
                <th>t_title</th>
                <th>department_id</th>
                <th>total_participants</th>
                <th>Trainee</th>
                <th>Facilitator</th>
                <th>male</th>
                <th>female</th>
                <th><?php echo $this->lang->line('Action'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
                            $count = 1;
                            if ($trainings) {
                                foreach ($trainings as $training) : ?>
              <tr>
                <td><a onclick="return confirm('Are you sure? you want to remove')" class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "trainings/trash/" . $training->training_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a></td>
                <td><?php echo $count++; ?></td>
                <td><?php echo $training->t_title; ?></td>
                <td><?php echo $training->department_id; ?></td>
                <td><?php echo $training->total_participants; ?></td>
                <td><?php echo $training->Trainee; ?></td>
                <td><?php echo $training->Facilitator; ?></td>
                <td><?php echo $training->male; ?></td>
                <td><?php echo $training->female; ?></td>
                <td><a class="btn btn-sm btn-danger" href="<?php echo site_url(ADMIN_DIR . "trainings/edit/" . $training->training_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a> <span style="margin-left: 5px;"></span></td>
              </tr>
              <?php endforeach;
                            } else { ?>
              <tr>
                <td colspan="7"><p style="color: red; text-align:center">No training added yet.</p></td>
              </tr>
              <?php  }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /MESSENGER --> 
</div>
