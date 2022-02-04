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
		<td><center><h4>Pemesanan Bus Bandara </h4></center></td>
	</tr>
 </table>
 
 <table border=1>

	<tr>
		<td colspan="6"><center><h4>Penjemputan Dari Bandara</h4></center></td>
	</tr>
	
	<tr>
		<td><center><b>Tanggal Berangkat</b></center></td>
		<td><center><b>Berangkat Dari</b></center></td>
		<td><center><b>Tujuan Ke</b></center></td>
		<td><center><b>Jam</b></center></td>
		<td><center><b>Kapasitas</b></center></td>
		<td><center><b>Catatan</b></center></td>
	</tr>
		
	<?php foreach($data_airport_shuttle_arrival as $arrival) { ?>
		<tr>
			<td><?php echo date('d M Y',strtotime($arrival->TanggalBerangkat)); ?></td>
			<td><?php echo $arrival->BerangkatDari; ?></td>
			<td><?php echo $arrival->Tujuan; ?></td>
			<td><?php echo $arrival->Jam; ?></td>
			<td><?php echo $arrival->Kapasitas; ?></td>
			<td><?php echo $arrival->Keterangan; ?></td>
		
		</tr>
	<?php } ?>
</table>

<br>

<table border=1>

	<tr>
		<td colspan="6"><center><h4>Antar Ke Bandara</h4></center></td>
	</tr>
	
	<tr>
		<td><center><b>Tanggal Berangkat</b></center></td>
		<td><center><b>Berangkat Dari</b></center></td>
		<td><center><b>Tujuan Ke</b></center></td>
		<td><center><b>Jam</b></center></td>
		<td><center><b>Kapasitas</b></center></td>
		<td><center><b>Catatan</b></center></td>
	</tr>
		
	<?php foreach($data_airport_shuttle_departure as $arrival) { ?>
		<tr>
			<td><?php echo date('d M Y',strtotime( $arrival->TanggalBerangkat)); ?></td>
			<td><?php echo $arrival->BerangkatDari; ?></td>
			<td><?php echo $arrival->Tujuan; ?></td>
			<td><?php echo $arrival->Jam; ?></td>
			<td><?php echo $arrival->Kapasitas; ?></td>
			<td><?php echo $arrival->Keterangan; ?></td>
		
		</tr>
	<?php } ?>
</table>