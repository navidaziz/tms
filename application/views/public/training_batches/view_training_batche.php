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
				<a href="<?php echo site_url("training_batches/view/"); ?>">Training Batches</a>
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
					  <?php foreach($training_batches as $training_batche): ?>
                         
                         
            <tr>
                <th><?php echo $this->lang->line('batch_title'); ?></th>
                <td>
                    <?php echo $training_batche->batch_title; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('batch_detail'); ?></th>
                <td>
                    <?php echo $training_batche->batch_detail; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('title'); ?></th>
                <td>
                    <?php echo $training_batche->title; ?>
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
