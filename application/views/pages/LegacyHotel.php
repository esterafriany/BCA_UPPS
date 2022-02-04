 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=History_Hotel.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>

<?php
$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$this->input->get("NP").'/'.$this->input->get("AP").'/Hotel/';//1
if (is_dir($file)==true)
{
  $DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
  $JumlahHistory=iterator_count($DirectoryCount);
}
else
{
  $JumlahHistory=0;
}
for ($i=1; $i <= $JumlahHistory; $i++)
{
  $url = base_url().'assets/JSON/'.str_replace(' ', '%20', $this->input->get("NP")).'/'.$this->input->get("AP").'/Hotel/LegacyHotel'.$i.'.json';//2
  $content = file_get_contents($url);
  $hoteljson[$i] = json_decode($content, true);//3
}
?>

<table>
	<tr>
		<td>Nama Program</td>
		<td>: <?=$this->input->get("Program")?></td>
		<td></td>
	</tr>
	<tr>
		<td>Tanggal Program</td>
		<td>: 
		<?php 
			echo date("d M Y", strtotime($this->input->get("TanggalProgramMulai"))); 
			echo " s/d "; 
			echo date("d M Y", strtotime($this->input->get("TanggalProgramSelesai"))); ?>
		</td>
		<td>
			
		</td>
	</tr>
	<tr>
		<td>PIC</td>
		<td>: <?php echo $this->input->get("PIC");?></td>
		<td></td>
	</tr>
</table>
<br>
<div class="panel" action="<?= base_url()?>">
      <div class="panel-body">
        <?php
        for ($legacy=1; $legacy < $JumlahHistory; $legacy++)
        {
          ?>
          <table class="table" style="text-align:center;font-weight: bold;" border="1">
            <?php $no = 1; ?>
            <tr>
              <th colspan=15 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Hotel <th><!-- //4 -->
            </tr>
            <tr>
              <td rowspan="2" colspan="2">Nama Hotel</td>
              <td colspan="4">Tanggal</td>
              <td colspan="4">Single</td>
              <td colspan="4">Twin SHaring</td>
              <td rowspan="3">Catatan</td>
            </tr>
            <tr>
              <td colspan="2">CheckIn</td>
              <td colspan="2">CheckOut</td>
              <td colspan="2">Pria</td>
              <td colspan="2">Wanita</td>
              <td colspan="2">Pria</td>
              <td colspan="2">Wanita</td>
            </tr>
            <tr>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
            </tr>
            <?php
            $jsonCount=0;
            for ($count=0; $count < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $count++)//5
            {
              if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))//6
              {
                $jsonCount++;
              }
            }
            $nextjsonCount=0;
            $nextLegacy=$legacy+1;
            for ($count=0; $count < count($hoteljson[$nextLegacy]['pemesanan_hotel'.$nextLegacy]); $count++)
            {
              if ($hoteljson[$nextLegacy]['pemesanan_hotel'.$nextLegacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $nextjsonCount++;
              }
            }
            $dataCount=0;
            foreach ($Hotels as $key)
            {
              if ($key->id_pemesanan==$this->input->get("PemesananID"))
              {
                $dataCount++;
              }
            }
            if ($nextjsonCount>$jsonCount)
            {
               $Nlegacy=$legacy+1;
              for ($i=0; $i < count($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy]); $i++)
              {
                if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <?php

                    if (isset($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]))
                    {
                      if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"])
                      {
                        ?>
                        <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]);?></td>
                        <?php
                      }
                    }
                    else
                    {
                      ?>
                      <td>-</td>
                      <?php
                      }
                     ?>
                    <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["HotelName"]); ?></td>
                    <?php
                    if (isset($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]))
                    {
                      if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                      {
                        ?>
                        <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckIn"]); ?></td>
                        <?php
                      }
                    }
                      else
                      {
                      ?>
                      <td>-</td>
                      <?php
                      }
                     ?>
                     <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["TanggalCheckIn"]); ?></td>
                     <?php
                     if (isset($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]))
                     {
                       if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                       {
                         ?>
                         <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckOut"]); ?></td>
                         <?php
                       }
                     }
                       else
                       {
                       ?>
                       <td>-</td>
                       <?php
                       }
                      ?>
                      <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["TanggalCheckOut"]); ?></td>

                     <?php
                     if (isset($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]))
                     {
                       if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                       {
                         ?>
                         <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_SinglePria"]); ?></td>
                         <?php
                       }
                     }
                       else
                       {
                       ?>
                       <td>-</td>
                       <?php
                       }
                      ?>
                      <td><?php $Nlegacy=$legacy+1; print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_SinglePria"]); ?></td>
                      <?php
                      if (isset($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]))
                      {
                        if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                        {
                          ?>
                          <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_singleWanita"]); ?></td>
                          <?php
                        }
                      }
                        else
                        {
                        ?>
                        <td>-</td>
                        <?php
                        }
                       ?>
                       <td><?php $Nlegacy=$legacy+1; print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_singleWanita"]); ?></td>
                        <?php
                        if (isset($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]))
                        {
                          if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                          {
                            ?>
                            <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_TwinPria"]); ?></td>
                            <?php
                          }
                        }
                          else
                          {
                          ?>
                          <td>-</td>
                          <?php
                          }
                         ?>
                         <td><?php $Nlegacy=$legacy+1; print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_TwinPria"]); ?></td>
                         <?php
                         if (isset($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]))
                         {
                           if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                           {
                             ?>
                             <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_twinWanita"]); ?></td>
                             <?php
                           }
                         }
                           else
                           {
                           ?>
                           <td>-</td>
                           <?php
                           }
                          ?>
                          <td><?php $Nlegacy=$legacy+1; print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_twinWanita"]); ?></td>
                          <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Note"]); ?></td>
                  </tr>
                  <?php
                }
              }
            }
            else
            {
              for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
              {
                if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["HotelName"]); ?></td>
                    <?php
                    $Nlegacy=$legacy+1;
                    if (isset($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]))
                    {
                      if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                      {
                        ?>
                        <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["HotelName"]); ?></td>
                        <?php
                      }
                    }
                      else
                      {
                      ?>
                      <td>DELETED</td>
                      <?php
                      }
                     ?>
                    <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckIn"]); ?></td>
                    <?php
                    $Nlegacy=$legacy+1;
                    if (isset($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]))
                    {
                      if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                      {
                        ?>
                        <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["TanggalCheckIn"]); ?></td>
                        <?php
                      }
                    }
                      else
                      {
                      ?>
                      <td>DELETED</td>
                      <?php
                      }
                     ?>

                     <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckOut"]); ?></td>
                     <?php
                     $Nlegacy=$legacy+1;
                     if (isset($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]))
                     {
                       if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                       {
                         ?>
                         <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["TanggalCheckOut"]); ?></td>
                         <?php
                       }
                     }
                       else
                       {
                       ?>
                       <td>DELETED</td>
                       <?php
                       }
                      ?>

                     <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_SinglePria"]); ?></td>
                     <?php
                     $Nlegacy=$legacy+1;
                     if (isset($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]))
                     {
                       if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                       {
                         ?>
                         <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_SinglePria"]); ?></td>
                         <?php
                       }
                     }
                       else
                       {
                       ?>
                       <td>DELETED</td>
                       <?php
                       }
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_singleWanita"]); ?></td>
                      <?php
                      $Nlegacy=$legacy+1;
                      if (isset($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]))
                      {
                        if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                        {
                          ?>
                          <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_singleWanita"]); ?></td>
                          <?php
                        }
                      }
                        else
                        {
                        ?>
                        <td>DELETED</td>
                        <?php
                        }
                       ?>
                       <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_TwinPria"]); ?></td>
                       <?php
                       $Nlegacy=$legacy+1;
                       if (isset($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]))
                       {
                         if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                         {
                           ?>
                           <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_TwinPria"]); ?></td>
                           <?php
                         }
                       }
                         else
                         {
                         ?>
                         <td>DELETED</td>
                         <?php
                         }
                        ?>
                        <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_twinWanita"]); ?></td>
                        <?php
                        $Nlegacy=$legacy+1;
                        if (isset($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]))
                        {
                          if ($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["PemesananHotelID"]==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                          {
                            ?>
                            <td><?php print($hoteljson[$Nlegacy]['pemesanan_hotel'.$Nlegacy][$i]["Jml_twinWanita"]); ?></td>
                            <?php
                          }
                        }
                          else
                          {
                          ?>
                          <td>DELETED</td>
                          <?php
                          }
                         ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Note"]); ?></td>
                  </tr>
                  <?php
                }
              }
            }
               ?>
          </table>
          <?php
        }
        ?>
        <?php if ($JumlahHistory!=0)
        {
          ?>
          <table class="table" style="text-align:center;font-weight: bold;" border="1">
            <?php $no = 1; ?>
            <tr>
              <th colspan=15 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Hotel <th><!-- //4 -->
            </tr>
            <tr>
              <td rowspan="2" colspan="2">Nama Hotel</td>
              <td colspan="4">Tanggal</td>
              <td colspan="4">Single</td>
              <td colspan="4">Twin SHaring</td>
              <td rowspan="3">Catatan</td>
            </tr>
            <tr>
              <td colspan="2">CheckIn</td>
              <td colspan="2">CheckOut</td>
              <td colspan="2">Pria</td>
              <td colspan="2">Wanita</td>
              <td colspan="2">Pria</td>
              <td colspan="2">Wanita</td>
            </tr>
            <tr>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
            </tr>
            <?php
            $jsonCount=0;
            for ($count=0; $count < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $count++)
            {
              if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $jsonCount++;
              }
            }
            $dataCount=0;
            foreach ($Hotels as $key)
            {
              if ($key->id_pemesanan==$this->input->get("PemesananID"))
              {
                $dataCount++;
              }
            }
            if ($dataCount>$jsonCount)
            {
              foreach ($Hotels as $hotel)
              {
                ?>
                <tr style="font-weight: normal;">
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
                  {
                    if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hotel->hotelID)
                    {
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["HotelName"]); ?></td>
                      <?php
                      $trig=False;
                    }
                  }
                  if ($trig)
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $hotel->nama_hotel; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
                  {
                    if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hotel->hotelID)
                    {
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckIn"]); ?></td>
                      <?php
                      $trig=False;
                    }
                  }
                  if ($trig)
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $hotel->tgl_checkin; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
                  {
                    if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hotel->hotelID)
                    {
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckOut"]); ?></td>
                      <?php
                      $trig=False;
                    }
                  }
                  if ($trig)
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $hotel->tgl_checkout; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
                  {
                    if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hotel->hotelID)
                    {
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_SinglePria"]); ?></td>
                      <?php
                      $trig=False;
                    }
                  }
                  if ($trig)
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $hotel->Jml_SinglePria; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
                  {
                    if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hotel->hotelID)
                    {
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_singleWanita"]); ?></td>
                      <?php
                      $trig=False;
                    }
                  }
                  if ($trig)
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $hotel->Jml_SingleWanita; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
                  {
                    if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hotel->hotelID)
                    {
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_TwinPria"]); ?></td>
                      <?php
                      $trig=False;
                    }
                  }
                  if ($trig)
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $hotel->Jml_TwinPria; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
                  {
                    if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"]==$hotel->hotelID)
                    {
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_twinWanita"]); ?></td>
                      <?php
                      $trig=False;
                    }
                  }
                  if ($trig)
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $hotel->Jml_TwinWanita; ?></td>
                  <td><?php echo $hotel->HotelNote; ?></td>
                </tr>
                <?php
              }
            }
            else
            {
              for ($i=0; $i < count($hoteljson[$legacy]['pemesanan_hotel'.$legacy]); $i++)
              {
                if ($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["HotelName"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($Hotels as $hotel)
                    {
                      if ($hotel->hotelID==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                      {
                        ?>
                        <td><?php echo $hotel->nama_hotel; ?></td>
                        <?php
                        $trig=False;
                      }
                    }
                    if ($trig)
                    {
                      ?>
                      <td>DELETED</td>
                      <?php
                    }
                     ?>
                    <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckIn"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($Hotels as $hotel)
                    {
                      if ($hotel->hotelID==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                      {
                        ?>
                        <td><?php echo $hotel->tgl_checkin; ?></td>
                        <?php
                        $trig=False;
                      }
                    }
                    if ($trig)
                    {
                      ?>
                      <td>DELETED</td>
                      <?php
                    }
                     ?>
                     <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["TanggalCheckOut"]); ?></td>
                     <?php
                     $trig=True;
                     foreach ($Hotels as $hotel)
                     {
                       if ($hotel->hotelID==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                       {
                         ?>
                        <td><?php echo $hotel->tgl_checkout; ?></td>
                         <?php
                         $trig=False;
                       }
                     }
                     if ($trig)
                     {
                       ?>
                       <td>DELETED</td>
                       <?php
                     }
                      ?>
                      <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_SinglePria"]); ?></td>
                      <?php
                      $trig=True;
                      foreach ($Hotels as $hotel)
                      {
                        if ($hotel->hotelID==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                        {
                          ?>
                         <td><?php echo $hotel->Jml_SinglePria; ?></td>
                          <?php
                          $trig=False;
                        }
                      }
                      if ($trig)
                      {
                        ?>
                        <td>DELETED</td>
                        <?php
                      }
                       ?>
                       <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_singleWanita"]); ?></td>
                       <?php
                       $trig=True;
                       foreach ($Hotels as $hotel)
                       {
                         if ($hotel->hotelID==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                         {
                           ?>
                          <td><?php echo $hotel->Jml_SingleWanita; ?></td>
                           <?php
                           $trig=False;
                         }
                       }
                       if ($trig)
                       {
                         ?>
                         <td>DELETED</td>
                         <?php
                       }
                        ?>
                        <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_TwinPria"]); ?></td>
                        <?php
                        $trig=True;
                        foreach ($Hotels as $hotel)
                        {
                          if ($hotel->hotelID==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                          {
                            ?>
                           <td><?php echo $hotel->Jml_TwinPria; ?></td>
                            <?php
                            $trig=False;
                          }
                        }
                        if ($trig)
                        {
                          ?>
                          <td>DELETED</td>
                          <?php
                        }
                         ?>
                         <td><?php print($hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["Jml_twinWanita"]); ?></td>
                         <?php
                         $trig=True;
                         foreach ($Hotels as $hotel)
                         {
                           if ($hotel->hotelID==$hoteljson[$legacy]['pemesanan_hotel'.$legacy][$i]["PemesananHotelID"])
                           {
                             ?>
                            <td><?php echo $hotel->Jml_TwinWanita; ?></td>
                             <?php
                             $trig=False;
                           }
                         }
                         if ($trig)
                         {
                           ?>
                           <td>DELETED</td>
                           <?php
                         }
                          ?>
                    <td><?php echo $hotel->HotelNote; ?></td>
                  </tr>
                  <?php
                }
              }
            }
               ?>
          </table>
          <?php
        }
        else
        {
          ?>
          <h1>NO CHANGES HAS BEEN MADE</h1>
          <?php
        }
         ?>
      </div>
</div>
