<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>CRM Sense</title>
		<meta name="description" content="" />
		<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="<?php echo base_url(); ?>webroot/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="<?php echo base_url(); ?>webroot/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>webroot/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>webroot/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />

	</head>
	<!--
		.boxed = boxed version
	-->
	<body>


		<div class="padding-15">

			<div class="login-box">
			<div id="msg_div">
					<?php echo $this->session->flashdata('message');?>				
				</div>	

				<!-- login form -->
				<form method="post" class="sky-form boxed">
					<header><i class="fa fa-users"></i> Sign In</header>
					<fieldset>	
					
						<section>
							<label class="label">E-mail</label>
							<label class="input">
								<i class="icon-append fa fa-envelope"></i>
								<input type="email" name="user_email" id="user_email">
								<span class="tooltip tooltip-top-right">Email Address</span>
							</label>
						</section>
						
						<section>
							<label class="label">Password</label>
							<label class="input">
								<i class="icon-append fa fa-lock"></i>
								<input type="password" name="user_password" id="user_password">
								<b class="tooltip tooltip-top-right">Type your Password</b>
							</label>
							<label class="checkbox"><input type="checkbox" name="checkbox-inline" checked><i></i>Keep me logged in</label>
						</section>

					</fieldset>

					<footer>
						<button type="submit" name="login" value="Login" class="btn btn-primary pull-right">Sign In</button>
						<div class="forgot-password pull-left">
							<a href="page-password.html">Forgot password?</a> <br />
							<a href="page-register.html"><b>Need to Register?</b></a>
						</div>
					</footer>
				</form>
				<!-- /login form -->

				<hr />

				<div class="text-center">
					Or sign in using:
				</div>

<!-- 
				<div class="socials margin-top-10 text-center"> --><!-- more buttons: ui-buttons.html --><!-- 
					<a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
					<a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
				</div> -->

			</div>

		</div>

		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '<?php echo base_url(); ?>webroot/plugins/';</script>
		<script type="text/javascript" src="<?php echo base_url(); ?>webroot/plugins/jquery/jquery-2.2.3.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>webroot/js/app.js"></script>
	</body>
</html>