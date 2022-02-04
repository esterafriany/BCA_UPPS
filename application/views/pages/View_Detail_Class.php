<div style="padding-right: 5cm; color: blue">
<input type="hidden" name="tipe" value="Classes">

</div>
    <?php
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
    }?>

<div class="panel">
	<div class="panel-heading">
    <?php
    if (count($Rekap_Classes)==0)
    {
      ob_start(); // ensures anything dumped out will be caught
			$url = 'http://localhost/UPPS/Koor/view_Recaps?tipe=All';
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
    }
     ?>
		<h3 class="panel-title">DETAIL PEMESANAN KELAS </h3>

	</div>
	<div class="panel-body">
		<form method="Post" action="<?= base_url() ?>Koor/update_pemesanan_content?Content=Class">
			<table id="dataTable" align="center" style="border-collapse: collapse;font-size: 13px;" class="table table-bordered table-hover">
				<tr align="center">
					<th width="6%">No.</th>
					<th>Program - Angkatan</th>
					<th>Tanggal Program</th>
					<th colspan="2">Tanggal Pemesanan</th>
					<th>PIC</th>
					<th>Nama Ruangan</th>
					<th>Jumlah Peserta</th>
					<th>Layout</th>
					<th>Action</th>
				</tr>

				<?php
					$i = 1;
				$bool=TRUE;
					foreach($Rekap_Classes as $class) {
					if (isset($class->fault)==TRUE AND $bool==True)
					{
					  ?>
					  <h2 class="bg-danger text-center" style="color:white;"><?=$class->fault?></h2>
					  <?php
					  $bool=FALSE;
					}
						 ?>
						<tr>
						<script type="text/javascript">
							var classNote = "<?php echo $class->classNote;?>"
						</script>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $i ?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $class->nama_program;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $class->tanggal_program_mulai;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $class->tanggal_awal_pemesanan;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $class->tanggal_akhir_pemesanan;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $class->pic_program;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" class="Ruangan" align="center"><?php echo $class->nama_ruangan;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" class="Peserta" align="center"><?php echo $class->jumlah_peserta;?></td>
							<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" class="Layout" align="center"><?php echo $class->Layout;?></td>
								<?php
								$selesai = $class->tanggal_akhir_pemesanan;
								$dis = date ("Y-m-d", strtotime("-1 day", strtotime($class->tanggal_awal_pemesanan))); ?>
							<td width=<?php echo(strlen("Action"))?> style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
								<?php
								$RoleID = ($this->session->userdata['logged_in']['RoleID']);
								if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1)
								{
									if (date("Y-m-d")<$dis AND date("Y-m-d") < $selesai)
									{ ?>
										<a style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan_detail";?>?content=Class&ID=<?=$class->classID?>&pemesanan=<?=$this->input->get("id_pemesanan")?>&NP=<?=$class->nama_program?>&AP=<?=$class->tanggal_awal_pemesanan?>" onclick="return confirm('Are you sure?');">&#10006;
									  </a>
									<?php
									}else{
										echo "disabled:<br>".$dis;
								  }
								}
								else {
								  echo "None";
								}?>
							</td>
							<input type="number" class="hidden" name="ClassID[]" value="<?=$class->classID?>">
						</tr>
					<?php
					$i = $i+1;
					$note = $class->classNote;
					}
					?>
          <input type="text" class="hidden" name="NP" value="<?php echo $class->nama_program;?>">
          <input type="text" class="hidden" name="AP" value="<?php echo $class->tanggal_awal_pemesanan;?>">
			</table>

			<?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1){?>
				<a href="add-new-row" id="addAnchor" onclick="incrementValue();" class="btn btn-primary btn-sm" hidden="hidden"><i class="fa fa-plus"></i></a>
				<a href="delete-row" id="deleteAnchor" onclick=", nValue();" class="btn btn-primary btn-sm"><i class="fa fa-minus"></i></a>
				<?php
				if (date("Y-m-d")<$dis AND date("Y-m-d") < $selesai)
				{
				  ?>
				  <a class="close" style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan_content";?>?content=Class&pemesanan=<?=$this->input->get("id_pemesanan")?>" onclick="return confirm('Are you sure?');">Clean All Data</a>
				  <?php
				}
			}
			?>

			<br><br>Notes:
			<input type="text" class="form-control" disabled="disabled" id="noteArea" name="Note" value="<?php echo $note;?>">
			<br>


		<?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1){?>
			<button id="save_button" type="submit" class="form-control btn btn-primary btn-circle btn-xl">&#10004; Save Changes
			</button>
			<input type="number" name="id_pemesanan" class="hidden" value=<?=$this->input->get("id_pemesanan")?>>
			<input type="number" class="hidden" id="number" name="Jumlah" value=<?=$i-1?> />
		</form>
			<?php
			if (date("Y-m-d")>=$dis OR date("Y-m-d")>=$class->tanggal_akhir_pemesanan)
			{
			  ?>
			  <button id="edit_btn" class="form-control btn btn-primary btn-circle btn-xl" disabled="disabled">Edit has been disabled:<?=$dis?></button>
			<?php
			}
			else
			{
			?>
		  <button id="edit_btn" class="form-control btn btn-primary btn-circle btn-xl">&#9998;&nbsp;Enable Edit Data</button>
		<?php }

			}else { ?>
			  </form>
			<?php }  ?>

	</div>
</div>
<script type="text/javascript">
document.getElementById("noteArea").value = classNote;
$("#addAnchor").hide();
edit_btn = document.getElementById('edit_btn');
$('#save_button').hide();
$("#deleteAnchor").hide();
var num = <?php print($i-1)?>;
edit_btn.addEventListener("click",function()
{
    $("#noteArea").removeAttr('disabled');
    $("#addAnchor").fadeIn();
    $("#deleteAnchor").fadeIn();

    $('tr td:nth-child(8)').each(function () {
        var html = $(this).html();
        length = html.length;
        var roomnames = [
        <?php
        $room_strings = array();
        foreach($Rooms as $room)
        {
        $room_strings[] = '"'.$room['RoomName'].'"';
    	}
    	echo implode(",",$room_strings);
    	?>
    					];
    	var input = $('<input name="ruanganKelas[]" style="padding-bottom: 1px;padding-left: 1px;padding-top: 1px;padding-right: 1px;height: 24px;" class="form-control" type="text" size='+length+'/>');
        input.val(html);
        $(this).html(input);

    });
     $('tr td:nth-child(9)').each(function ()
     {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="jumlahPeserta[]" style="padding-bottom: 1px;padding-left: 1px;padding-top: 1px;padding-right: 1px;height: 24px;" class="form-control" type="number" size='+length+'/>');        input.val(html);
        $(this).html(input);

    });
    $('tr td:nth-child(10)').each(function ()
    {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="layoutKelas[]" style="padding-bottom: 1px;padding-left: 1px;padding-top: 1px;padding-right: 1px;height: 24px;" class="form-control" type="text" size='+length+'/>');
        input.val(html);
        $(this).html(input);
    });
    $("#edit_btn").each(function ()
    {
    	 $('#edit_btn').fadeOut()
    	 $('#save_button').fadeIn()
    });
});
var num= <?=$i?>;
function addRow(tableID)
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	var colCount = (table.rows[0].cells.length);
	for(var i=0; i<colCount; i++)
		{
			var newcell = row.insertCell(i);
			if (i==0)
			{
				newcell.innerHTML = num;
			}
			else
			{
				newcell.innerHTML = table.rows[1].cells[i].innerHTML;
			}
		}
		num++;
}

function deleteRow(tableID)
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if (rowCount > <?=$i?>)
	{
		var i = rowCount-1;
		table.deleteRow(i);
		num--;
	}
	else
	{
		alert("use the (x) to delete");
	}

}

$(function ()
{
    $('a[href="add-new-row"]').on('click', function (e)
    {
        e.preventDefault();
        addRow('dataTable');
    });
    $('a[href="delete-row"]').on('click', function (e)
    {
        e.preventDefault();
        deleteRow('dataTable')
    });
});
function incrementValue()
	{
		var value = document.getElementById('number').value
	    value = isNaN(value) ? 0 : value;
	    value++;
	    document.getElementById('number').value = value;
	    value=value;
	}
function subtractionValue()
	{
		var value = document.getElementById('number').value
	    // var value = parseInt(document.getElementById('number').value, 10);
	    value = isNaN(value) ? 0 : value;
	    value--;
	    document.getElementById('number').value = value;
	    value=value;
	}
</script>
