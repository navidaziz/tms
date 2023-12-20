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
                        <h3 class="content-ti tle pull-left">PSHA Training Dashboard</h3>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "trainings/add"); ?>"><i class="fa fa-plus"></i> Add New Training</a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR . "trainings/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
    <div class="col-md-12">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-list"></i> <?php echo $title; ?> Lists</h4>

            </div>
            <div class="box-body">

                <div class="table-responsive">

                    <table class="table" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>S.No.</th>
                                <th><?php echo $this->lang->line('code'); ?></th>
                                <th>Training Detail</th>
                                <th><?php echo $this->lang->line('start_date'); ?></th>
                                <th><?php echo $this->lang->line('end_date'); ?></th>
                                <th><?php echo $this->lang->line('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($trainings as $training) : ?>

                                <tr>
                                    <td><a onclick="return confirm('Are you sure? you want to remove')" class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR . "trainings/trash/" . $training->training_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a></td>
                                    <td><?php echo $count++; ?></td>
                                    <td>
                                        <?php echo $training->code; ?>
                                    </td>
                                    <td>
                                        <?php echo $training->title; ?>
                                        <br />
                                        <small>
                                            <i> #
                                                <?php echo $training->level; ?> /
                                                <?php echo $training->category; ?> /
                                                <?php echo $training->sub_category; ?> /
                                                <?php echo $training->type; ?> /
                                                <?php echo $training->training_for; ?>
                                                <br />
                                                <strong>
                                                    Location: <?php echo $training->location; ?>
                                                </strong>
                                            </i>
                                        </small>
                                    </td>

                                    <td>
                                        <?php echo date('D, j M Y', strtotime($training->start_date)); ?>
                                    </td>
                                    <td>
                                        <?php echo date('D, j M Y', strtotime($training->end_date)); ?>
                                    </td>


                                    <td>
                                        <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "trainings/edit/" . $training->training_id . "/" . $this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                        <span style="margin-left: 5px;"></span>
                                        <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "trainings/view_training/" . $training->training_id . "/" . $this->uri->segment(4) . "?tab=training"); ?>"><i class="fa fa-eye"></i> Manage</a>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php echo $pagination; ?>


                </div>


            </div>

        </div>
    </div>
    <!-- /MESSENGER -->
</div>