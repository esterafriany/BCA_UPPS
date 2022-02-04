<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{
?>
		<form method="post" action="<?= base_url() ?>MasterAdmin/do_changePass">
<?php
	}
	else
	{
		?>
		<form method="post" action="<?= base_url() ?>Koor/do_changePass">
		<?php
	}
?> 

<div class="panel">
	<div class="panel-heading" style="padding-bottom:0px;">CHANGE PASSWORD</div>
	<div class="panel-body">
	<div class="vertical-align-middle">
		<?php
		if (isset($message_display)) { ?>
		
		<div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		   <?php echo $message_display; ?>
		</div>
		
		<?php }?>
		<div class="panel panel-default">
		<div class="panel-body">
		<table align="center" style="border-collapse: collapse;" class="table table-stripped">
			<tr style="background: #ccccff"> 
			<tr>
				<td>Current Password:</td>
				<td>
					<?php
						$ID = ($this->session->userdata['logged_in']['UserID']);
						$passwords = ($this->session->userdata['logged_in']['password']);
					?>
					<input type="hidden" name="True" value="<?=  $passwords ?>">
					<input type="hidden" name="SelectedID" value="<?=  $ID ?>">
					<input type="Password" name="CurrentPassword" class="form-control">
				</td>
			</tr>
			<tr>
				<td>New Password:</td>
				<td>
					<input type="Password" name="NewPassword" class="form-control">
				</td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td>
					<input type="Password" name="ConfirmPassword" class="form-control">
				</td>
			</tr>
		</table>
		
		</div>
		
		<div class="panel-footer">
			<button type="submit" class="btn btn-primary">Save <i class="fa fa-check"></i></button>
			<button type="reset" class="btn btn-primary">Reset <i class="fa fa-arrow-circle-left"></i></button>
		</div>
		</div>
		
        </div>
</div>
</div>
</form>
