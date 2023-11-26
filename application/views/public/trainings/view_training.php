<!-- PAGE HEADER-->
<div class="breadcrumb-box">
  <div class="container">
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url("Home"); ?>">Home</a>
					<span class="divider">/</span>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url("trainings/view/"); ?>">Trainings</a>
				<span class="divider">/</span>
			</li><li ><?php echo $title; ?> </li>
				</ul>
			</div>
		</div>
		<!-- .breadcrumb-box --><section id="main">
			  <header class="page-header">
				<div class="container">
				  <h1 class="title"><?php echo $title; ?></h1>
				</div>
			  </header>
			  <div class="container">
			  <div class="row">
			  <?php $this->load->view(PUBLIC_DIR."components/nav"); ?><div class="content span9 pull-right">
            <div class="table-responsive">
                
                    <table class="table">
						<thead>
						  
						</thead>
						<tbody>
					  <?php foreach($trainings as $training): ?>
                         
                         
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
                         
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      
                      

            </div>
			
			</div>
		</div>
	 </div>
  <!-- .container --> 
</section>
<!-- #main -->
