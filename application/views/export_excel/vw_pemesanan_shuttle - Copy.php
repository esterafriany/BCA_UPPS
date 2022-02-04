 <?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 <table width="100%">
	<?php foreach($info_pemesanan as $info) { ?>
	<tr>
		<td>Nama Program</td>
		<td>: <?php echo $info->ProgramName; ?>, Angkatan <?php echo $info->NamaAngkatan; ?></td>
	</tr>
	
	<tr>
		<td>Tanggal Program</td>
		<td>: <?php echo date('d M Y',strtotime($info->ProgramMulai)); ?> s/d <?php echo date('d M Y',strtotime( $info->ProgramSelesai)); ?></td>
	</tr>
	
	<tr>
		<td>PIC Program</td>
		<td>: <?php echo $info->PICProgram; ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td><center><h4>Pemesanan Shuttle Bus</h4></center></td>
	</tr>
 </table>
 
 <table border=1>
	<tr>
		<td rowspan="2"><center><b>Hari/Tanggal</b></center></td>
		<td colspan="6"><center><b>Titik Shuttle</b></center></td>
		<td rowspan="2"><center><b>Catatan</b></center></td>
	</tr>
	
	<tr>
		<td>
			Bogor
		</td>
		<td>
			Alam Sutera
		</td>
		<td>
			Wisma Asia
		</td>
		<td>
			Kelapa Gading
		</td>
		<td>
			Bekasi
		</td>
		<td>
			Pondok Indah
		</td>
	</tr>
	
	<?php foreach($data_shuttle as $shuttle) { ?>
	<tr>
			<td><?php echo date('d M Y',strtotime($shuttle->Dates));  ?></td>
			<td><?php echo $shuttle->Bogor; ?></td>
			<td><?php echo $shuttle->Alam_Sutera; ?></td>
			<td><?php echo $shuttle->Wisma_Asia; ?></td>
			<td><?php echo $shuttle->Kelapa_Gading; ?></td>
			<td><?php echo $shuttle->Bekasi; ?></td>
			<td><?php echo $shuttle->Pondok_indah; ?></td>
			<td><?php echo $shuttle->note; ?></td>
		
	</tr>
	<?php } ?>
</table>