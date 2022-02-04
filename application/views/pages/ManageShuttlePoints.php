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
		<form  action="<?= base_url() ?>go_Adds">
		<?php
	}
?>
<div style="padding-right: 5cm; color: blue">
<input type="hidden" name="tipe" value="ShuttlePoint">

</div>
<!-- TABLE STRIPED -->
<div class="panel">
<div class="panel-heading" style="padding-bottom:0px;"><h3>LIST SHUTTLE POINT</h3></div>
<div class="panel-body">
<div align="right"><button type="submit" class="btn btn-primary btn-xs" >Add ShuttlePoint <i class="fa fa-plus-circle"></i></button></div><br>
<?php
    if (isset($message_display)) {
	?>
		<div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			   <?php echo($message_display); ?>
			</div>
		<?php
    }
	?>
	<table align="center" style="border-collapse: collapse;" class="table table-hover" id="bootstrap-table">
		<thead>
		<tr>
			<th width="5%">No.</th>
			<th valign="middle">Nama Titik Shuttle</th>
			<th colspan="3" width="10%">Action</th>
		</tr>
		</thead>
		<?php
		$number=1;
		?>
        <?php foreach ($ShuttlePoints as $ShuttlePoint) {?>
        <tr>
            <td><?php echo $number;?></td>
            <td>
                <?php
                 echo $ShuttlePoint['PointName'];
                 ?>
            </td>
			<?php $ShuttlePointID = $ShuttlePoint['ShuttlePointID'];?>
				<td>
					<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/go_Edits";?>?ID=<?=$ShuttlePointID?>&tipe=ShuttlePoint">
						<i class="fa fa-pencil"></i>
					</a>
				</td>
				<td>
					<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/do_deletes";?>?ID=<?=$ShuttlePointID?>&tipe=ShuttlePoint" onclick="return confirm('Are you sure?');">
						<i class="fa fa-trash"></i>
					</a>
				</td>
		</tr>
		
        <?php $number=$number+1; } ?>
</table>
    </div>
</div>

</form>