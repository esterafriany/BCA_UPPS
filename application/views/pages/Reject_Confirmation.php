<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==4 OR $RoleID==1 OR $RoleID==3)
	{
	$UserID = $this->session->userdata['logged_in']['UserID'];
?>

		<form  action="<?= base_url() ?>MasterAdmin/reject_status" method="post">
<?php } else { ?>
		<form  action="<?= base_url() ?>go_Adds">
		<?php
	}
?>
    <?php
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
    }?>
<div class="panel">
<div class="panel-heading">
    <h3 class="panel-title">REJECT PEMESANAN</h3>
</div>
<div class="panel-body">
<table align="center" style="border-collapse: collapse;" class="table table-hover">
	<?php foreach($Info_Pemesanan as $pemesanan){ ?>
		<tr>
			<th width="25%">Nama Program</th>
			<th width="2%">:</th>
			<th><?php echo $pemesanan->ProgramName; ?></th>

		</tr>
		<tr>
			<th>Tanggal Mulai</th>
			<th>:</th>
			<th><?php echo $pemesanan->ProgramMulai; ?></th>
		</tr>
		<tr>
			<th>Tanggal Selesai</th>
			<th>:</th>
			<th><?php echo $pemesanan->ProgramSelesai; ?></th>
		</tr>
		<tr>
			<th>PIC</th>
			<th>:</th>
			<th><?php echo $pemesanan->PICProgram; ?></th>
		</tr>
		<tr>
			<th>Note</th>
			<th>:</th>
			<th><?php echo $pemesanan->ProgramName; ?></th>
		</tr>

		<?php } ?>

		<tr>
			<th>Tanggal Buat</th>
			<th>:</th>
			<th><?php echo date("d-M-Y");?></th>
		</tr>

		<tr>
			<th>Checker's Note</th>
			<th>:</th>
			<th><textarea type="text" rows="3" name="checkers_note" class="form-control" required></textarea></th>
		</tr>
		<tr>
			<th colspan=3></th>
		</tr>
				<input type="hidden" name="tipe" value="<?php echo $tipe;?>">
				<input type="hidden" name="id_pesan" value="<?php echo $id_pesan; ?>">
				<input type="hidden" name="status_id" value="<?php echo $status_id; ?>">
				<input type="hidden" name="user_id" value="<?php echo $UserID; ?>">
				<input type="hidden" name="tgl_buat" value="<?php echo date("d-m-Y"); ?>">
				<input type="hidden" name="id_user_koor" value="<?php echo $pemesanan->UserID; ?>">
</table>
</div>

<div class="panel-footer">
	<!--<a class="btn btn-primary" onclick="return confirm('Yakin ingin update status?')" type="submit" href="<?php echo base_url(); ?>MasterAdmin/reject_status?tipe=Class&id_pemesanan=<?=$id_pesan; ?>&status=<?=$status;?>">Submit</a>	-->
	<button class="btn btn-primary" onclick="return confirm('Yakin ingin update status?')" type="submit">Submit <i class="fa fa-check"></i></button>
</div>

</div>
</form>
