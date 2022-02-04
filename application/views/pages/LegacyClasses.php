 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=History_Class.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>

<?php
$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$this->input->get("NP").'/'.$this->input->get("AP").'/Kelas/';
if (is_dir($file)==true) {
	$DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	$JumlahHistory=iterator_count($DirectoryCount);
}else{
  $JumlahHistory=0;
}
for ($i=1; $i <= $JumlahHistory; $i++){
  $url = base_url().'assets/JSON/'.str_replace(' ', '%20', $this->input->get("NP")).'/'.$this->input->get("AP").'/Kelas/LegacyKelas'.$i.'.json';
  $content = file_get_contents($url);
  $classjson[$i] = json_decode($content, true);
}?>


<table>
	<tr>
		<td>Nama Program</td>
		<td>:</td>
		<td><?=$this->input->get("Program")?></td>
	</tr>
	<tr>
		<td>Tanggal Program</td>
		<td>:</td>
		<td>
			<?php 
			echo date("d M Y", strtotime($this->input->get("TanggalProgramMulai"))); 
			echo " s/d "; 
			echo date("d M Y", strtotime($this->input->get("TanggalProgramSelesai"))); ?>
		</td>
	</tr>
	<tr>
		<td>PIC</td>
		<td>:</td>
		<td><?php echo $this->input->get("PIC");?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>

<div class="panel" >
    <div class="panel-body">
        <?php
        for ($legacy=1; $legacy < $JumlahHistory; $legacy++) { ?>
          <table class="table" style="text-align:center;font-weight: bold;" border="1">
            <?php $no = 1; ?>
            <tr>
              <th colspan=7 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Kelas <th>
            </tr>
            <tr>
              <td colspan="2">Ruangan</td>
              <td colspan="2">JumlahPeserta</td>
              <td colspan="2">Layout</td>
              <td rowspan="2">Catatan</td>
            </tr>
            <tr>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
            </tr>
            <?php
            $jsonCount=0;
            for ($count=0; $count < count($classjson[$legacy]['pemesanan_kelas'.$legacy]); $count++)
            {
              if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $jsonCount++;
              }
            }
            $nextjsonCount=0;
            $nextLegacy=$legacy+1;
            for ($count=0; $count < count($classjson[$nextLegacy]['pemesanan_kelas'.$nextLegacy]); $count++)
            {
              if ($classjson[$nextLegacy]['pemesanan_kelas'.$nextLegacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $nextjsonCount++;
              }
            }
            $dataCount=0;
            foreach ($Classes as $key)
            {
              if ($key->id_pemesanan==$this->input->get("PemesananID"))
              {
                $dataCount++;
              }
            }
            if ($nextjsonCount>$jsonCount)
            {
               $Nlegacy=$legacy+1;
              for ($i=0; $i < count($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy]); $i++)
              {
                if ($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <?php

                    if (isset($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"]))
                    {
                      if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"]==$classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"])
                      {
                        ?>
                        <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["RoomName"]);?></td>
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
                    <td><?php print($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["RoomName"]); ?></td>
                    <?php
                    if (isset($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"]))
                    {
                      if ($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                      {
                        ?>
                        <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Jumlah_Peserta"]); ?></td>
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
                     <td><?php print($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["Jumlah_Peserta"]); ?></td>
                     <?php
                     if (isset($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"]))
                     {
                       if ($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                       {
                         ?>
                         <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Layout"]); ?></td>
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
                      <td><?php $Nlegacy=$legacy+1; print($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["Layout"]); ?></td>
                      <td><?php print($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["Note"]); ?></td>
                  </tr>
                  <?php
                }
              }
            }
            else
            {
              for ($i=0; $i < count($classjson[$legacy]['pemesanan_kelas'.$legacy]); $i++)
              {
                if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["RoomName"]); ?></td>
                    <?php
                    $Nlegacy=$legacy+1;
                    if (isset($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]))
                    {
                      if ($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                      {
                        ?>
                        <td><?php print($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["RoomName"]); ?></td>
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
                    <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Jumlah_Peserta"]); ?></td>
                    <?php
                    $Nlegacy=$legacy+1;
                    if (isset($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]))
                    {
                      if ($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                      {
                        ?>
                        <td><?php print($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["Jumlah_Peserta"]); ?></td>
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
                     <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Layout"]); ?></td>
                     <?php
                     $Nlegacy=$legacy+1;
                     if (isset($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]))
                     {
                       if ($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["ClassID"]==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                       {
                         ?>
                         <td><?php print($classjson[$Nlegacy]['pemesanan_kelas'.$Nlegacy][$i]["Layout"]); ?></td>
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
                      <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Note"]); ?></td>
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
              <th colspan=7 style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Kelas <th>
            </tr>
            <tr>
              <td colspan="2">Ruangan</td>
              <td colspan="2">JumlahPeserta</td>
              <td colspan="2">Layout</td>
              <td rowspan="2">Catatan</td>
            </tr>
            <tr>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
              <td>DR</td>
              <td>MJD</td>
            </tr>
            <?php
            $jsonCount=0;
            for ($count=0; $count < count($classjson[$legacy]['pemesanan_kelas'.$legacy]); $count++)
            {
              if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
              {
                $jsonCount++;
              }
            }
            $dataCount=0;
            foreach ($Classes as $key)
            {
              if ($key->id_pemesanan==$this->input->get("PemesananID"))
              {
                $dataCount++;
              }
            }
            if ($dataCount>$jsonCount)
            {
              foreach ($Classes as $class)
              {
                ?>
                <tr style="font-weight: normal;">
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($classjson[$legacy]['pemesanan_kelas'.$legacy]); $i++)
                  {
                    if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"]==$class->classID)
                    {
                      ?>
                      <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["RoomName"]); ?></td>
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
                  <td><?php echo $class->nama_ruangan; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($classjson[$legacy]['pemesanan_kelas'.$legacy]); $i++)
                  {
                    if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"]==$class->classID)
                    {
                      ?>
                      <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Jumlah_Peserta"]); ?></td>
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
                  <td><?php echo $class->jumlah_peserta; ?></td>
                  <?php
                  $trig=True;
                  for ($i=0; $i < count($classjson[$legacy]['pemesanan_kelas'.$legacy]); $i++)
                  {
                    if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"]==$class->classID)
                    {
                      ?>
                      <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Layout"]); ?></td>
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
                  <td><?php echo $class->Layout; ?></td>
                  <td><?php echo $class->classNote; ?></td>
                </tr>
                <?php
              }
            }
            else
            {
              for ($i=0; $i < count($classjson[$legacy]['pemesanan_kelas'.$legacy]); $i++)
              {
                if ($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["PemesananID"]==$this->input->get("PemesananID"))
                {
                  ?>
                  <tr style="font-weight: normal;">
                    <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["RoomName"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($Classes as $class)
                    {
                      if ($class->classID==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                      {
                        ?>
                        <td><?php echo $class->nama_ruangan; ?></td>
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
                    <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Jumlah_Peserta"]); ?></td>
                    <?php
                    $trig=True;
                    foreach ($Classes as $class)
                    {
                      if ($class->classID==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                      {
                        ?>
                        <td><?php echo $class->jumlah_peserta; ?></td>
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
                     <td><?php print($classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["Layout"]); ?></td>
                     <?php
                     $trig=True;
                     foreach ($Classes as $class)
                     {
                       if ($class->classID==$classjson[$legacy]['pemesanan_kelas'.$legacy][$i]["ClassID"])
                       {
                         ?>
                        <td><?php echo $class->Layout; ?></td>
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
                    <td><?php echo $class->classNote; ?></td>
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
