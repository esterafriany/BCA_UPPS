<div class="col-md-13">
	<div class="panel">
		<div class="panel-body">

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

 select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   overflow: hidden;
   padding: 5px 10px;

   text-overflow: ellipsis;
   white-space: nowrap;
   width: 100%;
}
fieldset.date {
  margin: 0;
  padding: 0;
  padding-left: 20px;
  padding-bottom: .5em;
  display: block;
  border: none;
}

fieldset.date legend {
  margin: 0;
  padding: 0;
  margin-top: .25em;
  font-size: 100%;
}


fieldset.date label {
  position: absolute;
  top: -20em;
  left: -200em;
}

fieldset.date select {
margin: 0;
padding: 0;
font-size: 100%;
display: inline;
}

span.inst {
  font-size: 75%;
  color: blue;
  padding-left: .25em;
}


fieldset.date select:active,
fieldset.date select:focus,
fieldset.date select:hover
{
  border-color: gray;
  background-color: lightyellow;
}
</style>

<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Hotel">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Informasi Pemesanan</h3>
	</div>
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
	<div id="Hotel" class="tabcontent">
		<div class="panel-heading">
			<h3 class="panel-title">Detail Pemesanan Hotel</h3>
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
			<div class="panel-body">
			<div id="" class="sidebar-scroll">
					<table class="table table-bordered table-hover">

					<tr>
						<th>Nama Hotel</th>
						<th>Tanggal CheckIn</th>
						<th>Tanggal CheckOut</th>
						<th>S - Pria</th>
						<th>S - Wanita</th>
						<th>T - Pria</th>
						<th>T - Wanita</th>
					</tr>
					<?php
					for ($i=1; $i <= $_SESSION['JumlahHotel']; $i++)
					{
						?>
						<tr>
						<td>

						<?php
						if (isset($_SESSION['Book_Hotel'][$i]))
						{
							echo $_SESSION['Book_Hotel'][$i];
						}
						else
						{
							var_dump($_SESSION['Book_Hotel']);
						}
						 ?>
						</td>
						<td>
						<?php echo $_SESSION['Date_Start'][$i]?>
						</td>
						<td>
						<?php echo $_SESSION['Date_End'][$i]?>
						</td>
					<td><?php echo $_SESSION['SinglePria'][$i]?></td>
					<td><?php echo $_SESSION['TwinsPria'][$i]?></td>
					<td><?php echo $_SESSION['SingleWanita'][$i]?></td>
					<td><?php echo $_SESSION['TwinsWanita'][$i]?></td>

						 </tr>
						<?php
					}
					 ?>

					<tr>

					</tr>

				</table>
			</div>
			<br>

			<table width="100%" border=0>
				<tr>
					<td align="right">
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" >Detail Pemesanan</button>
					</td>

				</tr>
			</table>
				 <br>
				 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myFiles">Additional Information<i class="fa fa-paperclip"></i></button>

			</div>

		</div>

</div>
</div>
<table width="100%">
	<tr>
		<td align="right">
		<button type="submit" name="Finish_Button" value="Tambahkan" class="btn btn-primary btn-lg">Submit <i class="fa fa-check"></i> </button>
		</td>
	</tr>
</table>
<input type="hidden" value="Flagged" name="Flag" />

</form>

<div class="container">
<script type="text/javascript">
$(function ()
{
	var duplicates = <?php Print($_SESSION["JumlahHotel"]+1); ?>;
        $original = $('.Classes-Content').clone(true);

    function DuplicateForm ()
    {
        var newForm;

        duplicates++;
        newForm = $original.clone(true).insertBefore($('h2'));
        $.each($('select', newForm), function(i, item)
        {
            $(item).attr('name', $(item).attr('name') + duplicates);
        });
        $.each($('input', newForm), function(i, item)
        {
            $(item).attr('name', $(item).attr('name') + duplicates);
        });
    }

    $('a[href="add-new-form"]').on('click', function (e) {
        e.preventDefault();
        DuplicateForm();
    });

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

});

function myFunction()
{
    var button = document.getElementById('clickButton');
    button.click();
}

function incrementValue()
	{
		var value = document.getElementById('number').value
	    // var value = parseInt(document.getElementById('number').value, 10);
	    value = isNaN(value) ? 0 : value;
	    value++;
	    document.getElementById('number').value = value;
	    value=value;
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

<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Pemesanan Hotel</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Hotel">
        <div class="modal-body">
        <?php
        $next= $_SESSION["JumlahHotel"]+1;
         ?>
        <div>
        	<table class="table-checkered">
        	<tr>
        		<th>Check-In Date<span class="inst">(Day-Month-Year)</span></th>
        	</tr>
        	<tr>
        		<td><input required type="date" class="form-control" name="Date_Start<?=$next?>"><br></td>
        	</tr>
        	<tr>
        		<th>Check-Out Date<span class="inst">(Day-Month-Year)</span></th>
        	</tr>
        	<tr>
        		<td><input required type="date" class="form-control" name="Date_End<?=$next?>"></td>
        	</tr>
        	<tr>
        		<th><br>Nama Hotel</th>
        	</tr>
        	<tr>
				<h1>
					<th>
					<select required name="Hotel<?=$next?>" id="soflow" style="background-color: white;">
					<option  disabled>Pilih Hotel</option>
					<?php
	                foreach($Hotels as $new_item)
	                {
	                ?>
	                <option value="<?=$new_item['HotelName']?>">
	                <?=$new_item['HotelName']?>
	                </option>
                    <?php
                 }
              ?>
             </select>
					</th>
				</h1>
			</tr>

        	</table>
<table class="table table-condensed">
										<tr>
										<table class="table table-condensed">
											<tr>
												<th colspan="4" style="text-align: center;">Jenis dan Jumlah Kamar</th>
											</tr>
											<tr>
												<th>Single-Pria</th>
												<th>Twins-Pria</th>
												<th>Single-Wanita</th>
												<th>Twins-Wanita</th>
											</tr>
											<tr align="center">
												<td>
												<input type="number" min="0" name="JumlahSinglePria<?=$next?>" class="form-control" placeholder="0" >
												</td>
												<td>
												<input type="number" min="0" name="JumlahTwinsPria<?=$next?>" class="form-control" placeholder="0" >
												</td>
												<td>
												<input type="number" min="0" name="JumlahSingleWanita<?=$next?>" class="form-control" placeholder="0">
												</td>
												<td>
												<input type="number" min="0" name="JumlahTwinsWanita<?=$next?>" class="form-control" placeholder="0" >
												</td>
											</tr>
										</table>
										</tr>
									</table>
			</div>
		<h2>
		<a href="add-new-form" onclick="incrementValue();" class="btn btn-primary btn-sm" style="margin-left: 13cm"><i class="fa fa-plus"></i></a></h2>
	<input type="hidden" id="number" name="Jumlah" value=<?=$_SESSION["JumlahHotel"]+1?>>
		</form>
	  <div class="modal-footer">
		<input type="submit" name="Hotel_Button" value="ADD" class="btn btn-primary btn-sm" />
     </div>
     </div>
      </div>

    </div>
  </div>


<div class="hidden">
<div class="Classes-Content">
        	<label>Detail Pemesanan Hotel</label>
        	<table class="table-checkered">
        	<tr>
        		<th>Check-In Date</th>
        	</tr>
        	<tr>
        		<td><input type="date" class="form-control" name="Date_Start"></td>
        		<td><span class="inst">(Day-Month-Year)</span></td>
        	</tr>
        	<tr>
        		<th>Check-Out Date</th>
        	</tr>
        	<tr>
        		<td><input type="date" class="form-control" name="Date_End"></td>
        		<td><span class="inst">(Day-Month-Year)</span></td>
        	</tr>
        	</table>
<table class="table table-condensed">
										<tr>
										<h1>
											<th>
											<select name="Hotel" id="soflow" style="background-color: white;">
		                    					<option  disabled>Select Hotel</option>
		                    					<?php
	                        					foreach($Hotels as $new_item)
	                        					{
	                        					?>
	                        						<option value=<?=$new_item['HotelName'] ?>>
	                        						<?=$new_item['HotelName']?>
	                        						</option>
                            					<?php
                        						}
                    							?>
                    						</select>
											</th>
										</h1>
										</tr>
										<tr>
										<table class="table table-condensed">
											<tr>
												<th colspan="4" style="text-align: center;">Jenis dan Jumlah Kamar</th>
											</tr>
											<tr>
												<th>Single-Pria</th>
												<th>Twins-Pria</th>
												<th>Single-Wanita</th>
												<th>Twins-Wanita</th>
											</tr>
											<tr align="center">
												<td>
												<input type="number" min="0" name="JumlahSinglePria" class="form-control" placeholder="0" >
												</td>
												<td>
												<input type="number" min="0" name="JumlahTwinsPria" class="form-control" placeholder="0" >
												</td>
												<td>
												<input type="number" min="0" name="JumlahSingleWanita" class="form-control" placeholder="0" >
												</td>
												<td>
												<input type="number" min="0" name="JumlahTwinsWanita" class="form-control" placeholder="0" >
												</td>
											</tr>
										</table>
										</tr>
									</table>
			</div>
			</div>
  <div class="container">
  <?php
	$files = glob('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Hotel_F/*');
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
          <h4 class="modal-title">Attach File Pemesanan Hotel</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Hotel" enctype="multipart/form-data">
        <div class="modal-body">
        <table width="100%">
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
	        			$namaFile =str_replace('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Hotel_F/','',$files[$i]);
	        			 ?>
								<a href="<?= base_url() ?>Koor/remove_file?file=Hotel_F&From=ADD&filename=<?=$namaFile?>&NP=<?=$_SESSION["InputProgramName"];?>&AK=<?=$_SESSION["InputNamaAngkatan"]?>&Refreshes=Refresh" class="close" style="cursor: pointer; color: red;">&times;</a>
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
		<label>Notes:</label>
				 <?php

				if (isset($_SESSION["Hotel_Notes"]))
				{
					?>
					<input type="text" class="form-control" placeholder="Notes" name="Hotel_Notes" value="<?=$_SESSION["Hotel_Notes"]?>" >
					<input type="hidden" value="Flagged" name="Flag" />
					<?php

				}
				else
				{
					?>
					<input type="text" class="form-control" placeholder="Notes" name="Hotel_Notes">
					<?php
				}
				 ?>
		</div>


	 <div class="modal-footer">
	 <input type="hidden" name="Refreshes" value="Refresh">
		<input type="submit" name="Hotel_Button" value="ADD" class="btn btn-primary btn-sm" />
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
