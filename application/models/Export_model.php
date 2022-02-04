<!-- DEV NOTE
	Jika terjadi update/Penambahan pada Master data shuttle point
	tambahkan line
	[
		, MAX(IF(ShuttlePoint = '[NAMA SESUAI SHUTTLE INPUT]', `passanger_count`, 0)) AS '[NAMA BARU]'
	]
	pada SQL di function get_Shutlebus_All_Recap($date_from, $date_to) di bawah comment //HARD CODE SHUTTLE ALL
-->
<?php
class Export_model extends CI_Model  
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
		$this->load->database();
    }

	public function get_Info_Pemesanan($id_pesan)
    {
		$query = $this->db->query("SELECT ProgramName, NamaAngkatan, ProgramMulai, ProgramSelesai, PICProgram, p.UserID
				FROM `pemesanan` p
				JOIN angkatan a on a.AngkatanID = p.AngkatanID
				JOIN program pr on pr.ProgramID = a.ProgramID
				WHERE PemesananID = ".$id_pesan);
		$result = $query->result();
		
        return $result;
    }
	
    public function get_Consumption_per_Pemesanan_ID($id_pesan)
    {
		$query = $this->db->query("SELECT p.pemesananid, p.tanggal
							, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Pagi
							, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan1
							, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Siang
							, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan2
							, SUM(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.jumlah ELSE 0 END) AS Lunch
							, MAX(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan3
							, p.note 
							FROM pemesanan_konsumsi p 
							Where Pemesananid = ".$id_pesan."
							Group by p.tanggal");
							
		$result = $query->result();
		
        return $result;
    }
	
	public function get_Hotel_per_Pemesanan_ID($id_pesan)
    {
		$query = $this->db->query("SELECT p.pemesananid, p.hotelname
								,p.TanggalCheckin
								,p.TanggalCheckout
								,p.Jml_SInglePria
								,p.Jml_SingleWanita
								,p.Jml_TwinPria
								,p.Jml_twinWanita
								, p.note 
								FROM pemesanan_hotel p 
								Where Pemesananid = ".$id_pesan);
		$result = $query->result();
		
        return $result;
    }
	public function get_Shuttle_per_Pemesanan_ID($id_pesan)
    {
		$query = $this->db->query("SELECT p.pemesananid, p.Dates
					, p.ShuttlePoint as name
					, p.Passanger_Count as Count
					, p.note 
					FROM pemesanan_shuttlebus p 
					Where Pemesananid = ".$id_pesan."
					ORDER by p.Dates,name");
		$result = $query->result();
        return $result;
    }
	public function countOrderbyID($id_pesan)
	{
		$query = $this->db->query("SELECT count(DISTINCT(p.Dates)) as DateCount,
count(DISTINCT(p.ShuttlePoint)) as PointCount
FROM pemesanan_shuttlebus p WHERE p.PemesananID=".$id_pesan."");
		$result = $query->result();
        return $result;

	}
	
	public function get_AirportShuttle_Arrival_per_Pemesanan_ID($id_pesan)
    {
		$query = $this->db->query("SELECT pas.PemesananID, pas.AirportShuttleID, TanggalBerangkat, BerangkatDari, Tujuan, Jam, Kapasitas, Keterangan
								FROM `pemesanan_airportshuttle` pas JOIN airportshuttle_arrival aa ON aa.AirportSHuttleID = pas.AirportShuttleID
								WHERE pas.PemesananID = ".$id_pesan);
		$result = $query->result();
		
        return $result;
    }
	
	public function get_Class_per_Pemesanan_ID($id_pesan)
    {
		$query = $this->db->query("SELECT PemesananID, RoomName, Jumlah_Peserta,Layout, note FROM `pemesanan_kelas` Where PemesananID = ".$id_pesan);
		$result = $query->result();
		
        return $result;
    }
	
	
	
	public function get_AirportShuttle_Departure_per_Pemesanan_ID($id_pesan)
    {
		$query = $this->db->query("SELECT pas.PemesananID, pas.AirportShuttleID, TanggalBerangkat, BerangkatDari, Tujuan, Jam, Kapasitas, Keterangan
								FROM `pemesanan_airportshuttle` pas JOIN airportshuttle_departure aa ON aa.AirportSHuttleID = pas.AirportShuttleID
								WHERE pas.PemesananID = ".$id_pesan);
		$result = $query->result();
		
        return $result;
    }
	
	public function get_Detail_AirportBus($id_pesan)
    {
		$query = $this->db->query("SELECT p.PemesananID as id_pemesanan
									, concat (pr.programname,' - ',ak.namaangkatan) as nama_program 
									, ak.programmulai as tanggal_program_mulai 
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
									, p.PICprogram as pic_program
									, asd.TanggalBerangkat
									, asd.BerangkatDari
									, asd.Tujuan
									, asd.Jam
									, asd.Kapasitas
									, asd.Keterangan
									, p.UserID

									FROM `pemesanan` as p join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID 
									join angkatan ak on ak.angkatanid = p.angkatanid 
									join program pr on pr.programID = ak.programid 
									join airportshuttle_arrival asd on asd.airportshuttleid = pk.airportshuttleid 
									where p.PemesananID = ".$id_pesan."

									UNION ALL

									SELECT p.PemesananID as id_pemesanan
									, concat (pr.programname,' - ',ak.namaangkatan) as nama_program 
									, ak.programmulai as tanggal_program_mulai 
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
									, p.PICprogram as pic_program
									, asd.TanggalBerangkat
									, asd.BerangkatDari
									, asd.Tujuan
									, asd.Jam
									, asd.Kapasitas
									, asd.Keterangan
									, p.UserID

									FROM `pemesanan` as p join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID 
									join angkatan ak on ak.angkatanid = p.angkatanid 
									join program pr on pr.programID = ak.programid 
									join airportshuttle_departure asd on asd.airportshuttleid = pk.airportshuttleid 
									where p.PemesananID = ".$id_pesan."
									");
		
		$result = $query->result();
		
        return $result;
    }
	// Hard Code SHUTTLE ALL
	public function get_Shutlebus_All_Recap($date_from, $date_to)
    {
		$query = $this->db->query("SELECT id_pemesanan
									, `nama_program`
									, Dates
									, pic_program, status_shuttle
									, MAX(IF(ShuttlePoint = 'Bogor', `passanger_count`, 0)) AS Bogor
									, MAX(IF(ShuttlePoint = 'Bekasi', `passanger_count`, 0)) AS Bekasi
									, MAX(IF(ShuttlePoint = 'Kelapa Gading', `passanger_count`, 0)) AS Kelapa_Gading
									, MAX(IF(ShuttlePoint = 'Alam Sutera', `passanger_count`, 0)) AS Alam_Sutera
									, MAX(IF(ShuttlePoint = 'Wisma Asia', `passanger_count`, 0)) AS Wisma_Asia
									, MAX(IF(ShuttlePoint = 'Pondok Indah', `passanger_count`, 0)) AS Pondok_Indah
									, ShuttleID
									, UserID
									, JumlahPenumpang
									FROM (
										SELECT p.PemesananID as id_pemesanan , p.UserID, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
										, pr.programname as name
										, ak.namaangkatan as angkatan
										, pk.ShuttleID as ShuttleID
										, pk.Dates
										, pk.Passanger_Count as JumlahPenumpang
										, ak.programmulai as tanggal_program_mulai 
										, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
										, p.PICprogram as pic_program 
										, pk.status as status_shuttle 
										, pk.ShuttlePoint, pk.Passanger_count 
										FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid
									) as _tb
									WHERE Dates >= '".$date_from."' and Dates <= '".$date_to."'
									GROUP BY id_pemesanan, Dates
									ORDER BY id_pemesanan, dates");
 
		return $query->result();
    }
	
	public function get_Count_Tanggal($date_from, $date_to)
    {
			$query = $this->db->query("Select Count(Distinct Dates) as jumlah From (
								SELECT id_pemesanan
									, `nama_program`
									, Dates
									, pic_program, status_shuttle
									, MAX(IF(ShuttlePoint = 'Bogor', `passanger_count`, 0)) AS Bogor
									, MAX(IF(ShuttlePoint = 'Bekasi', `passanger_count`, 0)) AS Bekasi
									, MAX(IF(ShuttlePoint = 'Kelapa Gading', `passanger_count`, 0)) AS Kelapa_Gading
									, MAX(IF(ShuttlePoint = 'Alam Sutera', `passanger_count`, 0)) AS Alam_Sutera
									, MAX(IF(ShuttlePoint = 'Wisma Asia', `passanger_count`, 0)) AS Wisma_Asia
									, ShuttleID
									, UserID
									, JumlahPenumpang
									FROM (
										SELECT p.PemesananID as id_pemesanan , p.UserID, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
										, pr.programname as name
										, ak.namaangkatan as angkatan
										, pk.ShuttleID as ShuttleID
										, pk.Dates
										, pk.Passanger_Count as JumlahPenumpang
										, ak.programmulai as tanggal_program_mulai 
										, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
										, p.PICprogram as pic_program 
										, pk.status as status_shuttle 
										, pk.ShuttlePoint, pk.Passanger_count 
										FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid
									) as _tb  
									WHERE Dates >= '".$date_from."' and Dates <= '".$date_to."'
									GROUP BY id_pemesanan, Dates
									ORDER BY nama_program, dates
									) _tbb");
 
		return $query->row();
    }
	
	public function get_Count_Rows($date_from, $date_to)
    {
			$query = $this->db->query("Select Count(*) as jumlah From (
								SELECT id_pemesanan
									, `nama_program`
									, Dates
									, pic_program, status_shuttle
									, MAX(IF(ShuttlePoint = 'Bogor', `passanger_count`, 0)) AS Bogor
									, MAX(IF(ShuttlePoint = 'Bekasi', `passanger_count`, 0)) AS Bekasi
									, MAX(IF(ShuttlePoint = 'Kelapa Gading', `passanger_count`, 0)) AS Kelapa_Gading
									, MAX(IF(ShuttlePoint = 'Alam Sutera', `passanger_count`, 0)) AS Alam_Sutera
									, MAX(IF(ShuttlePoint = 'Wisma Asia', `passanger_count`, 0)) AS Wisma_Asia
									, ShuttleID
									, UserID
									, JumlahPenumpang
									FROM (
										SELECT p.PemesananID as id_pemesanan , p.UserID, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
										, pr.programname as name
										, ak.namaangkatan as angkatan
										, pk.ShuttleID as ShuttleID
										, pk.Dates
										, pk.Passanger_Count as JumlahPenumpang
										, ak.programmulai as tanggal_program_mulai 
										, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
										, p.PICprogram as pic_program 
										, pk.status as status_shuttle 
										, pk.ShuttlePoint, pk.Passanger_count 
										FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid
									) as _tb  
									WHERE Dates >= '".$date_from."' and Dates <= '".$date_to."'
									GROUP BY id_pemesanan, Dates
									ORDER BY nama_program, dates
									) _tbb");
 
		return $query->row();
    }
	
	public function get_Ordered_Date($date_from, $date_to)
    {
		$query = $this->db->query("Select Distinct Dates as jumlah From (
									SELECT id_pemesanan
										, `nama_program`
										, Dates
										, pic_program, status_shuttle
										, MAX(IF(ShuttlePoint = 'Bogor', `passanger_count`, 0)) AS Bogor
										, MAX(IF(ShuttlePoint = 'Bekasi', `passanger_count`, 0)) AS Bekasi
										, MAX(IF(ShuttlePoint = 'Kelapa Gading', `passanger_count`, 0)) AS Kelapa_Gading
										, MAX(IF(ShuttlePoint = 'Alam Sutera', `passanger_count`, 0)) AS Alam_Sutera
										, MAX(IF(ShuttlePoint = 'Wisma Asia', `passanger_count`, 0)) AS Wisma_Asia
										, ShuttleID
										, UserID
										, JumlahPenumpang
										FROM (
											SELECT p.PemesananID as id_pemesanan , p.UserID, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
											, pr.programname as name
											, ak.namaangkatan as angkatan
											, pk.ShuttleID as ShuttleID
											, pk.Dates
											, pk.Passanger_Count as JumlahPenumpang
											, ak.programmulai as tanggal_program_mulai 
											, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
											, p.PICprogram as pic_program 
											, pk.status as status_shuttle 
											, pk.ShuttlePoint, pk.Passanger_count 
											FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid
										) as _tb  
										WHERE Dates >= '".$date_from."' and Dates <= '".$date_to."'
										GROUP BY id_pemesanan, Dates
										ORDER BY nama_program, dates
										) _tbb 
										ORDER BY jumlah ASC");

		return $query->result();
    }
	
	public function get_Count_Rows_Disctinct($date_from, $date_to)
    {
		$query = $this->db->query("Select Count( Distinct id_pemesanan) as jumlah_baris From (
							SELECT id_pemesanan
								, `nama_program`
								, Dates
								, pic_program, status_shuttle
								, MAX(IF(ShuttlePoint = 'Bogor', `passanger_count`, 0)) AS Bogor
								, MAX(IF(ShuttlePoint = 'Bekasi', `passanger_count`, 0)) AS Bekasi
								, MAX(IF(ShuttlePoint = 'Kelapa Gading', `passanger_count`, 0)) AS Kelapa_Gading
								, MAX(IF(ShuttlePoint = 'Alam Sutera', `passanger_count`, 0)) AS Alam_Sutera
								, MAX(IF(ShuttlePoint = 'Wisma Asia', `passanger_count`, 0)) AS Wisma_Asia
								, ShuttleID
								, UserID
								, JumlahPenumpang
								FROM (
									SELECT p.PemesananID as id_pemesanan , p.UserID, concat (pr.programname,' - ',ak.namaangkatan) as nama_program
									, pr.programname as name
									, ak.namaangkatan as angkatan
									, pk.ShuttleID as ShuttleID
									, pk.Dates
									, pk.Passanger_Count as JumlahPenumpang
									, ak.programmulai as tanggal_program_mulai 
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
									, p.PICprogram as pic_program 
									, pk.status as status_shuttle 
									, pk.ShuttlePoint, pk.Passanger_count 
									FROM `pemesanan` as p join `pemesanan_shuttlebus` as pk on p.PemesananID = pk.PemesananID join angkatan ak on ak.angkatanid = p.angkatanid join program pr on pr.programID = ak.programid
								) as _tb  
								WHERE Dates >= '".$date_from."' and Dates <= '".$date_to."'
								GROUP BY id_pemesanan, Dates
								ORDER BY nama_program, dates
								) _tbb");
 
		return $query->row();
    }
	
	public function get_Hotel_All_Recap($date_from, $date_to)
    {
		$query = $this->db->query("SELECT ph.PemesananID as Pemesanan, concat (pr.programname,' - ',a.namaangkatan) as nama_program
								, p.PICprogram as PIC
								, HotelName
								, DATE_FORMAT(TanggalCheckin, '%e %M %Y') AS TanggalCheckin
								, DATE_FORMAT(TanggalCheckOut, '%e %M %Y') AS TanggalCheckOut 
								, Jml_SinglePria + Jml_singleWanita AS Single
								, `Jml_TwinPria` + `Jml_twinWanita` As Twin_Sharing
								FROM pemesanan_hotel ph JOIN pemesanan p ON ph.PemesananID = p.PemesananID
								JOIN Angkatan a ON a.AngkatanID = p.AngkatanID
								JOIN program pr ON pr.ProgramID = a.ProgramID
								WHERE TanggalCheckin >= '".$date_from."' and TanggalCheckin <= '".$date_to."'
								ORDER BY ph.PemesananID,TanggalCheckin ASC");
 
		return $query->result();
    }
	
	public function get_Airport_Shuttle_All_Recap($date_from, $date_to)
    {
		
		$query = $this->db->query("SELECT a.* FROM (
			SELECT p.PemesananID as id_pemesanan
									, concat (pr.programname,' - ',ak.namaangkatan) as nama_program 
									, ak.programmulai as tanggal_program_mulai 
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
									, p.PICprogram as pic_program
									, asd.TanggalBerangkat
									, asd.Jenis
									, asd.BerangkatDari
									, asd.Tujuan
									, asd.Jam
									, asd.Kapasitas
									, asd.Keterangan
									, p.UserID

									FROM `pemesanan` as p join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID 
									join angkatan ak on ak.angkatanid = p.angkatanid 
									join program pr on pr.programID = ak.programid 
									join airportshuttle_arrival asd on asd.airportshuttleid = pk.airportshuttleid 
									WHERE TanggalBerangkat >='".$date_from."' AND TanggalBerangkat <='".$date_to."'
									ORDER BY p.PemesananID,TanggalBerangkat ASC
									) a
									UNION ALL
									SELECT b.* FROM (
									SELECT p.PemesananID as id_pemesanan
									, concat (pr.programname,' - ',ak.namaangkatan) as nama_program 
									, ak.programmulai as tanggal_program_mulai 
									, p.TanggalAwalPemesanan as tanggal_awal_pemesanan 
									, p.PICprogram as pic_program
									, asd.TanggalBerangkat
									, asd.Jenis
									, asd.BerangkatDari
									, asd.Tujuan
									, asd.Jam
									, asd.Kapasitas
									, asd.Keterangan
									, p.UserID

									FROM `pemesanan` as p join `pemesanan_airportshuttle` as pk on p.PemesananID = pk.PemesananID 
									join angkatan ak on ak.angkatanid = p.angkatanid 
									join program pr on pr.programID = ak.programid 
									join airportshuttle_departure asd on asd.airportshuttleid = pk.airportshuttleid 
									WHERE TanggalBerangkat >='".$date_from."' AND TanggalBerangkat <='".$date_to."'
									ORDER BY p.PemesananID,TanggalBerangkat ASC
									) b
									");
 
		return $query->result();
    }
	
	// public function get_Consumption_All_Recap($date_from, $date_to)
    // {
	// 	$query = $this->db->query("SELECT p.pemesananid
	// 							, concat (pr.programname,' - ',a.namaangkatan) as nama_program
	// 							, pe.PICprogram as PIC
	// 							, p.tanggal
	// 							, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Pagi
	// 							, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan1
	// 							, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Siang
	// 							, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan2
	// 							, SUM(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.jumlah ELSE 0 END) AS Lunch
	// 							, MAX(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan3
	// 							FROM pemesanan_konsumsi p 
	// 							JOIN pemesanan pe on p.pemesananid = pe.PemesananID
	// 							JOIN Angkatan a on a.AngkatanID = pe.AngkatanID
	// 							JOIN Program pr on pr.ProgramID = a.ProgramID
	// 							WHERE p.tanggal >= '".$date_from."' and p.tanggal <= '".$date_to."'
	// 							Group by p.tanggal, nama_program
	// 							ORDER BY pemesananid ASC, tanggal ASC");
 
	// 	return $query->result();
    // }

	public function get_Consumption_All_Recap($date_from, $date_to)
    {
		$query = $this->db->query("SELECT p.pemesananid
								, concat (pr.programname,' - ',a.namaangkatan) as nama_program
								, pe.PICprogram as PIC
								, p.tanggal
								, p.Jumlah as JumlahKonsumsi
								, p.jeniskonsumsi AS JenisKonsumsi
								, p.ruangankonsumsi AS Ruangan
								FROM pemesanan_konsumsi p 
								JOIN pemesanan pe on p.pemesananid = pe.PemesananID
								JOIN Angkatan a on a.AngkatanID = pe.AngkatanID
								JOIN Program pr on pr.ProgramID = a.ProgramID
								WHERE p.tanggal >= '".$date_from."' and p.tanggal <= '".$date_to."'
								ORDER BY pemesananid ASC, tanggal ASC, JenisKonsumsi ASC");
		return $query->result();
    }
	public function CountJumlahRekapKonsum($date_from, $date_to)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT(concat (pr.programname,' - ',a.namaangkatan))) as JumlahProgram FROM pemesanan_konsumsi p JOIN pemesanan pe on p.pemesananid = pe.PemesananID JOIN Angkatan a on a.AngkatanID = pe.AngkatanID JOIN Program pr on pr.ProgramID = a.ProgramID WHERE p.tanggal >= '".$date_from."' and p.tanggal <= '".$date_to."'");
		return $query->result();
	}
	
	public function get_Count_Tanggal2($date_from, $date_to)
    {
			$query = $this->db->query("Select Count(Distinct tanggal) as jumlah From ( 
								SELECT p.pemesananid
								, concat (pr.programname,' - ',a.namaangkatan) as nama_program
								, pe.PICprogram as PIC
								, p.tanggal
								, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Pagi
								, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan1
								, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Siang
								, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan2
								, SUM(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.jumlah ELSE 0 END) AS Lunch
								, MAX(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan3
								FROM pemesanan_konsumsi p 
								JOIN pemesanan pe on p.pemesananid = pe.PemesananID
								JOIN Angkatan a on a.AngkatanID = pe.AngkatanID
								JOIN Program pr on pr.ProgramID = a.ProgramID
								WHERE tanggal >= '".$date_from."' and tanggal <= '".$date_to."'
								Group by p.tanggal
								ORDER BY pemesananid ASC, tanggal ASC
								) _tbb");
 
		return $query->row();
    }
	
	public function get_Ordered_Date2($date_from, $date_to)
    {
		$query = $this->db->query("Select Distinct tanggal as jumlah From (
									SELECT p.pemesananid
									, concat (pr.programname,' - ',a.namaangkatan) as nama_program
									, pe.PICprogram as PIC
									, p.tanggal
									, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Pagi
									, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan1
									, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Siang
									, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan2
									, SUM(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.jumlah ELSE 0 END) AS Lunch
									, MAX(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan3
									FROM pemesanan_konsumsi p 
									JOIN pemesanan pe on p.pemesananid = pe.PemesananID
									JOIN Angkatan a on a.AngkatanID = pe.AngkatanID
									JOIN Program pr on pr.ProgramID = a.ProgramID
									WHERE tanggal >= '".$date_from."' and tanggal <= '".$date_to."'
									Group by p.tanggal
									ORDER BY pemesananid ASC, tanggal ASC
								) _tbb 
								ORDER BY jumlah ASC");
		return $query->result();
    }
	
	public function get_Count_Date2($date_from, $date_to)
    {
		$query = $this->db->query("Select Count(*) as jumlah From (
									Select Distinct tanggal as jumlah From (
									SELECT p.pemesananid
									, concat (pr.programname,' - ',a.namaangkatan) as nama_program
									, pe.PICprogram as PIC
									, p.tanggal
									, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Pagi
									, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan1
									, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Siang
									, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan2
									, SUM(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.jumlah ELSE 0 END) AS Lunch
									, MAX(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan3
									FROM pemesanan_konsumsi p 
									JOIN pemesanan pe on p.pemesananid = pe.PemesananID
									JOIN Angkatan a on a.AngkatanID = pe.AngkatanID
									JOIN Program pr on pr.ProgramID = a.ProgramID
									WHERE tanggal >= '".$date_from."' and tanggal <= '".$date_to."'
									Group by p.tanggal
									ORDER BY pemesananid ASC, tanggal ASC
								) _tbb 
								ORDER BY jumlah ASC ) _t")
								;
		return $query->row();
    }
	
	
	public function get_Count_Rows2($date_from, $date_to)
    {
			$query = $this->db->query("Select Count(*) as jumlah From (
									SELECT p.pemesananid
									, concat (pr.programname,' - ',a.namaangkatan) as nama_program
									, pe.PICprogram as PIC
									, p.tanggal
									, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Pagi
									, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Pagi' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan1
									, SUM(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.jumlah ELSE 0 END) AS Coffee_Break_Siang
									, MAX(CASE WHEN p.jeniskonsumsi = 'Coffee Break Siang' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan2
									, SUM(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.jumlah ELSE 0 END) AS Lunch
									, MAX(CASE WHEN p.jeniskonsumsi = 'Lunch' THEN p.ruangankonsumsi ELSE NULL END) AS Ruangan3
									FROM pemesanan_konsumsi p 
									JOIN pemesanan pe on p.pemesananid = pe.PemesananID
									JOIN Angkatan a on a.AngkatanID = pe.AngkatanID
									JOIN Program pr on pr.ProgramID = a.ProgramID
									WHERE tanggal >= '".$date_from."' and tanggal <= '".$date_to."'
									Group by p.tanggal, nama_program
									ORDER BY pemesananid ASC, tanggal ASC
									) _tb
");
 
		return $query->row();
    }
}