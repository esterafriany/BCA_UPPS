<div class="col-md-13">

<script type="text/javascript">
$(function ()
{
	var duplicates = 0;
	$original = $('#Classes-Content').clone(true);

    function DuplicateForm ()
    {
        var newForm;
        if (duplicates==0)
        {
        duplicates=duplicates+2;
        }
        else
        {
        	duplicates++;
        }
        newForm = $original.clone(true).insertBefore($('h2'));
        $.each($('select', newForm), function(i, item)
        {
            $(item).attr('name', $(item).attr('name') + duplicates);
        });
    }
    var FileDuplicates = <?php Print($_SESSION["JumlahFile"]+1); ?>;
        $OriginalFile = $('.Files-Content').clone(true);
    function DuplicateFiles ()
    {
        var newFile;

        FileDuplicates++;
        newFile = $OriginalFile.clone(true).insertBefore($('h6'));
        $.each($('input', newFile), function(i, item)
        {
            $(item).attr('name', $(item).attr('name') + FileDuplicates);
        });
    }

    $('a[href="add-new-form"]').on('click', function (e)
    {
        e.preventDefault();
        DuplicateForm();
    });
    $('a[href="add-new-files"]').on('click', function (e)
    {
        e.preventDefault();
        DuplicateFiles();
    });
});
   function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}
   function incrementValue($date)
{
	var date = $date;
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}
function incrementFileNumber()
	{
		var value = document.getElementById('Filenumber').value
	    // var value = parseInt(document.getElementById('number').value, 10);
	    value = isNaN(value) ? 0 : value;
	    value++;
	    document.getElementById('Filenumber').value = value;
	    value=value;
	}
</script>
	<div class="panel">
		<div class="panel-body">
			<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Consumption">


			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Informasi Pemesanan</h3>
				</div>
				<div class="panel-body">
				<table>
					<tr>
						<td width="200px"><label>Program Name</label>  </td>
						<td>:<?php  echo $_SESSION["InputProgramName"]; ?>
						</td>
					</tr>
					<tr>
						<td><label>Angkatan</label></td>
						<td>:<?php echo $_SESSION["InputNamaAngkatan"]; ?></td>
					</tr>
					<tr>
						<td><label>Tanggal Pelatihan</label></td>
						<td>:<?php echo date("d M Y", strtotime($_SESSION["InputProgramMulai"])).' - '.date("d M Y", strtotime($_SESSION["InputProgramSelesai"])); ?></td>
					</tr>
					<tr>
						<td><label>PIC Program</label></td>
						<td>:<?php echo $_SESSION["InputPicProgram"]; ?></td>
					</tr>
				</table>
				</div>
			</div>

			<div class="panel panel-primary">
				<div id="Konsumsi" class="tabcontent">
					<div class="panel-heading">
						<h3 class="panel-title">Detail Pemesanan Konsumsi</h3>
					</div>
	<?php
	if ($this->input->post("Refreshes")!=null OR $this->input->get("Refreshes")!=null)
	{
	?>
		<body onload=""></body>
		<?php
		unset($_SESSION["Refresh"]);
	}
	 ?>
					<div class="panel-body">
						<div id="" class="sidebar-scroll">
							<?php
								date_default_timezone_set('UTC');
	$date = $_SESSION["InputAwalPemesanan"];
	$end_date = $_SESSION["InputAkhirPemesanan"];
								// var_dump($date);
								// var_dump($end_date);
								$i=1;

								while (strtotime($date) <= strtotime($end_date)){ ?>
									<h5 style="margin-top: 0px;margin-bottom: 3px;"><label><i class="fa fa-calendar"></i> &nbsp;<?php echo  date("d M Y", strtotime($date)); ?></label></h5>
									<table border="0" width="400px" style="margin-bottom:2px;">
<tr>
											<th width="200px" colspan="4"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Coffee Break Pagi </th>
										</tr>
										<tr>
											<?php if (isset($_SESSION['Consumption_type'.$date])) {
											for ($x=1; $x <= $_SESSION['JumlahPagi'.$date] ; $x++) {
												for ($y=1; $y <= $_SESSION["Jumlah".$date] ; $y++) {
													if ( isset($_SESSION['Consumption_type'.$date][$y]) AND
													strcmp($_SESSION['Consumption_type'.$date][$y], "Coffee Break Pagi")==0) { ?>
													<td align="right" width="150px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Jumlah : &nbsp;</td>
													<td align="center" >
														<input type="hidden" name="CoffeBreak_Pagi$date$y" disabled="disabled" class="form-control" value="<?=$_SESSION['Consumption_Amount'.$date][$y]?>"><?=$_SESSION['Consumption_Amount'.$date][$y]?>
													</td>
													<?php
													foreach ($Rooms as $key) {
													if ($key["RoomName"]==$_SESSION['ConsumptionRoom'.$date][$y]) { ?>
													<td align="right">&nbsp;Ruangan : &nbsp;</td>
													<td align="center">
														<input type="hidden" name="Ruangan_CoffeBreak_Pagi$date$y" disabled="disabled" class="form-control" value="<?=$key['RoomName']?>"><?=$key['RoomName']?>
													</td>
													<input type="hidden" name="IDRuanganCoffeBreak_Pagi$date" value="<?=$key['RoomID']?>">
													<?php
													}
													}
													?>
										</tr>
													<?php
													}
												}
												break;
											}
											}else{ ?>
													<td align="right" width="100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Jumlah : &nbsp;</td>
													<td align="center">-
														<input type="hidden" name="CoffeBreak_Siang$date$y" disabled="disabled" class="form-control" value="0">
													</td>
													<td align="right">&nbsp;Ruangan : &nbsp;</td>
													<td align="center">-
														<input type="hidden" name="Ruangan_CoffeBreak_Siang$date$y" disabled="disabled" class="form-control" value="">
													</td>
												</tr>
											<?php }?>

										<tr>
											<th colspan="4"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Makan Siang</th>
										</tr>
										<tr>
											<?php
											if (isset($_SESSION['Consumption_type'.$date])){
												for ($x=1; $x <= $_SESSION['JumlahLunch'.$date] ; $x++) {
													for ($y=1; $y <= $_SESSION["Jumlah".$date] ; $y++) {
														if (isset($_SESSION['Consumption_type'.$date][$y])
														AND
														strcmp($_SESSION['Consumption_type'.$date][$y], "Lunch")==0) { ?>
														<td align="right" width="100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Jumlah : &nbsp;</td>
														<td align="center">
															<input type="hidden" name="Lunch$date$y" disabled="disabled" class="form-control" value="<?=$_SESSION['Consumption_Amount'.$date][$y]?>" ><?=$_SESSION['Consumption_Amount'.$date][$y]?>

														</td>
														<?php foreach ($Rooms as $key)
														{
														if ($key["RoomName"]==$_SESSION['ConsumptionRoom'.$date][$y])
														{ ?>
																<td align="right">&nbsp;Ruangan : &nbsp;</td>
																<td align="center">
																	<input type="hidden" name="Ruangan_Lunch$date$y" disabled="disabled" class="form-control" value="<?=$key['RoomName']?>"><?=$key['RoomName']?>
																</td>
																<input type="hidden" name="IDRuanganLunch$date" value="<?=$key['RoomID']?>">
														<?php
														}
														}?>
										</tr>
													<?php }
													}
													break;
												}
											} else { ?>
											<tr>
												<td align="right" width="100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Jumlah : &nbsp;</td>
												<td align="center">-
													<input type="hidden" name="Lunch$date$y" disabled="disabled" class="form-control" value="0">
												</td>
												<td align="right">&nbsp;Ruangan : &nbsp;</td>
												<td align="center">-
													<input type="hidden" name="Ruangan_Lunch$date$y" disabled="disabled" class="form-control" value="" >
												</td>
											</tr>
											<?php } ?>
											<tr>
												<th colspan="3"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Coffee Break Siang</th>
											<tr>
											</tr>
												<?php
												if (isset($_SESSION['Consumption_type'.$date]))
												{
													for ($x=1; $x <= $_SESSION['JumlahSiang'.$date] ; $x++)
													{
														for ($y=1; $y <= $_SESSION["Jumlah".$date] ; $y++)
														{
															if (isset($_SESSION['Consumption_type'.$date][$y]) AND strcmp($_SESSION['Consumption_type'.$date][$y], "Coffee Break Siang")==0) { ?>
																<tr>
																	<td align="right" width="150px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Jumlah : &nbsp;</td>
																	<td align="center">
																		<input type="hidden" name="CoffeBreak_Siang$date$y" class="form-control" value="<?=$_SESSION['Consumption_Amount'.$date][$y]?>"><?=$_SESSION['Consumption_Amount'.$date][$y]?>
																	</td>
																	<?php
																	foreach ($Rooms as $key) {
																		if ($key["RoomName"]==$_SESSION['ConsumptionRoom'.$date][$y]) { ?>
																			<td align="right">&nbsp;Ruangan : &nbsp;</td>
																			<td align="center">
																				<input type="hidden" name="Ruangan_CoffeBreak_Siang$date$y" class="form-control" value="<?=$key['RoomName']?>" style="width: 80px;text-align:center;"><?=$key['RoomName']?>
																			</td>
																				<input type="hidden" name="IDRuanganCoffeBreak_Siang$date" value="<?=$key['RoomID']?>">

																		<?php
																		}
																	}?>
																</tr>
																<?php
															}
														}
														break;
													}
												}
												else
												{?>
													<tr>
														<td align="right" width="150px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Jumlah : &nbsp;</td>
														<td align="center">-
															<input type="hidden" name="CoffeBreak_Siang$date$y" disabled="disabled" class="form-control" value="0">
														</td>
														<td align="right">&nbsp;Ruangan : &nbsp;</td>
														<td align="center">-
															<input type="hidden" name="Ruangan_CoffeBreak_Siang$date$y" disabled="disabled" class="form-control">
														</td>
													</tr>
												<?php } ?>
											</tr>
											<tr style="text-align:right;">
												<td colspan="4" height="50px">
													<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?=$date?>" >Detail Konsumsi</button>
												</td>
											</tr>
									</table>
							<table border="0" width="100%" >
								<tr style="text-align:right;">
								</tr>
							</table>
									<?php
									$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
									echo "<br>";
									$i=$i+1;
								}
								?>
							 <br>
							 <br>
							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myFiles">Additional Information <i class="fa fa-paperclip"></i></button>
							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#setDefault">Set consumption Default <i class="fa fa-paperclip"></i></button>
							<br/>
							<br/>
							</div>
							
					</div>
					<!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myFiles">Additional Information <i class="fa fa-paperclip"></i></button> -->

				</div>
			</div>
			<table width="100%">
				<tr>
					<td align="right">
						<br>
						<button type="submit" name="Finish_Button" value="Tambahkan" class="btn btn-primary btn-lg">Submit <i class="fa fa-check"></i> </button>
					</td>
				</tr>
			</table>
		</div>

	<br>
	</form>
<style type="text/css">
.btn-circle {
width: 30px;
height: 30px;
text-align: center;
padding: 6px 0;
font-size: 12px;
line-height: 1.428571429;
border-radius: 15px;
}
.btn-circle.btn-lg {
width: 50px;
height: 50px;
padding: 10px 16px;
font-size: 18px;
line-height: 1.33;
border-radius: 25px;
}
.btn-circle.btn-xl {
width: 70px;
height: 70px;
padding: 10px 16px;
font-size: 24px;
line-height: 1.33;
border-radius: 35px;
}

</style>
<!--///////////////////////////////////////////////////////////////////////////////////////// -->

<?php
date_default_timezone_set('UTC');
	$date = $_SESSION["InputAwalPemesanan"];
	$end_date = $_SESSION["InputAkhirPemesanan"];
	$i=0;
	while (strtotime($date) <= strtotime($end_date))
	{
		if (isset($_SESSION['Jumlah'.$date]))
		{
		$next= $_SESSION['Jumlah'.$date]+1;
		}
		else
		{
			$next= 1;
		}

?>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal<?=$date?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Consumption</h4>
        </div>
<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Consumption">
        <div class="modal-body ">
                 <div  class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><?=$date?></h3>
					</div>
					<div class="panel-body">
				<table class="table table-hover">
						<tr>
						<td>
						<th><h5>Konsumsi:</h5></th>
						</td>
						<td>
							<select class="form-control" name="Consumption_type<?=$date?><?=$next?>">
		<option value="" disabled selected>Pilih Jenis Konsumsi</option>
		<option value="Coffee Break Pagi">Coffee Break Pagi</option>
		<option value="Lunch">Lunch</option>
		<option value="Coffee Break Siang">Coffee Break Siang</option>
							</select>
						</td>
						</tr>
						<tr>
						<td>
							<th><h5>Ruangan:</h5></th>
						</td>
						<td>
						<select required name="Room<?=$date?><?=$next?>" class="form-control" id="Room">
						<option value="" disabled selected>Pilih Ruangan</option>
								<?php
								foreach($Rooms as $new_item)
									{
										?>
										<option value="<?=$new_item['RoomName'] ?>">
										<?=$new_item['RoomName']?>
										</option>
								<?php
                        			}
                        			?>
                    		</select>
						</td>
						</tr>
						<tr>
						<td>
						<th><h5>Jumlah:</h5></th>
						</td>
						<td>
												<!-- <select  name="JumlahPeserta<?=$date?><?=$next?>" class="form-control">
						<?php
						// for ($i=0; $i <= $_SESSION["InputJumlahPeserta"]; $i++)
							{
								?>
								<option value="<?=$i?>"><?=$i?></option>
								<?php
							}
								?>
						</select> -->
						<input type="number" min=0 required name="JumlahPeserta<?=$date?><?=$next?>" class="form-control"></input>
						</td>
						</tr>
						</table>
						<div class="hidden">
<table class="table table-hover" id="Classes-Content">
						<tr>
						<td>
						<th><h5>Konsumsi:</h5></th>
						</td>
						<td>
							<select class="form-control" name="Consumption_type<?=$date?>">
		<option value="" disabled selected>Pilih Jenis Konsumsi</option>
		<option value="Coffee Break Pagi">Coffee Break Pagi</option>
		<option value="Lunch">Lunch</option>
		<option value="Coffee Break Siang">Coffee Break Siang</option>
							</select>
						</td>
						</tr>
						<tr>
						<td>
							<th><h5>Ruangan:</h5></th>
						</td>
						<td>
						<select name="Room<?=$date?>" class="form-control" id="Room">
						<option value="" disabled selected>Pilih Ruangan</option>
								<?php
								foreach($Rooms as $new_item)
									{
										?>
										<option value="<?=$new_item['RoomName'] ?>">
										<?=$new_item['RoomName']?>
										</option>
								<?php
                        			}
                        			?>
                    		</select>
						</td>
						</tr>
						<tr>
						<td>
						<th><h5>Jumlah:</h5></th>
						</td>
						<td>
						<select name="JumlahPeserta<?=$date?>" class="form-control">
						<option value="0" disabled selected>0</option>
						<?php
						for ($i=1; $i <= $_SESSION["InputJumlahPeserta"]; $i++)
							{
								?>
								<option value=<?=$i?>><?=$i?></option>
								<?php
							}
								?>
						</select>
						</td>
						</tr>
</table>
</div>
<input type="hidden" name="Flags" value="Flagged">
							<br>
					</div>
				</div>
	 <div class="modal-footer">
	 <input type="hidden" name="Jumlah<?=$date?>" id="number" value=<?=$next?>>
	 	   <input type="hidden" name="Refreshes" value="Refresh">
  <input type="submit" name="Consumption_Button" value="ADD" class="btn btn-primary btn-sm" />
     </div>
     </div>

        </form>
      </div>

    </div>
  </div>
</div>
<?php
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                echo "<br>";
                $i=$i+1;
}
?>
  <div class="container">
  <?php
  $files = glob('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Konsumsi_F/*');
  ?>
  <!-- Modal -->
  <div class="modal fade" id="myFiles" role="dialog">
    <div class="modal-dialog">
    <?php
    $nextFile= $_SESSION["JumlahFile"]+1;
     ?>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Attach File Pemesanan Konsumsi</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Consumption" enctype="multipart/form-data">
        <div class="modal-body">
        <table class="table table-hover">
        	<tr>
        		<th>Uploaded Files</th>
        	</tr>
        		<?php
        		if ($_SESSION["JumlahFile"]<1)
        		{
        			?>
        			<tr>
        			<td><h1>NO DATA</h1></td>
        			</tr>
        			<?php
        		}
        		else
        		{

        			for ($i=0; $i < $_SESSION["JumlahFile"] ; $i++)
        			{
        			?>
        			<tr>
	        			<td>
	        			<?php
	        			$namaFile =str_replace('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Konsumsi_F/','',$files[$i]);
	        			 ?>
								 <a href="<?= base_url() ?>Koor/remove_file?file=Konsumsi_F&From=ADD&filename=<?=$namaFile?>&NP=<?=$_SESSION["InputProgramName"];?>&AK=<?=$_SESSION["InputNamaAngkatan"]?>&Refreshes=Refresh" class="close" style="cursor: pointer; color: red;">&times;</a>
								<input type="text" disabled name="filename" class="form-control" value=<?=$namaFile?>>

	        			</td>
	        		</tr>
	        			<?php
	        			 ?>
        			<?php
    	    		}
        		}
        		?>
        		<input type="hidden" name="File_Path" class="form-control">
        </table>
        <table>
        <tr>
        <input type="File" name="userfile<?=$nextFile?>" class="form-control">
        </tr>
        </table>
        <center>
		<h6>
		<input type="hidden" id="Filenumber" name="JumlahFile" value=<?=$_SESSION["JumlahFile"]+1?> />
		<a href="add-new-files" onclick="incrementFileNumber();" class="btn btn-primary btn-sm" style="margin-left: 13cm">
		<i class="fa fa-plus"></i>
		</a>
		</h6>
		</center>
		<label>Note (Optional):</label>
		<?php

		if (isset($_SESSION["Consumption_Notes"]))
		{
			?>
			<input type="text" class="form-control" placeholder="Notes" name="Consumption_Notes" value=<?=$_SESSION["Consumption_Notes"]?> >
			<?php
		}
		else
		{
			?>
			<input type="text" class="form-control" placeholder="Notes" name="Consumption_Notes">
			<?php
		}
			?>
		</div>


	 <div class="modal-footer">
	 <input type="hidden" name="Refreshes" value="Refresh">
		<input type="submit" name="Consumption_Button" value="ADD" class="btn btn-primary btn-lg" style="padding-left: 45%; padding-right: 50%;" />
     </div>
	 </form>
     </div>
      </div>

    </div>
  </div>
<div class="hidden">
        	<div class="Files-Content">
        	<tr>
        	<input type="File" name="userfile" class="form-control">
        	</tr>
        	</div>
</div>
<div class="container">
	<div class="modal fade" id="setDefault" role="dialog">
		<div class="modal-dialog modal-md ">
			<div class="modal-content">
				<div class="modal-header" style="background-color:#D1DBDD;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><center>Set Default</center></h4>
				</div>
				<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Consumption">
					<div class="modal-body" id="app">
						<table class="table table-hover">
							<tr>
								<td>Dimulai</td><td><input type="date" name="Default-TanggalAwal" class="form-control" value="<?=$_SESSION["InputAwalPemesanan"]?>"></td>
								<td>Hingga</td><td><input type="date" name="Default-TanggalAkhir" class="form-control" value="<?=$_SESSION["InputAkhirPemesanan"]?>"></td>
							</tr>
							<tr>
								<td colspan=2>Coffee Break Pagi</td>
								<td><input type="number" class="form-control" name="DefaultMorningCoffee" value="0" min=0 require></td>
								<td>
									<select required name="DefaultMorningRoom" class="form-control" id="Room">
									<option value="" disabled selected>Pilih Ruangan</option>
									<?php
										foreach($Rooms as $new_item)
										{
									?>
										<option value="<?=$new_item['RoomName'] ?>">
										<?=$new_item['RoomName']?>
										</option>
									<?php
										}
                        			?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan=2>Lunch</td>
								<td ><input type="number" class="form-control" name="DefaultLunch" value="0" min=0 require></td>
								<td>
									<select required name="DefaultLunchRoom" class="form-control" id="Room">
									<option value="" disabled selected>Pilih Ruangan</option>
									<?php
										foreach($Rooms as $new_item)
										{
									?>
										<option value="<?=$new_item['RoomName'] ?>">
										<?=$new_item['RoomName']?>
										</option>
									<?php
										}
                        			?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan=2>Coffee Break Siang</td>
								<td ><input type="number" class="form-control" name="DefaultNoonCoffee" value="0" min=0 require></td>
								<td>
									<select required name="DefaultNoonRoom" class="form-control" id="Room">
									<option value="" disabled selected>Pilih Ruangan</option>
									<?php
										foreach($Rooms as $new_item)
										{
									?>
										<option value="<?=$new_item['RoomName'] ?>">
										<?=$new_item['RoomName']?>
										</option>
									<?php
										}
                        			?>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<div class="modal-footer" style="background-color:#D1DBDD;">
					<?php $_SESSION['IsDefault']="true"?>
					<!-- <input type="text" class="hidden"  name="IsDefault" value="true"> -->
					<button type="submit" name="Consumption_Button" class="btn btn-primary">Set as Default</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>