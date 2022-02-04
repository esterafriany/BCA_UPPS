<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	$namadepan = ($this->session->userdata['logged_in']['namadepan']);
?>
<div style="padding-right: 5cm; color: blue">
<input type="hidden" name="tipe" value="Classes">

</div>
<?php
if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}?>

<div class="panel">
<div class="panel-heading">
    <h3 class="panel-title">REKAP SHUTTLE BUS</h3>
</div>
<div class="panel-body">

<?php if(isset($msg)){ ?>
<div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <?php echo $msg; ?>
</div>
<?php } ?>

<form method="post" action="<?= base_url() ?>MasterAdmin/exportRecap_excel?tipe=Shuttle">
	<table align="right" width="60%" border=0>
		<tr align="right">
			<td>Date&nbsp;&nbsp;</td>
			<td><input type="date" name="date_from"	class="form-control"> </td>
			<td>to&nbsp;&nbsp;</td>
			<td><input type="date" name="date_to" class="form-control"></td>
			<td>&nbsp;&nbsp;</td>
			<td width="20px"><input type="submit" class="btn btn-success" value="Download Rekap" class="form-control"></td>
		</tr>
	</table>
</form>
<form method="post" action="<?= base_url() ?>Koor/update_pemesanan_content?Content=Hotels">
<br/><br/>

<table id="bootstrap-table" align="center" style="border-collapse: collapse;font-size: 13px;" class="table table-bordered table-hover" >
	<thead>
		<tr align="center">
			<th width="5%">No.</th>
			<th>Program - Angkatan</th>
			<th>Tanggal Program</th>
			<th>Tanggal Awal Pemesanan</th>
			<th>PIC</th>
			<th>Jumlah Penumpang</th>
			<th>Lampiran</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<?php
		$num = 0;
		$UserID = $this->session->userdata['logged_in']['UserID'];
		foreach($Rekap_ShuttleBus as $bus)
		{
			if($RoleID == 2){
				if($UserID == $bus->UserID){
				$num = $num + 1; ?>
					<tr>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->nama_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_program_mulai;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_awal_pemesanan;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->pic_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->JumlahPenumpang;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
						<?php
							 $files = glob('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/*');
							 if (is_dir('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/'))
							 {
								 $DirectoryIterator = new FilesystemIterator('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/');
							 }
							 else
							 {
								$DirectoryIterator=null;
							 }

							if (null!=$DirectoryIterator)
							{
								$DirectoryCount = iterator_count($DirectoryIterator);
							}
							else
							{
								$DirectoryCount = 0;
							}
							for ($i=0; $i < $DirectoryCount; $i++)
							{
								$namaFile =str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i]);
								?>
								<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
									<a href="<?=base_url()?>download
									?className=<?=$bus->name?>&Angkatan=<?=$bus->angkatan?>/Shuttle_F/<?=str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i])?>"
									class="lnr lnr-download"><?=$namaFile?>
									</a>
									<?php
									if($this->input->get("id_pemesanan")==null)
									{
										?>
										<a href="<?= base_url() ?>Koor/remove_file?file=Shuttle_F&filename=<?=$namaFile?>&id_pemesanan=<?=$bus->id_pemesanan;?>&NP=<?=$bus->name;?>&AK=<?=$bus->angkatan;?>&go=ALL" style="cursor: pointer; color: red;">&times;</a>
										<?php	
									}
									else
									{
										?>
										<a href="<?= base_url() ?>Koor/remove_file?file=Shuttle_F&filename=<?=$namaFile?>&id_pemesanan=<?=$bus->id_pemesanan;?>&NP=<?=$bus->name;?>&AK=<?=$bus->angkatan;?>" style="cursor: pointer; color: red;">&times;</a>
										<?php
									}
									?>
									
								</button>
							<?php
							}
							?>
						</td>

						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($bus->status_shuttle != NULL){echo $bus->status_shuttle;?>&nbsp;  <?php } ?>
						</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
							<?php if ($RoleID==2)
							{ ?>
								<a href="<?php echo base_url(); ?>Koor/view_Detail?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan;  ?>"><i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i></a>
								<a id="btnPlaceOrder" name="btnPlaceOrder" href="<?php echo base_url(); ?>MasterAdmin/export_excel?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan; ?>"><i class="btn btn-default fa fa-download" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i></a>
								<?php
							}
							else {
								?>
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Detail?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan;  ?>"><i class="lnr lnr-magnifier"></i></a>
								<a href=""><i class=" fa fa-file-excel-o"></i></a>
								<?php
								}
								?>
						</td>
					</tr>
				<?php
				}
			}else if($RoleID == 4){
				$num = $num + 1; ?>
				<tr>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->nama_program;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_program_mulai;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_awal_pemesanan;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->pic_program;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->JumlahPenumpang;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
						<?php
							 $files = glob('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/*');
							 if (is_dir('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/'))
							 {
								 $DirectoryIterator = new FilesystemIterator('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/');
							 }
							 else
							 {
								$DirectoryIterator=null;
							 }

							if (null!=$DirectoryIterator)
							{
								$DirectoryCount = iterator_count($DirectoryIterator);
							}
							else
							{
								$DirectoryCount = 0;
							}
							for ($i=0; $i < $DirectoryCount; $i++)
							{
								$namaFile =str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i]);
								?>
								<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
									<a href="<?=base_url()?>download
									?className=<?=$bus->name?>&Angkatan=<?=$bus->angkatan?>/Shuttle_F/<?=str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i])?>"
									class="lnr lnr-download"><?=str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i])?>
									</a>
									
								</button>
							<?php
							}
							?>
					</td>

					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
						<?php if($bus->status_shuttle != NULL){echo $bus->status_shuttle;?>&nbsp;  <?php } ?>
					</td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
						<a href="<?php echo base_url(); ?>Koor/view_Detail?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan;  ?>">
							<i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i>
						</a>
						<?php if($bus->status_shuttle != NULL && ($bus->status_shuttle == 'booked' || $bus->status_shuttle  == 'rejected')){ ?>
							<a onclick="return confirm('Tidak dapat approve !')">
								<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
							</a>
							<a>
								<i class="btn btn-default fa fa-times-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
							</a>
						<?php }else if($bus->status_shuttle  != NULL && $bus->status_shuttle == 'approved') { ?>
							<a onclick="return confirm('Tidak dapat approve !')">
								<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
							</a>
							<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>"><i class="btn btn-default fa fa-times-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i></a>

						<?php }else {?>
							<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
								<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
							</a>

							<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
								<i class="btn btn-default fa fa-times-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
							</a>

						<?php }?>
					</td>
				</tr>
			<?php } else if($RoleID == 1){
				$num = $num + 1;?>
				<tr>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->nama_program;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_program_mulai;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_awal_pemesanan;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->pic_program;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->JumlahPenumpang;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
						<?php
							 $files = glob('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/*');
							 if (is_dir('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/'))
							 {
								 $DirectoryIterator = new FilesystemIterator('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/');
							 }
							 else
							 {
								$DirectoryIterator=null;
							 }

							if (null!=$DirectoryIterator)
							{
								$DirectoryCount = iterator_count($DirectoryIterator);
							}
							else
							{
								$DirectoryCount = 0;
							}
							for ($i=0; $i < $DirectoryCount; $i++)
							{
								$namaFile =str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i]);
								?>
								<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
									<a href="<?=base_url()?>download
									?className=<?=$bus->name?>&Angkatan=<?=$bus->angkatan?>/Shuttle_F/<?=str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i])?>"
									class="lnr lnr-download"><?=str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i])?>
									</a>
									<?php
									if($this->input->get("id_pemesanan")==null)
									{
										?>
										<a href="<?= base_url() ?>Koor/remove_file?file=Shuttle_F&filename=<?=$namaFile?>&id_pemesanan=<?=$bus->id_pemesanan;?>&NP=<?=$bus->name;?>&AK=<?=$bus->angkatan;?>&go=ALL" style="cursor: pointer; color: red;">&times;</a>
										<?php	
									}
									else
									{
										?>
										<a href="<?= base_url() ?>Koor/remove_file?file=Shuttle_F&filename=<?=$namaFile?>&id_pemesanan=<?=$bus->id_pemesanan;?>&NP=<?=$bus->name;?>&AK=<?=$bus->angkatan;?>" style="cursor: pointer; color: red;">&times;</a>
										<?php
									}
									?>
								</button>
							<?php
							}
							?>
						</td>

					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
						<?php if($bus->status_shuttle != NULL){echo $bus->status_shuttle;?>&nbsp;  <?php } ?>
					</td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
						<a href="<?php echo base_url(); ?>Koor/view_Detail?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan;  ?>"><i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i>
						</a>

						<a id="btnPlaceOrder" name="btnPlaceOrder" href="<?php echo base_url(); ?>MasterAdmin/export_excel?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan; ?>"><i class="btn btn-default fa fa-download" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i></a>

						<!-- fungsi checker-->
						<?php if($bus->status_shuttle != NULL && ($bus->status_shuttle == 'booked' || $bus->status_shuttle  == 'rejected')){ ?>
							<a onclick="return confirm('Tidak dapat approve !')">
								<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
							</a>
							<a>
								<i class="btn btn-default fa fa-times-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
							</a>
						<?php }else if($bus->status_shuttle  != NULL && $bus->status_shuttle == 'approved' || $bus->status_shuttle = 'Pending') { ?>
							<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
								<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
							</a>
							<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>"><i class="btn btn-default fa fa-times-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i></a>

						<?php }else {?>
							<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
								<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
							</a>

							<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
								<i class="btn btn-default fa fa-times-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
							</a>

						<?php }?>
					</td>
				</tr>

			<?php } if($RoleID == 3){
				$num = $num + 1;?>
				<tr>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->nama_program;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_program_mulai;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->tanggal_awal_pemesanan;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->pic_program;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $bus->JumlahPenumpang;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
						<?php
							 $files = glob('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/*');
							 if (is_dir('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/'))
							 {
								 $DirectoryIterator = new FilesystemIterator('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/');
							 }
							 else
							 {
								$DirectoryIterator=null;
							 }

							if (null!=$DirectoryIterator)
							{
								$DirectoryCount = iterator_count($DirectoryIterator);
							}
							else
							{
								$DirectoryCount = 0;
							}
							for ($i=0; $i < $DirectoryCount; $i++)
							{
								$namaFile =str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i]);
								?>
								<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
									<a href="<?=base_url()?>download
									?className=<?=$bus->name?>&Angkatan=<?=$bus->angkatan?>/Shuttle_F/<?=str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i])?>"
									class="lnr lnr-download"><?=str_replace('./uploads/'.$bus->name.'/'.$bus->angkatan.'/Shuttle_F/','',$files[$i])?>
									</a>
								</button>
							<?php
							}
							?>
						</td>

					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
						<?php if($bus->status_shuttle != NULL){echo $bus->status_shuttle;?>&nbsp;  <?php } ?>
					</td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
						<a href="<?php echo base_url(); ?>Koor/view_Detail?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan;  ?>"><i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i></a>
						<a id="btnPlaceOrder" name="btnPlaceOrder" href="<?php echo base_url(); ?>MasterAdmin/export_excel?tipe=Shuttle&id_pemesanan=<?=$bus->id_pemesanan; ?>"><i class="btn btn-default fa fa-download" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i></a>

						<!-- fungsi checker-->
							&nbsp;
							<?php if($bus->status_shuttle != NULL && ($bus->status_shuttle  == 'booked' || $bus->status_shuttle  == 'rejected') || $bus->status_shuttle == 'Pending') { ?>
								<a onclick="return confirm('Tidak dapat approve !')">
									<i class="btn btn-default fa fa-check-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:grey;" disabled></i>
								</a>
							<?php }else{ ?>
								<a onclick="return confirm('Booked ?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=ShuttleBus&id_pemesanan=<?=$bus->id_pemesanan; ?>&status=<?=$bus->status_shuttle;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
									<i class="btn btn-default fa fa-check-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
								</a>

							<?php }?>
					</td>
				</tr>

			<?php } ?>
		<?php
		}
		?>

</table>
<?php
if ($RoleID==2 OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
{
if($this->input->get("id_pemesanan")!=null)
		{
?>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myFiles">New Attachments&nbsp;<i class="fa fa-paperclip"></i></button>
<?php
		}
}
?>
</form>


</div>
</div>
<div class="modal fade" id="myFiles" role="dialog">
	<div class="modal-dialog">
	<?php
	if(isset($_SESSION["JumlahFile"]))
	{
	$nextFile= $_SESSION["JumlahFile"]+1;
	}
	else
	{
	$_SESSION["JumlahFile"]=0;
	$nextFile= 1;
	}
	 ?>
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Attach File</h4>
			</div>
	<form method="post" action="<?= base_url() ?>Koor/additional_files?Program=<?=$bus->name?>&angkatan=<?=$bus->angkatan?>&folder=Shuttle_F&ID=<?=$this->input->get("id_pemesanan")?>" enctype="multipart/form-data">
			<div class="modal-body">
		<table>
			<tr>
				<input type="File" name="userfile<?=$nextFile?>" class="form-control">
			</tr>
		</table>

		<font style="text-align:right;">
			<h6>
				<input type="hidden" id="Filenumber" name="JumlahFile" value=<?=$_SESSION["JumlahFile"]+1?> />
				<a href="add-new-files" onclick="incrementFileNumber();" class="btn btn-primary btn-sm">
				<i class="fa fa-plus"></i>
				</a>
			</h6>
		</font>

	</div>


 <div class="modal-footer">
 <input type="hidden" name="Refreshes" value="Refresh">
	<button type="submit" name="Class_Button" class="btn btn-primary btn-m" >Submit <i class=" fa fa-check"></i></button
	 </div>
 </form>
	 </div>
		</div>

	</div>
	<div class="hidden">
	        	<div class="Files-Content">
	        	<tr>
	        	<input type="File" name="userfile" class="form-control">
	        	</tr>
	        	</div>
	</div>
	<script type="text/javascript">
	function addRow(tableID) {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		if(rowCount < 5){							// limit the user from creating fields more than your limits
			var row = table.insertRow(rowCount);
			var colCount = table.rows[0].cells.length;
			for(var i=0; i<colCount; i++) {
				var newcell = row.insertCell(i);
				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			}
		}
		else
		{
			 alert("Maximum Input is 5.");
		}
	}

	function deleteRow(tableID)
	{
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		if (rowCount > 1)
		{
			var i = rowCount-1;
			table.deleteRow(i);
		}
		else
		{
			alert("Minimum Input Reached (1).");
		}
	}
	$(function ()
	{
	    var FileDuplicates = <?php Print($_SESSION["JumlahFile"]+1); ?>;
	        $OriginalFile = $('.Files-Content').clone(true);
	    function DuplicateFiles ()
	    {
	        var newFile;

	        FileDuplicates++;
	        newFile = $OriginalFile.clone(true).insertBefore($('h6'));
	        $.each($('input', newFile), function(i, item)
	        {
	            $(item).attr('name', $(item).attr('name') + FileDuplicates);
	        });
	    }
	    $('a[href="add-new-row"]').on('click', function (e)
	    {
	        e.preventDefault();
	        addRow('dataTable');
	    });
	    $('a[href="delete-row"]').on('click', function (e)
	    {
	        e.preventDefault();
	        deleteRow('dataTable')
	    });
	    $('a[href="add-new-files"]').on('click', function (e)
	    {
	        e.preventDefault();
	        DuplicateFiles();
	    });

	});

	function myFunction()
	{
	    var button = document.getElementById('clickButton');
	    button.click();
	}

	function incrementValue()
		{
			var value = document.getElementById('number').value
		    value = isNaN(value) ? 0 : value;
		    value++;
		    document.getElementById('number').value = value;
		    value=value;
		}
	function subtractionValue()
		{
			var value = document.getElementById('number').value
		    // var value = parseInt(document.getElementById('number').value, 10);
		    value = isNaN(value) ? 0 : value;
		    value--;
		    document.getElementById('number').value = value;
		    value=value;
		}
	function incrementFileNumber()
		{
			var value = document.getElementById('Filenumber').value
		    value = isNaN(value) ? 0 : value;
		    value++;
		    document.getElementById('Filenumber').value = value;
		    value=value;
		}
	</script>
