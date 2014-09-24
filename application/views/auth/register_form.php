<body class="login tooltips">
	
	<div class="login-header text-center">
		<!-- <img src="<?php echo base_url('assets/img/logo-login.png') ?>" class="logo" alt="Logo"> -->
		<i class="fa fa-line-chart"></i> <strong>MIS</strong> IRC
	</div>

	<div class="login-wrapper">
		<form role="form" action="<?php echo base_url('auth/register') ?>" method="POST">
			<div class="form-group has-feedback lg left-feedback no-label">
			  <input type="text" name="personname" class="form-control no-border input-lg rounded" placeholder="Full name" autofocus="">
			  <span class="fa fa-male form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback lg left-feedback no-label">
			  <input type="text" name="username" class="form-control no-border input-lg rounded" placeholder="Choose username">
			  <span class="fa fa-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback lg left-feedback no-label">
			  <input type="email" name="email" class="form-control no-border input-lg rounded" placeholder="Enter email">
			  <span class="fa fa-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback lg left-feedback no-label">
			  <input type="password" name="password" class="form-control no-border input-lg rounded" placeholder="Enter password">
			  <span class="fa fa-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback lg left-feedback no-label">
			  <input type="password" name="confirm_password" class="form-control no-border input-lg rounded" placeholder="re-enter password">
			  <span class="fa fa-unlock form-control-feedback"></span>
			</div>
			<!-- <div class="form-group has-feedback lg left-feedback no-label"> -->
			<div class="form-group has-feedback lg left-feedback">
				<label>Role</label>
				<select class="form-control no-border input-lg rounded" tabindex="2">
					<option value=""></option>
					<option value="1">Super admin</option>
					<option value="2">Admin</option>
					<option value="4">Guest</option>
					<!-- <option value="3">Afghanistan</option> -->
				</select>
			  	<span class="fa fa-edit form-control-feedback"></span>
			</div>
			<!-- <div class="form-group">
			  <div class="checkbox">
				<label class="inline-popups">
				  <div class="icheckbox_flat-yellow" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="i-yellow-flat" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> I accept <a href="#text-popup" data-effect="mfp-zoom-in">Terms and conditions</a>
				</label>
			  </div>
			</div> -->
			<div class="form-group">
				<button type="submit" name="register" class="btn btn-warning btn-lg btn-perspective btn-block">REGISTER</button>
			</div>
		</form>
	</div>