<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2 style="display:inline;">
      <?php echo @$title; ?>
    </h2>
    <small><?php echo @$description; ?></small>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url($this->session->userdata('role_homepage_uri')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('user'); ?>"><?php echo @$title; ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo @$title; ?> form</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <?php echo validation_errors(); ?>
          <div class="col-md-offset-1 col-md-9">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('user/update_user_record/'); ?><?php echo $userId; ?>">
              <div class="box-body">
                <?php if ($this->session->userdata('role_id') == 15 || $this->session->userdata('role_id') == 16) : ?>
                  <?php $school_user_edit_field = 'disabled'; ?>
                <?php else : ?>
                  <?php $school_user_edit_field = ''; ?>
                <?php endif; ?>
                <?php if ($this->session->userdata('role_id') != 15 && $this->session->userdata('role_id') != 16) : ?>




                <?php endif; ?>
                <div class="form-group">
                  <?php $address = set_value('address') == false ? $userInfo->address : set_value('address'); ?>
                  <label for="address" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" <?php echo $school_user_edit_field; ?> class="form-control" name="address" value="<?php echo $address; ?>" id="address" placeholder="Address">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                  <?php $userTitle = set_value('userTitle') == false ? $userInfo->userTitle : set_value('userTitle'); ?>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="userTitle" value="<?php echo $userTitle; ?>" id="name" placeholder="Name" readonly>
                  </div>
                </div>
                <?php $user_title = set_value('user_title') == false ? $userInfo->user_title : set_value('user_title'); ?>
                <div class="form-group">
                  <label for="user_title" class="col-sm-2 control-label">User-name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="user_title" value="<?php echo $user_title; ?>" id="user_title" placeholder="User-name">
                  </div>
                </div>
                <?php $userPassword = set_value('userPassword') == false ? $userInfo->userPassword : set_value('userPassword'); ?>
                <div class="form-group">
                  <label for="userPassword" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="text" name="userPassword" class="form-control" id="userPassword" value="<?php echo trim($userPassword); ?> ">
                  </div>
                </div>
                <?php $contactNumber = set_value('contactNumber') == false ? $userInfo->contactNumber : set_value('contactNumber'); ?>
                <div class="form-group">
                  <label for="contactNumber" class="col-sm-2 control-label">Contact Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="contactNumber" value="<?php echo $contactNumber; ?>" id="contactNumber" placeholder="Contact Number" readonly>
                  </div>
                </div>
                <?php $userEmail = set_value('userEmail') == false ? $userInfo->userEmail : set_value('userEmail'); ?>
                <div class="form-group">
                  <label for="userEmail" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="userEmail" value="<?php echo $userEmail; ?>" id="userEmail" placeholder="Email" readonly>
                  </div>
                </div>
                <?php $cnic = set_value('cnic') == false ? $userInfo->cnic : set_value('cnic'); ?>
                <div class="form-group">
                  <label for="cnic" class="col-sm-2 control-label">CNIC</label>
                  <div class="col-sm-10">
                    <input type="text" <?php echo $school_user_edit_field; ?> class="form-control" name="cnic" value="<?php echo $cnic; ?>" id="cnic" placeholder="CNIC" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="gender" class="col-sm-2 control-label">Gender</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="gender" id="gender">
                      <option>Select Gender</option>
                      <?php $gender_id = set_value('gender') == false ? $userInfo->gender : set_value('gender'); ?>
                      <?php foreach ($gender as $gen) : ?>
                        <?php if ($userInfo->gender !=  $gen->genderId) : ?>
                          <option value="<?php echo $gen->genderId; ?>"><?php echo $gen->genderTitle; ?></option>
                        <?php else : ?>
                          <option value="<?php echo $gen->genderId; ?>" selected><?php echo $gen->genderTitle; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>

                    </select>
                  </div>
                </div>

                <!-- radio for status -->
                <?php if ($this->session->userdata('role_id') != 15 && $this->session->userdata('role_id') != 16) : ?>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">User status</label>
                    <div class="col-sm-10">
                      <label>
                        <input type="radio" name="userStatus" value="1" class="flat-red" <?php if ($userInfo->userStatus == 1) {
                                                                                            echo "checked";
                                                                                          } ?>> Active
                      </label>
                      <br>
                      <label>
                        <input type="radio" name="userStatus" value="0" class="flat-red" <?php if ($userInfo->userStatus == 0) {
                                                                                            echo "checked";
                                                                                          } ?>> In-Active
                      </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="img" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                      <input type="file" name="file" id="img">
                      <p class="help-block">Profile picture is optional if not provided, the default avator will be set.</p>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="form-group">
                  <div class="col-md-offset-2 col-sm-offset-2">
                    <button type="submit" style="margin-left:15px;" class="btn btn-primary btn-flat">Update user</button>
                  </div>
                </div>

            </form>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <!-- Footer -->
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->