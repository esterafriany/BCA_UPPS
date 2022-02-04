<?php
	$RoleID = ($this->session->userdata['logged_in']['RoleID']);
?>
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
	if (count($Rekap_Hotels)==0)
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
    <h3 class="panel-title">DETAIL PEMESANAN HOTEL</h3>
</div>
<div class="panel-body">
<form method="post" action="<?= base_url() ?>Koor/update_pemesanan_content?Content=Hotel">
<table id="dataTable" align="center" style="border-collapse: collapse;font-size: 13px;" class="table table-bordered">
		<tr align="center">
			<th width="5%">No.</th>
			<th>Program - Angkatan</th>
			<th>Tanggal Program</th>
			<th>Tanggal Awal Pemesanan</th>
			<th>PIC</th>
			<th>Nama Hotel</th>
			<th>Tanggal Checkin</th>
			<th>Tanggal Checkout</th>
			<th>Single (P)</th>
			<th>Double (P)</th>
			<th>Single (W)</th>
			<th>Double (W)</th>
			<th>Action</th>
		</tr>

		<?php
		$i = 1;
		$bool=TRUE;
		foreach($Rekap_Hotels as $hotel){

			if (isset($hotel->fault)==TRUE AND $bool==True) {
				?>
				<h2 class="bg-danger text-center" style="color:white;"><?=$hotel->fault?></h2>
				<?php
				$bool=FALSE;
			} ?>
		<tr>
			<script type="text/javascript">
				var classNote = "<?php echo $hotel->HotelNote;?>"
			</script>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"  align="center"><?php echo $i;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->nama_program;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->tanggal_program_mulai;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->tanggal_awal_pemesanan;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->pic_program;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->nama_hotel;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->tgl_checkin;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->tgl_checkout;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->Jml_SinglePria;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->Jml_TwinPria;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->Jml_SingleWanita;?></td>
			<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" ><?php echo $hotel->Jml_TwinWanita;?></td>
			<td width=<?php echo(strlen("Action"))?> style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" >
				<?php
				$selesai = $hotel->tanggal_akhir_pemesanan;
				$RoleID = ($this->session->userdata['logged_in']['RoleID']);
				$dis = date ("Y-m-d", strtotime("-1 day", strtotime($hotel->tanggal_awal_pemesanan)));
				if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1)
				{
					if (date("Y-m-d")<$dis AND date("Y-m-d") < $selesai)
					{ ?>
					<a style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan_detail";?>?content=Hotel&ID=<?=$hotel->hotelID?>&pemesanan=<?=$this->input->get("id_pemesanan")?>&NP=<?=$hotel->nama_program?>&AP=<?=$hotel->tanggal_awal_pemesanan?>" onclick="return confirm('Are you sure?');">&#10006;
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
			<input type="number" class="hidden" name="hotelID[]" value=<?=$hotel->hotelID?>>
		</tr>
		<?php
		$i = $i+1;
		$note = $hotel->HotelNote;
		}
		?>
		<input type="text" class="hidden" name="NP" value="<?php echo $hotel->nama_program;?>">
    <input type="text" class="hidden" name="AP" value="<?php echo $hotel->tanggal_awal_pemesanan;?>">
</table>

	<?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1){?>
		<a href="add-new-row" id="addAnchor" onclick="incrementValue();" class="btn btn-primary btn-sm" hidden="hidden"><i class="fa fa-plus"></i></a>
		<a href="delete-row" id="deleteAnchor" onclick="subtractionValue();" class="btn btn-primary btn-sm"><i class="fa fa-minus"></i></a>
		<?php
		if (date("Y-m-d")<$dis AND date("Y-m-d") < $selesai)
		{
		  ?>
		  <a class="close" style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan_content";?>?content=Hotel&pemesanan=<?=$this->input->get("id_pemesanan")?>" onclick="return confirm('Are you sure?');">Clean All Data</a>
		  <?php
		}
	}
	?>

	<br><br>Notes:
	<input type="text" class="form-control" disabled="disabled" id="noteArea" name="Note" value="<?php echo $note; ?>">
	<br>

	<?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1){?>
		<button id="save_button" type="submit" class="form-control btn btn-primary btn-circle btn-xl">&#10004; &nbsp; Save Changes
		</button>
		<input type="number" name="id_pemesanan" class="hidden" value=<?=$this->input->get("id_pemesanan")?>>
		<input type="number" class="hidden" id="number" name="Jumlah" value=<?=$i-1?> />
		</form>
		<?php
		if (date("Y-m-d")>=$dis OR date("Y-m-d")>=$hotel->tanggal_akhir_pemesanan)
		{
		  ?>
		  <button id="edit_btn" class="form-control btn btn-primary btn-circle btn-xl" disabled="disabled">Edit has been disabled:<?=$dis?></button>
		<?php
		}
		else
		{
		?>
	  <button id="edit_btn" class="form-control btn btn-primary btn-circle btn-xl">&#9998; &nbsp; Enable Edit Data</button>
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
		$('tr td:nth-child(7)').each(function ()
		{
			 var html = $(this).html();
			 length = html.length;
			 var input = $('<input name="NamaHotel[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="text" size='+length+'/>');        input.val(html);
			 $(this).html(input);
	 });
     $('tr td:nth-child(8)').each(function ()
     {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="TanggalCheckIn[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="date" size='+length+'/>');        input.val(html);
        $(this).html(input);
    });
     $('tr td:nth-child(9)').each(function ()
     {
			 var html = $(this).html();
			 length = html.length;
			 var input = $('<input name="TanggalCheckOut[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="date" size='+length+'/>');        input.val(html);
			 $(this).html(input);
    });
    $('tr td:nth-child(10)').each(function ()
    {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="SingleP[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="number" size='+length+'/>');
        input.val(html);
        $(this).html(input);
    });
		$('tr td:nth-child(11)').each(function ()
		{
				var html = $(this).html();
				length = html.length;
				var input = $('<input name="DoubleP[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="number" size='+length+'/>');
				input.val(html);
				$(this).html(input);
		});
		$('tr td:nth-child(12)').each(function ()
		{
				var html = $(this).html();
				length = html.length;
				var input = $('<input name="SingleW[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="number" size='+length+'/>');
				input.val(html);
				$(this).html(input);
		});
		$('tr td:nth-child(13)').each(function ()
		{
				var html = $(this).html();
				length = html.length;
				var input = $('<input name="DoubleW[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="number" size='+length+'/>');
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
