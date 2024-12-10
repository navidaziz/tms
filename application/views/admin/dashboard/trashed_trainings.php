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
				<a href="<?php echo site_url(ADMIN_DIR."trainings/view/"); ?>"><?php echo $this->lang->line('Trainings'); ?></a>
			</li><li><?php echo $title; ?></li>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."trainings/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."trainings/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
		</div><div class="box-body">
			
            <div class="table-responsive">
                
                    <table class="table table-table-bordered">
						<thead>
						  <tr>
							<th><?php echo $this->lang->line('code'); ?></th>
<th><?php echo $this->lang->line('title'); ?></th>
<th><?php echo $this->lang->line('level'); ?></th>
<th><?php echo $this->lang->line('category'); ?></th>
<th><?php echo $this->lang->line('sub_category'); ?></th>
<th><?php echo $this->lang->line('type'); ?></th>
<th><?php echo $this->lang->line('training_for'); ?></th>
<th><?php echo $this->lang->line('location'); ?></th>
<th><?php echo $this->lang->line('start_date'); ?></th>
<th><?php echo $this->lang->line('end_date'); ?></th>
<th><?php echo $this->lang->line('detail'); ?></th>
                            <th><?php echo $this->lang->line('Action'); ?></th>
						  </tr>
						</thead>
						<tbody>
					  <?php foreach($trainings as $training): ?>
                         <tr>
                            
                            
            <td>
                <?php echo $training->code; ?>
            </td>
            <td>
                <?php echo $training->title; ?>
            </td>
            <td>
                <?php echo $training->level; ?>
            </td>
            <td>
                <?php echo $training->category; ?>
            </td>
            <td>
                <?php echo $training->sub_category; ?>
            </td>
            <td>
                <?php echo $training->type; ?>
            </td>
            <td>
                <?php echo $training->training_for; ?>
            </td>
            <td>
                <?php echo $training->location; ?>
            </td>
            <td>
                <?php echo $training->start_date; ?>
            </td>
            <td>
                <?php echo $training->end_date; ?>
            </td>
            <td>
                <?php echo $training->detail; ?>
            </td>
                            
                            <td>
                                <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR."trainings/view_training/".$training->training_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-eye"></i> </a>
                                <a class="llink llink-restore" href="<?php echo site_url(ADMIN_DIR."trainings/restore/".$training->training_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-undo"></i></a>
                                <a class="llink llink-delete" href="<?php echo site_url(ADMIN_DIR."trainings/delete/".$training->training_id."/".$this->uri->segment(3)); ?>"><i class="fa fa-times"></i></a>
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
