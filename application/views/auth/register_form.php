<body class="login-body">
	
	<div class="login-header text-center">
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
			<div class="form-group has-feedback lg left-feedback no-label">
				<select name="user-level" class="form-control no-border input-lg rounded" tabindex="2">
					<option value="" disabled selected>Role</option>
					<option value="1">Super Administrator</option>
					<option value="2">Administrator</option>
					<option value="3">Manager</option>
					<option value="4">Operator</option>
				</select>
			  	<span class="fa fa-cogs form-control-feedback"></span>
			</div>
			<div class="form-group">
				<button type="submit" name="register" class="btn btn-info-login btn-lg btn-perspective btn-block"><i class="fa fa-edit"></i> REGISTER</button>
			</div>
		</form>
	</div>