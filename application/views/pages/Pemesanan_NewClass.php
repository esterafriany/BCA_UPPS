<div class="col-md-13">
	<div class="panel">
	<div class="panel-body">
<script type="text/javascript">
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 5){							// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}
	else
	{
		 alert("Maximum Input is 5.");
	}
}

function deleteRow(tableID)
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if (rowCount > 1)
	{
		var i = rowCount-1;
		table.deleteRow(i);
	}
	else
	{
		alert("Minimum Input Reached (1).");
	}
}
$(function ()
{
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
    $('a[href="add-new-row"]').on('click', function (e)
    {
        e.preventDefault();
        addRow('dataTable');
    });
    $('a[href="delete-row"]').on('click', function (e)
    {
        e.preventDefault();
        deleteRow('dataTable')
    });
    $('a[href="add-new-files"]').on('click', function (e)
    {
        e.preventDefault();
        DuplicateFiles();
    });

});

function myFunction()
{
    var button = document.getElementById('clickButton');
    button.click();
}

function incrementValue()
	{
		var value = document.getElementById('number').value
	    value = isNaN(value) ? 0 : value;
	    value++;
	    document.getElementById('number').value = value;
	    value=value;
	}
function subtractionValue()
	{
		var value = document.getElementById('number').value
	    // var value = parseInt(document.getElementById('number').value, 10);
	    value = isNaN(value) ? 0 : value;
	    value--;
	    document.getElementById('number').value = value;
	    value=value;
	}
function incrementFileNumber()
	{
		var value = document.getElementById('Filenumber').value
	    value = isNaN(value) ? 0 : value;
	    value++;
	    document.getElementById('Filenumber').value = value;
	    value=value;
	}
</script>
<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan" enctype="multipart/form-data">
<center>
		<div class="row">
			<div class="col-xs-11">
				<ul class="nav nav-pills nav-justified thumbnail" style="border: 1px solid rgba(255, 255, 255, 0);">
					<li>
					<button id="clickButton" type="submit" type="submit" name="Class_Button" value="Kelas" class="btn btn-primary btn-circle btn-xl"><i class="lnr lnr-store"></i>
					</button> Kelas
					</li>

					<li class="active">
						<button type="submit" name="Consumption_Button" value="Konsumsi" class="btn btn-primary btn-circle btn-xl"><i class="lnr lnr-dinner"></i>
						</button>    Konsumsi
					</li>
					<li>
						<button type="submit" name="Hotel_Button" value="Hotel" class="btn btn-primary btn-circle btn-xl"><i class="lnr lnr-apartment"></i>
						</button> Hotel
					</li>
					<li>
						<button type="submit" name="Shuttle_Button" value="ShuttleBus" class="btn btn-primary btn-circle btn-xl"><i class="lnr lnr-bus"></i>
						</button> Shuttle Bus

					</li>
					<li>
						<button type="submit" name="Airport_Button" value="Airport'Bus" class="btn btn-primary btn-circle btn-xl"><i class="lnr lnr-train"></i>
						</button> Bus Bandara
					</li>
				</ul>
			</div>
		</div>
</center>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Pemesanan</h3>
	</div>
	<div class="panel-body">
		<table>
			<tr>
				<td width="150px"><label>Program Name</label>  </td>
				<td width="10px">:</td>
				<td><?php  echo $_SESSION["InputProgramName"]; ?> </td>
			</tr>
			<tr>
				<td><label>Angkatan</label></td>
				<td width="10px">:</td>
				<td><?php echo $_SESSION["InputNamaAngkatan"]; ?></td>
			</tr>
			<tr>
				<td><label>Tanggal Pelatihan</label></td>
				<td width="10px">:</td>
				<td>
					<?php
					$TglMulai = $_SESSION["InputProgramMulai"];
					$newTglMulai = date("d M Y", strtotime($TglMulai));

					$TglSelesai = $_SESSION["InputProgramSelesai"];
					$newTglSelesai = date("d M Y", strtotime($TglSelesai));

					echo $newTglMulai.' - '.$newTglSelesai; ?>
				</td>
			</tr>
			<tr>
				<td><label>PIC Program</label></td>
				<td width="10px">:</td>
				<td><?php echo $_SESSION["InputPicProgram"]; ?></td>
			</tr>
		</table>
	</div>
</div>

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

<div class="panel panel-primary">
<div id="Kelas">
	<div class="panel-heading">
	<h3 class="panel-title">Detail Pemesanan Kelas</h3>
	</div>
	<?php
	if ($this->input->post("Refreshes")!=null OR $this->input->get("Refreshes")!=null)
	{
	?>
		<body onload="myFunction()"></body>
		<?php
		unset($_SESSION["Refresh"]);
	}
	 ?>
			<div class="panel-body">
			<div class="content">
			<table class="table table-hover" style="text-align: left;">
				<div class="Classes">
					<tr style="text-align: center;">
						<td><label>Jumlah Peserta:</label></td>
						<td><label>Ruangan:</label></td>
						<td><label>Layout :</label></td>
					</tr>
					<?php
				if($_SESSION["JumlahRuanganKelas"]>0)
				{
					for ($i=1; $i <= $_SESSION["JumlahRuanganKelas"]; $i++)
					{
					?>
					<tr style="text-align: center;">
						<td>
							<?=$_SESSION['JumlahPeserta'][$i]?>
							<input type="hidden" style="text-align: center;background-color:#ffffff;border-color:#ffffff;" name="JumlahPeserta$i"  disabled="disabled" class="form-control" value=<?=$_SESSION['JumlahPeserta'][$i]?>>
						</td>
						<td>
							<?=$_SESSION['RoomID'][$i]?>
							<input type="hidden" style="text-align: center;background-color:#ffffff;border-color:#ffffff;" name="RoomID$i" disabled="disabled" class="form-control" value=<?=$_SESSION['RoomID'][$i]?>>
						</td>
						<td>
							<?=$_SESSION["Layout"][$i]?>
							<input type="hidden" style="text-align: center;background-color:#ffffff;border-color:#ffffff;" name="Class_Layout$i" disabled="disabled" class="form-control" value=<?=$_SESSION["Layout"][$i]?>>
						</td>
					</tr>
					<?php
					}
				}
				else
				{
					?>
					<tr>
						<td><input type="hidden" name="" disabled="disabled" class="form-control"></td>
						<td><input type="hidden" name="" disabled="disabled" class="form-control"></td>
						<td><input type="hidden" name="" disabled="disabled" class="form-control"></td>
					</tr>
					<?php
				}
					?>
				</div>
			</table>
			<table width="100%" border=0>
				<tr>
					<td align="right">
						<a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></a>
					</td>

				</tr>
			</table>
				</div>
				 <br>
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myFiles">Additional Information <i class="fa fa-paperclip"></i></button>
			</div>
</div>

</div>
<table width="100%">
	<tr>
		<td align="right">
		<button type="submit" name="Finish_Button" value="Submit" class="btn btn-primary btn-lg">Submit <i class="fa fa-check"></i> </button>

		</td>
	</tr>
</table>

</form>
  <div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <?php
     ?>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Pemesanan Kelas</h4>
        </div>
		<form id="Classes-Content" method="post" action="<?= base_url() ?>Koor/add_Pemesanan">
        <div class="modal-body">
        <div>

        	<?php
        	if (isset($_SESSION["JumlahRuanganKelas"]))
        	{
        	?>
        	<table id="dataTable" class="table table-hover">
				<tr>
					 <td>
					<!-- <select required name="JumlahPeserta[]" class="form-control">
						<option disabled="disabled">Jumlah Peserta</option>
					<?php
					// for ($i=1; $i <= $_SESSION["InputJumlahPeserta"]; $i++)
					{
					 ?>
						<option value=<?=$i?>><?=$i?></option>
					 <?php
					}
					 ?>
					</select>  -->
					<input type="number" min=0 required name="JumlahPeserta[]" class="form-control"></input>
					<td>
						<select required name="RoomID[]" class="form-control">
							<option disabled="disabled">Ruangan</option>

						<?php
						foreach ($Rooms as $Room)
						{
							?>
							 <option value=<?php echo $Room['RoomName'];?>><?=$Room['RoomName']?></option>

							<?php
						}
					?>
					</select>

					</td>
					<td>
					<input type="text" name="Class_Layout[]" class="form-control"
					placeholder="Layout">
					</td>
				</tr>
				</table>
        <?php } ?>
        </div>


        <center>
		<h2>
		<a href="add-new-row" onclick="incrementValue();" class="btn btn-primary btn-sm" style="margin-left: 12cm">
		<i class="fa fa-plus"></i>
		</a>
		<a href="delete-row" onclick="subtractionValue();" class="btn btn-primary btn-sm">
		<i class="fa fa-minus"></i>
		</a>
		<input type="hidden" id="number" name="Jumlah" value=<?=$_SESSION["JumlahRuanganKelas"]+1?> />
		</h2>
		</center>

		</div>


	 <div class="modal-footer">
	 <input type="hidden" name="Refreshes" value="Refresh">
		<input type="submit" name="Class_Button" value="ADD" class="btn btn-primary btn-m" />
     </div>
	 </form>
     </div>
      </div>

    </div>
  </div>


  <div class="container">
  <?php

  $files = glob('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Class/*');
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
          <h4 class="modal-title">Attach File</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan" enctype="multipart/form-data">
        <div class="modal-body">
			<table width="100%">
				<?php if ($_SESSION["JumlahFile"]<1) { ?>
					<h4 style="margin-top: 10px;">NO DATA</h4>
					<?php
				} else {
					for ($i=0; $i < $_SESSION["JumlahFile"] ; $i++)
					{
					?>
					<tr>
						<td>
							<?php $namaFile =str_replace('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Class/','',$files[$i]);  ?>
							<ul class="list-group">
								<li class="list-group-item">
									<a href="<?= base_url() ?>Koor/remove_file?file=Class&filename=<?=$namaFile?>&NP=<?=$_SESSION["InputProgramName"];?>&AK=<?=$_SESSION["InputNamaAngkatan"]?>&Refreshes=Refresh" class="close" style="cursor: pointer; color: red;">&times;</a>
									<?php echo $namaFile?>
								</li>
							</ul>
							<input type="hidden" disabled name="filename" class="form-control" value=<?php echo $namaFile?>>
						</td>
					</tr>
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

			<font style="text-align:right;">
				<h6>
					<input type="hidden" id="Filenumber" name="JumlahFile" value=<?=$_SESSION["JumlahFile"]+1?> />
					<a href="add-new-files" onclick="incrementFileNumber();" class="btn btn-primary btn-sm">
					<i class="fa fa-plus"></i>
					</a>
				</h6>
			</font>
			<label>Note(Optional):</label>
			<?php
			if (isset($_SESSION["Class_Notes"]))
			{
				?>
				<input type="text" class="form-control" placeholder="Notes" name="Class_Notes" value="<?=$_SESSION["Class_Notes"]?>" >
				<?php
			}
			else
			{
				?>
				<input type="text" class="form-control" placeholder="Notes" name="Class_Notes">
				<?php
			}
			 ?>

		</div>


	 <div class="modal-footer">
	 <input type="hidden" name="Refreshes" value="Refresh">
		<input type="submit" name="Class_Button" value="ADD" class="btn btn-primary btn-m" />
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
</div>
</div>
</div>
