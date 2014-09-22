<style>
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 300;
	src: local('Open Sans Light'), local('OpenSans-Light'), url(//themes.googleusercontent.com/static/fonts/opensans/v9/DXI1ORHCpsQm3Vp6mXoaTXhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Open Sans'), local('OpenSans'), url(//themes.googleusercontent.com/static/fonts/opensans/v9/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
</style>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">				
			<h1 class="text-center login-title">NLP Monitoring Management</h1>
			<div class="account-wall">					
				<img class="profile-img" src="<?php echo base_url("assets/img/default.png"); ?>" alt="">
				<form class="form-signin" method="post" action="#">
					<input type="text" class="form-control" name="login" id="login" placeholder="Username" required autofocus>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">
						Sign in</button>
					<label class="checkbox pull-left">
						<input type="checkbox" value="remember-me" id="remember" name="remember" />
						Remember me
					</label>
					<a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
				</form>
			</div>
			<?php if ($this->config->item('allow_registration', 'tank_auth')) { # echo anchor('/auth/register/', 'Register'); ?>
			<a href="<?php echo base_url("auth/register/"); ?>" class="text-center new-account">Create an account </a>
			<?php } ?>
		</div>
	</div>
</div>
