<body class="login-body">

	<div class="login-header text-center">
		<!-- <img src="<?php echo base_url('assets/img/logo-login.png') ?>" class="logo" alt="Logo"> -->
		<i class="fa fa-line-chart"></i> <strong>MIS</strong> IRC
	</div>
		<!-- <div class="alert alert-warning alert-bold-border fade in alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <strong>Warning!</strong> Better check yourself, you're <a href="#fakelink" class="alert-link">not looking too good</a>.
		</div> -->
	<div class="login-wrapper">
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
				  <input type="checkbox" class="i-grey-flat" /><ins class="iCheck-helper"></ins> Remember me
				</label>
			  </div>
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-info-login btn-lg btn-perspective btn-block"><i class="fa fa-sign-in"></i> LOGIN</button>
			</div>
		</form>
		<p class="text-center"><strong><a class="login-label" href="<?php echo base_url('auth/forgot_password') ?>">Forgot your password?</a></strong></p>
	</div>