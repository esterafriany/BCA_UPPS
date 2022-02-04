<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
	if($RoleID==1)
	{ ?>
<form method="post" action="<?= base_url() ?>MasterAdmin/do_Adds?tipe=User" class="form-auth-large" >
	<?php
	}
	else{
		?>
		<form method="post" action="<?= base_url() ?>dothat/do_Adds?tipe=User" class="form-auth-large" >
		<?php
	}
?>
<!-- TABLE STRIPED -->
<div class="panel">
	<div class="panel-heading" style="padding-bottom:0px;">ADD USER</div>
	<div class="panel-body">
	<div class="vertical-align-middle">
		<?php
		if (isset($message_display)) { ?>
		
		<div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		   <?php echo $message_display; ?>
		</div>
		
		<?php }?>
		<div class="panel panel-default">
		<div class="panel-body">
		
		<table cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td width="170px">Nama Depan</td>
					<td>
						<input type="text" name="NewNamaDepan" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>Nama Belakang</td>
					<td>
						<input type="text" name="NewNamaBelakang" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>Gender</td>
					<td>
						<select name="Gender" id="NewGender" class="form-control">
							<option value="Male">Please Select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td>Email</td>
					<td>
						<input type="email" name="NewEmail" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>Username</td>
					<td>
						<input type="text" name="NewUsername" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>Password</td>
					<td>
						<input type="Password" name="NewPassword" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>Role</td>
					<td>
						<select name="Role" id="Role" class="form-control">
							<option>Please Select</option>
							<?php
								foreach($Users as $new_item)
								{
									?>
										<option value=<?=$new_item->RoleID ?> >
										<?=$new_item->Roles?>
										</option>
									<?php
								}
							?>
						</select>
					</td>
				</tr>
		
			</tbody>
        </table>
		</div>
		<div class="panel-footer">
		<button type="submit" class="btn btn-primary">Save <i class="fa fa-check"></i></button>
		<button type="reset" class="btn btn-primary">Reset <i class="fa fa-undo"></i></button>
		</div>
		</div>
		</div>
    </div>
</div>
<!-- END TABLE STRIPED -->

</form>