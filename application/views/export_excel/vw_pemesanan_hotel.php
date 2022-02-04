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
		<td><center><h4>Pemesanan Hotel</h4></center></td>
	</tr>
 </table>
 
 <table border=1>
	<tr>
		<td rowspan="2"><center><b>Nama Hotel</b></center></td>
		<td colspan="2"><center><b>Tanggal</b></center></td>
		<td colspan="2"><center><b>Single</b></center></td>
		<td colspan="2"><center><b>Twin Sharing</b></center></td>
		<td rowspan="2"><center><b>Catatan</b></center></td>
	</tr>
	
	<tr>
		<td>Checkin</td>
		<td>Checkout</td>
		<td>Pria</td>
		<td>Wanita</td>
		<td>Pria</td>
		<td>Wanita</td>
	</tr>
	
	<?php foreach($data_hotel as $hotel) { ?>
		<tr>
			<td><?php echo $hotel->hotelname; ?></td>
			<td><?php echo date('d M Y',strtotime($hotel->TanggalCheckin)); ?></td>
			<td><?php echo date('d M Y',strtotime($hotel->TanggalCheckout)); ?></td>
			<td><?php echo $hotel->Jml_SInglePria; ?></td>
			<td><?php echo $hotel->Jml_SingleWanita; ?></td>
			<td><?php echo $hotel->Jml_TwinPria; ?></td>
			<td><?php echo $hotel->Jml_twinWanita; ?></td>
			<td><?php echo $hotel->note; ?></td>
		</tr>
	<?php } ?>
	
	
	
</table>