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
					<h1 class="page-heading">USER MANAGEMENTS&nbsp;&nbsp;<small>Controling User Permission</small></h1>
					<!-- End page heading -->
					
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="index.html"><i class="fa fa-home"></i></a></li>
						<li><a href="#fakelink">User Management</a></li>
						<li class="active">Users</li>
					</ol>
					<!-- End breadcrumb -->
					
					<?php echo $msg;?>
					
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">

						<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;Add Data</button>
						<br/><br/>

						<div class="table-responsive">
						<table class="table table-striped table-hover" id="datatable-example">
							<thead class="the-box dark full">
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Username</th>
									<th>Email</th>
									<th>Last Login</th>
									<th></th>									
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 0;
								foreach($users as $u) { ?>
								<tr class="gradeA">
									<td><?php echo ++$no; ?></td>
									<td><?php echo $u->name; ?></td>
									<td><?php echo $u->username; ?></td>
									<td><?php echo $u->email; ?></td>
									<td><?php echo $u->last_login; ?></td>
									<td class="text-right">
										<button class="btn btn-primary btn-circle btn-outline" type="button"><i class="fa fa-lock"></i></button>
										<button class="btn btn-success btn-circle btn-outline" type="button"><i class="fa fa-eye"></i></button>
										<button class="btn btn-warning btn-circle btn-outline" type="button"><i class="fa fa-edit"></i></button>
										<button class="btn btn-danger btn-circle btn-outline" type="button"><i class="fa fa-times"></i></button>
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
		
		<script type="text/javascript">
		$(document).ready(function(){			
			$(".tooltip-examples button").tooltip(); 
			window.setTimeout(function() { $(".alert").alert('close'); }, 5000);
		});
		</script>
		
		
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->


		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">User Registered</h4>
					</div>
					<form role="form" action="<?php echo base_url('auth/register') ?>" method="post">
						<div class="modal-body">																			
							<div class="form-group">
								<label>Full name</label>
								<input type="text" name="personname" class="form-control has-feedback" autofocus />
								<!-- <span class="fa fa-male form-control-feedback"></span> -->				
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="username" name="username" class="form-control has-feedback">
								<!-- <span class="fa fa-user form-control-feedback"></span> -->								
							</div>
							<div class="form-group">
								<label>Email address</label>
								<input type="email" name="email" class="form-control has-feedback">
								<!-- <span class="fa fa-envelope form-control-feedback"></span> -->
							</div>							
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control has-feedback">
								<!-- <span class="fa fa-lock form-control-feedback"></span> -->
							</div>
							<div class="form-group">
								<label>Retype Password</label>
								<input type="password" name="confirm_password" class="form-control has-feedback">
								<!-- <span class="fa fa-unlock form-control-feedback"></span> -->
							</div>
							<div class="form-group">
								<label>Permission</label>
								<select name="user-level" class="form-control" tabindex="2">
									<option value="" disabled selected>Choosen Role</option>
									<option value="1">Super Administrator</option>
									<option value="2">Administrator</option>
									<option value="3">Manager</option>
									<option value="4">Operator</option>									
								</select>
								<!-- <span class="fa fa-cogs form-control-feedback"></span> -->
							</div>							
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" class="i-grey-flat"> I've read and agree with <a href="#fakelink">Term and condition</a>
									</label>
								</div>
							</div>				  						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="register" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>