<!-- DEV NOTE
	Jika terjadi update/Penambahan pada Master data shuttle point
	Periksa Export_Model.php pada Folder Application/Model
	Jika pengubahan telah di akomodasi pada export_model.php
	lakukan perubahan pada setiap comment HARD CODE pada file ini
	pada HARD CODE 3 tambahkan fungsi untuk melakukan fungsi penambahan dan penempatan pada
	table excel yang di inginkan (peletakan table di tentukan dengan menggunakan asci pada table yang sesuai)
	(Jika terjadi kesulitan, sesuaikan code dengan fungsi yang sudah ada)
	Asci[alphabet]: menunjukan pada table mana total akan di letakan (table excel)
-->
<?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$title.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
  
 <table border=1>
		<tr>
			<td rowspan="2"><center><b>No.</b></center></td>
			<td rowspan="2"><center><b>Nama Program</b></center></td> 
			<!-- start looping --> 
		<?php 
		$a = $count_tanggal->jumlah; 
		if  ($a == 1){ ?> 
			<td colspan="6"><center><b><?php echo $data_shuttle[0]->Dates; ?></b></center></td>
		</tr>
		
		<tr>
		<!--HARD CODE 1-->
			<td> Bogor </td>
			<td> Alam Sutera </td>
			<td> Kelapa Gading </td>
			<td> Bekasi </td>
			<td> Wisma Asia </td>
			<td> Pondok Indah </td>
		</tr>
		
		<?php foreach($data_shuttle as $shuttle) { ?>
		<tr>
			<td><?php echo 1; ?></td>
			<td><?php echo $shuttle->nama_program; ?></td>
			<!--HARD CODE 2-->
			<td><?php if($data_shuttle[$i]->Bogor == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bogor; } ?></td>
			<td><?php if($data_shuttle[$i]->Alam_Sutera == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Alam_Sutera; } ?></td>
			<td><?php if($data_shuttle[$i]->Kelapa_Gading == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Kelapa_Gading; } ?></td>
			<td><?php if($data_shuttle[$i]->Bekasi == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bekasi; } ?></td>
			<td><?php if($data_shuttle[$i]->Wisma_Asia == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Wisma_Asia; } ?></td>
			<td><?php if($data_shuttle[$i]->Pondok_Indah == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Pondok_Indah; } ?></td>

		</tr>
		<?php } ?>
		
		<?php } else { ?>
			<?php 
			
			$array = array();
			//for($i = 0; $i<$a; $i++){ ?>
			<?php foreach($ordered_date as $date) { ?>
				<td colspan="6"><center><b><?php echo $date->jumlah; ?></b></center></td>
			<?php 
			array_push($array, $date->jumlah);
			} ?>
		<tr>
			<?php for($i = 0; $i<$a; $i++){ ?>
			<!--HARD CODE 1-->
			<td> Bogor </td>
			<td> Alam Sutera </td>
			<td> Kelapa Gading </td>
			<td> Bekasi </td>
			<td> Wisma Asia </td>
			<td> Pondok Indah </td>
			<?php } ?>
		</tr>
		<tr>
		<?php
		$num = 1;
		$num_rows = $count_rows->jumlah;
		for($i = 0; $i<$num_rows; $i++){ ?>
			<?php if($i == 0){ ?>
				<td><?php echo $num; $num++?></td>
				<td><?php echo $data_shuttle[$i]->nama_program; ?></td>
				<!--HARD CODE 2-->
				<td><?php if($data_shuttle[$i]->Bogor == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bogor; } ?></td>
				<td><?php if($data_shuttle[$i]->Alam_Sutera == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Alam_Sutera; } ?></td>
				<td><?php if($data_shuttle[$i]->Kelapa_Gading == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Kelapa_Gading; } ?></td>
				<td><?php if($data_shuttle[$i]->Bekasi == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bekasi; } ?></td>
				<td><?php if($data_shuttle[$i]->Wisma_Asia == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Wisma_Asia; } ?></td>
				<td><?php if($data_shuttle[$i]->Pondok_Indah == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Pondok_Indah; } ?></td>

				
			<?php }else{ ?>
				<?php if($data_shuttle[$i]->nama_program == $data_shuttle[$i-1]->nama_program && $data_shuttle[$i]->id_pemesanan == $data_shuttle[$i-1]->id_pemesanan){ ?>
				<!--HARD CODE 2-->
					<td><?php if($data_shuttle[$i]->Bogor == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bogor; } ?></td>
					<td><?php if($data_shuttle[$i]->Alam_Sutera == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Alam_Sutera; } ?></td>
					<td><?php if($data_shuttle[$i]->Kelapa_Gading == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Kelapa_Gading; } ?></td>
					<td><?php if($data_shuttle[$i]->Bekasi == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bekasi; } ?></td>
					<td><?php if($data_shuttle[$i]->Wisma_Asia == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Wisma_Asia; } ?></td>
					<td><?php if($data_shuttle[$i]->Pondok_Indah == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Pondok_Indah; } ?></td>
				<?php }else { ?>
					<tr>
					<td><?php echo $num; $num++?></td>
					<td><?php echo $data_shuttle[$i]->nama_program; ?></td>
					<?php 
					$n = sizeof($array);
					for($x = 0; $x<$n; $x++){ 
						if($data_shuttle[$i]->Dates != $array[$x]){ ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						<?php }else{ ?>
						<!--HARD CODE 2-->
							<td><?php if($data_shuttle[$i]->Bogor == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bogor; } ?></td>
							<td><?php if($data_shuttle[$i]->Alam_Sutera == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Alam_Sutera; } ?></td>
							<td><?php if($data_shuttle[$i]->Kelapa_Gading == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Kelapa_Gading; } ?></td>
							<td><?php if($data_shuttle[$i]->Bekasi == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Bekasi; } ?></td>
							<td><?php if($data_shuttle[$i]->Wisma_Asia == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Wisma_Asia; } ?></td>
							<td><?php if($data_shuttle[$i]->Pondok_Indah == NULL){ echo "0"; } else{ echo $data_shuttle[$i]->Pondok_Indah; } ?></td>
						<?php 
						break;
						} ?>
					<?php } ?>
				
				
				
				<?php } ?>
			<?php } ?>
		
		<?php } ?>
		
		<?php } ?>
		
		<tr>
			<td colspan="2">Total</td>
			
			<!--HARD CODE 3-->
			
			<?php 
			$asciiC = 67;
			$asciiD = 68;
			$asciiE = 69;
			$asciiF = 70;
			$asciiG = 71;
			$asciiH = 72;
			
			$row = 3;
			$jlh_baris = $distinct_rows->jumlah_baris;
			foreach($ordered_date as $date) { ?>
				<td>
					<?php if($asciiC > 90){ ?>
						=SUM(<?php 
						if($asciiC == 91) {
							echo chr(65); echo chr(65);
						}else {
							echo chr($asciiC);
						}
						echo $row;?>:<?php 
						if($asciiC == 91) {
							echo chr(65); echo chr(65);
						}else {
							echo chr($asciiC);
						}
						echo $row + $jlh_baris-1; ?>)
						
					<?php }else{ ?>
						=SUM(<?php echo chr($asciiC); echo $row;?>:<?php echo chr($asciiC); echo $row + $jlh_baris-1; ?>)
					<?php } ?>
				</td>
				<td>				
					<?php if($asciiD > 91){ ?>
						=SUM(<?php 
						if($asciiD == 92) {
							echo chr(65); echo chr(66);
						}else {
							echo chr($asciiD);
						}
						echo $row;?>:<?php 
						if($asciiD == 92) {
							echo chr(65); echo chr(66);
						}else {
							echo chr($asciiD);
						}
						echo $row + $jlh_baris-1; ?>)
						
					<?php }else{ ?>
						=SUM(<?php echo chr($asciiD); echo $row;?>:<?php echo chr($asciiD); echo $row + $jlh_baris-1; ?>)
					<?php } ?>
				</td>
				<td>
					<?php if($asciiE > 92){ ?>
						=SUM(<?php 
						if($asciiE == 93) {
							echo chr(65); echo chr(67);
						}else {
							echo chr($asciiE);
						}
						echo $row;?>:<?php 
						if($asciiE == 93) {
							echo chr(65); echo chr(67);
						}else {
							echo chr($asciiE);
						}
						echo $row + $jlh_baris-1; ?>)
						
					<?php }else{ ?>
						=SUM(<?php echo chr($asciiE); echo $row;?>:<?php echo chr($asciiE); echo $row + $jlh_baris-1; ?>)
					<?php } ?>
				</td>
				<td>
					<?php if($asciiF > 93){ ?>
						=SUM(<?php 
						if($asciiF == 94) {
							echo chr(65); echo chr(68);
						}else {
							echo chr($asciiF);
						}
						echo $row;?>:<?php 
						if($asciiF == 94) {
							echo chr(65); echo chr(68);
						}else {
							echo chr($asciiF);
						}
						echo $row + $jlh_baris-1; ?>)
						
					<?php }else{ ?>
						=SUM(<?php echo chr($asciiF); echo $row;?>:<?php echo chr($asciiF); echo $row + $jlh_baris-1; ?>)
					<?php } ?>
				</td>
				<td>
					<?php if($asciiG > 94){ ?>
						=SUM(<?php 
						if($asciiG == 95) {
							echo chr(65); echo chr(69);
						}else {
							echo chr($asciiG);
						}
						echo $row;?>:<?php 
						if($asciiG == 95) {
							echo chr(65); echo chr(69);
						}else {
							echo chr($asciiG);
						}
						echo $row + $jlh_baris-1; ?>)
						
					<?php }else{ ?>
						=SUM(<?php echo chr($asciiG); echo $row;?>:<?php echo chr($asciiG); echo $row + $jlh_baris-1; ?>)
					<?php } ?>
				</td>
				<td>
					<?php if($asciiH > 95){ ?>
						=SUM(<?php 
						if($asciiH == 96) {
							echo chr(65); echo chr(70);
						}else {
							echo chr($asciiH);
						}
						echo $row;?>:<?php 
						if($asciiH == 96) {
							echo chr(65); echo chr(70);
						}else {
							echo chr($asciiH);
						}
						echo $row + $jlh_baris-1; ?>)
						
					<?php }else{ ?>
						=SUM(<?php echo chr($asciiH); echo $row;?>:<?php echo chr($asciiH); echo $row + $jlh_baris-1; ?>)
					<?php } ?>
				</td>
			
			<?php 
			
			$asciiC = $asciiC + 6;
			$asciiD = $asciiD + 6;
			$asciiE = $asciiE + 6;
			$asciiF = $asciiF + 6;
			$asciiG = $asciiG + 6;
			$asciiH = $asciiH + 6; 
			} ?>
			<!-- /Hardcode -->
			
		</tr>
</table>