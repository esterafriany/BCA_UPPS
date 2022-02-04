<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{
?>
		<form  action="<?= base_url() ?>MasterAdmin/go_Adds">
<?php
	}
	else
	{
		?>
		<form  action="<?= base_url() ?>go_Adds?">
		<?php
	}
?>
<div class="panel">
<div class="panel-heading" style="padding-bottom:0px;"><h3>Program:
<?php foreach ($Views as $view)
{
	echo $view['ProgramName'];
	break;
}
?>
<br><br></h3>
</div>
<div class="panel-body">
<div align="right"><button type="submit" class="btn btn-primary btn-xs">Add Angkatan <i class="fa fa-plus-circle"></i></button></div><br>
<table align="center" style="border-collapse: collapse;" class="table table-hover table-striped">
		<thead>
            <tr align="center">
                <th>No.</th>
                <th>Nama Name</th>
				<th>Tanggal Mulai Pelatihan</th>
				<th>Tanggal Selesai Pelatihan</th>

                <th colspan="2" width="5%">Action</th>
            </tr>
        </thead>
		<?php
		$number=1;
		?>
        <?php foreach ($Views as $View) {?>
        <tr>
            <td width="10px"><?php echo $number;?></td>
			 <td>
                <?php
                 echo $View['NamaAngkatan'];
                 ?>
            </td>
			 <td>
                <?php
                 echo $View['ProgramMulai'];
                 ?>
            </td>
			 <td>
                <?php
                 echo $View['ProgramSelesai'];
                 ?>
            </td>
			<?php $AngkatanID = $View['AngkatanID'];?>
				<td>
				<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/go_Edits";?>?ID=<?=$AngkatanID?>&tipe=Angkatan">
					<i class="fa fa-pencil"></i>
				</a>
				</td>
				<td>
					<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/do_deletes";?>?ID=<?=$AngkatanID?>&tipe=Angkatan&ProgramID=<?=$View['ProgramID']?>" onclick="return confirm('Are you sure?');">
						<i class="fa fa-times"></i>
					</a>
				</td>
		</tr>

        <?php $number=$number+1; } ?>
</table>
<input type="hidden" name="tipe" value="Angkatan">
<input type="hidden" name="ID" value=<?=$View['ProgramID']?>>
</div>
</div>
</div>
</form>
</div>
