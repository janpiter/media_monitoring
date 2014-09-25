		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<div class="wrapper">
			
			<?php $this->load->view('backend/top-nav'); ?>
			<?php $this->load->view('backend/nav'); ?>
			
			<!-- BEGIN PAGE CONTENT -->
			<div class="page-content">
				<div class="container-fluid">
					<!-- Begin page heading -->
					<h1 class="page-heading">ACTIVITY LOG&nbsp;&nbsp;<small>Monitoring All User Activity</small></h1>
					<!-- End page heading -->
					
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="index.html"><i class="fa fa-home"></i></a></li>
						<li><a href="#fakelink">Activity Log</a></li>
						<li class="active">Log</li>
					</ol>
					<!-- End breadcrumb -->
					
					<?php 
						echo $this->session->flashdata('msg');						
					?>
					
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						
						<div class="table-responsive">
						<table class="table table-striped table-hover" id="datatable-example">
							<thead class="the-box dark full">
								<tr>
									<th>#</th>
									<th>Activity</th>
									<th>Detail</th>
									<th>Date</th>
									<th>Username</th>
									<th></th>									
								</tr>
							</thead>
							<tbody>
								<?php
		                            $no = 0;
		                            foreach ($objList as $obj) {
		                                ?>
		                                <tr class="gradeA">
		                                    <td><?php echo ++$no; ?></td>
		                                    <td><?php echo ucwords($obj->activity); ?></td>
		                                    <td><?php echo ucwords($obj->activity_detail); ?></td>
		                                    <td class="text-right"><?php echo $this->mith_func->time_elapsed_string($obj->created); ?></td>
		                                    <td><?php echo ucwords($obj->user_id); ?></td>
		                                    <td class="text-center">
		                                        <div class="btn-group">
		                                            <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown" title="Action Menu">
		                                                <i class="fa fa-cogs"></i>
		                                            </button>
		                                        </div>
		                                    </td>									
		                                </tr>
		                            <?php } ?>
							</tbody>
						</table>
						</div><!-- /.table-responsive -->
					</div><!-- /.the-box .default -->
					<!-- END DATA TABLE -->
				</div><!-- /.container-fluid -->				
			</div><!-- /.page-content -->
		</div><!-- /.wrapper -->
		<!-- END PAGE CONTENT -->
		
		
	
		<!-- BEGIN BACK TO TOP BUTTON -->
		<div id="back-top">
			<a href="#top"><i class="fa fa-chevron-up"></i></a>
		</div>
		<!-- END BACK TO TOP -->		
		
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->
		


		