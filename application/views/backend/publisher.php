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
					<h1 class="page-heading">PUBLISHER&nbsp;&nbsp;<small>manage the entrie publisher data</small></h1>
					<!-- End page heading -->
					
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="index.html"><i class="fa fa-home"></i></a></li>
						<li><a href="#fakelink">Data Management</a></li>
						<li class="active">Publisher</li>
					</ol>
					<!-- End breadcrumb -->					
					
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						
						<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;Add Data</button>
						<br/><br/>
						
						<?php echo $this->session->flashdata('msg'); ?>
						
						<div class="table-responsive">
						<table class="table table-striped table-hover" id="datatable-example">
							<thead class="the-box dark full">
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Media Type</th>
									<th>Created</th>									
									<th></th>									
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 0;
								foreach($publisher as $u) { ?>
								<tr class="gradeA">
									<td><?php echo ++$no; ?></td>
									<td><?php echo $u->publisher_name; ?></td>
									<td><?php echo $u->media_type; ?></td>
									<td><?php echo $this->mith_func->time_elapsed_string($u->created); ?></td>									
									<td class="text-right">
										<div class="btn-group">
											<button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
												<i class="fa fa-cogs"></i>
											</button>
											<ul class="dropdown-menu pull-right" role="menu">												
												<li><a href="#" class="edit-row" data-id="<?php echo $u->publisher_id; ?>">Edit Data</a></li>
												<li><a href="#" class="delete-row" data-id="<?php echo $u->publisher_id; ?>">Delete Data</a></li>										
											</ul>
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
		
		<script type="text/javascript">
			$('.edit-row').click(function(e) {
				$.ajax({
					type: 'POST',
					dataType : 'json',
					url: '<?php echo base_url('/backend/publisher/get'); ?>',
					data: 'id=' + $(this).data('id'),
					success: function(response) {
						console.log(response);								
						$('input[id=edit_id]').val(response.publisher_id);
						$('input[name=name]').val(response.publisher_name);					
						$('select[name=media_type]').val(response.media_type);
						
						$('#myModal form').attr('action', '<?php echo base_url('/backend/publisher/edit') ?>'); //this fails silently
						$('#myModal form').get(0).setAttribute('action', '<?php echo base_url('/backend/publisher/edit') ?>'); //this works
						
						$('#myModal').modal('show');
					}
				})
			});			
			$('.delete-row').click(function(e) {
				$('input[id=deleted_id]').val($(this).data('id'));
				$('#delete').modal('show');
			});
		</script>


		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Publisher Registered</h4>
					</div>
					<form role="form" action="<?php echo base_url('backend/publisher/add') ?>" method="post">
						<div class="modal-body">																			
							<div class="form-group">
								<label>Publiher</label>
								<input type="text" name="name" class="form-control has-feedback" autofocus required />
								<!-- <span class="fa fa-male form-control-feedback"></span> -->				
							</div>
							<div class="form-group">
								<label>Media Type</label>
								<select name="media_type" class="form-control" tabindex="2" required >
									<option value="" disabled selected>Choosen Media Type</option>
									<!-- choosen -->
									<?php 
										foreach($media_type as $v) {											
											echo '<option value="'.$v.'">'.$v.'</option>';
										} 
									?>
								</select>
								<!-- <span class="fa fa-cogs form-control-feedback"></span> -->
							</div>														  						
						</div>
						<div class="modal-footer">
							<input type="hidden" id="edit_id" name="id" value="" />
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="register" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="delete" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Delete Publisher</h4>
					</div>
					<form action="<?php echo base_url('/backend/publisher/delete'); ?>" method="post">
						<div class="modal-body">
							<p>Are you sure you want to delete this data?</p>
							<input type="hidden" name="id" id="deleted_id" value="" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" >Delete</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->