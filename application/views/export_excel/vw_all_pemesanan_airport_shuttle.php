 <?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
//  var_dump($this->input->post('date_from'));
//  var_dump($this->input->post('date_to'));
 ?>
 
 <br>
 <table border=1>

	<tr>
		<td colspan="8"><center><h4>SHUTTLE BUS ANTAR JEMPUT BANDARA</h4></center></td>
	</tr>
	
	<tr>
		<td><center><b>No.</b></center></td>
		<td><center><b>Tanggal Berangkat</b></center></td>
		<td><center><b>Nama Program</b></center></td>
		<td><center><b>Penjemputan</b></center></td>
		<td><center><b>Waktu</b></center></td>
		<td><center><b>Tujuan</b></center></td>
		<td><center><b>Peserta</b></center></td>
		<td><center><b>Jenis Penjemputan</b></center></td>
	</tr>
		
	<?php $num=1; foreach($data_bus as $arrival) { ?>
		<tr>
			<td><?php echo $num; ?></td>
			<td><?php $d = date("d M Y", strtotime($arrival->TanggalBerangkat));echo $d; ?></td>
			<td><?php echo $arrival->nama_program; ?></td>
			<td><?php echo $arrival->BerangkatDari; ?></td>
			<td><?php echo $arrival->Jam; ?></td>
			<td><?php echo $arrival->Tujuan; ?></td>
			<td><?php echo $arrival->Kapasitas; ?></td>
			<td><?php echo $arrival->Jenis; ?></td>
		</tr>
	<?php $num = $num + 1;} ?>
</table>