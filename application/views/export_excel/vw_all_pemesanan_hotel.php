 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$title.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
  
 <table border=1>
	<tr>
		<td colspan="8"><center><h4>Periode: <?php $d = date("d M Y", strtotime($date_from));echo $d; ?> - <?php $d = date("d M Y", strtotime($date_to)); echo $d; ?></h4></center></td>
	</tr>
	
	<tr>
		<td rowspan="2"><center><b>No.</b></center></td>
		<td rowspan="2"><center><b>Program</b></center></td>
		<td rowspan="2"><center><b>PIC Koor</b></center></td>
		<td colspan="2"><center><b>Tanggal</b></center></td>
		<td rowspan="2"><center><b>Hotel</b></center></td>
		<td colspan="2"><center><b>Jumlah</b></center></td>
	</tr>
	
	<tr>
		<td><center><b>Checkin</b></center></td>
		<td><center><b>Checkout</b></center></td>
		<td><center><b>Single</b></center></td>
		<td><center><b>Twin Sharing</b></center></td>
	</tr>
	
	<?php 
	$num = 1;
	foreach($data_hotel as $hotel) { ?>
		<tr>
			<td><?php echo $num; ?></td>
			<td><?php echo $hotel->nama_program; ?></td>
			<td><?php echo $hotel->PIC; ?></td>
			<td><?php echo $hotel->TanggalCheckin; ?></td>
			<td><?php echo $hotel->TanggalCheckOut; ?></td>
			<td><?php echo $hotel->HotelName; ?></td>
			<td><?php echo $hotel->Single; ?></td>
			<td><?php echo $hotel->Twin_Sharing; ?></td>
		</tr>
	<?php $num = $num+1;
	} ?>
	
	
	
</table>