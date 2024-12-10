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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR . "trainings/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
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
                <h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>

            </div>
            <?php
            $user_id = $this->session->userdata('userId');
            $query = "SELECT users.user_id, departments.department_id 
                FROM users 
                INNER JOIN departments ON(departments.department_id = users.department_id)
                WHERE users.user_id = $user_id
                AND role_id = 5";
            $focal_person = $this->db->query($query)->row();
            if ($focal_person) { ?>
                <div class="box-body">

                    <?php
                    $add_form_attr = array("class" => "form-horizontal");
                    echo form_open_multipart(ADMIN_DIR . "trainings/save_data", $add_form_attr);
                    ?>
                    <?php $user_id = $this->session->userdata('userId');
                    $query = "SELECT users.user_id, departments.department_id
FROM users 
INNER JOIN departments ON(departments.department_id = users.department_id)
WHERE users.user_id = $user_id
AND role_id = 5";
                    $department = $this->db->query($query)->row();
                    ?>

                    <input type="hidden" value="<?php echo $department->department_id; ?>" name="department_id" />


                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('title'), "title", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "title",
                                "id"            =>  "title",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('title'),
                                "value"         =>  set_value("title"),
                                "placeholder"   =>  $this->lang->line('title')
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("title", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('level'), "level", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "level",
                                "id"            =>  "level",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('level'),
                                "value"         =>  set_value("level"),
                                "placeholder"   =>  'Provincial, District etc'
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("level", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('category'), "category", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "category",
                                "id"            =>  "category",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('category'),
                                "value"         =>  set_value("category"),
                                "placeholder"   =>  'Management, IT, Paramedics, Nursing etc'
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("category", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('sub_category'), "sub_category", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "sub_category",
                                "id"            =>  "sub_category",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('sub_category'),
                                "value"         =>  set_value("sub_category"),
                                "placeholder"   =>  'Capacity Building, Mandatory Training Promotion etc'
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("sub_category", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('type'), "type", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "type",
                                "id"            =>  "type",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('type'),
                                "value"         =>  set_value("type"),
                                "placeholder"   =>  'Training, Workshop'
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("type", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('training_for'), "training_for", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "training_for",
                                "id"            =>  "training_for",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required",
                                "title"         =>  $this->lang->line('training_for'),
                                "value"         =>  set_value("training_for"),
                                "placeholder"   =>  'Cadre'
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("training_for", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('location'), "location", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $text = array(
                                "type"          =>  "text",
                                "name"          =>  "location",
                                "id"            =>  "location",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required",
                                "title"         =>  $this->lang->line('location'),
                                "value"         =>  set_value("location"),
                                "placeholder"   =>  $this->lang->line('location')
                            );
                            echo  form_input($text);
                            ?>
                            <?php echo form_error("location", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('start_date'), "start_date", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $date = array(
                                "type"          =>  "date",
                                "name"          =>  "start_date",
                                "id"            =>  "start_date",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('start_date'),
                                "value"         =>  set_value("start_date"),
                                "placeholder"   =>  $this->lang->line('start_date')
                            );
                            echo  form_input($date);
                            ?>
                            <?php echo form_error("start_date", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('end_date'), "end_date", $label);      ?>

                        <div class="col-md-8">
                            <?php

                            $date = array(
                                "type"          =>  "date",
                                "name"          =>  "end_date",
                                "id"            =>  "end_date",
                                "class"         =>  "form-control",
                                "style"         =>  "", "required"      => "required", "title"         =>  $this->lang->line('end_date'),
                                "value"         =>  set_value("end_date"),
                                "placeholder"   =>  $this->lang->line('end_date')
                            );
                            echo  form_input($date);
                            ?>
                            <?php echo form_error("end_date", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>



                    </div>

                    <div class="form-group">

                        <?php
                        $label = array(
                            "class" => "col-md-2 control-label",
                            "style" => "",
                        );
                        echo form_label($this->lang->line('detail'), "detail", $label);
                        ?>

                        <div class="col-md-8">
                            <?php

                            $textarea = array(
                                "name"          =>  "detail",
                                "id"            =>  "detail",
                                "class"         =>  "form-control",
                                "style"         =>  "",
                                "title"         =>  $this->lang->line('detail'), "required"      => "required",
                                "rows"          =>  "",
                                "cols"          =>  "",
                                "value"         => set_value("detail"),
                                "placeholder"   =>  $this->lang->line('detail')
                            );
                            echo form_textarea($textarea);
                            ?>
                            <?php echo form_error("detail", "<p class=\"text-danger\">", "</p>"); ?>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="sponsored_by" class="col-md-2 control-label" style="">Sponsored By</label>
                        <div class="col-md-8">
                            <input type="text" name="sponsored_by" value="" id="sponsored_by" class="form-control" style="" required="required" title="Sponsored By" placeholder="Sponsored By">
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="organized_by" class="col-md-2 control-label" style="">Organize By</label>
                        <div class="col-md-8">
                            <input type="text" name="organized_by" value="" id="organized_by" class="form-control" style="" required="required" title="Organize By" placeholder="Organize By">
                        </div>
                    </div>

                    <div class="col-md-offset-2 col-md-10">
                        <?php
                        $submit = array(
                            "type"  =>  "submit",
                            "name"  =>  "submit",
                            "value" =>  $this->lang->line('Save'),
                            "class" =>  "btn btn-primary",
                            "style" =>  ""
                        );
                        echo form_submit($submit);
                        ?>



                        <?php
                        $reset = array(
                            "type"  =>  "reset",
                            "name"  =>  "reset",
                            "value" =>  $this->lang->line('Reset'),
                            "class" =>  "btn btn-default",
                            "style" =>  ""
                        );
                        echo form_reset($reset);
                        ?>
                    </div>
                    <div style="clear:both;"></div>

                    <?php echo form_close(); ?>

                </div>
            <?php } else { ?>
                <div class="box-body">
                    <div class="alert alert-danger">
                        Only Department Focal Person can add and update trainings.
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- /MESSENGER -->
</div>