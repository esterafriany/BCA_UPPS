
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
    <h3 class="panel-title">DAFTAR NOTIFIKASI REJECTED</h3>
</div>
<div class="panel-body">

<table align="center" style="border-collapse: collapse;" class="table table-bordered">

<?php  foreach($notifikasi as $notif)
{
?>
<tr>
  <td>
    <a href="<?php echo base_url(); ?>Koor/view_Recaps?tipe=<?=$notif->Tipe;  ?>&id_pemesanan=<?=$notif->PemesananID;  ?>"><?php echo $notif->NamaDepan; ?> <?php echo $notif->NamaBelakang;?> menolak pemesanan <?php echo $notif->Tipe;?> yang anda buat.</a>
  </td>
</tr>
<?php
}
?>

</table>
</div>
</div>

</form>
