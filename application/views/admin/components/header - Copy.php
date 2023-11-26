<!DOCTYPE html>
<html lang="en" dir="<?php echo $this->lang->line('direction'); ?>" />

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title><?php echo $system_global_settings[0]->system_title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "css/cloud-admin.css"); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "css/themes/default.css"); ?>" id="skin-switcher" />
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "css/responsive.css"); ?>" />

  <!-- STYLESHEETS -->
  <!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->



  <!-- ANIMATE -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "css/animatecss/animate.min.css"); ?>" />

  <!-- date picker-->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "js/bootstrap-datepicker/css/bootstrap-datepicker.css"); ?>" />

  <!-- JQUERY -->
  <script src="<?php echo site_url("assets/" . ADMIN_DIR . "js/jquery/jquery-2.0.3.min.js"); ?>"></script>

  <!-- BOOTSTRAP -->
  <script src="<?php echo site_url("assets/" . ADMIN_DIR . "bootstrap-dist/js/bootstrap.min.js"); ?>"></script>

  <!-- GRITTER -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "js/gritter/css/jquery.gritter.css"); ?>" />
  <!-- FONTS -->
  <link href='<?php echo site_url("assets/" . ADMIN_DIR . "css/fonts.css"); ?>' rel='stylesheet' type='text/css' />

  <!-- jstree resources -->
  <script src="<?php echo site_url("assets/" . ADMIN_DIR . "jstree-dist/jstree.min.js"); ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "jstree-dist/themes/default/style.min.css"); ?>" />

  <!-- HUBSPOT MESSENGER -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "js/hubspot-messenger/css/messenger.min.css"); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "js/hubspot-messenger/css/messenger-theme-flat.min.css"); ?>" />
  <script type="text/javascript" src="<?php echo site_url("assets/" . ADMIN_DIR . "js/hubspot-messenger/js/messenger.min.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo site_url("assets/" . ADMIN_DIR . "js/hubspot-messenger/js/messenger-theme-flat.js"); ?>"></script>
  <!-- HUBSPOT MESSENGER -->
  <!-- SELECT2 -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/js/select2/select2.min.css" />
  <!-- TYPEAHEAD -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/js/typeahead/typeahead.css" />
  <!-- SELECT2 -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/js/select2/select2.min.css" />
  <!-- UNIFORM -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/js/uniform/css/uniform.default.min.css" />

  <!-- DATE PICKER -->
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/js/datepicker/themes/default.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/js/datepicker/themes/default.date.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/js/datepicker/themes/default.time.min.css" />



  <script src="<?php echo site_url("assets/" . ADMIN_DIR); ?>/horizontal_timeline/js/modernizr.js"></script><!-- Modernizr -->
  <!-- end time line -->
  <!-- Bootstrap core CSS -->
  <link href="<?php echo site_url("assets/" . ADMIN_DIR); ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar {
      background: none repeat scroll 0 0 #FFD700 !important;
    }

    .box.border.blue .box-title {
      color: #fff !important;
      background-color: #70afc4 !important;
      background-color: #000 !important;
      border-bottom: 1px solid #5ea5bd;
    }
  </style>

</head>

<body>



  <!--<link rel="stylesheet" type="text/css" href="<?php echo site_url("assets/" . ADMIN_DIR . "css/my_fucking_style.css"); ?>" />-->
  <header class="navbar clearfix" id="header">
    <div class="container">
      <div class="navbar-brand">

        <!-- COMPANY LOGO -->
        <a href="<?php echo site_url(ADMIN_DIR . $this->session->userdata("role_homepage_uri")); ?>">
          <img src="<?php echo site_url("assets/uploads/" . $system_global_settings[0]->sytem_admin_logo); ?>" alt="<?php echo $system_global_settings[0]->system_title ?>" title="<?php echo $system_global_settings[0]->system_title ?>" class="img-responsive " style="width:100px !important;"></a>
        <!-- /COMPANY LOGO -->
        <!-- TEAM STATUS FOR MOBILE -->
        <div class="visible-xs "> <a href="#" class="team-status-toggle switcher btn dropdown-toggle"> <i class="fa fa-users"></i> </a> </div>
        <!-- /TEAM STATUS FOR MOBILE -->
        <!-- SIDEBAR COLLAPSE -->
        <div id="sidebar-collapse" class="sidebar-collapse btn"> <i class="fa fa-bars" data-icon1="fa fa-bars" data-icon2="fa fa-bars"></i> </div>
        <!-- /SIDEBAR COLLAPSE -->
      </div>
      <div class="nav navbar-nav pull-left">
        <!--<h3 style="color:white;"><?php echo $row['site_name']; ?></h3>-->
        <!--<h5 style="color:white;">Government Of Khyber Pakhtunkhwa</h5>-->
      </div>

      <!-- BEGIN TOP NAVIGATION MENU -->
      <ul class="nav navbar-nav pull-right">
        <!-- <h3 style="color:white; float:right; display:block;"><?php //echo $system_global_settings[0]->system_title 
                                                                  ?></h3>
      <br>-->



        <li style="float:right;" class="dropdown user" id="header-user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img alt="" src="<?php echo site_url("assets/uploads/" . $this->session->userdata("user_image")); ?>" /> <span class="username"><?php echo $this->session->userdata("user_title"); ?></span> <i class="fa fa-angle-down"></i> </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url(ADMIN_DIR . "users/update_profile"); ?>"><i class="fa fa-user"></i> Update Profile</a></li>
            <!--<li><a href="#"><i class="fa fa-cog"></i> Account Settings</a></li>
          <li><a href="#"><i class="fa fa-eye"></i> Privacy Settings</a></li>-->
            <li><a href="<?php echo site_url(ADMIN_DIR . "login/logout"); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>

          </ul>

        </li>



        <!-- END USER LOGIN DROPDOWN -->
      </ul>
      <!-- END TOP NAVIGATION MENU -->
    </div>
  </header>
  <!--/HEADER -->

  <!-- PAGE -->
  <section id="page">



    <?php


    $this->load->view(ADMIN_DIR . "components/nav.php"); ?>
    <div id="main-content" <?php if ($this->router->fetch_class() == 'orders' or $this->router->fetch_class() == 'riders') { ?> class="margin-left-50" <?php } ?>>
      <div class="container">
        <div class="row">
          <div id="content" class="col-lg-12">
            <?php
            if ($this->session->flashdata("msg") || $this->session->flashdata("msg_error") || $this->session->flashdata("msg_success")) {

              $type = "";
              if ($this->session->flashdata("msg_success")) {
                $type = "success";
                $msg = $this->session->flashdata("msg_success");
              } elseif ($this->session->flashdata("msg_error")) {
                $type = "error";
                $msg = $this->session->flashdata("msg_error");
              } else {
                $type = "info";
                $msg = $this->session->flashdata("msg");
              }
            ?>
              <script type="text/javascript">
                $(document).ready(function() {
                  //Set theme
                  Messenger.options = {
                    extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
                    theme: "flat"
                  }
                  Messenger().post({
                    message: '<?php echo $msg; ?>',
                    type: '<?php echo $type; ?>',
                    showCloseButton: true
                  })
                })
              </script>
            <?php }  ?>