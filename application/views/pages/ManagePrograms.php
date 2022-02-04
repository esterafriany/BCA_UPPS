<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1){ ?>
		<form  action="<?= base_url() ?>MasterAdmin/go_Adds"> <?php
	}else{
		?><form  action="<?= base_url() ?>go_Adds"><?php
	}
?>

<input type="hidden" name="tipe" value="Program">

<?php
if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}?>
	
<div class="panel">
<div class="panel-heading" style="padding-bottom:0px;"><h3>LIST PROGRAM</h3></div>
<div class="panel-body">
	<div align="right"><button type="submit" class="btn btn-primary btn-xs">Add Program <i class="fa fa-plus-circle"></i></button></div><br>
	<?php
	if (isset($message_display)) {
		echo "<div class='message'>";
			echo $message_display;
		echo "</div>";
	}
	?>
	<table class="table table-hover" id="bootstrap-table">
		<thead>
			<tr align="center">
				<th style="vertical-align: middle;">No.</th>
				<th width="80%" style="vertical-align: middle;">Program Name</th>
				<th colspan="3" style="vertical-align: middle;">Action</th>
			</tr>
		</thead>
		<?php
		$number=1;
		?>
		<?php foreach ($Programs as $Program) {?>
		<tr>
			<td><?php echo $number;?></td>
			<td>
				<?php
				 echo $Program['ProgramName'];
				 ?>
			</td>
			<?php $ProgramID = $Program['ProgramID'];?>
				<td>
					<a class="btn btn-success btn-xs" type="button" href="<?php echo base_url()."MasterAdmin/go_Edits";?>?ID=<?=$ProgramID?>&tipe=Program">
						<i class="fa fa-pencil"></i>
					</a>
				</td>
				<td>
					<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/do_deletes";?>?ID=<?=$ProgramID?>&tipe=Program" onclick="return confirm('Are you sure?');">
						<i class="fa fa-times"></i>	
					</a>
				</td>
				<td>
					<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/go_views";?>?ID=<?=$ProgramID?>&tipe=Program">View Angkatan</a>
				</td>
		</tr>
		
		<?php $number=$number+1; } ?>
	</table>

  </div>
</div>
