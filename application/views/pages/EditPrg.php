<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{
?>
		<form method="post" action="<?= base_url() ?>MasterAdmin/do_Edits">
<?php
	}
	else
	{
		?>
		<form method="post" action="<?= base_url() ?>do_edits">
		<?php
	}
?>

<!-- TABLE STRIPED -->
<div class="panel">
<div class="panel-heading">
    <h3 class="panel-title">Edit Program</h3>
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
					<td width="130px">Nama Program</td>
					<td>
						<?php foreach ($Programs as $program)
							{
								?>
								<input type="hidden" name="tipe" value="Program">
								<input type="hidden" name="selectedID" value=<?= $program['ProgramID']?>>
								<td><input type="text" name="NewPrg" value="<?php echo $program['ProgramName']?>" class="form-control"></td>
								<?php 
							}
						?>
					</td>
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


</form>
</div>