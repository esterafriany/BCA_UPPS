 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=History_Bus_Bandara.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 
<?php
$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$this->input->get("NP").'/'.$this->input->get("AP").'/Airport/';
if (is_dir($file)==true){
	$DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	$JumlahHistory=iterator_count($DirectoryCount);
}else{
  $JumlahHistory=0;
}

for ($i=1; $i <= $JumlahHistory; $i++) {
  $url = base_url().'assets/JSON/'.str_replace(' ', '%20', $this->input->get("NP")).'/'.$this->input->get("AP").'/Airport/LegacyAirport'.$i.'.json';
  $content = file_get_contents($url);
  $airportjson[$i] = json_decode($content, true);
}
?>

<table>
	<tr>
		<td>Nama Program</td>
		<td>:</td>
		<td><?=$this->input->get("Program")?></td>
	</tr>
	<tr>
		<td>Tanggal Program</td>
		<td>:</td>
		<td><?php echo $this->input->get("TanggalProgramMulai"); echo " s/d 	"; echo  $this->input->get("TanggalProgramSelesai");?></td>
	</tr>
	<tr>
		<td>PIC</td>
		<td>:</td>
		<td><?php echo $this->input->get("PIC");?></td>
	</tr>
</table>

<div class="panel" action="<?= base_url()?>">
      <div class="panel-body">
        <center><h1><label>Arrival Log</label></h1></center>
        <?php
        for ($legacy=1; $legacy < $JumlahHistory; $legacy++)
        {
          ?>
          <table class="table" style="text-align:center;font-weight: bold;" border="1">
            <?php $no = 1; ?>
            <tr>
              <th colspan=13 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Airport Shuttle Kesampaian<th>
            </tr>
            <tr>
              <td colspan="2">Tanggal</td>
              <td colspan="2">Jam</td>
              <td colspan="2">Meeting Point</td>
              <td colspan="2">Tujuan</td>
              <td colspan="2">Penumpang</td>
              <td colspan="2">Keterangan</td>
              <td rowspan="2">Catatan</td>
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
            </tr>
            <?php

            $ArrivaljsonCount=0;
            for ($count=0; $count < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $count++)
            {
              if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $ArrivaljsonCount++;
              }
            }
            $nextArrivaljsonCount=0;

            $nextLegacy=$legacy+1;
            for ($count=0; $count < count($airportjson[$nextLegacy]['airportshuttle_arrival'.$nextLegacy]); $count++)
            {
              if ($airportjson[$nextLegacy]['airportshuttle_arrival'.$nextLegacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $nextArrivaljsonCount++;
              }
            }

            if ($nextArrivaljsonCount>$ArrivaljsonCount)
            {
               $Nlegacy=$legacy+1;
              for ($i=0; $i < count($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy]); $i++)
              {
                if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <?php
                    if (isset($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]))
                    {
                      if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]==$airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"])
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["TanggalBerangkat"]);?></td>
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
                    <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["TanggalBerangkat"]); ?></td>
                    <?php
                    if (isset($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]))
                    {
                      if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Jam"]); ?></td>
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
                     <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Jam"]); ?></td>
                     <?php
                     if (isset($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]))
                     {
                       if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                       {
                         ?>
                         <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["BerangkatDari"]); ?></td>
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
                      <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["BerangkatDari"]); ?></td>
                      <?php
                      if (isset($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]))
                      {
                        if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                        {
                          ?>
                          <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Tujuan"]); ?></td>
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
                       <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Tujuan"]); ?></td>
                       <?php
                       if (isset($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]))
                       {
                         if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                         {
                           ?>
                           <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Kapasitas"]); ?></td>
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
                        <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Kapasitas"]); ?></td>
                        <?php
                        if (isset($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]))
                        {
                          if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                          {
                            ?>
                            <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Keterangan"]); ?></td>
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
                         <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Keterangan"]); ?></td>
                         <td>
                           <?php
                           foreach ($AirportBus as $Bus)
                           {
                             echo $Bus->AirportNotes;break;
                           }
                            ?>
                         </td>
                  </tr>
                  <?php
                }
              }
            }
            else
            {
              for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
              {
                if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["TanggalBerangkat"]); ?></td>
                    <?php
                    $Nlegacy=$legacy+1;
                    if (isset($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]))
                    {
                      if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                      {
                        ?>
                        <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["TanggalBerangkat"]); ?></td>
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
                    <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Jam"]); ?></td>
                    <?php
                    $Nlegacy=$legacy+1;
                    if (isset($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]))
                    {
                      if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                      {
                        ?>
                        <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Jam"]); ?></td>
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
                     <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["BerangkatDari"]); ?></td>
                     <?php
                     $Nlegacy=$legacy+1;
                     if (isset($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]))
                     {
                       if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                       {
                         ?>
                         <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["BerangkatDari"]); ?></td>
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
                      <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Tujuan"]); ?></td>
                      <?php
                      $Nlegacy=$legacy+1;
                      if (isset($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]))
                      {
                        if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                        {
                          ?>
                          <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Tujuan"]); ?></td>
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
                       <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Keterangan"]); ?></td>
                       <?php
                       $Nlegacy=$legacy+1;
                       if (isset($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]))
                       {
                         if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                         {
                           ?>
                           <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Keterangan"]); ?></td>
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
                       <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Kapasitas"]); ?></td>
                       <?php
                       $Nlegacy=$legacy+1;
                       if (isset($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]))
                       {
                         if ($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["ArrivalID"]==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"])
                         {
                           ?>
                           <td><?php print($airportjson[$Nlegacy]['airportshuttle_arrival'.$Nlegacy][$i]["Kapasitas"]); ?></td>
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
                      <td>
                        <?php
                        foreach ($AirportBus as $Bus)
                        {
                          echo $Bus->AirportNotes;break;
                        }
                         ?>
                      </td>
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
              <th colspan=13 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Airport Shuttle Kesampaian<th>
            </tr>
            <tr>
              <td colspan="2">Tanggal</td>
              <td colspan="2">Jam</td>
              <td colspan="2">Meeting Point</td>
              <td colspan="2">Tujuan</td>
              <td colspan="2">Penumpang</td>
              <td colspan="2">Keterangan</td>
              <td rowspan="2">Catatan</td>
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
            </tr>
            <?php
            $jsonCount=0;
            for ($count=0; $count < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $count++)
            {
              if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $jsonCount++;
              }
            }
            $dataCount=0;
            foreach ($AirportBus as $key)
            {
              if ($key->id_pemesanan==$this->input->get("PemesananID") AND strcmp($key->jenis,"Arrival")==0)
              {
                $dataCount++;
              }
            }
            if ($dataCount>$jsonCount)
            {
              foreach ($AirportBus as $Bus)
              {
                if (strcmp($Bus->jenis,"Arrival")==0)
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["TanggalBerangkat"]); ?></td>
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
                    <td><?php echo $Bus->TanggalBerangkat; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Jam"]); ?></td>
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
                    <td><?php echo $Bus->Jam; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["BerangkatDari"]); ?></td>
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
                    <td><?php echo $Bus->Tujuan; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Tujuan"]); ?></td>
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
                    <td><?php echo $Bus->BerangkatDari; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Kapasitas"]); ?></td>
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
                    <td><?php echo $Bus->Kapasitas; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Keterangan"]); ?></td>
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
                    <td><?php echo $Bus->Keterangan; ?></td>
                    <td><?php echo $Bus->AirportNotes;?></td>
                  </tr>
                  <?php
                }
              }
            }
            else
            {
              for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_arrival'.$legacy]); $i++)
              {
                if ($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["TanggalBerangkat"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($AirportBus as $Bus)
                    {
                      if ($Bus->TID==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"] AND strcmp($Bus->jenis,"Arrival")==0)
                      {
                        ?>
                        <td><?php echo $Bus->TanggalBerangkat; ?></td>
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
                    <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Jam"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($AirportBus as $Bus)
                    {
                      if ($Bus->TID==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"] AND strcmp($Bus->jenis,"Arrival")==0)
                      {
                        ?>
                        <td><?php echo $Bus->Jam; ?></td>
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
                     <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["BerangkatDari"]); ?></td>
                     <?php
                     $trig=True;
                     foreach ($AirportBus as $Bus)
                     {
                       if ($Bus->TID==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"] AND strcmp($Bus->jenis,"Arrival")==0)
                       {
                         ?>
                        <td><?php echo $Bus->BerangkatDari; ?></td>
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
                      <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Tujuan"]); ?></td>
                      <?php
                      $trig=True;
                      foreach ($AirportBus as $Bus)
                      {
                        if ($Bus->TID==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"] AND strcmp($Bus->jenis,"Arrival")==0)
                        {
                          ?>
                         <td><?php echo $Bus->Tujuan; ?></td>
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
                       <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Kapasitas"]); ?></td>
                       <?php
                       $trig=True;
                       foreach ($AirportBus as $Bus)
                       {
                         if ($Bus->TID==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"] AND strcmp($Bus->jenis,"Arrival")==0)
                         {
                           ?>
                          <td><?php echo $Bus->Kapasitas; ?></td>
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
                        <td><?php print($airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["Keterangan"]); ?></td>
                        <?php
                        $trig=True;
                        foreach ($AirportBus as $Bus)
                        {
                          if ($Bus->TID==$airportjson[$legacy]['airportshuttle_arrival'.$legacy][$i]["ArrivalID"] AND strcmp($Bus->jenis,"Arrival")==0)
                          {
                            ?>
                           <td><?php echo $Bus->Keterangan; ?></td>
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
                    <td><?php echo $Bus->AirportNotes;?></td>
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
         <center><h1><label>Departure Log</label></h1></center>
          <?php
          for ($legacy=1; $legacy < $JumlahHistory; $legacy++)
          {
            ?>

            <table class="table" style="text-align:center;font-weight: bold;" border="1">
              <?php $no = 1; ?>
              <tr>
                <th colspan=13 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Airport Shuttle Kesampaian<th>
              </tr>
              <tr>
                <td colspan="2">Tanggal</td>
                <td colspan="2">Jam</td>
                <td colspan="2">Meeting Point</td>
                <td colspan="2">Tujuan</td>
                <td colspan="2">Penumpang</td>
                <td colspan="2">Keterangan</td>
                <td rowspan="2">Catatan</td>
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
              </tr>
              <?php
              $DeparturejsonCount=0;
              for ($count=0; $count < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $count++)
              {
                if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  $DeparturejsonCount++;
                }
              }
              $nextDeparturejsonCount=0;

              $nextLegacy=$legacy+1;
              for ($count=0; $count < count($airportjson[$nextLegacy]['airportshuttle_departure'.$nextLegacy]); $count++)
              {
                if ($airportjson[$nextLegacy]['airportshuttle_departure'.$nextLegacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  $nextDeparturejsonCount++;
                }
              }

              if ($nextDeparturejsonCount>$DeparturejsonCount)
              {

                   $Nlegacy=$legacy+1;
                  for ($i=0; $i < count($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy]); $i++)
                  {
                    if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                    {
                      ?>
                      <tr style="font-weight: normal;">
                        <?php
                        if (isset($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]))
                        {
                          if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]==$airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"])
                          {
                            ?>
                            <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["TanggalBerangkat"]);?></td>
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
                        <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["TanggalBerangkat"]); ?></td>
                        <?php
                        if (isset($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]))
                        {
                          if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                          {
                            ?>
                            <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Jam"]); ?></td>
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
                         <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Jam"]); ?></td>
                         <?php
                         if (isset($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]))
                         {
                           if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                           {
                             ?>
                             <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["BerangkatDari"]); ?></td>
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
                          <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["BerangkatDari"]); ?></td>
                          <?php
                          if (isset($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]))
                          {
                            if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                            {
                              ?>
                              <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Tujuan"]); ?></td>
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
                           <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Tujuan"]); ?></td>
                           <?php
                           if (isset($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]))
                           {
                             if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                             {
                               ?>
                               <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Kapasitas"]); ?></td>
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
                            <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Kapasitas"]); ?></td>
                            <?php
                            if (isset($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]))
                            {
                              if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                              {
                                ?>
                                <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Keterangan"]); ?></td>
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
                             <td><?php $Nlegacy=$legacy+1; print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Keterangan"]); ?></td>
                          <td>
                            <?php
                            foreach ($AirportBus as $Bus)
                            {
                              echo $Bus->AirportNotes;break;
                            }
                             ?>
                          </td>
                      </tr>
                      <?php
                    }
                  }
              }
              else
              {

                  for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
                  {
                    if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                    {
                      ?>
                      <tr style="font-weight: normal;">
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["TanggalBerangkat"]); ?></td>
                        <?php
                        $Nlegacy=$legacy+1;
                        if (isset($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]))
                        {
                          if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                          {
                            ?>
                            <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["TanggalBerangkat"]); ?></td>
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
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Jam"]); ?></td>
                        <?php
                        $Nlegacy=$legacy+1;
                        if (isset($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]))
                        {
                          if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                          {
                            ?>
                            <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Jam"]); ?></td>
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
                         <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["BerangkatDari"]); ?></td>
                         <?php
                         $Nlegacy=$legacy+1;
                         if (isset($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]))
                         {
                           if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                           {
                             ?>
                             <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["BerangkatDari"]); ?></td>
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
                          <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Tujuan"]); ?></td>
                          <?php
                          $Nlegacy=$legacy+1;
                          if (isset($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]))
                          {
                            if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                            {
                              ?>
                              <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Tujuan"]); ?></td>
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
                           <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Keterangan"]); ?></td>
                           <?php
                           $Nlegacy=$legacy+1;
                           if (isset($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]))
                           {
                             if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                             {
                               ?>
                               <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Keterangan"]); ?></td>
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
                           <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Kapasitas"]); ?></td>
                           <?php
                           $Nlegacy=$legacy+1;
                           if (isset($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]))
                           {
                             if ($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["DepartureID"]==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"])
                             {
                               ?>
                               <td><?php print($airportjson[$Nlegacy]['airportshuttle_departure'.$Nlegacy][$i]["Kapasitas"]); ?></td>
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
                          <td>
                            <?php
                            foreach ($AirportBus as $Bus)
                            {
                              echo $Bus->AirportNotes;break;
                            }
                             ?>
                          </td>
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
              <th colspan=13 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Airport Shuttle Keberangkatan<th>
            </tr>
            <tr>
              <td colspan="2">Tanggal</td>
              <td colspan="2">Jam</td>
              <td colspan="2">Meeting Point</td>
              <td colspan="2">Tujuan</td>
              <td colspan="2">Penumpang</td>
              <td colspan="2">Keterangan</td>
              <td rowspan="2">Catatan</td>
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
            </tr>
            <?php
            $jsonCount=0;
            for ($count=0; $count < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $count++)
            {
              if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $jsonCount++;
              }
            }
            $dataCount=0;
            foreach ($AirportBus as $key)
            {
              if ($key->id_pemesanan==$this->input->get("PemesananID") AND strcmp($key->jenis,"Departure")==0)
              {
                $dataCount++;
              }
            }
            if ($dataCount>$jsonCount)
            {
              foreach ($AirportBus as $Bus)
              {
                if (strcmp($Bus->jenis,"Departure")==0)
                {

                  ?>
                  <tr style="font-weight: normal;">
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["TanggalBerangkat"]); ?></td>
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
                    <td><?php echo $Bus->TanggalBerangkat; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Jam"]); ?></td>
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
                    <td><?php echo $Bus->Jam; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["BerangkatDari"]); ?></td>
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
                    <td><?php echo $Bus->Tujuan; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Tujuan"]); ?></td>
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
                    <td><?php echo $Bus->BerangkatDari; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Kapasitas"]); ?></td>
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
                    <td><?php echo $Bus->Kapasitas; ?></td>
                    <?php
                    $trig=True;
                    for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
                    {
                      if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"]==$Bus->TID)
                      {
                        ?>
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Keterangan"]); ?></td>
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
                    <td><?php echo $Bus->Keterangan; ?></td>
                    <td><?php echo $Bus->AirportNotes;?></td>
                  </tr>
                  <?php
                }

                }
            }
            else
            {
              for ($i=0; $i < count($airportjson[$legacy]['airportshuttle_departure'.$legacy]); $i++)
              {
                if ($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["TanggalBerangkat"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($AirportBus as $Bus)
                    {
                      if ($Bus->TID==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"] AND strcmp($Bus->jenis,"Departure")==0)
                      {
                        ?>
                        <td><?php echo $Bus->TanggalBerangkat; ?></td>
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
                    <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Jam"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($AirportBus as $Bus)
                    {
                      if ($Bus->TID==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"] AND strcmp($Bus->jenis,"Departure")==0)
                      {
                        ?>
                        <td><?php echo $Bus->Jam; ?></td>
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
                     <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["BerangkatDari"]); ?></td>
                     <?php
                     $trig=True;
                     foreach ($AirportBus as $Bus)
                     {
                       if ($Bus->TID==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"] AND strcmp($Bus->jenis,"Departure")==0)
                       {
                         ?>
                        <td><?php echo $Bus->BerangkatDari; ?></td>
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
                      <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Tujuan"]); ?></td>
                      <?php
                      $trig=True;
                      foreach ($AirportBus as $Bus)
                      {
                        if ($Bus->TID==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"] AND strcmp($Bus->jenis,"Departure")==0)
                        {
                          ?>
                         <td><?php echo $Bus->Tujuan; ?></td>
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
                       <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Kapasitas"]); ?></td>
                       <?php
                       $trig=True;
                       foreach ($AirportBus as $Bus)
                       {
                         if ($Bus->TID==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"] AND strcmp($Bus->jenis,"Departure")==0)
                         {
                           ?>
                          <td><?php echo $Bus->Kapasitas; ?></td>
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
                        <td><?php print($airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["Keterangan"]); ?></td>
                        <?php
                        $trig=True;
                        foreach ($AirportBus as $Bus)
                        {
                          if ($Bus->TID==$airportjson[$legacy]['airportshuttle_departure'.$legacy][$i]["DepartureID"] AND strcmp($Bus->jenis,"Departure")==0)
                          {
                            ?>
                           <td><?php echo $Bus->Keterangan; ?></td>
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
                    <td><?php echo $Bus->AirportNotes; ?></td>
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
