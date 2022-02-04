<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{
?>
		<form method="post" action="<?= base_url() ?>MasterAdmin/do_Adds?tipe=Hotels" class="form-auth-large" >
<?php
	}
	else
	{
		?>
		<form method="post" action="<?= base_url() ?>dothat/s?tipe=Hotels" class="form-auth-large" >
		<?php
	}
?>

	<!-- TABLE STRIPED -->
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Add Hotel</h3>
		</div>
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
					<table>
						<tr>
							<td width="130px">Nama Hotel</td>
							<td><input type="text" name="NewHotel" class="form-control"></td>
						</tr>
					</table>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary btn-sm">Save <i class="fa fa-check"></i></button>
				</div>
				</div>
		</div>
		</div>
		<!-- END TABLE STRIPED -->
	</div>

</form>
</div>