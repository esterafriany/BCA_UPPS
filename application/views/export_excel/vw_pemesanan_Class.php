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
		<td><center><h4>Pemesanan Class</h4></center></td>
	</tr>
 </table>
 
 <table border=1>
	<tr>
		<td><center><b>Nama Ruangan </b></center></td>
		<td><center><b>Jumlah Peserta</b></center></td>
		<td><center><b>Layout</b></center></td>
		<td><center><b>Catatan</b></center></td>
	</tr>
	
	<?php foreach($data_class as $class) { ?>
		<tr>
			<td><?php echo $class->RoomName; ?></td>
			<td><?php echo $class->Jumlah_Peserta; ?></td>
			<td><?php echo $class->Layout; ?></td>
			<td><?php echo $class->note; ?></td> 
		</tr>
	<?php } ?>
</table>