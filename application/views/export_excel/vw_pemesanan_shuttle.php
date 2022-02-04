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
 <?php
	foreach($numberOfOrder as $Order)
	{
		$DateCount=$Order->DateCount;
		$PointCount=$Order->PointCount;
	}
 ?>
	<tr>
		<td rowspan="2"><center><b>Hari/Tanggal</b></center></td>
		<td colspan=<?=$PointCount?>><center><b>Titik Shuttle</b></center></td>
		<td rowspan="2"><center><b>Catatan</b></center></td>
	</tr>
	
	<tr>
	<?php
	$count = 0;
	foreach($data_shuttle as $shuttle){
		if($count==$PointCount)
		{
			break;
		}
		else
		{
		?>
		<td>
		<?=$shuttle->name?>
		</td>
		<?php	
		}
		$count++;
	}
	?>
	</tr>
	
	<?php
	$DC=0;$DCu="";
	 foreach($data_shuttle as $shuttle) { ?>
	<?php
			if($DC<$DateCount)
			{
				?>
				<?php
				if($DCu==="")
				{
					$DCu=$shuttle->Dates;
					?>
					<tr>
						<td><?php echo date('d M Y',strtotime($DCu)); ?></td>
					<?php
					$DC++;
					$PC=0;
					foreach($data_shuttle as $shuttle) 
					{ 
						if($PC<$PointCount AND $shuttle->Dates===$DCu)
						{
						?>
						<td><?php echo $shuttle->Count; ?></td>
						<?php
						$PC++;
						}
						if($PC==$PointCount)
						{
							?>
							<td><?php echo $shuttle->note; ?></td>
							</tr>
							<?php
							break;
						}
					}
				}
				else
				{
					if(strcmp($DCu,$shuttle->Dates)!=0)
					{
						$DCu=$shuttle->Dates;
						?>
						<tr>
							<td><?php echo date('d M Y',strtotime($DCu)); ?></td>
						<?php
						$DC++;
						$PC=0;
					foreach($data_shuttle as $shuttle) { 
						if($PC<$PointCount AND $shuttle->Dates===$DCu)
						{
						?>
						<td><?php echo $shuttle->Count; ?></td>
						
						<?php
						$PC++;
						}
						if($PC==$PointCount)
						{
							?>
							<td><?php echo $shuttle->note; ?></td>
							</tr>
							<?php
							break;
						}
					}
						
					}
				}
			}
			else{break;}
	?>
	<?php } ?>
</table>