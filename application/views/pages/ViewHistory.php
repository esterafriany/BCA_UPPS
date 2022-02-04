<div class="panel" action="<?= base_url()?>">
<div class="panel-heading">
    <h3 class="panel-title" id="title">History Pemesanan</h3>
</div>
      <div class="panel-body">
        <table class="table table-hover" id="bootstrap-table">
          <?php $no = 1; ?>
		  <thead>
          <tr>
            <td>No.</td>
            <td>Program - Angkatan</td>
            <td colspan='2'>Tanggal Pemesanan</td>
            <td>PIC</td>
            <td align="center">Kelas</td>
            <td align="center">Konsumsi</td>
            <td align="center">Hotel</td>
            <td align="center">Shuttle</td>
            <td align="center">Airport</td>
          </tr>
		  </thead>
          <?php foreach ($Rekap_All as $all)
          {
            ?>
            <tr>
              <td><?php echo $no; $no++?></td>
              <td><?php echo($all->nama_program);?></td>
              <td><?php echo date("d M Y", strtotime($all->tanggal_awal_pemesanan)); ?></td>
              <td><?php echo date("d M Y", strtotime($all->tanggal_akhir_pemesanan))?></td>
              <td><?php echo $all->pic_program;?></td>
              <td align="center">
				  <a href="History/ClassLegacy?Program=<?=$all->program?>&Angkatan=<?=$all->angkatan?>&TanggalProgramMulai=<?=$all->tanggal_program_mulai?>&TanggalProgramSelesai=<?=$all->tanggal_program_selesai?>&PIC=<?=$all->pic_program?>&PemesananID=<?=$all->id_pemesanan?>&NP=<?=$all->nama_program?>&AP=<?=$all->tanggal_awal_pemesanan?>"><i class="fa fa-history"></i></a>
			  </td>
              <td align="center">
				<a href="History/ConsumptionLegacy?Program=<?=$all->program?>&Angkatan=<?=$all->angkatan?>&TanggalProgramMulai=<?=$all->tanggal_program_mulai?>&TanggalProgramSelesai=<?=$all->tanggal_program_selesai?>&PaS=<?=$all->tanggal_akhir_pemesanan?>&PIC=<?=$all->pic_program?>&PemesananID=<?=$all->id_pemesanan?>&NP=<?=$all->nama_program?>&AP=<?=$all->tanggal_awal_pemesanan?>"><i class="fa fa-history"></i></a>
			  </td>
              <td align="center">
				<a href="History/HotelLegacy?Program=<?=$all->program?>&Angkatan=<?=$all->angkatan?>&TanggalProgramMulai=<?=$all->tanggal_program_mulai?>&TanggalProgramSelesai=<?=$all->tanggal_program_selesai?>&PIC=<?=$all->pic_program?>&PemesananID=<?=$all->id_pemesanan?>&NP=<?=$all->nama_program?>&AP=<?=$all->tanggal_awal_pemesanan?>">
				<i class="fa fa-history"></i></a>
			  </td>
              <td align="center">
				<a href="History/ShuttleLegacy?Program=<?=$all->program?>&Angkatan=<?=$all->angkatan?>&TanggalProgramMulai=<?=$all->tanggal_program_mulai?>&TanggalProgramSelesai=<?=$all->tanggal_program_selesai?>&PaS=<?=$all->tanggal_akhir_pemesanan?>&PIC=<?=$all->pic_program?>&PemesananID=<?=$all->id_pemesanan?>&NP=<?=$all->nama_program?>&AP=<?=$all->tanggal_awal_pemesanan?>">
					<i class="fa fa-history"></i>
				</a>
			  </td>
              <td align="center">
				<a href="History/AirportLegacy?Program=<?=$all->program?>&Angkatan=<?=$all->angkatan?>&TanggalProgramMulai=<?=$all->tanggal_program_mulai?>&TanggalProgramSelesai=<?=$all->tanggal_program_selesai?>&PIC=<?=$all->pic_program?>&PemesananID=<?=$all->id_pemesanan?>&NP=<?=$all->nama_program?>&AP=<?=$all->tanggal_awal_pemesanan?>">
					<i class="fa fa-history"></i>
			  </td>
            </tr>
            <?php
          }
          ?>
        </table>
      </div>
</div>
