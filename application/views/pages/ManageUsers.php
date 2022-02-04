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
<?php
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
}?>

<div class="panel">
	<div class="panel-heading" style="padding-bottom:0px;">DAFTAR USER</div>
	<div class="panel-body">
		<div align="right"><button type="submit" class="btn btn-primary" >Add User <i class="fa fa-user-plus"></i></button></div><br>
		<div class="table-responsive">
		<table id="bootstrap-table" class="table table-hover table-striped" cellspacing="0" width="100%">
            <thead>
				<tr style="text-align: center">
					<th>Nama Depan</th>
					<th>Nama Belakang</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Username</th>
					<th>Password</th>
					<th>Role</th>
					<th>Description</th>
					<th colspan="2" width="100px">Action</th>
				</tr>
			</thead>

			<?php foreach ($Users as $User) {?>
			<tr>
				<td><?php echo $User['NamaDepan'];?></td>
				<td>
					<?php
					 echo $User['NamaDepan'].' ';
					 ?>
					 <?php
					 echo $User['NamaBelakang'];
					 ?>
				</td>
				<td><?php echo $User['Gender'];?></td>
				<td><?php echo $User['Email'];?></td>
				<td><?php echo $User['Username'];?></td>
				<td><?php echo $User['Password'];?></td>
				<td><?php echo $User['Roles'];?></td>
				<td><?php echo $User['Description'];?></td>
				<?php $ID = $User['UserID'];?>
				<?php if($RoleID==1) { ?>
					<td width="40px">
						<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/go_Edits";?>?ID=<?=$ID?>&tipe=User">
							<i class="fa fa-pencil"></i>
						</a>
					</td>
					<td>
						<a class="btn btn-success btn-xs" href="<?php echo base_url()."MasterAdmin/do_deletes";?>?ID=<?=$ID?>&tipe=User" onclick="return confirm('Are you sure?');">
							<i class="fa fa-times"></i>
						</a>
					</td>
				<?php } else { } ?>
			</tr>
			<?php } ?>
		</table>
		</div>
    </div>
</div>
<input type="hidden" name="tipe" value="User">

</form>
</div>