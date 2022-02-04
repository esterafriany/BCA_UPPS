<div class="col-md-13">
	<div class="panel">
		<div class="panel-body">
<script type="text/javascript">
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
<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Airport">


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
			<td width="200px"><label>Program Name</label>  </td>
			<td>:<?php  echo $_SESSION["InputProgramName"]; ?> </td>
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
		<input type="submit" name="Finish_Button" value="Tambahkan" class="btn btn-primary btn-lg"/>
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
		<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Airport">
        <div class="modal-body">
        <?php
        $nextD= $_SESSION["JumlahPemesananBusDeparture"]+1;
         ?>
         <div>
        		<table class="table table-hover" >
							<tr>
								<th>Tanggal Berangkat</th>
								<td><input required type="date" name="DepartureDate<?=$nextD?>" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Keberangkatan</th>
								<td><input required type="text" name="DeparturePoint<?=$nextD?>" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Bandara</th>
								<td><input required type="text" name="DepartureDestination<?=$nextD?>" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Jam</th>
								<!-- <td><input required type="time" name="DepartureTime<?=$nextD?>" style="text-align: center;" class="form-control"></td> -->
								<td>
									<select required class="form-control" name="DepartureTime<?=$nextD?>">
				<option value="" disabled selected>Hotel-Bandara</option>
				<option value="11:00 AM">11:00</option>
				<option value="03:00 PM">15:00</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Kapasitas</th>
								<td><input required type="number" min="0" name="DepartureCapacity<?=$nextD?>" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Keterangan</th>
								<td><input type="text" name="DepartureInformation<?=$nextD?>" style="padding-bottom: 3cm; padding-right: 3cm" class="form-control"></td>
							</tr>

						</table>
        	</div>



   <table width="100%" border=0>
		<tr>
			<td align="right"><h10><a href="add-new-departure" onclick="incrementValueDeparture();" class="btn btn-primary btn-sm" style="margin-left: 13cm"><i class="fa fa-plus"></i></a></h10></td>

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
	<div class="modal-footer">
	<input type="submit" name="Airport_Button" value="ADD" class="btn btn-primary btn-sm" />
     </div>
     </div>
	
	</div>
		</form>
  	</div>

	

      </div>

    </div>
  </div>

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
		<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Airport">
        <div class="modal-body">
        <div>
        <?php
        $nextA= $_SESSION["JumlahPemesananBusArrival"]+1;
         ?>
        		<table class="table table-hover">
							<tr>
								<th>Tanggal Berangkat</th>
								<td><input required type="date" name="ArrivalDate<?=$nextA?>" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Bandara</th>
								<td><input required type="text" name="ArrivalPoint<?=$nextA?>" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Tujuan</th>
								<td><input required type="text" name="ArrivalDestination<?=$nextA?>" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Jam</th>
								<td>
									<select required class="form-control" name="ArrivalTime<?=$nextA?>">
				<option value="" disabled selected>Bandara-Hotel</option>
				<option value="06:00 AM">06:00</option>
				<option value="07:00 AM">07:00</option>
									</select>
								</td>
								<!-- <td><input type="time" name="ArrivalTime<?=$nextA?>" style="text-align: center;" class="form-control"></td> -->
							</tr>
							<tr>
								<th>Kapasitas</th>
								<td><input required type="number" min="0" name="ArrivalCapacity<?=$nextA?>" style="text-align: center;" class="form-control"></td>
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
						<td><input type="date" name="ArrivalDate" style="text-align: center;" class="form-control"></td>
					</tr>
					<tr>
						<th>Bandara</th>
						<td><input type="text" name="ArrivalPoint" style="text-align: center;" class="form-control"></td>
					</tr>
					<tr>
						<th>Tujuan</th>
						<td><input type="text" name="ArrivalDestination" style="text-align: center;" class="form-control"></td>
					</tr>
					<tr>
						<th>Jam</th>
						<td><input type="time" name="ArrivalTime" style="text-align: center;" class="form-control"></td>
					</tr>
					<tr>
						<th>Kapasitas</th>
						<td><input type="number" min="0" name="ArrivalCapacity" style="text-align: center;" class="form-control"></td>
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
								<td><input type="date" name="DepartureDate" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Keberangkatan</th>
								<td><input type="text" name="DeparturePoint" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Bandara</th>
								<td><input type="text" name="DepartureDestination" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Jam</th>
								<td><input type="time" name="DepartureTime" style="text-align: center;" class="form-control"></td>
							</tr>
							<tr>
								<th>Kapasitas</th>
								<td><input type="number" min="0" name="DepartureCapacity" style="text-align: center;" class="form-control"></td>
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
	$files = glob('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport_F/*');
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
          <h4 class="modal-title">Attach File Pemesanan Bus Untuk Airport</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Airport" enctype="multipart/form-data">
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
        			<?php
	        			$namaFile =str_replace('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport_F/','',$files[$i]);
	        		?>
	        			<td>
	        			<a href="<?= base_url() ?>Koor/remove_file?file=Airport_F&NP=<?=$_SESSION["InputProgramName"];?>&AK=<?=$_SESSION["InputNamaAngkatan"]?>&From=ADD&filename=<?=$namaFile?>&Refreshes=Refresh" class="close" style="cursor: pointer; color: red;">&times;</a>
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
		<input type="number" class="hidden" id="Filenumber" name="JumlahFile" value=<?=$_SESSION["JumlahFile"]+1?> />
		<a href="add-new-files" onclick="incrementFileNumber();" class="btn btn-primary btn-sm" style="margin-left: 13cm">
		<i class="fa fa-plus"></i>
		</a>
		</h6>
		</center>
		    <label>Note (Optional):</label>
    <?php

    if (isset($_SESSION["Airport_Notes"]))
    {
        ?>
        <input type="text" class="form-control" placeholder="Notes" name="Airport_Notes" value=<?=$_SESSION["Airport_Notes"]?> >
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
		<input type="submit" name="Airport_Button" value="ADD" class="btn btn-primary btn-sm" /></div>
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
