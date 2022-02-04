<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{
?>
		<form method="post" action="<?= base_url() ?>MasterAdmin/do_Adds?tipe=Angkatan" class="form-auth-large" >
<?php
	}
	else
	{
		?>
		<form method="post" action="<?= base_url() ?>dothat/do_Adds?tipe=Angkatan" class="form-auth-large" >
		<?php
	}
?>
<div class="panel">
	<div class="panel-heading" style="padding-bottom:0px;">ADD ANGKATAN</div>
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
					<td>Nama Angkatan</td>
					<td><input type="text" name="newName" class="form-control"></td>
				</tr>
				<tr>
					<td width="190px">Tanggal Mulai Program</td>
					<td><input type="date" name="tanggalMulai" class="form-control"></td>
				</tr>
				<tr>
					<td>Tanggal Akhir Program</td>
					<td><input type="date" name="tanggalSelesai" class="form-control"></td>
				</tr>
					<?php 
					if($Views==NULL)
					{
						?>
						<input type="hidden" name="ProgramID" value=<?=$ID?>>
						<?php
					}
					else
					{
						foreach ($Views as $view) 
						{
							?>
							<input type="hidden" name="ProgramID" value=<?=$view['ProgramID']?>>
							<?php
							break;
						}
					}
					?>
			</table>
		<input type="hidden" name="tipe" value="Angkatan">
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-primary btn-sm">Save <i class="fa fa-check"></i></button>
			</div>
		</div>
	</div>
</div>
</div>

</form>
</div>