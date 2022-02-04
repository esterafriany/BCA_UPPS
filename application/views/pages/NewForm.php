<div class="col-md-13">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">FORM PEMESANAN BARU</h3>

		</div>
		<div class="panel-body">
		<?php
				if (isset($_SESSION["Warning"]))
				{
					if (strcmp($_SESSION["Warning"], "Kosong")!==0)
					{
					?>
						<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						   <?=$_SESSION["Warning"]?>
						</div>
					<?php
					}
				}
			 ?>
		<div class="panel panel-default">
			<div class="panel-body">
			<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan">
				<table border="0" width="100%">
					<tr>
						<td width="20%"><label>Nama Program</label></td>
						<td width="1%" height="40px">:</td>
						<td>
							<div class="dropdown">
								<a id="dLabel" role="button" data-toggle="dropdown" class="btn" data-target="#" href="" style="width:250px;text-align: left;padding-left: 15px;color: black;">
									<?php
										if( empty($_SESSION["InputProgramName"]))
										{
											echo "Program";
										}
										else
										{
											echo $_SESSION["InputProgramName"];
										}
									?>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
									<li>
										<?php foreach($Programs as $program)
											{
												if($program['ProgramID']!=0)
												{
										?>
											<input required type="hidden" name="ProgramID" value=<?=$program['ProgramID']?>>
											<a href="<?php echo base_url("Koor/go_adds?tipe=NewForm2&ProgramID=$program[ProgramID]&ProgramName=$program[ProgramName]");?>">
											<?=$program['ProgramName'];?>
											</a>
											<?php
												}
											?>
										<?php
											}
										?>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td><label>Angkatan</label></td>
						<td width="1%" height="40px">:</td>
						<td>
							<div class="dropdown">
								<a id="dLabel" role="button" data-toggle="dropdown" class="btn" data-target="#" href="" style="width:250px;text-align: left;padding-left: 15px;color: black;">
								<?php
									if( empty($_SESSION['InputNamaAngkatan']))
										{
											echo "Angkatan";
										}
										else
										{
											echo $_SESSION['InputNamaAngkatan'];
										}
								?>
										<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
											<li>
								<?php foreach($Angkatans as $angkatan)
									{
										if($angkatan['AngkatanID']!=0)
										{
								?>
											<input required type="hidden" name="AngkatanID" value=<?=$angkatan['AngkatanID']?>>
											<a href="<?php echo base_url("Koor/go_adds?tipe=NewForm3&ProgramID=$_SESSION[InputProgramID]&ProgramName=$_SESSION[InputProgramName]&AngkatanID=$angkatan[AngkatanID]&NamaAngkatan=$angkatan[NamaAngkatan]");?>">
											<?=$angkatan['NamaAngkatan'];?>
											</a>
									<?php
										}
									?>
								<?php
									}
								?>
											</li>
								</ul>
							</div>
						</td>
					</tr>
					<!-- 25-Jul-17 -->
					<!-- <tr>
						<td><label>Program Dimulai</label></td>
						<td width="1%" height="40px">:</td>
						<td> -->
							<?php
							foreach ($angkatans as $key)
							{
							?>
							<input required type="date" class="hidden" name="ProgramDimulai" value=<?=$key['ProgramMulai']?> disabled="disabled" class="form-control" style="width:250px;text-align: left;">
							<input required type="hidden" name="ProgramDimulai" value=<?=$key['ProgramMulai']?> >
							<?php
							}
							?>
						<!-- </td>
					</tr> -->
					<!-- <tr>
						<td><label>Program Selesai</label></td>
						<td width="1%" height="40px">:</td>
						<td> -->
							<?php
							foreach ($angkatans as $key)
							{
							?>
							<input required type="date" class="hidden" name="ProgramSelesai" value=<?=$key['ProgramSelesai']?> disabled="disabled" class="form-control" style="width:250px;text-align: left;">
							<input required type="hidden" name="ProgramSelesai" value=<?=$key['ProgramSelesai']?> >
							<?php
							}
							?>
						<!-- </td>
					</tr> -->

					<tr>
						<td><label>Tanggal Awal Pemesanan</label></td>
						<td width="1%" height="40px">:</td>
						<td><input required type="date" name="AwalPemesanan" class="form-control" style="width:250px"></td>
					</tr>
					<tr>
						<td><label>Tanggal Akhir Pemesanan</label></td>
						<td width="1%" height="40px">:</td>
						<td><input required type="date" name="AkhirPemesanan" class="form-control" style="width:250px"></td>
					</tr>
					<tr>
						<td><label>Jumlah Peserta</label></td>
						<td width="1%" height="40px">:</td>
						<td><input required type="number" min=0 name="JumlahPeserta" class="form-control" style="width:250px"></td>
					</tr>
					<tr>
						<td><label>PIC Program</label></td>
						<td width="1%" height="40px">:</td>
						<td>
							<input required type="text" class="form-control" placeholder="text field" name="picProgram" style="width:250px">
							<?php
							foreach ($Pemesanan as $key)
							{
							?>
								<input required type="hidden" name="NextPemesananID" value=<?php echo $key["PemesananID"] +1?>>
							<?php
							}
							 ?>
						</td>
					</tr>

				</table>
			
			</div>
			<div class="panel-footer" style="text-align: right;padding-right: 10px;">
				<button type="submit" name="Next_Button" class="btn btn-primary btn-lg	" />Selanjutnya <i class="fa fa-arrow-circle-right"></i> </button>
			</div>
		</div>
		</div>

	</div>
</div>
</form>
