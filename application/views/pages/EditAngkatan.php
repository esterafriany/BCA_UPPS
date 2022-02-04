<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{
?>
		<form method="post" action="<?= base_url() ?>MasterAdmin/do_edits">
<?php
	}
	else
	{
		?>
		<form method="post" action="<?= base_url() ?>do_edits">
		<?php
	}
?>
<div class="panel">
	<div class="panel-heading" style="padding-bottom:0px;">EDIT ANGKATAN</div>
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
				<?php foreach ($Views as $View) {?>
					<tr>
						<td>Angkatan Name</td>
						<td><input type="text" name="newName" value="<?=$View['NamaAngkatan'];?>" class="form-control"></td>
					</tr>
					
					<tr>
						<td width="200px">Tanggal Mulai Program</td>
						<td><input type="date" name="TanggalMulai" value=<?=$View['ProgramMulai'];?> class="form-control"></td>
					</tr>
					
					<tr>
						<td>Tanggal Akhir Program</td>
						<td><input type="date" name="TanggalSelesai" value=<?=$View['ProgramSelesai'];?> class="form-control"></td>
					</tr>
					<input type="hidden" name="selectedID" value=<?= $View['AngkatanID']?>>
					<input type="hidden" name="prgID" value=<?= $View['ProgramID']?>>
					<input type="hidden" name="tipe" value="Angkatan">
						
					</tr>
				
				<?php } ?>
			</table>
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-primary">Save Changes <i class="fa fa-check"></i></button>
				<button type="" class="btn btn-primary">Back <i class="fa fa-arrow-circle-left"></i></button>
			</div>
		</div>
	</div>
</div>
</div>
</form>
</div>