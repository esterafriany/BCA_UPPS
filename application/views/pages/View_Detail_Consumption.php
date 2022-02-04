<div style="padding-right: 5cm; color: blue">
<input type="hidden" name="tipe" value="Classes">
</div>
    <?php
    $RoleID = ($this->session->userdata['logged_in']['RoleID']);
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
    }?>

<div class="panel">
<div class="panel-heading">
  <?php
  if (count($Rekap_Consumption)==0)
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
    <h3 class="panel-title">DETAIL PEMESANAN KONSUMSI</h3>
</div>
<div class="panel-body">
<form method="post" action="<?= base_url() ?>Koor/update_pemesanan_content?Content=Consumption">
<table id="dataTable" align="center" style="border-collapse: collapse;font-size: 13px;" class="table table-bordered table-hover">
	<tr align="center">
		<th width="6%">No.</th>
		<th>Program - Angkatan</th>
		<th>Tanggal Program</th>
		<th>Tanggal Awal Pemesanan</th>
		<th>PIC</th>
		<th>Jenis Konsumsi</th>
		<th>Tanggal Konsumsi</th>
		<th>Jumlah</th>
		<th>Ruangan</th>
    <th>Action</th>
	</tr>

	<?php
	$i = 1;
    $bool=TRUE;
		foreach($Rekap_Consumption as $consump)
		{
      if (isset($consump->fault)==TRUE AND $bool==True)
      {
        ?>
        <h2 class="bg-danger text-center" style="color:white;"><?=$consump->fault?></h2>
        <?php
        $bool=FALSE;
      }
			 ?>
			<tr>
			<script type="text/javascript">
				var classNote = "<?php echo $consump->ConsumpNote;?>"
			</script>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $i;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $consump->nama_program;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $consump->tanggal_program_mulai;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $consump->tanggal_awal_pemesanan;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $consump->pic_program;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $consump->jenis_konsumsi;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;"><?php echo $consump->ConsumptionDate;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $consump->jumlah;?></td>
				<td style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center"><?php echo $consump->ruangan_konsumsi;?></td>

          <?php
          $selesai = $consump->tanggal_awal_pemesanan;
          $dis = date ("Y-m-d", strtotime("-1 day", strtotime($selesai)));
          ?>
          <?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1)
          {
            ?>
            <td width=<?php echo(strlen("Action"))?> style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;" align="center">
				<?php
				if (date("Y-m-d")>=$dis)
				{
                echo "disabled:<br>".$dis;
				} else { ?>
					<a style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan_detail";?>?content=Consumption&ID=<?=$consump->ConsumpID?>&pemesanan=<?=$this->input->get("id_pemesanan")?>&NP=<?=$consump->nama_program?>&AP=<?=$consump->tanggal_awal_pemesanan?>" onclick="return confirm('Are you sure?');">&#10006;
					</a>
            <?php } ?>
			</td>
            <?php
          }
          else {
            ?>
            <td>None</td>
            <?php
          }
           ?>
				<input type="number" class="hidden" name="consumptionID[]" value=<?=$consump->ConsumpID?>>
			</tr>
		<?php
		$i = $i+1;
		}
		?>
    <input type="text" class="hidden" name="NP" value="<?php echo $consump->nama_program;?>">
    <input type="text" class="hidden" name="AP" value="<?php echo $consump->tanggal_awal_pemesanan;?>">
</table>

<?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1){?>
<a href="add-new-row" id="addAnchor" onclick="incrementValue();" class="btn btn-primary btn-sm" hidden="hidden"><i class="fa fa-plus"></i></a>
<a href="delete-row" id="deleteAnchor" onclick="subtractionValue();" class="btn btn-primary btn-sm"><i class="fa fa-minus"></i></a>
<?php
  if (date("Y-m-d")<$dis)
  {
    ?>
    <a class="close" style="color: red;" href="<?php echo base_url()."Koor/remove_pemesanan_content";?>?content=Consumption&pemesanan=<?=$this->input->get("id_pemesanan")?>" onclick="return confirm('Are you sure?');">Clean All Data</a>
    <?php
  }
}
?>

<br><br>Notes:
<input type="text" class="form-control" disabled="disabled" id="noteArea" name="Note">
<br>
<?php if ($RoleID==2 AND strcmp($_SESSION["CompleteControl"],"NotAllowed")==0 OR $RoleID==2 AND strcmp($_SESSION["CompleteControl"],"Allowed")==0 OR $RoleID==1){?>
<button id="save_button" type="submit" class="form-control btn btn-primary btn-circle btn-xl">&#10004; &nbsp; Save Changes
</button>
<input type="number" name="id_pemesanan" class="hidden" value=<?=$this->input->get("id_pemesanan")?>>
<input type="number" class="hidden" id="number" name="Jumlah" value=<?=$i-1?> />
</form>
	<?php
	if (date("Y-m-d")>=$dis OR date("Y-m-d")>=$consump->tanggal_akhir_pemesanan)
	{ ?>
	  <button id="edit_btn" class="form-control btn btn-primary btn-circle btn-xl" disabled="disabled">Edit has been disabled:<?=$dis?></button>
	<?php
	} else {
	?>
	  <button id="edit_btn" class="form-control btn btn-primary btn-circle btn-xl">&#9998; &nbsp; Enable Edit Data</button>
	<?php
	}

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
        if (html=="Coffee Break Pagi")
        {
        var input = $('<select class="form-control" name="Consumption_type[]"><option value="" disabled selected>Pilih Jenis Konsumsi</option><option value="Coffee Break Pagi" selected>Coffee Break Pagi</option><option value="Lunch">Lunch</option><option value="Coffee Break Siang">Coffee Break Siang</option></select>');
    	}
    	else if (html=="Lunch")
    	{
    		var input = $('<select class="form-control" name="Consumption_type[]"></option><option value="Coffee Break Pagi">Coffee Break Pagi</option><option value="Lunch" selected>Lunch</option><option value="Coffee Break Siang">Coffee Break Siang</option></select>');
    	}
    	else if (html=="Coffee Break Siang")
    	{
    		var input = $('<select class="form-control" name="Consumption_type[]"></option><option value="Coffee Break Pagi">Coffee Break Pagi</option><option value="Lunch">Lunch</option><option value="Coffee Break Siang" selected>Coffee Break Siang</option></select>');
    	}
        $(this).html(input);

    });
     $('tr td:nth-child(8)').each(function ()
     {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="TanggalKonsumsi[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;" class="form-control" type="date" size='+length+'/>');        input.val(html);
        $(this).html(input);

    });
     $('tr td:nth-child(9)').each(function ()
     {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="JumlahKonsumsi[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="number" size='+length+'/>');        input.val(html);
        $(this).html(input);

    });
    $('tr td:nth-child(10)').each(function ()
    {
        var html = $(this).html();
        length = html.length;
        var input = $('<input name="RuanganKonsumsi[]" style="padding-top: 1px; padding-bottom: 1px;  padding-left: 1px; padding-right: 1px;height:24px;"  class="form-control" type="text" size='+length+'/>');
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
