<?php
		$RoleID = ($this->session->userdata['logged_in']['RoleID']);
		if($RoleID==1)
{?>
		<form method="post" action="<?= base_url() ?>MasterAdmin/do_edits">
<?php }
	else {
		?>
		<form method="post" action="<?= base_url() ?>do_edits">
		<?php
	}
?>
<input type="hidden" name="tipe" value="User">
<input type="hidden" name="selectedID" value="<?=$this->input->get("ID")?>">
<div class="panel">
	<div class="panel-heading" style="padding-bottom:0px;">EDIT USER</div>
	<div class="panel-body">
	<div class="vertical-align-middle">
		<?php
		if (isset($message_display) OR $this->input->get("Message")!=null) 
		{ 
			if(isset($message_display)==false)
			{
				$message_display = $this->input->get("Message"); 
			}
		?>
			<div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			   <?php echo $message_display; ?>
			</div>
		<?php }?>
		
		<div class="panel panel-default">
		<div class="panel-body">
		<table cellspacing="0" width="100%">
		<?php foreach ($Users as $new_item){ ?>
			<tbody>
				<tr>
					<td>Nama Depan</td>
					<td>
						<input type="text" name="NewNamaDepan" class="form-control" value=<?= $new_item['NamaDepan']?> >
					</td>
				</tr>
				
				<tr>
					<td width="180px">Nama Belakang</td>
					<td>
						<input type="text" name="NewNamaBelakang" class="form-control" value=<?= $new_item['NamaBelakang']?>>
					</td>
				</tr>
				
				<tr>
					<td>Gender</td>
					<td>
						<select name="Gender" id="NewGender" class="form-control">
							<?php for ($x = 0; $x <= 1; $x++) { ?>
								
							<?php }  ?>
							
							<?php if($new_item['Gender'] == "Male") { ?>
								<option value="Male" selected>Male</option>
								<option value="Female">Female</option>
							<?php }else { ?>
								<option value="Male">Male</option>
								<option value="Female" selected>Female</option>
							<?php } ?>
						</select>
						
					</td>
				</tr>
				
				<tr>
					<td>Email</td>
					<td>
						<input type="email" name="NewEmail" class="form-control" value=<?= $new_item['Email']?>>
					</td>
				</tr>
				
				<tr>
					<td>Username</td>
					<td>
						<input type="text" name="NewUsername" class="form-control" value=<?= $new_item['Username']?>>
					</td>
				</tr>
				
				<tr>
					<td>Password</td>
					<td>
						<input type="text" name="NewPassword" class="form-control" value=<?= $new_item['Password']?>>
					</td>
				</tr>
				
				<tr>
					<td>Role</td>
					<td>
						<select name="Role" id="Role" class="form-control">
							<option value="">Please Select</option>
							<?php foreach ($Roles as $type): ?>
								<?php $selected = '' ?>
								<?php if ($type->RoleID == $new_item['RoleID']) {
									$selected = 'selected';
								} ?>
								<option value="<?php echo $type->RoleID  ?>" <?php echo $selected ?>><?php echo $type->Roles ?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
			</tbody>
		<?php } ?>
        </table>
		</div>
		<div class="panel-footer">
		<button type="submit" class="btn btn-primary">Save Changes <i class="fa fa-check"></i></button>
		<button type="" class="btn btn-primary">Back <i class="fa fa-arrow-circle-left"></i></button>
		</div>
	</div>
    </div>
</div>
</form>