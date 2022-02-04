 <?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
$row=0;
	foreach($CountRow as $Order)
	{
		$row = $Order->JumlahProgram;
	}
 ?>
 
 <table>
 <!-- <?php echo($_SESSION["RESULT0"])?> -->
	<tr>
		<td colspan="3"><b>REKAPITULASI PEMESANAN KONSUMSI PESERTA TRAINING</b></td>
	</tr>
	<tr>
		<td colspan="3"><b>Periode: <?php $d = date("d M Y", strtotime($date_from));echo $d; ?> - <?php $d = date("d M Y", strtotime($date_to)); echo $d; ?></b>
		</td>
	</tr>
 </table>
 
 <table border=1>
	<tr>
		<td rowspan='3'>No</td>
		<td rowspan='3'>Nama Program</td>
		<!--Tanggal  -->
		<?php
			date_default_timezone_set('UTC');
			$date = $this->input->post('date_from');
			$end_date = $this->input->post('date_to');
			while (strtotime($date) <= strtotime($end_date))
			{
		?>
		<!--LOOP TANGGAL-->
		<td colspan='6'><?=$date?></td>
		<?php
		$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
			}
		?>
		<td colspan='3'>Total</td>
	</tr>
	<tr>
	
	<?php
		date_default_timezone_set('UTC');
		$date = $this->input->post('date_from');
		$end_date = $this->input->post('date_to');
		while (strtotime($date) <= strtotime($end_date))
		{
			// $Konsumsi = new stdClass();
			// $Konsumsi->$date = array 
			// (
			// 	array("Coffee Break Pagi",5),
			// 	array("Lunch",15),
			// 	array("Coffee Break Siang",51)
			// );
			
	?>
	<!--LOOP TANGGAL-->
	<td colspan=2>Coffee Break Pagi</td>
	<?php

//    var_dump($Konsumsi->$date);
//    print_r($Konsumsi->$date);
	?>
	<td colspan=2>Lunch</td>
	<td colspan=2>Coffee Break Siang</td>
	<?php
	$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
	?>
	<td rowspan=2>Snack</td>
	<td rowspan=2>Lunch</td>
	<td rowspan=2>Total Harga</td>
	</tr>
	<tr>
		<?php
		date_default_timezone_set('UTC');
		$date = $this->input->post('date_from');
		$end_date = $this->input->post('date_to');
		while (strtotime($date) <= strtotime($end_date))
		{
			// $Konsumsi = new stdClass();
			// $Konsumsi->$date = array 
			// (
			// 	array("Coffee Break Pagi",5),
			// 	array("Lunch",15),
			// 	array("Coffee Break Siang",51)
			// );
			for($o=0;$o<3;$o++)
			{
	?>
	<!--LOOP TANGGAL-->
	<td>Jumlah</td>
	<td>Ruangan</td>
	<?php
			}
	$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
	?>
	</tr>
	<?php
	if($row==0)
	{
		?>
		<h1>Empty</h1>
		<?php
	}
	else
	{
		$PreviousProgram="";
		$Created_Rows=0;
		$filler=0;
		$sumSnack=0;$sumLunch=0;
		foreach($data_konsumsi as $data)
		{
			if(strcmp($PreviousProgram,"")==0)
			{
				$PreviousProgram=$data->nama_program;
				?>
				<tr>
				<td><?=$Created_Rows+1?></td>
				<td><?=$PreviousProgram?></td>
				<?php
				$Created_Rows++;
				date_default_timezone_set('UTC');
				$date = $this->input->post('date_from');
				$end_date = $this->input->post('date_to');
				
				while (strtotime($date) <= strtotime($end_date))
				{
					$countPagi=0;$countLunch=0;$countSiang=0;
					foreach($data_konsumsi as $dataConten)
					{
						if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
						{
							if(strcmp($dataConten->tanggal,$date)==0)
							{
								if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Pagi")==0)
								{
								$countPagi++;
								}
								if(strcmp($dataConten->JenisKonsumsi,"Lunch")==0)
								{
								$countLunch++;
								}
								if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Siang")==0)
								{
								$countSiang++;
								}
							}
						}
						
					}

					if($countPagi>1)
					{
						$dataPagi[][]=null;
						$dataRuanganPagi[][]=null;
						$i=0;
						foreach($data_konsumsi as $dataContenPagi)
						{
							if(strcmp($dataContenPagi->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataContenPagi->tanggal,$date)==0)
								{
									if(strcmp($dataContenPagi->JenisKonsumsi,"Coffee Break Pagi")==0)
									{
										$dataPagi[$date][$i]=$dataContenPagi->JumlahKonsumsi;
										$dataRuanganPagi[$date][$i]=$dataContenPagi->Ruangan;
										$i++;
										if($i==$countPagi)
										{
											break;
										}
									}
								}
							}
						}
						?>
						<td>
						<?php
						for($o=0;$o<$countPagi;$o++) 
						{
							echo($dataPagi[$date][$o].'<BR>');
							$sumSnack+=$dataPagi[$date][$o];
						}
						?>
						</td>
						<td>
						<?php
						for($o=0;$o<$countPagi;$o++) 
						{
							echo($dataRuanganPagi[$date][$o].'<BR>');
						}
						?>
						</td>
						<?php
						$countPagi=0;
					}
					else if($countPagi>0)
					{
						foreach($data_konsumsi as $dataConten)
						{
							if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataConten->tanggal,$date)==0)
								{
									if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Pagi")==0)
									{
									?>
									<td><?=$dataConten->JumlahKonsumsi?></td>
									<?php $sumSnack+= $dataConten->JumlahKonsumsi?>
									<td><?=$dataConten->Ruangan?></td>
									<?php
									}
								}
							}
						}
					}
					else
					{
						for($blank=0;$blank<2;$blank++)
						{
						?>
							<td></td>
						<?php
						}
					}

					if($countLunch>1)
					{
						$dataLunch[][]=null;
						$dataRuanganLunch[][]=null;
						$i=0;
						foreach($data_konsumsi as $dataContenLunch)
						{
							if(strcmp($dataContenLunch->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataContenLunch->tanggal,$date)==0)
								{
									if(strcmp($dataContenLunch->JenisKonsumsi,"Lunch")==0)
									{
										$dataLunch[$date][$i]=$dataContenLunch->JumlahKonsumsi;
										$dataRuanganLunch[$date][$i]=$dataContenLunch->Ruangan;
										$i++;
										if($i==$countLunch)
										{
											break;
										}
									}
								}
							}
						}
						?>
						<td>
						<?php
						for($o=0;$o<$countLunch;$o++) 
						{
							echo($dataLunch[$date][$o].'<BR>');
							$sumLunch+=$dataLunch[$date][$o];
						}
						?>
						</td>
						<td>
						<?php
						for($o=0;$o<$countLunch;$o++) 
						{
							echo($dataRuanganLunch[$date][$o].'<BR>');
						}
						?>
						</td>
						<?php
						$countLunch=0;
					}
					elseif($countLunch>0)
					{
						foreach($data_konsumsi as $dataConten)
						{
							if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataConten->tanggal,$date)==0)
								{
									if(strcmp($dataConten->JenisKonsumsi,"Lunch")==0)
									{
									?>
									<td><?=$dataConten->JumlahKonsumsi?></td>
									<?php
									$sumLunch+=$dataConten->JumlahKonsumsi
									?>
									<td><?=$dataConten->Ruangan?></td>
									<?php
									}
								}
							}
						}
					}
					else
					{
						for($blank=0;$blank<2;$blank++)
						{
						?>
							<td></td>
						<?php
						}
					}

					if($countSiang>1)
					{
						$dataSiang[][]=null;
						$dataRuanganSiang[][]=null;
						$i=0;
						foreach($data_konsumsi as $dataContenSiang)
						{
							if(strcmp($dataContenSiang->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataContenSiang->tanggal,$date)==0)
								{
									if(strcmp($dataContenSiang->JenisKonsumsi,"Coffee Break Siang")==0)
									{
										$dataSiang[$date][$i]=$dataContenSiang->JumlahKonsumsi;
										$dataRuanganSiang[$date][$i]=$dataContenSiang->Ruangan;
										$i++;
										if($i==$countSiang)
										{
											break;
										}
									}
								}
							}
						}
						?>
						<td>
						<?php
						for($o=0;$o<$countSiang;$o++) 
						{
							echo($dataSiang[$date][$o].'<BR>');
							$sumSnack+=$dataSiang[$date][$o];
						}
						?>
						</td>
						<td>
						<?php
						for($o=0;$o<$countSiang;$o++) 
						{
							echo($dataRuanganSiang[$date][$o].'<BR>');
						}
						?>
						</td>
						<?php
						$countSiang=0;
					}
					elseif($countSiang>0)
					{
						foreach($data_konsumsi as $dataConten)
						{
							if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataConten->tanggal,$date)==0)
								{
									if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Siang")==0)
									{
									?>
									<td><?=$dataConten->JumlahKonsumsi?></td>
									<?php
									$sumSnack+=$dataConten->JumlahKonsumsi
									?>
									<td><?=$dataConten->Ruangan?></td>
									<?php
									}
								}
							}
						}
					}
					else
					{
						for($blank=0;$blank<2;$blank++)
						{
						?>
							<td></td>
						<?php
						}
					}

					if($date==$this->input->post('date_to'))
					{
						?>
						<td><?=$sumSnack?></td>
						<td><?=$sumLunch?></td>
						<td>
						<?php
						$angka = ($sumSnack*17000)+($sumLunch*51000);
						$CurrencyFormat = "Rp " . number_format($angka,2,',','.');
						echo($CurrencyFormat);
						?>
						</td>
						<?php
					}
					$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
					
				}
			}
			elseif(strcmp($PreviousProgram,"")!=0 AND strcmp($PreviousProgram,$data->nama_program)!=0)
			{
				$PreviousProgram=$data->nama_program;
				?>
				<tr>
				<td><?=$Created_Rows+1?></td>
				<td><?=$PreviousProgram?></td>
				<?php
				$Created_Rows++;
				date_default_timezone_set('UTC');
				$date = $this->input->post('date_from');
				$end_date = $this->input->post('date_to');
				
				while (strtotime($date) <= strtotime($end_date))
				{
					$countPagi=0;$countLunch=0;$countSiang=0;
					foreach($data_konsumsi as $dataConten)
					{
						if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
						{
							if(strcmp($dataConten->tanggal,$date)==0)
							{
								if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Pagi")==0)
								{
								$countPagi++;
								}
								if(strcmp($dataConten->JenisKonsumsi,"Lunch")==0)
								{
								$countLunch++;
								}
								if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Siang")==0)
								{
								$countSiang++;
								}
							}
						}
						
					}

					if($countPagi>1)
					{
						$dataPagi[][]=null;
						$dataRuanganPagi[][]=null;
						$i=0;
						foreach($data_konsumsi as $dataContenPagi)
						{
							if(strcmp($dataContenPagi->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataContenPagi->tanggal,$date)==0)
								{
									if(strcmp($dataContenPagi->JenisKonsumsi,"Coffee Break Pagi")==0)
									{
										$dataPagi[$date][$i]=$dataContenPagi->JumlahKonsumsi;
										$dataRuanganPagi[$date][$i]=$dataContenPagi->Ruangan;
										$i++;
										if($i==$countPagi)
										{
											break;
										}
									}
								}
							}
						}
						?>
						<td>
						<?php
						for($o=0;$o<$countPagi;$o++) 
						{
							echo($dataPagi[$date][$o].'<BR>');
							$sumSnack+=$dataPagi[$date][$o];
						}
						?>
						</td>
						<td>
						<?php
						for($o=0;$o<$countPagi;$o++) 
						{
							echo($dataRuanganPagi[$date][$o].'<BR>');
						}
						?>
						</td>
						<?php
						$countPagi=0;
					}
					elseif($countPagi>0)
					{
						foreach($data_konsumsi as $dataConten)
						{
							if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataConten->tanggal,$date)==0)
								{
									if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Pagi")==0)
									{
									?>
									<td><?=$dataConten->JumlahKonsumsi?></td>
									<?php $sumSnack+= $dataConten->JumlahKonsumsi?>
									<td><?=$dataConten->Ruangan?></td>
									<?php
									}
								}
							}
						}
					}
					else
					{
						for($blank=0;$blank<2;$blank++)
						{
						?>
							<td></td>
						<?php
						}
					}

					if($countLunch>1)
					{
						$dataLunch[][]=null;
						$dataRuanganLunch[][]=null;
						$i=0;
						foreach($data_konsumsi as $dataContenLunch)
						{
							if(strcmp($dataContenLunch->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataContenLunch->tanggal,$date)==0)
								{
									if(strcmp($dataContenLunch->JenisKonsumsi,"Lunch")==0)
									{
										$dataLunch[$date][$i]=$dataContenLunch->JumlahKonsumsi;
										$dataRuanganLunch[$date][$i]=$dataContenLunch->Ruangan;
										$i++;
										if($i==$countLunch)
										{
											break;
										}
									}
								}
							}
						}
						?>
						<td>
						<?php
						for($o=0;$o<$countLunch;$o++) 
						{
							echo($dataLunch[$date][$o].'<BR>');
							$sumLunch+=$dataLunch[$date][$o];
						}
						?>
						</td>
						<td>
						<?php
						for($o=0;$o<$countLunch;$o++) 
						{
							echo($dataRuanganLunch[$date][$o].'<BR>');
						}
						?>
						</td>
						<?php
						$countLunch=0;
					}
					elseif($countLunch>0)
					{
						foreach($data_konsumsi as $dataConten)
						{
							if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataConten->tanggal,$date)==0)
								{
									if(strcmp($dataConten->JenisKonsumsi,"Lunch")==0)
									{
									?>
									<td><?=$dataConten->JumlahKonsumsi?></td>
									<?php
									$sumLunch+=$dataConten->JumlahKonsumsi
									?>
									<td><?=$dataConten->Ruangan?></td>
									<?php
									}
								}
							}
						}
					}
					else
					{
						for($blank=0;$blank<2;$blank++)
						{
						?>
							<td></td>
						<?php
						}
					}

					if($countSiang>1)
					{
						$dataSiang[][]=null;
						$dataRuanganSiang[][]=null;
						$i=0;
						foreach($data_konsumsi as $dataContenSiang)
						{
							if(strcmp($dataContenSiang->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataContenSiang->tanggal,$date)==0)
								{
									if(strcmp($dataContenSiang->JenisKonsumsi,"Coffee Break Siang")==0)
									{
										$dataSiang[$date][$i]=$dataContenSiang->JumlahKonsumsi;
										$dataRuanganSiang[$date][$i]=$dataContenSiang->Ruangan;
										$i++;
										if($i==$countSiang)
										{
											break;
										}
									}
								}
							}
						}
						?>
						<td>
						<?php
						for($o=0;$o<$countSiang;$o++) 
						{
							echo($dataSiang[$date][$o].'<BR>');
							$sumSnack+=$dataSiang[$date][$o];
						}
						?>
						</td>
						<td>
						<?php
						for($o=0;$o<$countSiang;$o++) 
						{
							echo($dataRuanganSiang[$date][$o].'<BR>');
						}
						?>
						</td>
						<?php
						$countSiang=0;
					}
					elseif($countSiang>0)
					{
						foreach($data_konsumsi as $dataConten)
						{
							if(strcmp($dataConten->nama_program,$PreviousProgram)==0)
							{
								if(strcmp($dataConten->tanggal,$date)==0)
								{
									if(strcmp($dataConten->JenisKonsumsi,"Coffee Break Siang")==0)
									{
									?>
									<td><?=$dataConten->JumlahKonsumsi?></td>
									<?php
									$sumSnack+=$dataConten->JumlahKonsumsi
									?>
									<td><?=$dataConten->Ruangan?></td>
									<?php
									}
								}
							}
						}
					}
					else
					{
						for($blank=0;$blank<2;$blank++)
						{
						?>
							<td></td>
						<?php
						}
					}

					if($date==$this->input->post('date_to'))
					{
						?>
						<td><?=$sumSnack?></td>
						<td><?=$sumLunch?></td>
						<td>
						<?php
						$angka = ($sumSnack*17000)+($sumLunch*51000);
						$CurrencyFormat = "Rp " . number_format($angka,2,',','.');
						echo($CurrencyFormat);
						?>
						</td>
						<?php
					}
					$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
					
				}
			}
			if($row==$Created_Rows)
			{
				?>
				<script>
				console.log("tes")	
				</script>
				<?php
				break;
			}
		}
	}

		?>
 </table>