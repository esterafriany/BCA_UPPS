<?php
//25-Jul-17
if(isset($_SESSION["SUCCESS"]))
{
if($_SESSION["SUCCESS"])
{

    echo "<script> alert('Pemesanan telah di tambahkan,Menunggu approval');
        window.location.href='Views/Home';
        </script>";
        $_SESSION["SUCCESS"]=false;
}
}
?>
<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
?>
<div class="col-md-13">
<div style="padding-right: 5cm; color: blue">
<input type="hidden" name="tipe" value="Classes">
</div>
    <?php
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
    }?>
<div class="panel" action="<?= base_url()?>">
<div class="panel-heading">
    <h3 class="panel-title" id="title">REKAP PROSES</h3>
		<br>
		<!--DEBUG PURPOSES-->
		<!--<table>
			<tr>
				<td>You can view as :</td>
				<td>
					<?php if (strcmp($_SESSION["CompleteControl"],"Allowed")==0)
					{
						?>
						<select onChange="window.location.href=this.value" class="form-control">
							<option value="">Control Class</option>
							<option value="Privilaged?newRoleid=1">Master Admin</option>
							<option value="Privilaged?newRoleid=2">Koor</option>
							<option value="Privilaged?newRoleid=3">Admin Koor</option>
							<option value="Privilaged?newRoleid=4">Checker</option>
						</select>
						
					<?php } ?>
				</td>
			</tr> 
		</table>-->
		
</div>
<div class="panel-body">
<form method="Post" action="<?= base_url() ?>Koor/update_pemesanan_content?Content=All">
	<table align="center" style="border-collapse: collapse;font-size: 13px;" class="table table-bordered table-hover" id="bootstrap-table">
		<thead>
		<tr>
			<th>No.</th>
			<th>Program - Angkatan</th>
			<th>Tanggal Program</th>
			<th colspan="2">Tanggal Pemesanan</th>
			<th>PIC</th>
			<th>Jumlah Peserta</th>
			<th>Kelas</th>
			<th>Konsumsi</th>
			<th>Hotel</th>
			<th>Shuttle Bus</th>
			<th>Bus Bandara</th>
			<?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==1 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0)
			{
				?>
				<th>Action</th>
				<?php
			} ?>

		</tr>
		</thead>
		<?php
			$i = 1;
			foreach($Rekap_All as $all)
			{
				 ?>
				<tr>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $i;?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;
					<?php 
						$d_num = date_create($all->tanggal_awal_pemesanan);
						$d_now = date_create();
						$d_diff = date_diff($d_num,$d_now);
						$num_days = $d_diff->days;
						$sign_days = $d_diff->format("%R");
						
						if($sign_days == "-" && $all->status_kelas == "booked" && $all->status_konsumsi == "booked" && $all->status_hotel == "booked" && $all->status_shuttlebus == "booked" && $all->status_busbandara == "booked"){
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
					"><?php echo($all->nama_program);?></td>
					<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo ($all->tanggal_program_mulai);?></td>
					<?php
					$UserID = $this->session->userdata['logged_in']['UserID'];
					if ($UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
					{
						?>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" class="Target1"><?php echo $all->tanggal_awal_pemesanan;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" class="Target2"><?php echo $all->tanggal_akhir_pemesanan;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" class="Target3"><?php echo $all->pic_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" class="Target4" align="center"><?php echo $all->JumlahPeserta;?></td>
						<?php 
						$ListID=$all->id_pemesanan;
						?>
						<input type="text" class="hidden" name="PemesananID[]" value=<?=$ListID?>>
						<?php
					}
					else
					{
						?>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $all->tanggal_awal_pemesanan;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $all->tanggal_akhir_pemesanan;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $all->pic_program;?></td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $all->JumlahPeserta;?></td>

						<?php
					}
					 ?>
					<?php if($RoleID == 4 || $RoleID == 3 || $RoleID==1)
					{ ?>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($all->status_kelas != NULL && $all->status_kelas != "rejected"){
								echo $all->status_kelas;?>&nbsp;
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Classes&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }else if($all->status_kelas == "rejected") { ?>
								<span class="blink_me" ><?php echo $all->status_kelas;?></span>
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Classes&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }
							elseif ($all->status_kelas == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Classes&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
								<?php
							}
							else{echo $all->status_kelas;}
							 ?>
						</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($all->status_konsumsi != NULL && $all->status_konsumsi != "rejected"){
								echo $all->status_konsumsi;?>&nbsp;
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Consumption&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }else if($all->status_konsumsi == "rejected") { ?>
								<span class="blink_me"><?php echo $all->status_konsumsi;?></span>
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Consumption&id_pemesanan=<?=$all->id_pemesanan;?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }
							elseif ($all->status_konsumsi == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Consumption&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
								<?php
							}
							else{echo $all->status_konsumsi;}
							 ?>
						</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($all->status_hotel != NULL && $all->status_hotel != "rejected"){
								echo $all->status_hotel;?>&nbsp;
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Hotels&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }else if($all->status_hotel == "rejected") { ?>
								<span class="blink_me"><?php echo $all->status_hotel;?></span>
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=Hotels&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }
							elseif ($all->status_hotel == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Hotel&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>								<?php
							}
							else{echo $all->status_hotel;}
							?>

						</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($all->status_shuttlebus != NULL && $all->status_shuttlebus != "rejected"){
								echo $all->status_shuttlebus;?>&nbsp;
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=ShuttleBus&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }else if($all->status_shuttlebus == "rejected") { ?>
								<span class="blink_me"><?php echo $all->status_shuttlebus;?></span>
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=ShuttleBus&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }
							elseif ($all->status_shuttlebus == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Shuttle&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
								<?php
							}
							else{echo $all->status_shuttlebus;}
							 ?>
						</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php if($all->status_busbandara != NULL && $all->status_busbandara != "rejected"){
								echo $all->status_busbandara;?>&nbsp;
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=AirportShuttle&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }else if($all->status_busbandara == "rejected") { ?>
								<span class="blink_me"><?php echo $all->status_busbandara;?></span>
								<a href="<?php echo base_url(); ?>MasterAdmin/view_Recaps?tipe=AirportShuttle&id_pemesanan=<?=$all->id_pemesanan;  ?>">
									<i class="lnr lnr-magnifier">  </i>
								</a>
							<?php }
							elseif ($all->status_busbandara == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Airport&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
								<?php
							}
							else{echo $all->status_busbandara;}
							 ?>
						</td>
					<?php
					if ($RoleID==1)
					{
						?>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
							<a style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan";?>?ID=<?=$all->id_pemesanan?>" onclick="return confirm('Are you sure?');">&#10006;</a>
						</td>
							<!--<input type="text" class="hidden" name="PemesananID[]" value=<?=$ListID?>>-->
							<input type="text" class="hidden" name="NP[]" value="<?php echo $all->nama_program;?>">
							<input type="text" class="hidden" name="AP[]" value="<?php echo $all->tanggal_awal_pemesanan;?>">
						<?php
					}
				}
					if($RoleID==2)
					{ ?>
						<div id="Table_data">
						<?php $UserID = $this->session->userdata['logged_in']['UserID']; ?>
						<?php if (strcmp($all->status_kelas,"rejected")==0)
						{
							?>
							<td class="blink_me" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						else
						{
							?>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						?>
							<?php if($all->status_kelas != NULL && $UserID == $all->UserID OR $all->status_kelas != NULL AND strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{echo $all->status_kelas; ?>&nbsp;
								<a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=Classes&id_pemesanan=<?=$all->id_pemesanan;  ?> "> <i class="lnr lnr-magnifier">  </i></a>
							<?php }
							elseif ($all->status_kelas == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Classes&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
								<?php
							}
							else{echo $all->status_kelas;} ?>
						</td>
						<?php if (strcmp($all->status_konsumsi,"rejected")==0)
						{
							?>
							<td class="blink_me" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						else
						{
							?>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						?>
							<?php if($all->status_konsumsi != NULL && $UserID == $all->UserID OR $all->status_konsumsi != NULL AND strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{echo $all->status_konsumsi;?>&nbsp;
							<a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=Consumption&id_pemesanan=<?=$all->id_pemesanan;  ?>"> <i class="lnr lnr-magnifier">  </i></a>
							<?php
						}
						elseif ($all->status_konsumsi == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
						{
							?>
							<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Consumption&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
								&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
							<?php
						}
						else{echo $all->status_konsumsi;} ?>
						</td>
						<?php if (strcmp($all->status_hotel,"rejected")==0)
						{
							?>
							<td class="blink_me" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						else
						{
							?>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						?>
							<?php if($all->status_hotel != NULL && $UserID == $all->UserID OR $all->status_hotel != NULL AND strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{echo $all->status_hotel;?>&nbsp;
							<a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=Hotels&id_pemesanan=<?=$all->id_pemesanan;  ?>"> <i class="lnr lnr-magnifier">  </i> </a>
							<?php }
							elseif ($all->status_hotel == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Hotel&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>								<?php
							}
							else{echo $all->status_hotel;} ?>
						</td>
						<?php if (strcmp($all->status_shuttlebus,"rejected")==0)
						{
							?>
							<td class="blink_me" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						else
						{
							?>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						?>
						<?php if($all->status_shuttlebus != NULL && $UserID == $all->UserID OR $all->status_shuttlebus != NULL AND strcmp($_SESSION["CompleteControl"],"Allowed")==0)
						{
								echo $all->status_shuttlebus;?>&nbsp;
								<a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=ShuttleBus&id_pemesanan=<?=$all->id_pemesanan;  ?>"> <i class="lnr lnr-magnifier">  </i> </a>
							<?php
						}
							elseif ($all->status_shuttlebus == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Shuttle&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
								<?php
							}
							else{echo $all->status_shuttlebus;} ?>
						</td>
						<?php if (strcmp($all->status_busbandara,"rejected")==0)
						{
							?>
							<td class="blink_me" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						else
						{
							?>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;">
							<?php
						}
						?>
							<?php if($all->status_busbandara != NULL && $UserID == $all->UserID OR $all->status_busbandara != NULL AND strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								echo $all->status_busbandara;?>&nbsp;
							<a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=AirportShuttle&id_pemesanan=<?=$all->id_pemesanan;  ?>"> <i class="lnr lnr-magnifier">  </i> </a>
							<?php }
							elseif ($all->status_busbandara == NULL && $UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?>
								<a name="ContinueAnchor" href="<?php echo base_url(); ?>Koor/add_detail?tipe=Airport&id_pemesanan=<?=$all->id_pemesanan;?>&program=<?=$all->program;?>&angkatan=<?=$all->angkatan;?>&tanggal_program_mulai=<?=$all->tanggal_program_mulai;?>&tanggal_program_selesai=<?=$all->tanggal_program_selesai;?>&PIC=<?=$all->pic_program;?>&JumlahPeserta=<?=$all->JumlahPeserta;?>
									&AwalPemesanan=<?=$all->tanggal_awal_pemesanan;?>&AkhirPemesanan=<?=$all->tanggal_akhir_pemesanan;?>">ADD</a>
								<?php
							}
							else{echo $all->status_busbandara;} ?>
						</td>
						<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
							<?php
							$UserID = $this->session->userdata['logged_in']['UserID'];
							if ($UserID == $all->UserID OR strcmp($_SESSION["CompleteControl"],"Allowed")==0)
							{
								?><a style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan";?>?ID=<?=$all->id_pemesanan?>" onclick="return confirm('Are you sure?');">&#10006;</a>
							<?php } ?>
						</td>
						<!--<input type="text" class="hidden" name="PemesananID[]" value=<?=$ListID?>>-->
						<input type="text" class="hidden" name="NP[]" value="<?php echo $all->nama_program;?>">
						<input type="text" class="hidden" name="AP[]" value="<?php echo $all->tanggal_awal_pemesanan;?>">
					</div>
					<?php } ?>
				</tr>
			<?php
			$i = $i+1;
			}
			?>
			<?php
			if($RoleID==2 OR $RoleID==1)
			{
				?>
				<input type="text" class="hidden" name="Jumlah" value=<?=($i-1)?>>
	</table>
	<button id="save_button" type="submit" class="form-control btn btn-primary btn-circle btn-xl">&#10004; &nbsp;Save Changes
	</button>
	</form>
	<?php if ($Rekap_All!=null)
	{
		?>
		<button id="edit_btn" class="form-control btn btn-primary btn-circle btn-xl" value="<?=$all->id_pemesanan?>">&#9998; &nbsp;Enable Edit Data
		</button>
		<?php
	}
	?>
	<?php }else { ?>
		</table>
		</form>
	<?php } ?>


</div>
</div>
</div>
<script type="text/javascript">

edit_btn = document.getElementById('edit_btn');
$('#save_button').hide();
$('a[name=ContinueAnchor]').hide();
edit_btn.addEventListener("click",function()
{
			$('.Target1').each(function()
			{
				var html = $(this).html();
        length = html.length;
        var input = $('<input name="tanggalAwalPemesanan[]" style="padding-top: 1px; padding-left: 1px; padding-bottom: 1px; padding-right: 1px;width:125px" class="form-control" type="date" size='+length+'/>');
		input.val(html);
        $(this).html(input);
			});

     $('.Target2').each(function()
		 {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="tanggalAkhirPemesanan[]" style="padding-top: 1px; padding-left: 1px; padding-bottom: 1px; padding-right: 1px;width:125px;"  class="form-control" type="date" size='+length+'/>');        input.val(html);
        $(this).html(input);
    });
    $('.Target3').each(function()
		{
        var html = $(this).html();
        length = html.length;
        var input = $('<input style="padding-top: 1px; padding-left: 1px; padding-bottom: 1px; padding-right: 1px;" name="PIC[]" class="form-control" type="text" size='+length+'/>');
        input.val(html);
        $(this).html(input);
    });
		$('.Target4').each(function()
		{
        var html = $(this).html();
        length = html.length;
        var input = $('<input style="padding-top: 1px; padding-left: 1px; padding-bottom: 1px; padding-right: 1px;width:90px" name="JumlahPeserta[]" class="form-control" type="number" size='+length+'/>');
        input.val(html);
        $(this).html(input);
    });
    	 $('#edit_btn').fadeOut()
    	 $('#save_button').fadeIn()
			 $('a[name=ContinueAnchor]').fadeIn();
});
</script>
