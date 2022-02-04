<?php
class rekap_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
		$this->load->database();
    }

    public function get_All_Recaps()
    {
		$query = $this->db->query("SELECT Distinct p.PemesananID as id_pemesanan, p.JumlahPeserta as JumlahPeserta , concat (pr.programname,' - ',ak.namaangkatan) as nama_program,pr.programname as program,ak.namaangkatan as angkatan, ak.ProgramMulai as tanggal_program_mulai ,ak.ProgramSelesai as tanggal_program_selesai, p.TanggalAwalPemesanan as tanggal_awal_pemesanan, p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan , p.UserID, p.PICprogram as pic_program , pk.status as status_kelas , pks.status as status_konsumsi , psb.status as status_shuttlebus , pas.status as status_busbandara , ph.status as status_hotel
							FROM (((((`pemesanan` as p left join `pemesanan_kelas` as pk on p.PemesananID = pk.PemesananID)
							left JOIN pemesanan_konsumsi as pks on pks.PemesananID = p.PemesananID )
							left JOIN pemesanan_shuttlebus as psb on psb.PemesananID = p.PemesananID )
							left JOIN pemesanan_airportshuttle as pas on pas.PemesananID = p.PemesananID )
							left JOIN pemesanan_hotel as ph on ph.PemesananID = p.PemesananID )
							join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.ProgramID = ak.ProgramID
							Order by p.PemesananID");
		$result = $query->result();
         return $result;
    }
	//25-Jul-17
	public function get_All_5days_Recaps($currentDate,$endDate)
    {
		$query = $this->db->query("SELECT Distinct p.PemesananID as id_pemesanan, p.JumlahPeserta as JumlahPeserta , concat (pr.programname,' - ',ak.namaangkatan) as nama_program,pr.programname as program,ak.namaangkatan as angkatan, ak.ProgramMulai as tanggal_program_mulai ,ak.ProgramSelesai as tanggal_program_selesai, p.TanggalAwalPemesanan as tanggal_awal_pemesanan, p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan , p.UserID, p.PICprogram as pic_program , pk.status as status_kelas , pks.status as status_konsumsi , psb.status as status_shuttlebus , pas.status as status_busbandara , ph.status as status_hotel
							FROM (((((`pemesanan` as p left join `pemesanan_kelas` as pk on p.PemesananID = pk.PemesananID)
							left JOIN pemesanan_konsumsi as pks on pks.PemesananID = p.PemesananID )
							left JOIN pemesanan_shuttlebus as psb on psb.PemesananID = p.PemesananID )
							left JOIN pemesanan_airportshuttle as pas on pas.PemesananID = p.PemesananID )
							left JOIN pemesanan_hotel as ph on ph.PemesananID = p.PemesananID )
							join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.ProgramID = ak.ProgramID
							where  p.TanggalAwalPemesanan>='".$currentDate."' AND p.TanggalAwalPemesanan<='".$endDate."'
							Order by p.PemesananID");
		$result = $query->result();
         return $result;
    }
	


	public function get_Classes_Recaps()
    {
		$query = $this->db->query("SELECT Distinct p.PemesananID as id_pemesanan
								, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
								, pr.programname as name
								, ak.namaangkatan as angkatan
								, ak.programmulai as tanggal_program_mulai
								, ak.ProgramSelesai as tanggal_program_Selesai
								, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
								, p.PICprogram as pic_program, p.jumlahpeserta as jumlah_peserta
								, pk.status as status_kelas
								, p.UserID

								FROM `pemesanan` as p join `pemesanan_kelas` as pk on p.PemesananID = pk.PemesananID
								join angkatan ak on ak.angkatanid = p.angkatanid
								join program pr on pr.programID = ak.programid
								");
		$result = $query->result();

        return $result;
    }

	public function get_Class_Recaps($id_pesan)
    {
		$query = $this->db->query("SELECT Distinct p.PemesananID as id_pemesanan
							, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
							, pr.programname as name
							, ak.namaangkatan as angkatan
							, ak.programmulai as tanggal_program_mulai
							, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
							, p.PICprogram as pic_program
							, p.jumlahpeserta as jumlah_peserta
							, pk.status as status_kelas
							, p.UserID

							FROM `pemesanan` as p join `pemesanan_kelas` as pk on p.PemesananID = pk.PemesananID
							join angkatan ak on ak.angkatanid = p.angkatanid
							join program pr on pr.programID = ak.programid
							Where p.PemesananID=".$id_pesan);
		$result = $query->result();

        return $result;
    }

	public function get_Consumption_Recaps()
    {
		$query = $this->db->query("SELECT Distinct
			p.PemesananID as id_pemesanan , concat
			(pr.programname,' - ',ak.namaangkatan) as nama_program
			, pr.programname as name
			, ak.namaangkatan as angkatan
			, ak.programmulai as tanggal_program_mulai
			, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
			, p.PICprogram as pic_program
			, pk.status as status_konsumsi
			, p.UserID FROM `pemesanan` as p join `pemesanan_konsumsi` as pk on p.PemesananID = pk.PemesananID join angkatan ak
		on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid");
		$result = $query->result();

        return $result;
    }

	public function get_Cons_Recaps($id_pesan)
    {
		$query = $this->db->query("SELECT Distinct
			p.PemesananID as id_pemesanan , concat (pr.programname,' - ',ak.namaangkatan) as nama_program
		, pr.programname as name
		, ak.namaangkatan as angkatan
		, ak.programmulai as tanggal_program_mulai
		, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
		, p.PICprogram as pic_program
		, pk.status as status_konsumsi
		, p.UserID FROM `pemesanan` as p join `pemesanan_konsumsi` as pk on p.PemesananID = pk.PemesananID join angkatan ak
		on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid Where p.PemesananID=".$id_pesan);
		$result = $query->result();

        return $result;
    }

	public function get_Hotel_Recaps($id_pesan)
    {
		$query = $this->db->query("SELECT Distinct
			p.PemesananID as id_pemesanan , concat (pr.programname,' - ',ak.namaangkatan) as nama_program
			, pr.programname as name
			, ak.namaangkatan as angkatan
			, ak.programmulai as tanggal_program_mulai
			, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
			, p.PICprogram as pic_program
			, pk.status as status_hotel
			, p.UserID FROM `pemesanan` as p join `pemesanan_hotel` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid Where p.PemesananID=".$id_pesan);
		$result = $query->result();

        return $result;
    }

	public function get_Hotels_Recaps()
    {
		$query = $this->db->query("SELECT Distinct
			p.PemesananID as id_pemesanan
			, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
			, pr.programname as name
			, ak.namaangkatan as angkatan
			, ak.programmulai as tanggal_program_mulai
			, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
			, p.PICprogram as pic_program
			, pk.status as status_hotel
			, p.UserID FROM `pemesanan` as p join `pemesanan_hotel` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid");
		$result = $query->result();

        return $result;
    }

	public function get_ShuttleBus_Recaps()
    {
		$query = $this->db->query("SELECT id_pemesanan, `nama_program`,`name`,`angkatan`, `tanggal_program_mulai`, `tanggal_awal_pemesanan`, pic_program, status_shuttle
									, MAX(IF(ShuttlePoint = 'Bogor', `passanger_count`, 0)) AS Bogor
									, MAX(IF(ShuttlePoint = 'Bekasi', `passanger_count`, 0)) AS Bekasi
									, MAX(IF(ShuttlePoint = 'Kelapa Gading', `passanger_count`, 0)) AS Kelapa_Gading
									, MAX(IF(ShuttlePoint = 'Alam Sutera', `passanger_count`, 0)) AS Alam_Sutera
									, MAX(IF(ShuttlePoint = 'Wisma Asia', `passanger_count`, 0)) AS Wisma_Asia
									, MAX(IF(ShuttlePoint = 'Pondok Indah', `passanger_count`, 0)) AS Pondok_Indah
									, ShuttleID
									, UserID
									, JumlahPenumpang
									FROM (SELECT p.PemesananID as id_pemesanan , p.UserID, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
									, pr.programname as name
									, ak.namaangkatan as angkatan
									, pk.ShuttleID as ShuttleID
									, pk.Passanger_Count as JumlahPenumpang
									, ak.programmulai as tanggal_program_mulai , p.TanggalAwalPemesanan as tanggal_awal_pemesanan , p.PICprogram as pic_program , pk.status as status_shuttle , pk.ShuttlePoint, pk.Passanger_count FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid) as _tb
									GROUP BY id_pemesanan");
		$result = $query->result();

        return $result;
    }
	public function get_Shuttle_Recaps($id_pesan)
    {
		$query = $this->db->query("SELECT id_pemesanan, `nama_program`,`name`,`angkatan`, `tanggal_program_mulai`, `tanggal_awal_pemesanan`, pic_program, status_shuttle
									, MAX(IF(ShuttlePoint = 'Bogor', `passanger_count`, 0)) AS Bogor
									, MAX(IF(ShuttlePoint = 'Bekasi', `passanger_count`, 0)) AS Bekasi
									, MAX(IF(ShuttlePoint = 'Kelapa Gading', `passanger_count`, 0)) AS Kelapa_Gading
									, MAX(IF(ShuttlePoint = 'Alam Sutera', `passanger_count`, 0)) AS Alam_Sutera
									, MAX(IF(ShuttlePoint = 'Wisma Asia', `passanger_count`, 0)) AS Wisma_Asia
									, UserID
									, ShuttleID
									, JumlahPenumpang
									FROM (SELECT p.PemesananID as id_pemesanan , p.UserID, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
									, pr.programname as name
									, ak.namaangkatan as angkatan
									, pk.ShuttleID as ShuttleID
									, pk.Passanger_Count as JumlahPenumpang
									, ak.programmulai as tanggal_program_mulai , p.TanggalAwalPemesanan as tanggal_awal_pemesanan , p.PICprogram as pic_program , pk.status as status_shuttle , pk.ShuttlePoint, pk.Passanger_count FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid) as _tb
									Where id_pemesanan = ".$id_pesan." GROUP BY id_pemesanan");
		$result = $query->result();

        return $result;
    }

	public function get_AirportBus_Recaps()
    {
		$query = $this->db->query("SELECT Distinct p.PemesananID as id_pemesanan
									, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
									, pr.programname as name
									, ak.namaangkatan as angkatan
									, ak.programmulai as tanggal_program_mulai
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
									, p.PICprogram as pic_program
									, p.UserID
									, p.jumlahpeserta as jumlah_peserta
									, pk.status as status_bus_bandara FROM `pemesanan` as p
									join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID
									join angkatan ak on ak.angkatanid = p.angkatanid
									join program pr on pr.programID = ak.programid");
		$result = $query->result();

        return $result;
    }

	public function get_Airport_Recaps($id_pesan)
    {
		$query = $this->db->query("SELECT Distinct p.PemesananID as id_pemesanan , concat (pr.programname,' - ',ak.namaangkatan) as nama_program
			, pr.programname as name
			, ak.namaangkatan as angkatan
		, ak.programmulai as tanggal_program_mulai , p.TanggalAwalPemesanan as tanggal_awal_pemesanan , p.PICprogram as pic_program, p.jumlahpeserta as jumlah_peserta
		, pk.status as status_bus_bandara, p.UserID FROM `pemesanan` as p join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID join angkatan ak
		on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid Where p.PemesananID=".$id_pesan);
		$result = $query->result();

        return $result;
    }

	public function get_Detail_Class($id_pesan)
    {
		$query = $this->db->query("SELECT p.PemesananID as id_pemesanan, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
		, ak.programmulai as tanggal_program_mulai, ak.programmulai as tanggal_program_selesai , p.TanggalAwalPemesanan as tanggal_awal_pemesanan,p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan , p.PICprogram as pic_program
		, pk.RoomName as nama_ruangan, pk.CheckerNotes as fault, pk.jumlah_peserta,pk.ClassID as classID,pk.note as classNote, pk.Layout FROM `pemesanan` as p join `pemesanan_kelas` as pk on p.PemesananID = pk.PemesananID join
		angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid Where p.pemesananID =".$id_pesan);
		$result = $query->result();

        return $result;
    }
		public function get_Detail_Shuttle($id_pesan)
	    {
				$query = $this->db->query("SELECT p.PemesananID as id_pemesanan, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
				, ak.programmulai as tanggal_program_mulai, ak.programmulai as tanggal_program_selesai , p.TanggalAwalPemesanan as tanggal_awal_pemesanan,p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan , p.PICprogram as pic_program ,p.JumlahPeserta as JumlahPeserta
				,pk.Dates as Dates,pk.Passanger_Count as passanger, pk.ShuttlePoint as ShuttlePoint,pk.ShuttleID as shuttleID, pk.CheckerNotes as fault, pk.Passanger_Count as Passanger,pk.ShuttleID as ShuttleID,pk.note as ShuttleNote, pk.Dates as Date FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join
				angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid Where p.pemesananID =".$id_pesan);
				$result = $query->result();
	        return $result;
	    }

	public function get_Detail_Consumption($id_pesan)
    {
		$query = $this->db->query("SELECT p.PemesananID as id_pemesanan
		, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
		, ak.programmulai as tanggal_program_mulai
		, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
		, p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan
		, p.PICprogram as pic_program, pk.jeniskonsumsi as jenis_konsumsi
		, pk.Tanggal as ConsumptionDate
		, pk.KonsumsiID as ConsumpID
		, pk.Note as ConsumpNote
		, pk.CheckerNotes as fault
		, pk.ruanganKonsumsi as ruangan_konsumsi
		, pk.jumlah

		FROM `pemesanan` as p join `pemesanan_konsumsi` as pk on p.PemesananID = pk.PemesananID
		join angkatan ak on ak.angkatanid = p.angkatanid
		join program pr on pr.programID = ak.programid where p.PemesananID = ".$id_pesan." order by jeniskonsumsi");

		$result = $query->result();

        return $result;
    }

		public function get_sum_Consump($date="0000-00-00",$Jenis="",$ID=0)
	    {
			$query = $this->db->query("SELECT SUM(Jumlah) as Total FROM `pemesanan_konsumsi` WHERE Tanggal=".$date." AND PemesananID=".$ID." AND JenisKonsumsi='".$Jenis."'");
			$result = $query->result();
	        return $result;
	    }

	public function get_Detail_Hotel($id_pesan)
    {
		$query = $this->db->query("SELECT p.PemesananID as id_pemesanan
			, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
			, ak.programmulai as tanggal_program_mulai
			, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
			, p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan

			, p.PICprogram as pic_program
			, pk.HotelName as nama_hotel
			, pk.PemesananHotelID as hotelID
			, pk.note as HotelNote
			, pk.TanggalCheckin as tgl_checkin
			, pk.TanggalCheckout as tgl_checkout
			, pk.Jml_SinglePria
			, pk.Jml_TwinPria
			, pk.Jml_SingleWanita
			, pk.Jml_TwinWanita
			, pk.CheckerNotes as fault

			FROM `pemesanan` as p join `pemesanan_hotel` as pk on p.PemesananID = pk.PemesananID
			join angkatan ak on ak.angkatanid = p.angkatanid
			join program pr on pr.programID = ak.programid where p.PemesananID =".$id_pesan);

		$result = $query->result();

        return $result;
    }

	public function get_Detail_AirportBus($id_pesan)
    {
		$query = $this->db->query("SELECT p.PemesananID as id_pemesanan
									, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
									, pk.AirportShuttleID as AirportID
									, pk.Notes as AirportNotes
									, ak.programmulai as tanggal_program_mulai
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
									, p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan
									, p.PICprogram as pic_program
									, asd.TanggalBerangkat
									, asd.BerangkatDari
									, asd.Tujuan
									, asd.Jam
									, asd.Kapasitas
									, asd.Keterangan
									, asd.Jenis as jenis
									, pk.CheckerNotes as fault
									, p.UserID
									, asd.ArrivalID as TID

									FROM `pemesanan` as p join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID
									join angkatan ak on ak.angkatanid = p.angkatanid
									join program pr on pr.programID = ak.programid
									join airportshuttle_arrival asd on asd.airportshuttleid = pk.airportshuttleid
									where p.PemesananID = ".$id_pesan."

									UNION ALL

									SELECT p.PemesananID as id_pemesanan
									, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
									, pk.AirportShuttleID as AirportID
									, pk.Notes as AirportNotes
									, ak.programmulai as tanggal_program_mulai
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan
									, p.TanggalAkhirPemesanan as tanggal_akhir_pemesanan
									, p.PICprogram as pic_program
									, asd.TanggalBerangkat
									, asd.BerangkatDari
									, asd.Tujuan
									, asd.Jam
									, asd.Kapasitas
									, asd.Keterangan
									, asd.Jenis as jenis
									, pk.CheckerNotes as fault
									, p.UserID
									,asd.DepartureID as TID

									FROM `pemesanan` as p join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID
									join angkatan ak on ak.angkatanid = p.angkatanid
									join program pr on pr.programID = ak.programid
									join airportshuttle_departure asd on asd.airportshuttleid = pk.airportshuttleid
									where p.PemesananID = ".$id_pesan."
									");

		$result = $query->result();

        return $result;
    }

	//pending to approve
	public function update_status_approve($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_kelas` SET`status`='approved' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_approve_hotel($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_hotel` SET`status`='approved' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_approve_shuttlebus($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_shuttlebus` SET`status`='approved' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_approve_airportshuttle($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_airportshuttle` SET`status`='approved' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_approve_consump($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_konsumsi` SET`status`='approved' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }
	//end pending to approve


	//approve to booked
	public function update_status_booked($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_kelas` SET`status`='booked' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_booked_hotel($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_hotel` SET`status`='booked' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_booked_shuttlebus($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_shuttlebus` SET`status`='booked' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_booked_airportshuttle($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_airportshuttle` SET`status`='booked' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }

	public function update_status_booked_consump($id_pesan)
    {
		$query = $this->db->query("UPDATE `pemesanan_konsumsi` SET`status`='booked' WHERE PemesananID =".$id_pesan);
        return $this->db->affected_rows();
    }
	//end approve to booked

	//status rejected
	public function update_status_rejected($id_pesan,$cNotes, $cID, $tgl, $tipe)
    {

		if($tipe == "Class"){
			$query = $this->db->query("UPDATE `pemesanan_kelas` SET`status`='rejected', CheckerNotes = '".$cNotes."', CheckerID ='".$cID."', TanggalBuat = '".$tgl."' WHERE PemesananID =".$id_pesan);
		}elseif($tipe == "Consumption"){
			$query = $this->db->query("UPDATE `pemesanan_konsumsi` SET`status`='rejected', CheckerNotes = '".$cNotes."', CheckerID ='".$cID."', TanggalBuat = '".$tgl."' WHERE PemesananID =".$id_pesan);
		}elseif($tipe == "Hotels"){
			$query = $this->db->query("UPDATE `pemesanan_hotel` SET`status`='rejected', CheckerNotes = '".$cNotes."', CheckerID ='".$cID."', TanggalBuat = '".$tgl."' WHERE PemesananID =".$id_pesan);
		}elseif($tipe == "ShuttleBus"){
			$query = $this->db->query("UPDATE `pemesanan_shuttlebus` SET`status`='rejected', CheckerNotes = '".$cNotes."', CheckerID ='".$cID."', TanggalBuat = '".$tgl."' WHERE PemesananID =".$id_pesan);
		}elseif($tipe == "AirportShuttle"){
			$query = $this->db->query("UPDATE `pemesanan_airportshuttle` SET`status`='rejected', CheckerNotes = '".$cNotes."', CheckerID ='".$cID."', TanggalBuat = '".$tgl."' WHERE PemesananID =".$id_pesan);
		}
        return $this->db->affected_rows();
    }
	//end status rejected

	//notifikasi
	public function insert_notifikasi($id_pesan,$data)
    {
			$this->db->where('NotifikasiID',$id_pesan);
    	$q = $this->db->get('notifikasi_reject');
    	if ( $q->num_rows() > 0 )
    		{
    			$this->db->where('NotifikasiID',$id_pesan);
    			$this->db->update('notifikasi_reject',$data);
    		}
    		else
    		{
    			$this->db->set('NotifikasiID', $id_pesan);
    			$this->db->insert('notifikasi_reject',$data);
    		}
    }

		public function update_notifikasi($id,$data)
	    {
				$this->db->where('PemesananID',$id);
	        $this->db->update('notifikasi_reject',$data);
	    }

	public function get_notifikasi_per_user($UserID)
    {
		$query = $this->db->query("SELECT Distinct NotifikasiID, nr.PemesananID, Tipe, nr.UserID as UserID_Koor, u.UserID as UserID_Checker, u.NamaDepan,
								u.NamaBelakang, StatusAkhirPemesanan, Tanggal, nr.Tipe
								FROM notifikasi_reject nr JOIN user u on u.UserID = nr.CheckerID
								WHERE tanggal >= (NOW() - INTERVAL 7 DAY)
									and nr.UserID = ".$UserID."
									and statusAkhirPemesanan = 'rejected'");

        $result = $query->result();
		return $result;
    }

	public function get_num_notifikasi($UserID)
    {
		$query = $this->db->query("SELECT Distinct NotifikasiID, nr.PemesananID, Tipe, UserID, StatusAkhirPemesanan, Tanggal
						FROM notifikasi_reject nr
						WHERE tanggal >= (NOW() - INTERVAL 7 DAY)
							and UserID = ".$UserID."
							and statusAkhirPemesanan = 'rejected'");

        $return = $query->num_rows();

		return $query->num_rows();
    }



	//notifikasi

	public function get_notifikasii($id_pesan,$tipe,$UserID)
    {
		$query = $this->db->query("SELECT Distinct NotifikasiID, nr.PemesananID, Tipe, UserID, StatusAkhirPemesanan, Tanggal
				FROM notifikasi_reject nr Join pemesanan_kelas pk on pk.PemesananID = nr.PemesananID
				WHERE tanggal >= (NOW() - INTERVAL 7 DAY)
					and UserID = ".$UserID."
					and statusAkhirPemesanan = 'rejected'
					and Tipe='".$tipe."'");

        $result = $query->result();
    }
    function update_Pemesanan_all($id,$data)
    {
    	$this->db->where('PemesananID',$id);
        $this->db->update('pemesanan',$data);
    }
    function update_Pemesanan_class($id,$data)
    {
    	$this->db->where('ClassID',$id);
    	$q = $this->db->get('pemesanan_kelas');
    	if ( $q->num_rows() > 0 )
    		{
    			$this->db->where('ClassID',$id);
    			$this->db->update('pemesanan_kelas',$data);
    		}
    		else
    		{
    			$this->db->set('ClassID', $id);
    			$this->db->insert('pemesanan_kelas',$data);
    		}
    }
		function update_Pemesanan_shuttle($id,$data)
    {
    	$this->db->where('ShuttleID',$id);
    	$q = $this->db->get('pemesanan_shuttlebus');
    	if ( $q->num_rows() > 0 )
    		{
    			$this->db->where('ShuttleID',$id);
    			$this->db->update('pemesanan_shuttlebus',$data);
    		}
    		else
    		{
    			$this->db->set('ShuttleID', $id);
    			$this->db->insert('pemesanan_shuttlebus',$data);
    		}
    }

    function update_Pemesanan_consumption($id,$data)
    {
    	$this->db->where('KonsumsiID',$id);
    	$q = $this->db->get('pemesanan_konsumsi');
    	if ( $q->num_rows() > 0 )
    		{
    			$this->db->where('KonsumsiID',$id);
    			$this->db->update('pemesanan_konsumsi',$data);
    		}
    		else
    		{
    			$this->db->set('KonsumsiID', $id);
    			$this->db->insert('pemesanan_konsumsi',$data);
    		}
    }

		function update_Pemesanan_hotel($id,$data)
    {
    	$this->db->where('PemesananHotelID',$id);
    	$q = $this->db->get('pemesanan_hotel');
    	if ( $q->num_rows() > 0 )
    		{
    			$this->db->where('PemesananHotelID',$id);
    			$this->db->update('pemesanan_hotel',$data);
    		}
    		else
    		{
    			$this->db->set('PemesananHotelID', $id);
    			$this->db->insert('pemesanan_hotel',$data);
    		}
    }
		function update_Pemesanan_Airport($id,$data)
		{
			$this->db->where('AirportShuttleID',$id);
			$q = $this->db->get('pemesanan_airportshuttle');
			if ( $q->num_rows() > 0 )
				{
					$this->db->where('AirportShuttleID',$id);
					$this->db->update('pemesanan_airportshuttle',$data);
				}
				else
				{
					$this->db->set('AirportShuttleID', $id);
					$this->db->insert('pemesanan_airportshuttle',$data);
				}
		}

		function update_Pemesanan_Airport_AD($id,$data,$type,$TID)
    {
			if(strcmp($type,"Arrival")==0)
			{
	    	$q = $this->db->get('airportshuttle_arrival');
			}
				elseif(strcmp($type,"Departure")==0)
				{
					$q = $this->db->get('airportshuttle_departure');
				}

	    	if ( $q->num_rows() > 0)
	    		{
	    			$this->db->where('AirportShuttleID',$id);
						if($type=="Arrival")
						{
							$this->db->where('ArrivalID',$TID);
				    	$this->db->update('airportshuttle_arrival',$data);
						}
							elseif($type=="Departure")
							{
								$this->db->where('DepartureID',$TID);
								$this->db->update('airportshuttle_departure',$data);
							}

	    		}
	    		else
	    		{
	    			$this->db->set('AirportShuttleID', $id);
						if($type=="Arrival")
						{
				    	$this->db->insert('airportshuttle_arrival',$data);
						}
							elseif($type=="Departure")
							{
								$this->db->insert('airportshuttle_departure',$data);
							}

	    		}
    }
		function add_Pemesanan_Airport_AD($id,$data,$type)
    {
			$this->db->set('AirportShuttleID', $id);
			if($type=="Arrival")
			{
				$this->db->insert('airportshuttle_arrival',$data);
			}
			elseif($type=="Departure")
			{
				$this->db->insert('airportshuttle_departure',$data);
			}
    }

    function RemovePemesanan($PemesananID)
    {
        $this->db->delete('pemesanan',array('PemesananID' => $PemesananID));
        $this->db->delete('pemesanan_airportshuttle',array('pemesananID'=>$PemesananID));
        $this->db->delete('airportshuttle_arrival',array('PemesananID' => $PemesananID));
        $this->db->delete('airportshuttle_departure',array('PemesananID' => $PemesananID));
        $this->db->delete('pemesanan_kelas',array('PemesananID' => $PemesananID));
        $this->db->delete('pemesanan_hotel',array('PemesananID' => $PemesananID));
        $this->db->delete('pemesanan_konsumsi',array('PemesananID' => $PemesananID));
        $this->db->delete('pemesanan_shuttlebus',array('PemesananID' => $PemesananID));
    }
    function RemovePemesananDetail($ID,$content,$TID,$Type)
    {
    	if (strcmp($content, "class"))
    	{
    		$this->db->delete('pemesanan_kelas',array("ClassID" => $ID));
    	}
    	if (strcmp($content, "Consumption")==0)
    	{
    		$this->db->delete('pemesanan_konsumsi',array("KonsumsiID" => $ID));
    	}
			if (strcmp($content, "Shuttle")==0)
    	{
    		$this->db->delete('pemesanan_shuttlebus',array("ShuttleID" => $ID));
    	}
			if (strcmp($content, "Hotel")==0)
			{
				$this->db->delete('pemesanan_hotel',array("PemesananHotelID" => $ID));
			}
			if (strcmp($content, "Airport")==0)
			{
				if(strcmp($Type,"Arrival")==0)
					{
						$this->db->delete('airportshuttle_arrival',array('ArrivalID' => $TID));
					}
					else
					{
						$this->db->delete('airportshuttle_departure',array('DepartureID' => $TID));
					}
			}
		else
    	{
    		echo "<h1>ERROR - unrecognized content on remove commans</h1>";
    	}
    }

    function RemovePemesananContent($ID,$content)
    {
    	if (strcmp($content, "Class")==0)
    	{
    		$this->db->delete('pemesanan_kelas',array("PemesananID" => $ID));
    	}
    	if (strcmp($content, "Consumption")==0)
    	{
    		$this->db->delete('pemesanan_konsumsi',array("PemesananID" => $ID));
    	}
			if (strcmp($content, "Hotel")==0)
    	{
    		$this->db->delete('pemesanan_hotel',array("PemesananID" => $ID));
    	}

			if (strcmp($content, "Shuttle")==0)
    	{
    		$this->db->delete('pemesanan_shuttlebus',array("PemesananID" => $ID));
    	}
			if (strcmp($content, "Airports")==0)
    	{
				$this->db->delete('airportshuttle_arrival',array("PemesananID" => $ID));
				$this->db->delete('airportshuttle_departure',array("PemesananID" => $ID));
    		$this->db->delete('pemesanan_airportshuttle',array("PemesananID" => $ID));
    	}
    	else
    	{
    		echo "<h1>ERROR - unrecognized content on remove commans</h1>";
    	}
    }
    public function get_Room()
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("Room");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
		public function set_jsonPemesanan($NP,$AP)
		{
			$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$NP.'/'.$AP.'/Pemesanan/';
			if (is_dir($file)==true)
	    {
	      $DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	    $JumlahHistory=iterator_count($DirectoryCount);
	    }
	    else
	    {
	      $JumlahHistory=0;
				mkdir($file, 0777, TRUE);
	    }
			$JumlahHistory=$JumlahHistory+1;
			$response = array();
			$posts = array();
			$Base = mysqli_connect('localhost','root','','upps_data');

			$result = mysqli_query($Base,'SELECT * FROM pemesanan;');
			if($result)
			{
				while($row=
				mysqli_fetch_array($result, MYSQL_ASSOC))
				{
					$PemesananID=$row['PemesananID'];
					$AngkatanID=$row['AngkatanID'];
					$TanggalAwalPemesanan=$row['TanggalAwalPemesanan'];
					$TanggalAkhirPemesanan=$row['TanggalAkhirPemesanan'];
					$PICprogram=$row['PICprogram'];
					$JumlahPeserta=$row['JumlahPeserta'];
					$UserID=$row['UserID'];
					$Pemesanan[] = array('PemesananID'=> $PemesananID,'AngkatanID'=> $AngkatanID,'TanggalAwalPemesanan'=> $TanggalAwalPemesanan,'TanggalAkhirPemesanan'=> $TanggalAkhirPemesanan,'PICprogram'=> $PICprogram,'JumlahPeserta'=> $JumlahPeserta,'UserID'=>$UserID);
				}
				$path = $_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$NP.'/'.$AP.'/Pemesanan/LegacyPemesanan'.$JumlahHistory.'.json';
				$response['pemesanan'.$JumlahHistory] = $Pemesanan;
				$fp = fopen($path, 'w');
				fwrite($fp, json_encode($response));
				fclose($fp);
			}
			else
			{
				die(mysql_error()); // TODO: better error handling
			}
		}

		public function set_jsonKelas($NP,$AP)
		{
			$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$NP.'/'.$AP.'/Kelas/';
			if (is_dir($file)==true)
	    {
	      $DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	    $JumlahHistory=iterator_count($DirectoryCount);
	    }
	    else
	    {
	      $JumlahHistory=0;
				mkdir($file, 0777, TRUE);
	    }
			$JumlahHistory=$JumlahHistory+1;
			$response = array();
			$posts = array();
			$Base = mysqli_connect('localhost','root','','upps_data');
			$result = mysqli_query($Base,'SELECT * FROM pemesanan_kelas');
			if($result)
			{
				while($row=
				mysqli_fetch_array($result, MYSQL_ASSOC))
				{
					$ClassID=$row['ClassID'];
					$PemesananID=$row['PemesananID'];
					$RoomName=$row['RoomName'];
					$Jumlah_Peserta=$row['Jumlah_Peserta'];
					$Layout=$row['Layout'];
					$Note=$row['Note'];
					$CheckerNotes=$row['CheckerNotes'];
					$CheckerID=$row['CheckerID'];
					$TanggalBuat=$row['TanggalBuat'];
					$Stamp=$row['Stamp'];
					$status = $row['status'];

					$Pemesanan[] = array('ClassID'=>$ClassID,'PemesananID'=> $PemesananID,'RoomName'=> $RoomName,'Jumlah_Peserta'=>$Jumlah_Peserta,'Layout'=> $Layout,'Note'=>$Note,'CheckerNotes'=> $CheckerNotes,'CheckerID'=> $CheckerID,'TanggalBuat'=> $TanggalBuat,'Stamp'=>$Stamp,'status'=>$status,'HistoryLog'=>$JumlahHistory);
				}
				$path = $file.'LegacyKelas'.$JumlahHistory.'.json';
				$response['pemesanan_kelas'.$JumlahHistory] = $Pemesanan;
				$fp = fopen($path, 'w');
				fwrite($fp, json_encode($response));
				fclose($fp);
			}
			else
			{
				die(mysql_error()); // TODO: better error handling
			}
		}

		public function set_jsonKonsumsi($NP,$AP)
		{
			$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$NP.'/'.$AP.'/Konsumsi/';
			if (is_dir($file)==true)
	    {
	      $DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	    $JumlahHistory=iterator_count($DirectoryCount);
	    }
	    else
	    {
	      $JumlahHistory=0;
				mkdir($file, 0777, TRUE);
	    }
			$JumlahHistory=$JumlahHistory+1;
			$response = array();
			$posts = array();
			$Base = mysqli_connect('localhost','root','','upps_data');
			$result = mysqli_query($Base,'SELECT * FROM pemesanan_konsumsi;');
			if($result)
			{
				while($row=
				mysqli_fetch_array($result, MYSQL_ASSOC))
				{
					$KonsumsiID=$row['KonsumsiID'];
					$PemesananID=$row['PemesananID'];
					$Tanggal=$row['Tanggal'];
					$JenisKonsumsi=$row['JenisKonsumsi'];
					$Jumlah=$row['Jumlah'];
					$RuanganKonsumsi=$row['RuanganKonsumsi'];
					$Note=$row['Note'];
					$CheckerNotes=$row['CheckerNotes'];
					$CheckerID=$row['CheckerID'];
					$TanggalBuat=$row['TanggalBuat'];
					$Stamp=$row['Stamp'];
					$status = $row['status'];

					$Pemesanan[] = array('KonsumsiID'=>$KonsumsiID,'PemesananID'=> $PemesananID,'Tanggal'=> $Tanggal,'JenisKonsumsi'=> $JenisKonsumsi,'Jumlah'=> $Jumlah,'RuanganKonsumsi'=> $RuanganKonsumsi,'Note'=>$Note,'CheckerNotes'=> $CheckerNotes,'CheckerID'=> $CheckerID,'TanggalBuat'=> $TanggalBuat,'Stamp'=>$Stamp,'status'=>$status);
				}
				$path = $file.'LegacyKonsumsi'.$JumlahHistory.'.json';
				$response['pemesanan_konsumsi'.$JumlahHistory] = $Pemesanan;
				$fp = fopen($path, 'w');
				fwrite($fp, json_encode($response));
				fclose($fp);
			}
			else
			{
				die(mysql_error()); // TODO: better error handling
			}
		}

		public function set_jsonHotel($NP,$AP)
		{
			$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$NP.'/'.$AP.'/Hotel/';
			if (is_dir($file)==true)
	    {
	      $DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	    $JumlahHistory=iterator_count($DirectoryCount);
	    }
	    else
	    {
	      $JumlahHistory=0;
				mkdir($file, 0777, TRUE);
	    }
			$JumlahHistory=$JumlahHistory+1;
			$response = array();
			$posts = array();
			$Base = mysqli_connect('localhost','root','','upps_data');

			$result = mysqli_query($Base,'SELECT * FROM pemesanan_hotel');
			if($result)
			{
				while($row=
				mysqli_fetch_array($result, MYSQL_ASSOC))
				{
					$PemesananHotelID=$row['PemesananHotelID'];
					$PemesananID=$row['PemesananID'];
					$HotelName=$row['HotelName'];
					$TanggalCheckIn=$row['TanggalCheckIn'];
					$TanggalCheckOut=$row['TanggalCheckOut'];
					$Jml_SinglePria=$row['Jml_SinglePria'];
					$Jml_TwinPria=$row['Jml_TwinPria'];
					$Jml_singleWanita=$row['Jml_singleWanita'];
					$Jml_twinWanita=$row['Jml_twinWanita'];
					$Note=$row['Note'];
					$CheckerNotes=$row['CheckerNotes'];
					$CheckerID=$row['CheckerID'];
					$TanggalBuat=$row['TanggalBuat'];
					$Stamp=$row['Stamp'];
					$status = $row['status'];

					$Pemesanan[] = array('PemesananHotelID'=>$PemesananHotelID,'PemesananID'=> $PemesananID,'HotelName'=> $HotelName,'TanggalCheckIn'=> $TanggalCheckIn,'TanggalCheckOut'=> $TanggalCheckOut,'Jml_SinglePria'=> $Jml_SinglePria,'Jml_TwinPria'=> $Jml_TwinPria,'Jml_singleWanita'=> $Jml_singleWanita,'Jml_twinWanita'=> $Jml_twinWanita,'Note'=>$Note,'CheckerNotes'=> $CheckerNotes,'CheckerID'=> $CheckerID,'TanggalBuat'=> $TanggalBuat,'Stamp'=>$Stamp,'status'=>$status);
				}
				$path = $file.'LegacyHotel'.$JumlahHistory.'.json';
				$response['pemesanan_hotel'.$JumlahHistory] = $Pemesanan;
				$fp = fopen($path, 'w');
				fwrite($fp, json_encode($response));
				fclose($fp);
			}
			else
			{
				die(mysql_error()); // TODO: better error handling
			}
		}
		public function set_jsonShuttle($NP,$AP)
		{
			$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$NP.'/'.$AP.'/Shuttle/';
			if (is_dir($file)==true)
	    {
	      $DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	    $JumlahHistory=iterator_count($DirectoryCount);
	    }
	    else
	    {
	      $JumlahHistory=0;
				mkdir($file, 0777, TRUE);
	    }
			$JumlahHistory=$JumlahHistory+1;
			$response = array();
			$posts = array();
			$Base = mysqli_connect('localhost','root','','upps_data');

			$result = mysqli_query($Base,'SELECT * FROM pemesanan_shuttlebus');
			if($result)
			{
				while($row=
				mysqli_fetch_array($result, MYSQL_ASSOC))
				{
					$ShuttleID=$row['ShuttleID'];
					$ShuttlePoint=$row['ShuttlePoint'];
					$PemesananID=$row['PemesananID'];
					$Dates=$row['Dates'];
					$Passanger_Count=$row['Passanger_Count'];
					$Stamp=$row['Stamp'];
					$Note=$row['Note'];
					$CheckerNotes=$row['CheckerNotes'];
					$CheckerID=$row['CheckerID'];
					$TanggalBuat=$row['TanggalBuat'];
					$Stamp=$row['Stamp'];
					$status = $row['status'];

					$Pemesanan[] = array('ShuttleID'=>$ShuttleID,'ShuttlePoint'=>$ShuttlePoint,'PemesananID'=> $PemesananID,'Dates'=> $Dates,'Passanger_Count'=>$Passanger_Count,'Note'=>$Note,'CheckerNotes'=> $CheckerNotes,'CheckerID'=> $CheckerID,'TanggalBuat'=> $TanggalBuat,'Stamp'=>$Stamp,'status'=>$status);
				}
				$path = $file.'LegacyShuttle'.$JumlahHistory.'.json';
				$response['pemesanan_shuttlebus'.$JumlahHistory] = $Pemesanan;
				$fp = fopen($path, 'w');
				fwrite($fp, json_encode($response));
				fclose($fp);
			}
			else
			{
				die(mysql_error()); // TODO: better error handling
			}
		}

		public function set_jsonAirport($NP,$AP)
		{
			$file=$_SERVER['DOCUMENT_ROOT'].'/UPPS/assets/JSON/'.$NP.'/'.$AP.'/Airport/';
			if (is_dir($file)==true)
	    {
	      $DirectoryCount = new FilesystemIterator($file, FilesystemIterator::SKIP_DOTS);
	    $JumlahHistory=iterator_count($DirectoryCount);
	    }
	    else
	    {
	      $JumlahHistory=0;
				mkdir($file, 0777, TRUE);
	    }
			$JumlahHistory=$JumlahHistory+1;
			$response = array();
			$posts = array();
			$Base = mysqli_connect('localhost','root','','upps_data');
			$result = mysqli_query($Base,'SELECT * FROM pemesanan_airportshuttle;');
				if($result)
				{
					while($row=
					mysqli_fetch_array($result, MYSQL_ASSOC))
					{
						$AirportShuttleID=$row['AirportShuttleID'];
						$PemesananID=$row['PemesananID'];
						$Notes=$row['Notes'];
						$CheckerNotes=$row['CheckerNotes'];
						$CheckerID=$row['CheckerID'];
						$TanggalBuat=$row['TanggalBuat'];
						$Stamp=$row['Stamp'];
						$status = $row['status'];
						$Pemesanan_AirportShuttle[] = array('AirportShuttleID'=> $AirportShuttleID,'PemesananID'=> $PemesananID,'Notes'=> $Notes,'CheckerNotes'=> $CheckerNotes,'CheckerID'=> $CheckerID,'TanggalBuat'=> $TanggalBuat,'Stamp'=>$Stamp,'status'=>$status);
					}
					$response['pemesanan_airportshuttle'.$JumlahHistory] = $Pemesanan_AirportShuttle;
				}
				else
				{
					die(mysql_error()); // TODO: better error handling
				}

					$result = mysqli_query($Base,'SELECT * FROM airportshuttle_departure;');
						if($result)
						{
							while($row=
							mysqli_fetch_array($result, MYSQL_ASSOC))
							{
								$DepartureID=$row['DepartureID'];
								$AirportShuttleID=$row['AirportShuttleID'];
								$PemesananID=$row['PemesananID'];
								$TanggalBerangkat=$row['TanggalBerangkat'];
								$BerangkatDari=$row['BerangkatDari'];
								$Tujuan=$row['Tujuan'];
								$Jam=$row['Jam'];
								$Kapasitas=$row['Kapasitas'];
								$Keterangan = $row['Keterangan'];
								$Jenis = $row['Jenis'];
								$Stamp=$row['Stamp'];
								$AirportShuttle_Departure[] = array('DepartureID'=> $DepartureID,'AirportShuttleID'=> $AirportShuttleID,'PemesananID'=> $PemesananID,'TanggalBerangkat'=> $TanggalBerangkat,'BerangkatDari'=> $BerangkatDari,'Tujuan'=> $Tujuan,'Jam'=>$Jam,'Kapasitas'=>$Kapasitas,'Keterangan'=>$Keterangan,'Jenis'=>$Jenis,'Stamp'=>$Stamp);
							}
							$response['airportshuttle_departure'.$JumlahHistory] = $AirportShuttle_Departure;
						}
						else
						{
							die(mysql_error()); // TODO: better error handling
						}
							$result = mysqli_query($Base,'SELECT * FROM airportshuttle_arrival;');
								if($result)
								{
									while($row=
									mysqli_fetch_array($result, MYSQL_ASSOC))
									{
										$ArrivalID=$row['ArrivalID'];
										$AirportShuttleID=$row['AirportShuttleID'];
										$PemesananID=$row['PemesananID'];
										$TanggalBerangkat=$row['TanggalBerangkat'];
										$BerangkatDari=$row['BerangkatDari'];
										$Tujuan=$row['Tujuan'];
										$Jam=$row['Jam'];
										$Kapasitas=$row['Kapasitas'];
										$Keterangan = $row['Keterangan'];
										$Jenis = $row['Jenis'];
										$Stamp=$row['Stamp'];
										$AirportShuttle_Arrival[] = array('ArrivalID'=> $ArrivalID,'AirportShuttleID'=> $AirportShuttleID,'PemesananID'=> $PemesananID,'TanggalBerangkat'=> $TanggalBerangkat,'BerangkatDari'=> $BerangkatDari,'Tujuan'=> $Tujuan,'Jam'=>$Jam,'Kapasitas'=>$Kapasitas,'Keterangan'=>$Keterangan,'Jenis'=>$Jenis,'Stamp'=>$Stamp);
									}
									$response['airportshuttle_arrival'.$JumlahHistory] = $AirportShuttle_Arrival;

									$path = $file.'LegacyAirport'.$JumlahHistory.'.json';
									$fp = fopen($path, 'w');
									fwrite($fp, json_encode($response));
									fclose($fp);
								}
								else
								{
									die(mysql_error()); // TODO: better error handling
								}
		}
}
