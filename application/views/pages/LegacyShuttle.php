 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=History_ShutteBus.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 
<?php
$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$this->input->get("NP").'/'.$this->input->get("AP").'/Shuttle/';
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
  $url = base_url().'assets/JSON/'.str_replace(' ', '%20', $this->input->get("NP")).'/'.$this->input->get("AP").'/Shuttle/LegacyShuttle'.$i.'.json';
  $content = file_get_contents($url);
  $shuttlejson[$i] = json_decode($content, true);
}
$dataCount=0;
$jsonCount=0;
$nextjsonCount=0;
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
        for ($legacy=1; $legacy < $JumlahHistory; $legacy++)
        {
          for ($count=0; $count < count($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy]); $count++)
          {
            if ($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
            {
              $jsonCount++;
            }
          }
          $nextLegacy=$legacy+1;
          for ($count=0; $count < count($shuttlejson[$nextLegacy]['pemesanan_shuttlebus'.$nextLegacy]); $count++)
          {
            if ($shuttlejson[$nextLegacy]['pemesanan_shuttlebus'.$nextLegacy][$count]["PemesananID"]==$this->input->get("PemesananID"))
            {
              $nextjsonCount++;
            }
          }
          foreach ($Shuttle as $key)
          {
            if ($key->id_pemesanan==$this->input->get("PemesananID"))
            {
              $dataCount++;
            }
          }
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
              <th colspan=<?=(2+6*$datediff); ?> style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Shuttle <th>
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
                <td colspan="2"><?php print(date('l', strtotime($date))); ?></td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                ?>
              <td rowspan="3" style="background-color:#aec6cf">Catatan</td>
            </tr>
            <tr>
              <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                ?>
                <td colspan="2"><?php print($date);?></td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                ?>
            </tr>
            <tr>
              <td></td>
              <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                ?>
                <td>DR</td>
                <td>MJD</td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                ?>
            </tr>
              <?php
              foreach ($ShuttlePoints as $points)
              {
                ?>
                <tr>
                <td><?=$points['PointName']?></td>
                <?php
                  date_default_timezone_set('UTC');
                  $date =   $this->input->get("AP");
                  $end_date = $this->input->get("PaS");
                  while (strtotime($date) <= strtotime($end_date))
                  {
                    for ($dm=0; $dm < count($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy]); $dm++)
                    {
                      ?>
                      <?php
                      if ($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["Dates"],$date)==0 AND strcmp($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["ShuttlePoint"],$points['PointName'])==0)
                      {
                        ?>
                        <td><?=$shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["Passanger_Count"]?></td>
                        <?php
                        break; // Mempercepat saja, karna loopnya akan hanya butuh hingga ketemu 1 index
                      }
                    }
                    $Nlegacy=$legacy+1;
                    for ($dm2=0; $dm2 < count($shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy]); $dm2++)
                    {
                      if ($shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy][$dm2]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy][$dm2]["Dates"],$date)==0 AND strcmp($shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy][$dm2]["ShuttlePoint"],$points['PointName'])==0)
                      {
                        ?>
                        <td><?=$shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy][$dm2]["Passanger_Count"]?></td>
                        <?php
                        break; // Mempercepat saja, karna loopnya akan hanya butuh hingga ketemu 1 index
                      }
                    }
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                  }
                  $Nlegacy=$legacy+1;
                  for ($dm2=0; $dm2 < count($shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy]); $dm2++)
                  {
                    if ($shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy][$dm2]["PemesananID"]==$this->input->get("PemesananID"))
                    {
                      ?>
                      <td><?=$shuttlejson[$Nlegacy]['pemesanan_shuttlebus'.$Nlegacy][$dm2]["Note"]?></td>
                      <?php
                      break; // Mempercepat saja, karna loopnya akan hanya butuh hingga ketemu 1 index
                    }
                  }
                  ?>
                </tr>
                <?php
              }
               ?>
          </table>
            <?php
        }

        if ($JumlahHistory!=0)
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
              $datediff=$diff-1;
              ?>
            <tr>
              <th colspan=<?=(2+$datediff*2);?> style="text-align:center;font-weight: bold; background-color:#aec6cf">Perubahan <?php echo $legacy; ?> - Pemesanan Shuttle <th>
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
                <td colspan="2"><?php print(date('l', strtotime($date))); ?></td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                ?>
              <td rowspan="3" style="background-color:#aec6cf">Catatan</td>
            </tr>
            <tr>
              <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                ?>
                <td colspan="2"><?php print($date);?></td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                ?>
            </tr>
            <tr>
              <td></td>
              <?php
                date_default_timezone_set('UTC');
                $date =   $this->input->get("AP");
                $end_date = $this->input->get("PaS");
                while (strtotime($date) <= strtotime($end_date))
                {
                ?>
                <td>DR</td>
                <td>MJD</td>
                <?php
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                ?>
            </tr>
              <?php
              foreach ($ShuttlePoints as $points)
              {
                ?>
                <tr>
                <td><?=$points['PointName']?></td>
                <?php
                  date_default_timezone_set('UTC');
                  $date =   $this->input->get("AP");
                  $end_date = $this->input->get("PaS");
                  while (strtotime($date) <= strtotime($end_date))
                  {
                    for ($dm=0; $dm < count($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy]); $dm++)
                    {
                      ?>
                      <?php
                      if ($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["PemesananID"]==$this->input->get("PemesananID") AND strcmp($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["Dates"],$date)==0 AND strcmp($shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["ShuttlePoint"],$points['PointName'])==0)
                      {
                        ?>
                        <td><?=$shuttlejson[$legacy]['pemesanan_shuttlebus'.$legacy][$dm]["Passanger_Count"]?></td>
                        <?php
                        break; // Mempercepat saja, karna loopnya akan hanya butuh hingga ketemu 1 index
                      }
                    }

                    foreach ($Shuttle as $key)
                    {
                      if ($key->id_pemesanan=$this->input->get("PemesananID") AND strcmp($key->Dates,$date)==0 AND strcmp($key->ShuttlePoint,$points['PointName'])==0)
                      {
                        ?>
                        <td><?=$key->passanger?></td>
                        <?php
                        break;// Mempercepat saja, karna loopnya akan hanya butuh hingga ketemu 1 index
                      }
                    }
                    $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                  }
                  foreach ($Shuttle as $key)
                  {
                    if ($key->id_pemesanan=$this->input->get("PemesananID"))
                    {
                      ?>
                      <td><?=$key->ShuttleNote?></td>
                      <?php
                      break;// Mempercepat saja, karna loopnya akan hanya butuh hingga ketemu 1 index
                    }
                  }
                  ?>
                </tr>
                <?php
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
</div>
