<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{
?>

<?php
	}
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
    <h3 class="panel-title">REKAP BUS BANDARA</h3>
</div>
<div class="panel-body">

<form method="post" action="<?= base_url() ?>MasterAdmin/exportRecap_excel?tipe=Airport_Shuttle">
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
<br/><br/>

<table align="center" style="border-collapse: collapse;font-size: 13px;" class="table table-bordered table-hover" id="bootstrap-table">
		<thead>
		<tr align="center">
			<th width="5%">No.</th>
			<th>Program - Angkatan</th>
			<th>Tanggal Program</th>
			<th>Tanggal Awal Pemesanan</th>
			<th>PIC</th>
			<th>Lampiran</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<?php
			//$i = 1;
			$num = 0;
			$UserID = $this->session->userdata['logged_in']['UserID'];

			foreach($Rekap_AirportBus as $airport){
				if($RoleID == 2){
					if($UserID == $airport->UserID){
						$num = $num + 1;
						?>
						<tr>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;
							<?php 
								$d_num = date_create($airport->tanggal_awal_pemesanan);
								$d_now = date_create();
								$d_diff = date_diff($d_num,$d_now);
								$num_days = $d_diff->days;
								$sign_days = $d_diff->format("%R");
								
								if($sign_days == "-" && $airport->status_bus_bandara == "booked"){
									echo "background-color:green;color:white;";
								}else if($num_days == 7 && $sign_days == "-"){
									echo "";
								}else if($num_days == 5 && $sign_days == "-"){
									echo "background-color:yellow";
								}else if($num_days == 3 && $sign_days == "-"){
									echo "background-color:red;color:white;";
								}else if($sign_days == "+"){
									echo "background-color:blue;color:white;";
								}	 
							?>
							"><?php echo $airport->nama_program;?></td>
							
							
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_program_mulai;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_awal_pemesanan;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->pic_program;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
								 $files = glob('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/*');
								 if (is_dir('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/'))
								 {
									 $DirectoryIterator = new FilesystemIterator('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/');
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
									$namaFile =str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i]);
									?>
									<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
										<a href="<?=base_url()?>download
										?className=<?=$airport->name?>&Angkatan=<?=$airport->angkatan?>/Airport_F/<?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>"
										class="lnr lnr-download"><?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>
										</a>
										<?php
										if($this->input->get("id_pemesanan")==null)
										{
											?>
											<a href="<?= base_url() ?>Koor/remove_file?file=Airport_F&filename=<?=$namaFile?>&id_pemesanan=<?=$airport->id_pemesanan;?>&NP=<?=$airport->name;?>&AK=<?=$airport->angkatan;?>&go=ALL" style="cursor: pointer; color: red;">&times;</a>
											<?php	
										}
										else
										{
											?>
											<a href="<?= base_url() ?>Koor/remove_file?file=Airport_F&filename=<?=$namaFile?>&id_pemesanan=<?=$airport->id_pemesanan;?>&NP=<?=$airport->name;?>&AK=<?=$airport->angkatan;?>" style="cursor: pointer; color: red;">&times;</a>
											<?php
										}
										?>
									</button>
									<?php
								}
								?>
							</td>

							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
								<?php if($airport->status_bus_bandara != NULL){echo $airport->status_bus_bandara;?>&nbsp;  <?php } ?>
							</td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
								<a href="<?php echo base_url(); ?>Koor/view_Detail?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan;  ?>"><i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i></a>
								<a id="btnPlaceOrder" name="btnPlaceOrder" href="<?php echo base_url(); ?>MasterAdmin/export_excel?tipe=Airport_Shuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>"><i class="btn btn-default fa fa-download" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i></a>
							</td>
						</tr>
					<?php
					}
				}else if($RoleID == 3){ $num = $num +1;?>
					<tr>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;
						<?php 
								$d_num = date_create($airport->tanggal_awal_pemesanan);
								$d_now = date_create();
								$d_diff = date_diff($d_num,$d_now);
								$num_days = $d_diff->days;
								$sign_days = $d_diff->format("%R");
								
								if($sign_days == "-" && $airport->status_bus_bandara == "booked"){
									echo "background-color:green;color:white;";
								}else if($num_days == 7 && $sign_days == "-"){
									echo "";
								}else if($num_days == 5 && $sign_days == "-"){
									echo "background-color:yellow";
								}else if($num_days == 3 && $sign_days == "-"){
									echo "background-color:red;color:white;";
								}else if($sign_days == "+"){
									echo "background-color:blue;color:white;";
								}	 
							?>
						"><?php echo $airport->nama_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_program_mulai;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_awal_pemesanan;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->pic_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
								 $files = glob('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/*');
								 if (is_dir('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/'))
								 {
									 $DirectoryIterator = new FilesystemIterator('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/');
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
									$namaFile =str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i]);
									?>
									<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
										<a href="<?=base_url()?>download
										?className=<?=$airport->name?>&Angkatan=<?=$airport->angkatan?>/Airport_F/<?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>"
										class="lnr lnr-download"><?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>
										</a>
										
									</button>
									<?php
								}
								?>
							</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($airport->status_bus_bandara != NULL){echo $airport->status_bus_bandara;?>&nbsp;  <?php } ?>
						</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
							<a href="<?php echo base_url(); ?>MasterAdmin/view_Detail?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan;  ?>"><i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i></a>
							<a id="btnPlaceOrder" name="btnPlaceOrder" href="<?php echo base_url(); ?>MasterAdmin/export_excel?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>"><i class="btn btn-default fa fa-download" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i></a>

							&nbsp;
							<?php if($airport->status_bus_bandara != NULL && ($airport->status_bus_bandara  == 'booked' || $airport->status_bus_bandara  == 'rejected') || $airport->status_bus_bandara== 'Pending') { ?>
								<a onclick="return confirm('Tidak dapat approve !')">
									<i class="btn btn-default fa fa-check-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:grey;" disabled></i>
								</a>

							<?php }else{ ?>
								<a onclick="return confirm('Booked ?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->status_bus_bandara;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
									<i class="btn btn-default fa fa-check-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
								</a>


							<?php }?>
						</td>
					</tr>
					<?php }
				else if($RoleID == 4){ 
					$num = $num + 1;
				?>
					<tr>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;
						<?php 
								$d_num = date_create($airport->tanggal_awal_pemesanan);
								$d_now = date_create();
								$d_diff = date_diff($d_num,$d_now);
								$num_days = $d_diff->days;
								$sign_days = $d_diff->format("%R");
								
								if($sign_days == "-" && $airport->status_bus_bandara == "booked"){
									echo "background-color:green;color:white;";
								}else if($num_days == 7 && $sign_days == "-"){
									echo "";
								}else if($num_days == 5 && $sign_days == "-"){
									echo "background-color:yellow";
								}else if($num_days == 3 && $sign_days == "-"){
									echo "background-color:red;color:white;";
								}else if($sign_days == "+"){
									echo "background-color:blue;color:white;";
								}	 
							?>
						"><?php echo $airport->nama_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_program_mulai;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_awal_pemesanan;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->pic_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
								 $files = glob('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/*');
								 if (is_dir('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/'))
								 {
									 $DirectoryIterator = new FilesystemIterator('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/');
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
									$namaFile =str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i]);
									?>
									<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
										<a href="<?=base_url()?>download
										?className=<?=$airport->name?>&Angkatan=<?=$airport->angkatan?>/Airport_F/<?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>"
										class="lnr lnr-download"><?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>
										</a>
									</button>
									<?php
								}
								?>
							</td>

						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($airport->status_bus_bandara != NULL && $airport->status_bus_bandara != "rejected"){
								echo $airport->status_bus_bandara;?>&nbsp;  <?php
							}else{ ?>
								<span class="blink_me"><?php echo $airport->status_bus_bandara;?></span>
							<?php } ?>
						</td>
						<td style="padding-top: 3px; padding-bottom: 3px;  padding-left: 3px; padding-right: 3px;" align="center">
							<a href="<?php echo base_url(); ?>MasterAdmin/view_Detail?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan;  ?>">
								<i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i>
							</a>

							<?php if($airport->status_bus_bandara != NULL && ($airport->status_bus_bandara == 'booked' || $airport->status_bus_bandara  == 'rejected')) { ?>
								<a onclick="return confirm('Tidak dapat approve !')" disabled>
									<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
								</a>
								<a>
									<i class="btn btn-default fa fa-times-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
								</a>
							<?php }else if($airport->status_bus_bandara  != NULL && $airport->status_bus_bandara   == 'approved') { ?>

								<a onclick="return confirm('Tidak dapat approve !')">
									<i class="btn btn-default fa fa-check-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
								</a>

								<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->id_pemesanan;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
									<i class="btn btn-default fa fa-times-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
								</a>

							<?php }else {?>
								<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->status_bus_bandara;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
									<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
								</a>
								<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->id_pemesanan;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
									<i class="btn btn-default fa fa-times-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
								</a>

							<?php }?>
						</td>
					</tr>
				<?php } else if($RoleID == 1){ $num = $num + 1;?>
					<tr>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $num;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;
							<?php 
								$d_num = date_create($airport->tanggal_awal_pemesanan);
								$d_now = date_create();
								$d_diff = date_diff($d_num,$d_now);
								$num_days = $d_diff->days;
								$sign_days = $d_diff->format("%R");
								
								if($sign_days == "-" && $airport->status_bus_bandara == "booked"){
									echo "background-color:green;color:white;";
								}else if($num_days == 7 && $sign_days == "-"){
									echo "";
								}else if($num_days == 5 && $sign_days == "-"){
									echo "background-color:yellow";
								}else if($num_days == 3 && $sign_days == "-"){
									echo "background-color:red;color:white;";
								}else if($sign_days == "+"){
									echo "background-color:blue;color:white;";
								}	 
							?>
							"><?php echo $airport->nama_program;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_program_mulai;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->tanggal_awal_pemesanan;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $airport->pic_program;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
								 $files = glob('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/*');
								 if (is_dir('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/'))
								 {
									 $DirectoryIterator = new FilesystemIterator('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/');
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
									$namaFile =str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i]);
									?>
									<button class="form-control" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height: 24px;" align="center">
										<a href="<?=base_url()?>download
										?className=<?=$airport->name?>&Angkatan=<?=$airport->angkatan?>/Airport_F/<?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>"
										class="lnr lnr-download"><?=str_replace('./uploads/'.$airport->name.'/'.$airport->angkatan.'/Airport_F/','',$files[$i])?>
										</a>
										<?php
										if($this->input->get("id_pemesanan")==null)
										{
											?>
											<a href="<?= base_url() ?>Koor/remove_file?file=Airport_F&filename=<?=$namaFile?>&id_pemesanan=<?=$airport->id_pemesanan;?>&NP=<?=$airport->name;?>&AK=<?=$airport->angkatan;?>&go=ALL" style="cursor: pointer; color: red;">&times;</a>
											<?php	
										}
										else
										{
											?>
											<a href="<?= base_url() ?>Koor/remove_file?file=Airport_F&filename=<?=$namaFile?>&id_pemesanan=<?=$airport->id_pemesanan;?>&NP=<?=$airport->name;?>&AK=<?=$airport->angkatan;?>" style="cursor: pointer; color: red;">&times;</a>
											<?php
										}
										?>
									</button>
									<?php
								}
								?>
							</td>
							</td>

							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
								<?php if($airport->status_bus_bandara != NULL){echo $airport->status_bus_bandara;?>&nbsp;  <?php } ?>
							</td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
								<a href="<?php echo base_url(); ?>Koor/view_Detail?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan;  ?>">
									<i class="btn btn-default fa fa-search" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px; color:green;"></i>
								</a>
								<a id="btnPlaceOrder" name="btnPlaceOrder" href="<?php echo base_url(); ?>MasterAdmin/export_excel?tipe=Airport_Shuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>">
									<i class="btn btn-default fa fa-download" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
								</a>

								<!-- fungsi checker-->
								&nbsp;
								<?php if($airport->status_bus_bandara != NULL && ($airport->status_bus_bandara == 'booked' || $airport->status_bus_bandara  == 'rejected')) { ?>
									<a onclick="return confirm('Tidak dapat approve !')" disabled>
										<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
									</a>
									<a>
										<i class="btn btn-default fa fa-times-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;" disabled></i>
									</a>
								<?php }else if($airport->status_bus_bandara  != NULL && $airport->status_bus_bandara   == 'approved' || $airport->status_bus_bandara == 'Pending') { ?>
									<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->status_bus_bandara;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
										<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
									</a>
									<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->id_pemesanan;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
										<i class="btn btn-default fa fa-times-circle" aria-hidden="true" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
									</a>

								<?php }else {?>
									<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/update_status?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->status_bus_bandara;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
										<i class="btn btn-default fa fa-check-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
									</a>
									<a onclick="return confirm('Yakin ingin update status?')" href="<?php echo base_url(); ?>MasterAdmin/reject_confirm?tipe=AirportShuttle&id_pemesanan=<?=$airport->id_pemesanan; ?>&status=<?=$airport->id_pemesanan;?>&status_id=<?php if(isset($id_pemesanan)){echo $id_pemesanan; } ?>">
										<i class="btn btn-default fa fa-times-circle" style="padding-left: 5px;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;color:green;"></i>
									</a>

								<?php }?>

							</td>
						</tr>
				<?php } ?>
			<?php
			//$i = $i+1;
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
</div>
</div>

</form>
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
	<form method="post" action="<?= base_url() ?>Koor/additional_files?Program=<?=$airport->name?>&angkatan=<?=$airport->angkatan?>&folder=Airport_F&ID=<?=$this->input->get("id_pemesanan")?>" enctype="multipart/form-data">
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
	<button type="submit" name="Class_Button" class="btn btn-primary btn-m" >Submit <i class=" fa fa-check"></i></button>
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
