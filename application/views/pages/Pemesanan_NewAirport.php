<div class="col-md-13">
	<div class="panel">
		<div class="panel-body">
<script type="text/javascript">
$(function ()
{
	var FileDuplicates = <?php Print($_SESSION["JumlahFileAirport"]+1); ?>;
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
    $('a[href="add-new-files"]').on('click', function (e)
    {
        e.preventDefault();
        DuplicateFiles();
    });

    var duplicatesA = <?php Print($_SESSION["JumlahPemesananBusArrival"]+1); ?>;
    var duplicatesD = <?php Print($_SESSION["JumlahPemesananBusDeparture"]+1); ?>;
        $Arrival = $('.Arrival-Content').clone(true);
        $Departure = $('.Departure-Content').clone(true);

    function DuplicateForm ($type)
    {
    	var newForm;
    	if ($type=="Arrival")
    	{
    		duplicatesA++;
    		newForm = $Arrival.clone(true).insertBefore($('h11'));
    		$.each($('input', newForm), function(i, item)
        	{
            $(item).attr('name', $(item).attr('name') + duplicatesA);
        	});
    	}
    	else
    	{
    		duplicatesD++;
    		newForm = $Departure.clone(true).insertBefore($('h10'));
    		$.each($('input', newForm), function(i, item)
        	{
            $(item).attr('name', $(item).attr('name') + duplicatesD);
        	});
    	}
    }

    $('a[href="add-new-arrival"]').on('click', function (e)
    {
        e.preventDefault();
        DuplicateForm("Arrival");
    });
    $('a[href="add-new-departure"]').on('click', function (e)
    {
        e.preventDefault();
        DuplicateForm("Departure");
    });

});
   function incrementValueArrival()
{
    var value = parseInt(document.getElementById('numberArrival').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('numberArrival').value = value;
}
   function incrementValueDeparture()
{
    var value = parseInt(document.getElementById('numberDeparture').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('numberDeparture').value = value;
}
function myFunction()
{
    var button = document.getElementById('clickButton');
    button.click();
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
<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan">

<center>
	<div class="row">
		<div class="col-xs-11">
			<ul class="nav nav-pills nav-justified thumbnail" style="border: 1px solid rgba(255, 255, 255, 0);">
				<li>
				<button type="submit" type="submit" name="Class_Button" value="Kelas" class="btn btn-primary btn-circle btn-xl"><i class="lnr lnr-store"></i>
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
					<button id="clickButton" type="submit" name="Airport_Button" value="Airport'Bus" class="btn btn-primary btn-circle btn-xl"><i class="lnr lnr-train"></i>
					</button> Bus Bandara
				</li>
				</ul>
		</div>
	</div>
</center>

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


<div class="panel panel-primary">
	<div id="Shuttle" class="tabcontent">
		<div class="panel-heading">
			<h2 class="panel-title">Detail Pemesanan Bus Bandara</h2>
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
				<div id="" class="sidebar-scroll">
					<table class="table table-hover">
						<tt>
							<label>Arrival </label>
						</tt>
							<tr>
								<th>No.</th>
								<th>Tanggal Berangkat</th>
								<th>Bandara</th>
								<th>Tujuan</th>
								<th>Jam</th>
								<th>Kapasitas</th>
								<th>Keterangan</th>
							</tr>
							<?php
							if (isset( $_SESSION["JumlahPemesananBusArrival"]))
							{
								for ($x=1; $x <= $_SESSION["JumlahPemesananBusArrival"]; $x++)
								{
								?>
								<tr>
									<td><?php echo ($x); ?></td>
									<td><?=$_SESSION["ArrivalDate"][$x]?></td>
									<td><?=$_SESSION["ArrivalPoint"][$x]?></td>
									<td><?=$_SESSION["ArrivalDestination"][$x]?></td>
									<td><?=$_SESSION["ArrivalTime"][$x]?></td>
									<td><?=$_SESSION["ArrivalCapacity"][$x]?></td>
									<td><?=$_SESSION["ArrivalInformation"][$x]?></td>
								</tr>
								<?php
								}
							}
							else
							{
								?>
								<tr><td></td></tr>
								<?php
							}
							 ?>
						</table>
						<table class="table table-hover">
						<tt>
							<label>Departure </label>
						</tt>
							<tr>
								<th>No.</th>
								<th>Tanggal Berangkat</th>
								<th>Keberangkatan</th>
								<th>Bandara</th>
								<th>Jam</th>
								<th>Kapasitas</th>
								<th>Keterangan</th>
							</tr>
							<?php
							if (isset($_SESSION["JumlahPemesananBusDeparture"]))
							{
							
							
								for ($x=1; $x <= $_SESSION["JumlahPemesananBusDeparture"]; $x++)
								{
								?>
								<tr>
									<td><?php echo ($x); ?></td>
									<td><?=$_SESSION["DepartureDate"][$x]?></td>
									<td><?=$_SESSION["DeparturePoint"][$x]?></td>
									<td><?=$_SESSION["DepartureDestination"][$x]?></td>
									<td><?=$_SESSION["DepartureTime"][$x]?></td>
									<td><?=$_SESSION["DepartureCapacity"][$x]?></td>
									<td><?=$_SESSION["DepartureInformation"][$x]?></td>
								</tr>
								<?php
								}
							}
							else
							{
								echo "<tr><td></td></tr>";
							}
							 ?>
						</table>
								</div>



  <table border="0" width="100%" >
        <tr style="text-align:right;">
            <td colspan="3">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myArrival">Add Arrival</button>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myDeparture">Add Departure</button>
            </td>
        </tr>
    </table>
  <br>
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myFiles">Additional Information <i class="fa fa-paperclip"></i></button>
  <br>
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
</div>
</form>


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myDeparture" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Keberangkatan</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan">
        <div class="modal-body">
        <?php
        $nextD= $_SESSION["JumlahPemesananBusDeparture"]+1;
         ?>
         <div>
        		<table class="table table-hover" >
					<tr>
						<th>Tanggal Berangkat</th>
						<td><input required type="date" name="DepartureDate<?=$nextD?>" class="form-control"></td>
					</tr>
					<tr>
						<th>Keberangkatan</th>
						<td><input required type="text" name="DeparturePoint<?=$nextD?>" class="form-control"></td>
					</tr>
					<tr>
						<th>Bandara</th>
						<td><input required type="text" name="DepartureDestination<?=$nextD?>" class="form-control"></td>
					</tr>
					<tr>
						<th>Jam</th>
						<!-- <td><input required type="time" name="DepartureTime<?=$nextD?>" style="text-align: center;" class="form-control"></td> -->
						<td>
							<select required class="form-control" name="DepartureTime<?=$nextD?>">
								<option value="" disabled selected>Pilih Jam</option>
								<option value="06:00 AM">06:00</option>
								<option value="07:00 AM">07:00</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>Kapasitas</th>
						<td><input required type="number" min="0" name="DepartureCapacity<?=$nextD?>" class="form-control"></td>
					</tr>
					<tr>
						<th>Keterangan</th>
						<td><input type="text" name="DepartureInformation<?=$nextD?>" style="padding-bottom: 3cm; padding-right: 3cm" class="form-control"></td>
					</tr>

				</table>
        	</div>



	<table width="100%" border=0>
		<tr>
			<td align="right"><h10><a href="add-new-departure" onclick="incrementValueDeparture();" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a></h10></td>
		</tr>
	</table><br>

	<input type="hidden" id="numberDeparture" value=<?=$_SESSION["JumlahPemesananBusDeparture"]+1?> name="Jumlah" />
	<input type="hidden" name="InputType" value="Departure">
	<?php
		$filled=false;
		foreach ($AirportID as $key)
			{
			$filled=true;
			?>
			<input type="hidden" name="NextAirportID" value=<?=$key['AirportShuttleID']+1;?>>
			<?php
			}
			if ($filled==false)
			{
			?>
			<input type="hidden" name="NextAirportID" value=1>
			<?php
			}
			?>


  </div>

	 <div class="modal-footer">
		<input type="submit" name="Airport_Button" value="ADD" class="btn btn-primary btn-m" />
     </div>
     </div>
      </div>

    </div>
  </div>
</form>
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myArrival" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Kedatangan</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan">
        <div class="modal-body">
        <div>
        <?php
        $nextA= $_SESSION["JumlahPemesananBusArrival"]+1;
         ?>
        		<table class="table table-hover">
					<tr>
						<th>Tanggal Berangkat</th>
						<td><input type="date" name="ArrivalDate<?=$nextA?>" required class="form-control"></td>
					</tr>
					<tr>
						<th>Bandara</th>
						<td><input required type="text" name="ArrivalPoint<?=$nextA?>"  class="form-control"></td>
					</tr>
					<tr>
						<th>Tujuan</th>
						<td><input required  type="text" name="ArrivalDestination<?=$nextA?>" class="form-control"></td>
					</tr>
					<tr>
						<th>Jam</th>
						<td>
							<select required class="form-control" name="ArrivalTime<?=$nextA?>">
								<option value="" disabled selected>Pilih Jam</option>
								<option value="11:00 AM">11:00</option>
								<option value="03:00 PM">15:00</option>
							</select>
						</td>
								<!-- <td><input type="time" name="ArrivalTime<?=$nextA?>" style="text-align: center;" class="form-control"></td> -->
					</tr>
					<tr>
						<th>Kapasitas</th>
						<td><input required type="number" min="0" name="ArrivalCapacity<?=$nextA?>" class="form-control"></td>
					</tr>
					<tr>
						<th>Keterangan</th>
						<td><input type="text" name="ArrivalInformation<?=$nextA?>" style="padding-bottom: 3cm; padding-right: 3cm" class="form-control"></td>
					</tr>
				</table>

        	</div>

			<table width="100%" border=0>
				<tr>
					<td align="right"><h11><a href="add-new-arrival" onclick="incrementValueArrival();" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a></h11></td>
				</tr>
			</table><br>

		 <input type="hidden" id="numberArrival" value=<?=$_SESSION["JumlahPemesananBusArrival"]+1?>
		  name="Jumlah" />
		  <?php
		  $filled=false;
		foreach ($AirportID as $key)
			{
				$filled=true;
			?>
			<input type="hidden" name="NextAirportID" value=<?=$key['AirportShuttleID']+1;?>>
			<?php
			}
			if ($filled==false)
			{
				?>
				<input type="hidden" name="NextAirportID" value=1>
				<?php
			}
			 ?>
		 <input type="hidden" name="InputType" value="Arrival">
		</form>

	 <div class="modal-footer">
		<input type="submit" name="Airport_Button" value="ADD" class="btn btn-primary btn-sm" /></div>
     </div>
     </div>
      </div>

    </div>
  </div>

</div>

<div class="hidden">
<div class="Arrival-Content">
	<table class="table table-hover"><hr>
		<tr>
			<th>Tanggal Berangkat</th>
			<td><input type="date" name="ArrivalDate" class="form-control"></td>
		</tr>
		<tr>
			<th>Bandara</th>
			<td><input type="text" name="ArrivalPoint" class="form-control"></td>
		</tr>
		<tr>
			<th>Tujuan</th>
			<td><input type="text" name="ArrivalDestination" class="form-control"></td>
		</tr>
		<tr>
			<th>Jam</th>
			<td><input type="time" name="ArrivalTime" class="form-control"></td>
		</tr>
		<tr>
			<th>Kapasitas</th>
			<td><input type="number" min="0" name="ArrivalCapacity" class="form-control"></td>
		</tr>
		<tr>
			<th>Keterangan</th>
			<td><input type="text" name="ArrivalInformation" style="padding-bottom: 3cm; padding-right: 3cm" class="form-control"></td>
		</tr>

	</table>
</div>
<div class="Departure-Content">
	<table class="table table-hover" ><hr>
		<tr>
			<th>Tanggal Berangkat</th>
			<td><input type="date" name="DepartureDate" class="form-control"></td>
		</tr>
		<tr>
			<th>Keberangkatan</th>
			<td><input type="text" name="DeparturePoint" class="form-control"></td>
		</tr>
		<tr>
			<th>Bandara</th>
			<td><input type="text" name="DepartureDestination" class="form-control"></td>
		</tr>
		<tr>
			<th>Jam</th>
			<td><input type="time" name="DepartureTime" class="form-control"></td>
		</tr>
		<tr>
			<th>Kapasitas</th>
			<td><input type="number" min="0" name="DepartureCapacity" class="form-control"></td>
		</tr>
		<tr>
			<th>Keterangan</th>
			<td><input type="text" name="DepartureInformation" style="padding-bottom: 3cm; padding-right: 3cm" class="form-control"></td>
		</tr>

	</table>
</div>
</div>


</div>
<div class="container">
  <?php
  $files = glob('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport/*');
  ?>
<!-- Modal -->
  <div class="modal fade" id="myFiles" role="dialog">
    <div class="modal-dialog">
    <?php
    $nextFile= $_SESSION["JumlahFileAirport"]+1;
     ?>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Attach File</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan" enctype="multipart/form-data">
        <div class="modal-body">
        <table class="table table-hover">
			<?php
			if ($_SESSION["JumlahFileAirport"]<1)
			{
				?>
				<tr>
				<td><h4 style="margin-top: 10px;">NO DATA</h4></td>
				</tr>
				<?php
			}
			else
			{
				for ($i=0; $i < $_SESSION["JumlahFileAirport"] ; $i++)
				{
				?>
				<tr>
				<?php $namaFile =str_replace('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport/','',$files[$i]);
				?>
				<td>
				<a href="<?= base_url() ?>Koor/remove_file?file=Airport&filename=<?=$namaFile?>&NP=<?=$_SESSION["InputProgramName"];?>&AK=<?=$_SESSION["InputNamaAngkatan"]?>&Refreshes=Refresh" class="close" style="cursor: pointer; color: red;">&times;</a>
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


		<font style="text-align:right;">
			<h6>
			<input type="number" hidden id="Filenumber" name="JumlahFileAirport" value=<?=$_SESSION["JumlahFileAirport"]+1?> />
			<a href="add-new-files" onclick="incrementFileNumber();" class="btn btn-primary btn-sm">
			<i class="fa fa-plus"></i>
			</a>
			</h6>
		</font>
		<label>Note (Optional):</label>
    <?php

    if (isset($_SESSION["Airport_Notes"]))
    {
        ?>
        <input type="text" class="form-control" placeholder="Notes" name="Airport_Notes" value="<?=$_SESSION["Airport_Notes"]?>" >
        <?php
    }
    else
    {
        ?>
        <input type="text" class="form-control" placeholder="Notes" name="Airport_Notes">
        <?php
    }
     ?>

		</div>


	 <div class="modal-footer">
	 <input type="hidden" name="Refreshes" value="Refresh">
		<input type="submit" name="Airport_Button" value="ADD" class="btn btn-primary btn-sm"/>
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
