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
<input type="hidden" name="tipe" value="Hotels">

</div>
    <?php
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
    }?>
	
<div class="panel">
<div class="panel-heading" style="padding-bottom:0px;"><h3>LIST HOTEL</h3></div>
<div class="panel-body">
<div align="right"><button type="submit" class="btn btn-primary btn-xs" >Add Hotel <i class="fa fa-plus-circle"></i></button></div><br>

	<table align="center" style="border-collapse: collapse;" class="table table-hover" id="bootstrap-table">
		<thead>
		<tr align="center">
			<th width="5%">No.</th>
			<th>Hotel Name</th>
			<th colspan="3" width="10%">Action</th>
		</tr>
		</thead>
		<?php
		$number=1;
		?>
        <?php foreach ($Hotels as $Hotel) {?>
        <tr>
            <td><?php echo $number;?></td>
            <td>
                <?php
                 echo $Hotel['HotelName'];
                 ?>
            </td>
			<?php $HotelID = $Hotel['HotelID'];?>
				<td><a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/go_Edits";?>?ID=<?=$HotelID?>&tipe=Hotels">
					<i class="fa fa-pencil"></i>
				</a></td>
				<td><a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/do_deletes";?>?ID=<?=$HotelID?>&tipe=Hotels" onclick="return confirm('Are you sure?');">
				<i class="fa fa-times"></i>
				</a></td>
				
		</tr>
		
        <?php $number=$number+1; } ?>
</table>
</div>
</div>

</form>
</div>