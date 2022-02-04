<div class="panel"
<div class="col-md-5">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Add Details</h3>
		</div>
		<div class="panel-body">
<script type="text/javascript">
$(function () 
{
    var duplicates = 0,
        $original = $('.Classes-Content').clone(true);
    
    function DuplicateForm () 
    {
        var newForm;
        
        duplicates++; 
        var array = ['input','select'];
        newForm = $original.clone(true).insertBefore($('h2'));
        $.each($('select', newForm), function(i, item) 
        {            
            $(item).attr('name', $(item).attr('name') + duplicates);
        }


       			);                  
    }
    
    $('a[href="add-new-form"]').on('click', function (e) {
        e.preventDefault();
        DuplicateForm();
    });

});
   function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}
</script>
<form method="post" action="<?= base_url() ?>Koor/edit_Pemesanan_Detail">
<center>

  <input type="submit" name="Edit_Class_Button" value="Kelas" class="btn btn-primary btn-sm" />
  <input type="submit" name="Edit_Consumption_Button" value="Konsumsi" class="btn btn-primary btn-sm" />
  <input type="submit" name="Edit_Hotel_Button" value="Hotel" class="btn btn-primary btn-sm" />
  <input type="submit" name="Edit_Shuttle_Button" value="ShuttleBus" class="btn btn-primary btn-sm" />
  <input type="submit" name="Edit_Airport_Button" value="Airport'Bus" class="btn btn-primary btn-sm" />
</center>
<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Pemesanan</h3>
		</div>
		<div class="panel-body">
			<div class="panel">
								<div class="panel-body">
									<label>Program Name:</label>
									<?php 
									echo $_SESSION["InputProgramName"];
									?>
									<br>
									<label>Angkatan:</label>
									<?php
										echo $_SESSION["InputNamaAngkatan"];
									?>
									<br>
									<label>Tanggal Pelatihan:</label>
									<?php
										echo '['.$_SESSION["InputProgramMulai"].']'.' - ['.$_SESSION["InputProgramSelesai"].']';
									?>
									<br>
									<label>PIC Program:</label>
									<?php
										echo $_SESSION["InputPicProgram"];
									?>
								</div>
			</div>
		</div>
</div>


<div class="panel">
<div id="Kelas"> 
		<div class="panel-body">
								<div class="panel-heading">
								<h3 class="panel-title">Pendaftaran Kelas Baru</h3>
								</div>
								<div class="panel-body">
								<br>
								<div class="content">
								<table class="table table-hover" style="text-align: left;" >
									<div class="Classes">
										<tr style="text-align: center;">
											<th>Peserta:</th>
											<th>Ruangan:</th>
										</tr>
										<?php
									if(isset($_SESSION["JumlahRuanganKelas"]))
									{
										for ($i=0; $i < $_SESSION["JumlahRuanganKelas"]; $i++) 
										{
										?>
										<tr>
											<td>
											<input type="text" style="text-align: center;" name="JumlahPeserta$i" value=<?=$_SESSION['JumlahPeserta'][$i]?> disabled="disabled" class="form-control">
											</td>
											<td>
											<input type="text" style="text-align: center;" name="RoomID$i" value=<?=$_SESSION['RoomID'][$i]?> disabled="disabled" class="form-control">
											</td>
										</tr>
										<?php
										}
									}
									else
									{
										?>
										<tr>
											<td><input type="text" name="" disabled="disabled" class="form-control"></td>
											<td><input type="text" name="" disabled="disabled" class="form-control"></td>
										</tr>
										<?php
									}
										?>
									</div>
								</table>
									<br>
									</div>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" style="margin-left: 13cm; margin-bottom:0cm; margin-top:0cm; background-color: orange;">+</button>
									<br>
									<label>Layout:</label>
									<?php 
									if(isset($_SESSION["Class_Layout"]))
									{
										?>
										<input type="text" class="form-control" value=<?=$_SESSION["Class_Layout"]?> name="Layout">	
										<?php
									}
									else
									{
									 ?>
									 <input type="text" class="form-control" placeholder="Layout" name="Layout">
									 <?php
									} 
									?>
									<br>
									<label>Note(Optional):</label>
									<?php 

									if (isset($_SESSION["Class_Notes"])) 
									{
										?>
										<input type="text" class="form-control" placeholder="Notes" name="Class_Notes" value=<?=$_SESSION["Class_Notes"]?> >
										<?php
									}
									else
									{
										?>
										<input type="text" class="form-control" placeholder="Notes" name="Class_Notes">
										<?php
									}
									 ?>
									 <br>
									 <label>File:</label>
									<input type="text" class="form-control" placeholder="File" name="File" disabled="disabled">
									<button type="button" class="btn btn-primary btn-sm" style="margin-left: 22cm">Browse</button>
								</div>


		</div>
</div>

</div>
<input type="submit" name="Finish_Button" value="Finish" class="btn btn-primary btn-lg" style="margin-left: 24.5cm" />
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
          <h4 class="modal-title">Add Classes</h4>
        </div>
		<form method="post" action="<?= base_url() ?>Koor/add_Pemesanan">
        <div class="modal-body">
        	<div class="Classes-Content">
                <table class="table table-hover">
										<tr>
											<th>Jumlah Peserta:</th>
											<td>
											<select name="JumlahPeserta">
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
											<th style="padding-left: 3cm">Ruangan:</th>

											<th>
												<select name="RoomID">
												<?php
												foreach ($Rooms as $Room) 
												{
													?>
													 <option value=<?php echo $Room['RoomName'];?>><?=$Room['RoomName']?></option>

													<?php
												}
											?>
											</select>
											<br>
											</th>
										</tr>
				</table>
		</div>
		<h2><a href="add-new-form" onclick="incrementValue();" class="btn btn-primary btn-sm" style="margin-left: 13cm">+</a></h2>
		<input type="hidden" id="number" value="1" name="Jumlah" />
		<input type="submit" name="Class_Button" value="ADD" class="btn btn-primary btn-sm" />		</div>
		</form>
									
	 <div class="modal-footer">
     </div>
     </div>
      </div>
      
    </div>
  </div>
  
</div>
