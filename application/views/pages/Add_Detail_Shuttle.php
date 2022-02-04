<!-- DEV NOTE
	Jika terjadi update/Penambahan pada Master data shuttle point
	tambahkan kondisi if pada foreach di bawah comment //HARD CODE 1 dan 2
	Lalu
	tambahkan variable baru sesuai dengan v-model yang baru pada HARD CODE 3
-->
<div class="col-md-13">
	<div class="panel">
		<div class="panel-body">
<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Shuttle">
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
					<td>:<?php echo date("d M Y", strtotime($_SESSION["InputProgramMulai"])).' - '.date("d M Y", strtotime($_SESSION["InputProgramSelesai"])); ?></td>
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
	<div id="Shuttle" class="tabcontent">
		<div class="panel-heading">
			<h3 class="panel-title">Detail Pemesanan Shuttle</h3>
		</div>
		<?php if ($this->input->post("Refreshes")!=null OR $this->input->get("Refreshes")!=null) { ?>
			<body onload="myFunction()"></body>
			<?php
			unset($_SESSION["Refresh"]);
		}?>
			<div class="panel-body" >
			<div id="" class="sidebar-scroll">
				<?php
				date_default_timezone_set('UTC');
				$date = $_SESSION["InputAwalPemesanan"];
				$end_date = $_SESSION["InputAkhirPemesanan"];
				// var_dump($date);
				// var_dump($end_date);
				$i=0;
				while (strtotime($date) <= strtotime($end_date))
				{
					?>
					<div  class="panel">
						<div class="panel-heading" style="padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 5px;">
							<i class="fa fa-bus"></i>&nbsp;<label><?=$date?></label>
						</div>
						<div class="panel-body" style="padding-top: 0px;">
							<table>
							<?php
							$JumlahShuttle=0;
								foreach ($ShuttlePoint as $Shuttle){
								?>
								<tr>
									<!-- <td><?php// print_r($_SESSION["InputPointDate1"][1])?></td> -->
									<td width="150px"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> <?=$Shuttle['PointName']?></td>
									<td>:&nbsp;</td>
									<?php
									if(isset($_SESSION["JumlahPenumpang0"]))
									{ ?>
									<td>
										<input class="form-control" type="number" min=0 min="0" style="text-align: center;center;width:80px;" disabled="disabled" name="JumlahPenumpang$i[]" value="<?=$_SESSION["JumlahPenumpang$i"][$JumlahShuttle]?>">
										</input>
									</td>
										<?php
									}
									else
									{
										?>
									<td>
										<input class="form-control" type="number" min=0 min="0" style="text-align:" disabled="disabled" name="JumlahPenumpang$i[]">
										</input>
									</td>
										<?php
									}
									?>
								</tr>
								<?php
								$JumlahShuttle=$JumlahShuttle+1;
								}
								?>
							</table>
						</div>
					</div>
					<?php
					$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
					//echo "<br>";
					$i=$i+1;
				}
				?>
			</div>
			<table width="100%" border=0>
				<tr>
					<td align="right">
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Detail Pemesanan Shuttle</button>
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myDefault">Set Default Value</button>
					</td>
				</tr>
			</table>
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
</div>

</form>



<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Pemesanan Shuttle</h4>
					</div>
						<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Shuttle">
						<div class="modal-body">
							<div class="Classes-Content">
							<?php
								date_default_timezone_set('UTC');
								$date = $_SESSION["InputAwalPemesanan"];
								$end_date = $_SESSION["InputAkhirPemesanan"];
								// var_dump($date);
								// var_dump($end_date);
								$o=0;
								while (strtotime($date) <= strtotime($end_date))
								{
											//echo "$date\n";
											?>
								<div class="panel panel-success" style="margin-bottom: 0px;">
									<div class="panel-heading" style="padding-left: 10px;padding-top: 10px;padding-right: 10px;padding-bottom: 5px;">
										<i class="fa fa-bus"></i>&nbsp;<label><?=$date?></label>
									</div>
									<div class="panel-body">
										<table class="table table-hover">
											<tr>
												<th>Shuttle Point</th>
												<th>Jumlah</th>
											</tr>
											<?php
											$i=0;
											foreach ($ShuttlePoint as $Shuttle)
											{
											?>
											<tr>
												<td><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;<?=$Shuttle['PointName']?></td>
												<input type="hidden" name="InputPointName<?=$o?>[]" value="<?=$Shuttle['PointName']?>">
												<input type="hidden" name="InputPointDate<?=$o?>[]" value="<?=$date?>">
												<?php
											if (isset($_SESSION["JumlahPenumpang$o"][$i])==false)
												{
													?>
													<td>
													<input type="number" min=0 min="0" class="form-control"
												value=0 name="JumlahPenumpang<?=$o?>[]"
												style="text-align: center;">
												</td>
													<?php
												}
												else
												{
												?>
												<td>
												<input type="number" min=0 class="form-control"
												value="<?=$_SESSION["JumlahPenumpang$o"][$i]?>"
												name="JumlahPenumpang<?=$o?>[]"
												style="text-align: center;">
												</td>
												<tr>
											<?php
												}
											$i=$i+1;
											}
											?>

										</table>
									</div>
								</div>
								<?php
								$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
								echo "<br>";
								$o=$o+1;
								}
							?>
							</div>
						 <input type="hidden" id="counter" value="<?=$JumlahShuttle?>" name="JumlahShuttle" />
							<input type="hidden" id="counter" value=<?=$o?> name="JumlahPemesanan" />


						</div>
						<div class="modal-footer">
							<input type="submit" name="Shuttle_Button" value="ADD" class="btn btn-primary btn-m"/>
						</div>
						</form>
				</div>
		</div>
	</div>
</div>


	<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="myDefault" role="dialog">
	<div class="modal-dialog modal-sm ">
	<!-- Modal content-->
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title"><center>Set Default</center></h4>
	</div>
	<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Shuttle">
	<div class="modal-body" id="app">
	<?php
	//HARD CODE 1
	foreach($ShuttlePoint as $Shuttle)
	{
		if($Shuttle["PointName"]==="Alam Sutera")
		{
			?>
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i><?=$Shuttle['PointName']?> : {{ messageAS }}
      <input required type="number" min=0 min=0 v-model="messageAS" min=0 class="form-control" id="default" />
			<?php
		}
		elseif($Shuttle["PointName"]==="Bekasi")
		{
			?>
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i><?=$Shuttle['PointName']?> : {{ messageBK }}
      <input required type="number" min=0 min=0 v-model="messageBK" min=0 class="form-control" id="default" />
			<?php
		}
		elseif($Shuttle["PointName"]==="Bogor")
		{
			?>
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i><?=$Shuttle['PointName']?> : {{ messageBG }}
      <input required type="number" min=0 min=0 v-model="messageBG" min=0 class="form-control" id="default" />
			<?php			
		}
		elseif($Shuttle["PointName"]==="Kelapa Gading")
		{
			?>
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i><?=$Shuttle['PointName']?> : {{ messageKG }}
      <input required type="number" min=0 min=0 v-model="messageKG" min=0 class="form-control" id="default" />
			<?php			
		}
		elseif($Shuttle["PointName"]==="Wisma Asia")
		{
			?>
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i><?=$Shuttle['PointName']?> : {{ messageS }}
      <input required type="number" min=0 min=0 v-model="messageS" min=0 class="form-control" id="default" />
			<?php			
		}
		elseif($Shuttle["PointName"]==="Pondok Indah")
		{
			?>
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i><?=$Shuttle['PointName']?> : {{ messageSB }}
      <input required type="number" min=0 min=0 v-model="messageSB" min=0 class="form-control" id="default" />
			<?php			
		}
	}
	?>
      <!-- model ModelViewViewController 2 way binding -->
	<div class="Classes-Content hidden">


	<?php
		date_default_timezone_set('UTC');
		$date = $_SESSION["InputAwalPemesanan"];
		$end_date = $_SESSION["InputAkhirPemesanan"];
		// var_dump($date);
		// var_dump($end_date);
		$o=0;
		while (strtotime($date) <= strtotime($end_date))
		{
	               //echo "$date\n";
	               ?>
	<div class="panel panel-success">
	<div class="panel-heading">
	</div>
	<div class="panel-body">
									<?php
									$i=0;
									foreach ($ShuttlePoint as $Shuttle)
									{
									?>
										<input type="hidden" name="InputPointName<?=$o?>[]" value="<?=$Shuttle['PointName']?>">
										<input type="hidden" name="InputPointDate<?=$o?>[]" value="<?=$date?>">
		<?php
		//Hard Code 2
		if($Shuttle["PointName"]==="Alam Sutera")
		{
			?>
			<input type="number" min=0 class="" name="JumlahPenumpang<?=$o?>[]" v-model="messageAS"></input>
			<?php
		}
		elseif($Shuttle["PointName"]==="Bekasi")
		{
			?>
			<input type="number" min=0 class="" name="JumlahPenumpang<?=$o?>[]" v-model="messageBK"></input>
			<?php
		}
		elseif($Shuttle["PointName"]==="Bogor")
		{
			?>
			<input type="number" min=0 class="" name="JumlahPenumpang<?=$o?>[]" v-model="messageBG"></input>
			<?php			
		}
		elseif($Shuttle["PointName"]==="Kelapa Gading")
		{
			?>
			<input type="number" min=0 class="" name="JumlahPenumpang<?=$o?>[]" v-model="messageKG"></input>
			<?php			
		}
		elseif($Shuttle["PointName"]==="Wisma Asia")
		{
			?>
			<input type="number" min=0 class="" name="JumlahPenumpang<?=$o?>[]" v-model="messageS"></input>
			<?php			
		}
		elseif($Shuttle["PointName"]==="Pondok Indah")
		{
			?>
			<input type="number" min=0 class="" name="JumlahPenumpang<?=$o?>[]" v-model="messageSB"></input>
			<?php			
		}
									$i=$i+1;
									}
									?>
						</div>
					</div>
					<?php
	               $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
	               echo "<br>";
	               $o=$o+1;
		}
		?>
			</div>
	 <input type="hidden" id="counter" value="<?=$JumlahShuttle?>" name="JumlahShuttle" />
	   <input type="hidden" id="counter" value=<?=$o?> name="JumlahPemesanan" />

	<div class="modal-footer">
		<button type="submit" onclick="SetDefault()" name="Shuttle_Button" class="btn btn-primary">Set as Default</button>
	</div>
			</form>
	</div>
	</div>
	</div>
	</div>
	 </div>

</div>
</div>

<div class="container">
  <?php

  $files = glob('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Shuttle_F/*');
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
          <h4 class="modal-title">Attach Files</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_detail?tipe=Shuttle" enctype="multipart/form-data">
        <div class="modal-body">
        <table class="table table-hover">
        		<?php
        		if ($_SESSION["JumlahFile"]<1)
        		{
        			?>
        			<tr>
						<td><h4 style="margin-top: 10px;">NO DATA</h4></td>
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
	       			$namaFile =str_replace('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Shuttle_F/','',$files[$i]);
	       		?>
	       			<td>
	       			<a href="<?= base_url() ?>Koor/remove_file?file=Shuttle&filename=<?=$namaFile?>&NP=<?=$_SESSION["InputProgramName"];?>&AK=<?=$_SESSION["InputNamaAngkatan"]?>&Refreshes=Refresh" class="close" style="cursor: pointer; color: red;">&times;</a>
	       			<input type="text" disabled name="filename" class="form-control" value="<?=$namaFile?>">
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
			<input type="hidden" id="Filenumber" name="JumlahFile" value="<?=$_SESSION["JumlahFile"]+1?>" />
			<a href="add-new-files" onclick="incrementFileNumber();" class="btn btn-primary btn-sm">
			<i class="fa fa-plus"></i>
			</a>
			</h6>
		</font>
		<label>Note(Optional):</label>
		<?php

		if (isset($_SESSION["Shuttle_Notes"]))
		{
			?>
		<input type="text" class="form-control" placeholder="Notes" name="Shuttle_Notes" value="<?=$_SESSION["Shuttle_Notes"]?>" >
			<?php
		}
		else
		{
			?>
			<input type="text" class="form-control" placeholder="Notes" name="Shuttle_Notes">
			<?php
		}
		?>
		</div>
	<div class="modal-footer">
	<input type="hidden" name="Refreshes" value="Refresh">
		<input type="submit" name="Shuttle_Button" value="ADD" class="btn btn-primary btn-m" />
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
<script src="<?php echo base_url(); ?>assets/js/vue/vue.js"></script>
<script type="text/javascript">
//Hard Code 3
var app = new Vue({
      el: '#app',
      data: {
        messageAS: "Not Set",
		messageBK: "Not Set",
		messageBG: "Not Set",
		messageKG: "Not Set",
		messageS: "Not Set",
		messageSB: "Not Set"
      }
    })
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

});

function SetDefault()
{
	var input=0;
	input = document.getElementById('default').value
	document.getElementById('Filenumber').value = value;
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
