<?php 
if(isset($this->session->userdata['logged_in']))
{
	ob_start(); // ensures anything dumped out will be caught
	$url = base_url().'MasterAdmin/views/Home';
	// this can be set based on whatever
	while (ob_get_status())
		{
			ob_end_clean();
		}
		// no redirect
		header( "Location: $url" );
}	
?>
<!doctype html>
<html lang="en">
<?php   unset($_SESSION["jlh_notifikasi"]); ?>
<head>
  <title>Login | UUPS</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/vendor/icon-sets.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.min.css">
  <!-- GOOGLE FONTS -->
  <link href="<?php echo base_url(); ?>assets/css/GoogleFonts.css" rel="stylesheet">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon.png">
</head>

<body>
<div class="container">
		<div class="content">
			<div class="logo text-center" style="padding-top: 2cm"><img src="<?php echo base_url();?>assets/img/bca.png"></div>
<?php
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}
?>

<div id="main">
<div id="login">
<hr/>
<?php echo form_open('user_authentication/user_login_process'); ?>




<?php if (isset($error_message)) { ?>
<div class="alert alert-danger" role="alert" >
<?php echo $error_message; ?>
</div>
<?php } ?>

<?php if (isset($message_display)) { ?>
	<div class="alert alert-info"> <a href="#" class="close"></a>
   <?php echo $message_display; ?>
</div>
<?php }?>

	<table align="center">
	<td>
		<div class="panel panel-default">
		  <div class="panel-heading">Login</div>
		  <div class="panel-body">
			<form class="form-auth-small" action="<?php echo base_url() ?>">
			<div class="form-group">
				<label for="signup-email" class="control-label sr-only">Email</label>
				<input name="username" id="name" placeholder="Username" class="form-control" type="text">
			</div>
			<div class="form-group">
				<label for="signup-password" class="control-label sr-only">Password</label>
				<input name="password" id="password" placeholder="Password" class="form-control" type="password">
			</div>
		  </div>
		  <div class="panel-footer">
			<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
			</form>
		  </div>
		</div>
	</td>
		<tr>
			<td width="300">


		<?php
		?>
			</td>
		</tr>
	</table>

		</div>
	</div>
<?php echo form_close(); ?>
</div>
</div>


</body>
<footer>
	<div class="container-fluid">
		<p class="copyright">&copy; 2017. Designed &amp; Crafted by PTP</a></p>
	</div>
</footer>

</html>
