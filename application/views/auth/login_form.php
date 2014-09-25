<body class="background-image">

	<!-- <div class="login-header text-center">
		<i class="fa fa-line-chart"></i> <strong>MIS</strong> IRC
	</div> -->
	<!-- <div class="login-wrapper">
		<form role="form" action="<?php echo base_url('auth/login') ?>" method="POST">
			<div class="form-group has-feedback lg left-feedback no-label">
				<input type="text" name="login" class="form-control no-border input-lg rounded" placeholder="Username" autofocus="">
				<span class="fa fa-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback lg left-feedback no-label">
				<input type="password" name="password" class="form-control no-border input-lg rounded" placeholder="Password">
				<span class="fa fa-unlock-alt form-control-feedback"></span>
			</div>
			<div class="form-group">
				<div class="checkbox">
					<label class="login-label">
						<input type="checkbox" name="remember" value="1" class="i-grey-flat" /><ins class="iCheck-helper"></ins> Remember me
					</label>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-info-login btn-lg btn-perspective btn-block"><i class="fa fa-sign-in"></i> LOGIN</button>
			</div>
		</form>
	</div> -->

	<div class="container">
		<div class="col-sm-8 col-sm-offset-2 login-container">
			<div class="col-sm-6 background-login-header">
				<div class="text-center">
					<i class="fa fa-line-chart"></i>&nbsp;&nbsp;IRC<br/>
					<strong>Media Information System</strong> 
				</div>
			</div>
			<div class="col-sm-6">
				<h1 class="text-center">Log In</h1>
				<hr/>
				<?php echo form_open($this->uri->uri_string()); ?>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group has-feedback left-feedback no-label">
							  <input type="text" name="login" class="form-control" placeholder="Username" tabindex="1" autofocus="">
							  <span class="fa fa-user form-control-feedback"></span>
							</div>
							<div class="form-group has-feedback left-feedback no-label">
							  <input type="password" name="password" class="form-control" placeholder="Password" tabindex="2">
							  <span class="fa fa-lock form-control-feedback"></span>
							</div>
							<div class="form-group">
							  <div class="checkbox">
								<label class="login-label">
									<input type="checkbox" name="remember" value="1" class="i-grey-flat" tabindex="3" /><ins class="iCheck-helper"></ins> Remember me
								</label>
							  </div>
							</div>
						</div>
					</div>
					<button type="submit" name="submit" class="btn btn-info-login btn-lg btn-perspective btn-block" tabindex="4"><i class="fa fa-sign-in"></i> Let me in</button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	

<?php 
// print_r($errors);
?>