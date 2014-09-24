<body class="login-body">
	<div class="background-image col-lg-12"></div>
	<div class="login-header text-center">
		<i class="fa fa-line-chart"></i> <strong>MIS</strong> IRC
	</div>
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
		<div class="the-box-login col-sm-4 col-sm-offset-4">
			<form role="form" action="<?php echo base_url('auth/login') ?>" method="POST">
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
				<button type="submit" name="submit" class="btn btn-info-login btn-lg btn-perspective btn-block" tabindex="4"><i class="fa fa-sign-in"></i> LOGIN</button>
			</form>
		</div>
	</div>

	

<?php 
// print_r($errors);
?>