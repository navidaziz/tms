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
					<a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url(ADMIN_DIR."departments/view/"); ?>"><?php echo $this->lang->line('Departments'); ?></a>
			</li><li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
            <div class="row">
                        
                <div class="col-md-6">
                    <div class="clearfix">
					  <h3 class="content-title pull-left"><?php echo $title; ?></h3>
					</div>
					<div class="description">Add Department Detail and Focal Person</div>
                </div>
                
                <div class="col-md-6">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."departments/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."departments/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
			<h4><i class="fa fa-building-o"></i> <?php echo $title; ?></h4>
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

            <?php
                $add_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR."departments/save_data", $add_form_attr);
            ?>
            
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('department_name'), "department_name", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "department_name",
                        "id"            =>  "department_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('department_name'),
                        "value"         =>  set_value("department_name"),
                        "placeholder"   =>  $this->lang->line('department_name')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("department_name", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('address'), "address", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "address",
                        "id"            =>  "address",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('address'),
                        "value"         =>  set_value("address"),
                        "placeholder"   =>  $this->lang->line('address')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("address", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>



            <div class="col-md-12">
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-user"></i> Focal Person Detail</h4>
		</div>
        <div class="box-body">

          
           
            <div class="form-group">
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label('Role', "Role Id" , $label);
                ?>

                <div class="col-md-10">
                    <?php
                    echo form_dropdown("role_id", $roles, "", "class=\"form-control\" required style=\"\"");
                    ?>
                </div>
                <?php echo form_error("role_id", "<p class=\"text-danger\">", "</p>"); ?>
            </div>
            
            
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label('Focal Person Name', "user_title", $label);      ?>

                <div class="col-md-10">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_title",
                        "id"            =>  "user_title",
                        "class"         =>  "form-control",
                        "style"         =>  "",
                        "required"	  => "required",
                        "title"         =>  'Focal Person Name',
                        "value"         =>  set_value("user_title"),
                        "placeholder"   =>  'Focal Person Name'
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("user_title", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label('Focal Person Email Address', "user_email", $label);      ?>

                <div class="col-md-10">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_email",
                        "id"            =>  "user_email",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  'Focal Person Email Address',
                        "value"         =>  set_value("user_email"),
                        "placeholder"   =>  'Focal Person Email Address'
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("user_email", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label('Focal Person  Mobile Number', "user_mobile_number", $label);      ?>

                <div class="col-md-10">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_mobile_number",
                        "id"            =>  "user_mobile_number",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  'Focal Person  Mobile Number',
                        "value"         =>  set_value("user_mobile_number"),
                        "placeholder"   =>  'Focal Person  Mobile Number'
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("user_mobile_number", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label('Account User Name', "user_name", $label);      ?>

                <div class="col-md-10">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_name",
                        "id"            =>  "user_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  'Account User Name',
                        "value"         =>  set_value("user_name"),
                        "placeholder"   =>  'Account User Name'
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("user_name", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label('Account Password', "user_password", $label);      ?>

                <div class="col-md-10">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "user_password",
                        "id"            =>  "user_password",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  'Account Password',
                        "value"         =>  set_value("user_password"),
                        "placeholder"   =>  'Account Password'
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("user_password", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label('Profile Image', "user_image", $label);      ?>

                <div class="col-md-10">
                <?php
                    
                    $file = array(
                        "type"          =>  "file",
                        "name"          =>  "user_image",
                        "id"            =>  "user_image",
                        "class"         =>  "form-control",
                        "style"         =>  "",
                        "title"         =>  'Profile Image',
                        "value"         =>  set_value("user_image"),
                        "placeholder"   =>  'Profile Image'
                    );
                    echo  form_input($file);
                ?>
                <?php echo form_error("user_image", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            
            
        </div>
		
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
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>
