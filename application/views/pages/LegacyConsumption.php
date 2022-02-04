 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=History_Konsumsi.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
<?php
$category = ["Coffee Break Pagi","Lunch","Coffee Break Siang"];
$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$this->input->get("NP").'/'.$this->input->get("AP").'/Konsumsi/';
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
  $url = base_url().'assets/JSON/'.str_replace(' ', '%20', $this->input->get("NP")).'/'.$this->input->get("AP").'/Konsumsi/LegacyKonsumsi'.$i.'.json';
  $content = file_get_contents($url);
  $Consumpjson[$i] = json_decode($content, true);
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
</table>
<br>
<div class="panel" action="<?= base_url()?>">

      <div class="panel-body">
        <div id="" style="overflow-y: scroll; height:auto;">
        <?php
        $dataCount=0;
        foreach ($Consump as $key)
          {
            if ($key->id_pemesanan==$this->input->get("PemesananID"))
            {
              $dataCount++;
            }
          }
        $jsonCount=0;
        $nextjsonCount=0;
        for ($legacy=1; $legacy < $JumlahHistory; $legacy++)
        {
          $Nlegacy=$legacy+1;

          for ($count=0; $count < count($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy]); $count++)
          {
            if ($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
            {
              $jsonCount++;
            }
          }
          $nextLegacy=$legacy+1;

          for ($count=0; $count < count($Consumpjson[$nextLegacy]['pemesanan_konsumsi'.$nextLegacy]); $count++)
          {
            if ($Consumpjson[$nextLegacy]['pemesanan_konsumsi'.$nextLegacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
            {
              $nextjsonCount++;
            }
          }
          // foreach ($Consump as $key)
          // {
          //   if ($key->id_pemesanan==$this->input->get("PemesananID"))
          //   {
          //     $dataCount++;
          //   }
          // }
          ?>
          <table class="table table-bordered table-hover" style="text-align:center;font-weight: bold;" border="1">
            <?php
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              $diff=1;
              while (strtotime($date) <= strtotime($end_date))
              {
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                $diff=$diff+1;
              }
              $datediff=$diff;
              ?>
            <tr>
              <th colspan=<?=(2+6*$datediff); ?> style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Konsumsi <th>
            </tr>
            <tr>
              <td rowspan="2">Hari/Tanggal</td>
              <?php
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              while (strtotime($date) <= strtotime($end_date))
              {
                ?>
                <td colspan="6"><?php print(date('l', strtotime($date)))?></td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
               ?>               <td rowspan="6" style="background-color:#aec6cf">Catatan</td>
            </tr>
            <tr>
              <?php
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              $flag=0;
              while (strtotime($date) <= strtotime($end_date))
              {
                ?>
                <td colspan="6"><?=$date?></td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
               ?>
            </tr>
            <tr>
              <td>Kategori</td>
              <?php
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              $flag=0;
              while (strtotime($date) <= strtotime($end_date))
              {
                for ($type=0; $type < count($category); $type++)
                {
                  ?>
                  <td colspan="2"><?=$category[$type]?></td>
                  <?php
                }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
               ?>
            </tr>
            <tr>
              <td rowspan="2">Ruangan</td>
            </tr>
            <?php
            $arrRJ[]="";$arrRJ2[]="";
            for ($dr=0; $dr < count($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy]); $dr++)
            {
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              while (strtotime($date) <= strtotime($end_date))
              {
                if ($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["Tanggal"],$date)==0)
                {
                  for ($types=0; $types < count($category); $types++)
                  {
                    if (strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["JenisKonsumsi"],$category[$types])==0)
                    {
                      $arrRJ[$date][$types] = $Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["RuanganKonsumsi"];
                    }
                  }
                }

                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
            }
            for ($dr=0; $dr < count($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy]); $dr++)
            {
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              while (strtotime($date) <= strtotime($end_date))
              {
                if ($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["Tanggal"],$date)==0)
                {
                  for ($types=0; $types < count($category); $types++)
                  {
                    if (strcmp($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["JenisKonsumsi"],$category[$types])==0)
                    {
                      $arrRJ2[$date][$types] = $Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["RuanganKonsumsi"];
                    }
                  }
                }

                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
            }
            date_default_timezone_set('UTC');
            $date =   $this->input->get("AP");
            $end_date = $this->input->get("PaS");
            while (strtotime($date) <= strtotime($end_date))
            {
              for ($types=0; $types < count($category); $types++)
              {
                if (isset($arrRJ[$date][$types]))
                {
                  ?>
                  <td><?=$arrRJ[$date][$types]?></td>
                  <?php
                }
                else
                {
                  ?>
                  <td>-</td>
                  <?php
                }
                if (isset($arrRJ2[$date][$types]))
                {
                  ?>
                  <td><?=$arrRJ2[$date][$types]?></td>
                  <?php
                }
                else
                {
                  ?>
                  <td>-</td>
                  <?php
                }
              }
              $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            }
              ?>
              <tr>
              <td>State</td>
              <?php
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              while (strtotime($date) <= strtotime($end_date))
              {
                for ($each=0; $each < count($category); $each++)
                {
                  ?>
                  <td>DR</td>
                  <td>MJD</td>
                  <?php
                }
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
               ?>
            </tr>
            <tr>
              <td>Total</td>
              <?php
              $arrTJ[]="";$arrTJ2[]="";
              for ($dr=0; $dr < count($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy]); $dr++)
              {
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                  if ($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["Tanggal"],$date)==0)
                  {
                    for ($types=0; $types < count($category); $types++)
                    {
                      if (strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["JenisKonsumsi"],$category[$types])==0)
                      {
                        $arrTJ[$date][$types] = $Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["Jumlah"];
                      }
                    }
                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
              }
              $currNoteJ="";
              for ($dr=0; $dr < count($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy]); $dr++)
              {
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                  if ($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["Tanggal"],$date)==0)
                  {
                    for ($types=0; $types < count($category); $types++)
                    {
                      if (strcmp($Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["JenisKonsumsi"],$category[$types])==0)
                      {
                        $arrTJ2[$date][$types] = $Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["Jumlah"];
                        $currNoteJ = $Consumpjson[$Nlegacy]['pemesanan_konsumsi'.$Nlegacy][$dr]["Note"];
                      }
                    }
                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
              }

              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              while (strtotime($date) <= strtotime($end_date))
              {
                for ($types=0; $types < count($category); $types++)
                {
                  if (isset($arrTJ[$date][$types]))
                  {
                    ?>
                    <td><?=$arrTJ[$date][$types]?></td>
                    <?php
                  }
                  else
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  if (isset($arrTJ2[$date][$types]))
                  {
                    ?>
                    <td><?=$arrTJ2[$date][$types]?></td>
                    <?php
                  }
                  else
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }

                }
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
                ?>

                <td><?=$currNoteJ?></td>
            </tr>
          </table>
          <?php
        }
        if ($JumlahHistory!=0)
        {
          if ($dataCount==0)
          {
            ?>
            <center><h1>Removed</h1></center>
            <?php
          }
          else
          {
            ?>
            <table class="table table-bordered table-hover" style="text-align:center;font-weight: bold;" border="1">
              <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                $diff=1;
                while (strtotime($date) <= strtotime($end_date))
                {
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                  $diff=$diff+1;
                }
                $datediff=$diff;
                ?>
              <tr>
                <th colspan=<?=(2+6*$datediff); ?> style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Konsumsi <th>
              </tr>
              <tr>
                <td rowspan="2">Hari/Tanggal</td>
                <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                  ?>
                  <td colspan="6"><?php print(date('l', strtotime($date)))?></td>
                  <?php
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                 ?>
                 <td rowspan="6" style="background-color:#aec6cf">Catatan</td>
              </tr>
              <tr>
                <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                $flag=0;
                while (strtotime($date) <= strtotime($end_date))
                {
                  ?>
                  <td colspan="6"><?=$date?></td>
                  <?php
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                  }
                 ?>
              </tr>
              <tr>
                <td>Kategori</td>
                <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                $flag=0;
                while (strtotime($date) <= strtotime($end_date))
                {
                  for ($type=0; $type < count($category); $type++)
                  {
                    ?>
                    <td colspan="2"><?=$category[$type]?></td>
                    <?php
                  }
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                  }
                 ?>
              </tr>
              <tr>
                <td rowspan="2">Ruangan</td>
              </tr>
              <?php
              $arrRJ[]="";$arrRD[]="";
              for ($dr=0; $dr < count($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy]); $dr++)
              {
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                  if ($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["Tanggal"],$date)==0)
                  {
                    for ($types=0; $types < count($category); $types++)
                    {
                      if (strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["JenisKonsumsi"],$category[$types])==0)
                      {
                        $arrRJ[$date][$types] = $Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["RuanganKonsumsi"];
                      }
                    }
                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
              }
              for ($dats=0; $dats < count($Consump); $dats++)
              {
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                  if ($Consump[$dats]->id_pemesanan==$this->input->get("PemesananID") AND strcmp($Consump[$dats]->ConsumptionDate,$date)==0)
                  {
                    for ($types=0; $types < count($category); $types++)
                    {
                      if (strcmp($Consump[$dats]->jenis_konsumsi,$category[$types])==0)
                      {
                        $arrRD[$date][$types] = $Consump[$dats]->ruangan_konsumsi;
                      }
                    }
                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
              }
              date_default_timezone_set('UTC');
              $date =   $this->input->get("AP");
              $end_date = $this->input->get("PaS");
              while (strtotime($date) <= strtotime($end_date))
              {
                for ($types=0; $types < count($category); $types++)
                {
                  if (isset($arrRJ[$date][$types]))
                  {
                    ?>
                    <td><?=$arrRJ[$date][$types]?></td>
                    <?php
                  }
                  else
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                  if (isset($arrRD[$date][$types]))
                  {
                    ?>
                    <td><?=$arrRD[$date][$types]?></td>
                    <?php
                  }
                  else
                  {
                    ?>
                    <td>-</td>
                    <?php
                  }
                }
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
                ?>
                <tr>
                <td>State</td>
                <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                  for ($each=0; $each < count($category); $each++)
                  {
                    ?>
                    <td>DR</td>
                    <td>MJD</td>
                    <?php
                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                 ?>
              </tr>
              <tr>
                <td>Total</td>
                <?php
                $arrTJ[]="";$arrTD[]="";
                for ($dr=0; $dr < count($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy]); $dr++)
                {
                  date_default_timezone_set('UTC');
                  $date =   $this->input->get("AP");
                  $end_date = $this->input->get("PaS");
                  while (strtotime($date) <= strtotime($end_date))
                  {
                    if ($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["Tanggal"],$date)==0)
                    {
                      for ($types=0; $types < count($category); $types++)
                      {
                        if (strcmp($Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["JenisKonsumsi"],$category[$types])==0)
                        {
                          $arrTJ[$date][$types] = $Consumpjson[$legacy]['pemesanan_konsumsi'.$legacy][$dr]["Jumlah"];
                        }
                      }
                    }
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                  }
                }
                $CurrNote="";
                for ($dats=0; $dats < count($Consump); $dats++)
                {
                  date_default_timezone_set('UTC');
                  $date =   $this->input->get("AP");
                  $end_date = $this->input->get("PaS");
                  while (strtotime($date) <= strtotime($end_date))
                  {
                    if ($Consump[$dats]->id_pemesanan==$this->input->get("PemesananID") AND strcmp($Consump[$dats]->ConsumptionDate,$date)==0)
                    {
                      for ($types=0; $types < count($category); $types++)
                      {
                        if (strcmp($Consump[$dats]->jenis_konsumsi,$category[$types])==0)
                        {
                          $arrTD[$date][$types] = $Consump[$dats]->jumlah;
                          $CurrNote=$Consump[$dats]->ConsumpNote;
                        }
                      }
                    }
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                  }
                }
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                  for ($types=0; $types < count($category); $types++)
                  {
                    if (isset($arrTJ[$date][$types]))
                    {
                      ?>
                      <td><?=$arrTJ[$date][$types]?></td>
                      <?php
                    }
                    else
                    {
                      ?>
                      <td>-</td>
                      <?php
                    }
                    if (isset($arrTD[$date][$types]))
                    {
                      ?>
                      <td><?=$arrTD[$date][$types]?></td>
                      <?php
                    }
                    else
                    {
                      ?>
                      <td>-</td>
                      <?php
                    }

                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                  ?>
                  <td><?=$CurrNote?></td>
              </tr>
            </table>
            </div>
              <?php


          }
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
