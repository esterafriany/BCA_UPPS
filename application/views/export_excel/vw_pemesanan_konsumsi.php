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
		<td height="3px"></td>
	</tr>
	<tr>
		<td><center><h4>Pemesanan Konsumsi</h4></center></td>
	</tr>
 </table>
 
 <table border=1>
		<tr>
			<td align="right"><b>Hari/Tanggal</b></td>
			<?php foreach($data_konsumsi as $konsumsi) { ?>
				<td colspan="3" align="center"><?php echo date('d M Y',strtotime($konsumsi->tanggal)); ?></td>
			<?php } ?>
		</tr>
		
		<tr>
			<td align="right"><b>Kategori</b></td>
			<?php foreach($data_konsumsi as $konsumsi) { ?>
				<td><center><b>Coffee Break Pagi</b></center></td>
				<td><center><b>Coffee Break Siang</b></center></td>
				<td><center><b>Lunch</b></center></td>
			<?php } ?>
		</tr>
		
		<tr>
			<td align="right"><b>Ruangan</b></td>
			<?php foreach($data_konsumsi as $konsumsi) { ?>
				<td><?php echo $konsumsi->Ruangan1; ?></td>
				<td><?php echo $konsumsi->Ruangan2; ?></td>
				<td><?php echo $konsumsi->Ruangan3; ?></td>
			<?php } ?>
		</tr>
		
		<tr>
			<td align="right"><b>Jumlah</b></td>
			<?php foreach($data_konsumsi as $konsumsi) { ?>
				<td><?php echo $konsumsi->Coffee_Break_Pagi; ?></td>
				<td><?php echo $konsumsi->Coffee_Break_Siang; ?></td>
				<td><?php echo $konsumsi->Lunch; ?></td>
			<?php } ?>
		</tr>
		
		<tr>
			<td align="right"><b>Catatan</b></td>
			<?php foreach($data_konsumsi as $konsumsi) { ?>
				<td colspan="3"><?php echo $konsumsi->note; ?></td>
			<?php } ?>
				
		</tr>
		
		<?php
			$tot_cbp = 0;
			$tot_cbs = 0;
			$tot_l = 0;
			foreach($data_konsumsi as $konsumsi) { ?>
		
		<?php 
			$tot_cbp = $tot_cbp + $konsumsi->Coffee_Break_Pagi;
			$tot_cbs = $tot_cbs + $konsumsi->Coffee_Break_Siang;
			$tot_l = $tot_l + $konsumsi->Lunch;
			} ?>
		<!--<tr>
			<td>Total</td>
			<td><?php echo $tot_cbp; ?></td>
			<td><?php echo $tot_cbs; ?></td>
			<td><?php echo $tot_l; ?></td>
			<td></td>
		</tr>-->
</table>