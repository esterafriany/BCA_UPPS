<?php
class Model  extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');

    }

    public function verify_login($username,$password)
    {
    	$this->db->select('*');
    	$this->db->from('User');
    	$this->db->where('Username',$username);
    	$this->db->where('Password',$password);
    	$query = $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }

    public function get_Hotel_transaction()
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from("Hotel as h");
        $this->db->join('pemesanan_hotel as p', 'p.HotelName=h.HotelName');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_data()
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("user as a");
        $this->db->join('role as b', 'b.RoleID = a.RoleID');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

	public function viewP($ID)
	{
        $this->load->database();
        $this->db->select("*");
        $this->db->from("angkatan as a");
        $this->db->join('program as b', 'b.ProgramID = a.ProgramID');
		$this->db->where('a.ProgramID',$ID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}

    public function get_one_data($ID)
    {
        $this->db->select("*");
        $this->db->from("user as a");
        $this->db->join('role as b', 'b.RoleID = a.RoleID');
        $this->db->where('a.UserID',$ID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function row()
    {
        $this->load->database();
        $this->db->from('role');
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

	public function get_prg()
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("program");
        $this->db->where("ProgramID!=0");
		
		$this->db->order_by("UPPER(ProgramName)","asc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	
	public function get_Roo()
	{
		$this->load->database();
		$this->db->select("*");
		$this->db->from("Room");
		$this->db->order_by("UPPER(RoomName)","asc");
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_Hotels()
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("Hotel");
		$this->db->order_by("UPPER(HotelName)","asc");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

	public function get_ShuttlePoints()
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("ShuttlePoints");
		$this->db->order_by("UPPER(PointName)","asc");
        $query = $this->db->get();
        //$result = $query->result_array();
        $result=$query->result_array();
        return $result;
    }

	public function get_One_prg($ProgramID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("program");
		$this->db->where("ProgramID",$ProgramID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

	public function get_One_view($ID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("angkatan");
		$this->db->where("AngkatanID",$ID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

	public function get_One_room($ID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("room");
		$this->db->where("RoomID",$ID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	public function get_One_Hotel($ID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("hotel");
		$this->db->where("HotelID",$ID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
	public function get_One_ShuttlePoint($ID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("ShuttlePoints");
		$this->db->where("ShuttlePointID",$ID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function addUser($data)
    {
        $this->db->insert('user', $data);
    }
	function addProgram($data)
    {
        $this->db->insert('program', $data);
    }
	function addRoom($data)
    {
        $this->db->insert('Room', $data);
    }
	function addHotel($data)
    {
        $this->db->insert('Hotel', $data);
    }
	function addPoint($data)
    {
        $this->db->insert('ShuttlePoints', $data);
    }
	function addView($data)
    {
        $this->db->insert('Angkatan', $data);
    }
    function UpdateUser($data,$ID)
    {
        $this->db->where('UserID',$ID);
        $this->db->update('User', $data);
    }
	function UpdateProgram($data,$ProgramID)
    {
        $this->db->where('ProgramID',$ProgramID);
        $this->db->update('program', $data);
    }
	function UpdateRoom($data,$RoomID)
    {
        $this->db->where('RoomID',$RoomID);
        $this->db->update('room', $data);
    }
	function UpdateHotel($data,$ID)
    {
        $this->db->where('HotelID',$ID);
        $this->db->update('Hotel', $data);
    }
	function UpdatePoint($data,$ID)
    {
        $this->db->where('ShuttlePointID',$ID);
        $this->db->update('ShuttlePoints', $data);
    }
	function UpdateView($data,$AngkatanID)
    {
        $this->db->where('AngkatanID',$AngkatanID);
        $this->db->update('angkatan', $data);
    }
	function RemoveUser($ID)
    {
        $this->db->where('UserID',$ID);
        $this->db->delete('user');
    }
	function RemoveAngkatan($ID)
    {
        $this->db->where('AngkatanID',$ID);
        $this->db->delete('angkatan');
    }
        function RemoveProgram($ProgramID)
    {
        $this->db->where('ProgramID',$ProgramID);
        $this->db->delete('program');
    }
	function RemoveRoom($RoomID)
    {
        $this->db->where('RoomID',$RoomID);
        $this->db->delete('room');
    }
	function RemoveHotel($ID)
    {
        $this->db->where('HotelID',$ID);
        $this->db->delete('Hotel');
    }
	function RemovePoint($ID)
    {
        $this->db->where('ShuttlePointID',$ID);
        $this->db->delete('ShuttlePoints');
    }
    function addPemesanan($dataPemesanan,$table)
    {
        $this->db->insert($table, $dataPemesanan);
    }

        public function get_next_PemesananID()
    {
        $this->load->database();
        $this->db->select_max("PemesananID");
        $this->db->from("Pemesanan");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    // function get_curr_AirportID()
    // {
    //     $this->load->database();
    //     $this->db->select_max("AirportShuttleID");
    //     $this->db->from("pemesanan_airportshuttle");
    //     $query = $this->db->get();
    //     $result = $query->result_array();
    //     return $result;
    // }

    function get_all_Order()
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
        $this->db->join('angkatan as a', 'p.AngkatanID=a.AngkatanID');
         $this->db->join('program as b', 'a.ProgramID=b.ProgramID');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function get_full_Order($ID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
        $this->db->join('angkatan as a', 'p.AngkatanID=a.AngkatanID');
        $this->db->join('program as b', 'a.ProgramID=b.ProgramID');
        $this->db->where('p.PemesananID',$ID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_Pemesanan_Class($PemesananID)
    {

        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
        $this->db->join("pemesanan_kelas as pk", 'p.PemesananID=pk.PemesananID');
        $this->db->where('p.PemesananID',$PemesananID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

        function get_Pemesanan_Consumption($PemesananID)
    {

        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
        $this->db->join("pemesanan_konsumsi as pk", 'p.PemesananID=pk.PemesananID');
        $this->db->join("room as r", 'pk.RuanganKonsumsi=r.RoomID');
        $this->db->where('p.PemesananID',$PemesananID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

     function get_Pemesanan_Hotel($PemesananID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
      $this->db->join("pemesanan_hotel as ph", 'p.PemesananID=ph.PemesananID');
        $this->db->where('p.PemesananID',$PemesananID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_Pemesanan_Shuttle($PemesananID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
$this->db->join("pemesanan_shuttlebus as ps", 'p.PemesananID=ps.PemesananID');
        $this->db->where('p.PemesananID',$PemesananID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_Pemesanan_Airport_Arrival($PemesananID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
$this->db->join("airportshuttle_arrival as aa", 'p.PemesananID=aa.PemesananID');
        $this->db->where('p.PemesananID',$PemesananID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function get_Pemesanan_Airport_ID()
    {
        $this->load->database();
        $this->db->select_max("AirportShuttleID");
        $this->db->from("pemesanan_airportshuttle");
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function get_Pemesanan_Airport_Departure($PemesananID)
    {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("pemesanan as p");
$this->db->join("airportshuttle_departure as ad", 'p.PemesananID=ad.PemesananID');
        $this->db->where('p.PemesananID',$PemesananID);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    // $sql = "INSERT INTO pemesanan (`PemesananID`, `AngkatanID`, `TanggalAwalPemesanan`, `TanggalAkhirPemesanan`, `PICprogram`, `JumlahPeserta`) VALUES(11,14,\"2017-04-11\",\"2017-04-12\",\"Yacho\",8) ON DUPLICATE KEY UPDATE PemesananID = 11,JumlahPeserta = 90";

}
