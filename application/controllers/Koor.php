<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Koor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Model');
		$this->load->model('Rekap_model');
		$ID = ($this->session->userdata['logged_in']['UserID']);
		$_SESSION["jlh_notifikasi"] = $this->Rekap_model->get_num_notifikasi($ID);
	}
	public function views_bak($page = 'home')
	{
		//debug purposes
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			show_404();
		}
		else
		{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
				$data['title'] = ucfirst($page);
				$this->load->view('templates/header');
				$this->load->view('pages/'.$page,$data);
				$this->load->view('templates/footer');
				}
				else
					{
						$this->load->view('User_Authentication/Login');
					}
		}
		else{
			$data['title'] = ucfirst($page);
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page,$data);
			$this->load->view('templates/footer');
			}
		}
	}
	public function views($page = 'home')
	{
		//debug purposes
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			show_404();
		}
		else
		{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
			{
				if(strcasecmp ($page,"home")==0)
				{
					$CurrentDate = date('Y-m-d');
					$EndDate = date ("Y-m-d", strtotime("+5 day", strtotime($CurrentDate)));
					//echo($CurrentDate .' - '.$EndDate);
					$data['Rekap_All'] = $this->Rekap_model->get_All_5days_Recaps($CurrentDate,$EndDate);
				}
				$data['title'] = ucfirst($page);
				$this->load->view('templates/header');
				$this->load->view('pages/'.$page,$data);
				$this->load->view('templates/footer');
			}
			else
			{
				$this->load->view('User_Authentication/Login');
			}
		}
		else{
$this->load->view('pages/Login');
			}
		}
	}

	public function go_changePass($ID=0)
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
							$ID = $this->input->get('ID');
							$data['Users'] = $this->Model->get_one_data($ID);
							$this->load->view('templates/header');
							$this->load->view('pages/ChangePass',$data);
							$this->load->view('templates/footer');
				}
				else
					{
						$this->load->view('pages/Login');
					}
		}
	}

	public function do_changePass()
	{
		$truePass = $this->input->post('True');
		$ID = $this->input->post("SelectedID");
		$currPass = $this->input->post('CurrentPassword');
		$newPass = $this->input->post('NewPassword');
		$confirmation = $this->input->post('ConfirmPassword');
		if($truePass === $currPass)
		{
			if($newPass===$confirmation)
			{
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
					if(isset($this->session->userdata['logged_in']))
						{
				$Password = $this->input->post('NewPassword');
				$data = array
				(
					'Password' => $Password
				);

				$this->Model->UpdateUser($data,$ID);
				$data['title'] = ucfirst('Updated');

				$data['Users'] = $this->Model->get_data();
				$this->load->view('templates/header');
				$this->load->view('pages/home',$data);
				$this->load->view('templates/footer');
						}
						else
							{
								$this->load->view('pages/Login');
							}
				}
				else
				{
				$Password = $this->input->post('NewPassword');
				$data = array
				(
					'Password' => $Password
				);

				$this->Model->UpdateUser($data,$ID);
				$data['title'] = ucfirst('Updated');
				$data['Users'] = $this->Model->get_data();
				$this->load->view('templates/header');
				$this->load->view('pages/home',$data);
				$this->load->view('templates/footer');
				}
			}
			else
			{
				$data['message_display'] = 'failed to confirm new Password';
				$this->load->view('templates/header');
				$this->load->view('pages/ChangePass',$data);
				$this->load->view('templates/footer');
			}
		}
		else
		{
				$data['message_display'] = 'wrong current password';
				$this->load->view('templates/header');
				$this->load->view('pages/ChangePass',$data);
				$this->load->view('templates/footer');
		}
	}

	public function Edit_Pemesanan_Detail()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	if ($this->form_validation->run() == FALSE)
		{
					if(null != $this->input->post("Class_Notes"))
					{
						$_SESSION['Class_Notes'] = $this->input->post("Class_Notes");
					}
					if(null != $this->input->post("Consumption_Notes"))
					{
						$_SESSION["Consumption_Notes"] = $this->input->post("Consumption_Notes");
					}
					if(null != $this->input->post("Hotel_Notes"))
					{
						$_SESSION["Hotel_Notes"] = $this->input->post("Hotel_Notes");
					}
					if(null != $this->input->post("Shuttle_Notes"))
					{
						$_SESSION["Shuttle_Notes"] = $this->input->post("Shuttle_Notes");
					}
					if (null!=$this->input->get("trigger"))
					{
							$_SESSION["InputProgramMulai"] = $this->input->post("ProgramDimulai");
							$_SESSION["InputProgramSelesai"] = $this->input->post("ProgramSelesai");
							$_SESSION["InputAwalPemesanan"] = $this->input->post("AwalPemesanan");
							$_SESSION["InputAkhirPemesanan"] = $this->input->post("AkhirPemesanan");
							$_SESSION["InputPicProgram"] = $this->input->post("picProgram");
							$_SESSION["InputJumlahPeserta"] = $this->input->post("JumlahPeserta");
							$_SESSION["NextPemesananID"] = $this->input->post("NextPemesananID");
							$_SESSION["EditPemesananID"] = $_SESSION["EditID"];
					if (
								is_null($_SESSION["InputProgramMulai"])
								OR
								is_null($_SESSION["InputProgramSelesai"])
								OR
								strcmp($_SESSION["InputAwalPemesanan"],"")==0
								OR
								strcmp($_SESSION["InputAkhirPemesanan"],"")==0
								OR
								strcmp($_SESSION["InputPicProgram"],"")==0
								OR
								strcmp($_SESSION["InputJumlahPeserta"],"")==0
							)
							{
								$AngkatanID = $this->input->get("AngkatanID");
								$_SESSION["InputAngkatanID"] = $AngkatanID;
								$_SESSION["Warning"] = "Data Tidak Lengkap";
							$_SESSION["InputNamaAngkatan"] = $this->input->get("NamaAngkatan");
								//Get Data
								$data['Pemesanan'] = $this->Model->get_next_PemesananID();
								$data['Programs'] = $this->Model->get_prg();
								$data['Angkatans'] = $this->Model->ViewP($AngkatanID);
								$data['angkatans'] = $this->Model->get_One_view($AngkatanID);

								//Redirects

								$this->load->view('templates/header');
								$this->load->view('pages/Edit_Existing_Form', $data);
								$this->load->view('templates/footer');
							}
							else
						{
							$_SESSION['Warning'] == "Kosong";
							$data['PemesananKelas'] = $this->Model->get_Pemesanan_Class($_SESSION["EditPemesananID"]);
							if (
								count($this->Model->get_Pemesanan_Class($_SESSION["EditPemesananID"]))!=0
								AND
								strcmp($this->input->post("Edited"), "NEW")!=0
								AND
								strcmp($_SESSION['Edited'], "Class_true")!=0
								)
								{
									$JumlahRuanganKelas = count($this->Model->get_Pemesanan_Class($_SESSION["EditPemesananID"]));
									$_SESSION["JumlahRuanganKelas"] = $JumlahRuanganKelas;
									$i=1;
									foreach ($data['PemesananKelas'] as $key)
										{
											if (isset($_SESSION["Class_Notes"]))
											{
									$_SESSION["Class_Notes"] = $this->input->post("Class_Notes");
											}
											$_SESSION["JumlahPeserta"][$i] = $key['Jumlah_Peserta'];
											$_SESSION["RoomID"][$i] = $key['RoomName'];
											$_SESSION["Layout"][$i] = $key['Layout'];
											$i=$i+1;
										}
									}
							$data['Rooms'] = $this->Model->get_Roo();
							$this->load->view('templates/header');
							$this->load->view('pages/Edit_Pemesanan_Class',$data);
							$this->load->view('templates/footer');
						}
					}
					if(isset($_POST['Edit_Class_Button']))
						{
							if (strcmp($_SESSION["Warning"], "Kosong")==0)
								{
	$data['PemesananKelas'] = $this->Model->get_Pemesanan_Class($_SESSION["EditPemesananID"]);
	if
	(
		$this->input->post("Jumlah") > $_SESSION["JumlahRuanganKelas"]
	)
	{
		$_SESSION['Edited']="Class_true";
		if (null != $this->input->post("Jumlah"))
			{
				$JumlahRuanganKelas = $this->input->post("Jumlah");
				$_SESSION["JumlahRuanganKelas"] = $JumlahRuanganKelas;
				for ($i=1; $i <= $JumlahRuanganKelas; $i++)
					{
						if (isset($_SESSION["JumlahPeserta"][$i])==False)
						{
						$_SESSION["JumlahPeserta"][$i] = $this->input->post("JumlahPeserta$i");
						}
						if (isset($_SESSION["RoomID"][$i])==False)
						{
						$_SESSION["RoomID"][$i] = $this->input->post("RoomID$i");
						}
						if (isset($_SESSION["Layout"][$i])==False)
						{
						$_SESSION["Layout"][$i] = $this->input->post("Class_Layout$i");
						}
					}
			}
	}
	if
		(
			count($this->Model->get_Pemesanan_Class($_SESSION["EditPemesananID"]))!=0
			AND
			strcmp($_SESSION['Edited'], "Class_true")!=0
		)
	{
	$JumlahRuanganKelas = count($this->Model->get_Pemesanan_Class($_SESSION["EditPemesananID"]));
	$_SESSION["JumlahRuanganKelas"] = $JumlahRuanganKelas;
	$i=1;
	foreach ($data['PemesananKelas'] as $key)
		{
			if ($this->input->post("Class_Notes")==null)
				{
					$_SESSION["Class_Notes"] = $key['Note'];
				}
			else
			{
				$this->input->post("Class_Notes");
			}
			$_SESSION["JumlahPeserta"][$i] = $key['Jumlah_Peserta'];
			$_SESSION["RoomID"][$i] = $key['RoomName'];
			$_SESSION["Layout"][$i] = $key['Layout'];
			$i=$i+1;
		}
	}
	$data['Rooms'] = $this->Model->get_Roo();
	$this->load->view('templates/header');
	$this->load->view('pages/Edit_Pemesanan_Class',$data);
	$this->load->view('templates/footer');
								}
										}
					else if(isset($_POST['Edit_Consumption_Button']))
					{
						$_SESSION["Flags"] = $this->input->post("Flags");
$_SESSION["BerapaKaliKonumsi"] = $this->input->post("BerapaKaliKonsumsi");
						$Flags = $_SESSION["Flags"];
						if(isset($Flags)===True)
						{

								date_default_timezone_set('UTC');
	$date = $_SESSION["InputAwalPemesanan"];
	$end_date = $_SESSION["InputAkhirPemesanan"];
								while (strtotime($date) <= strtotime($end_date))
								{
	$_SESSION['InputCoffeBreakPagi'][] = $this->input->post("CoffeBreak_Pagi$date");
	$_SESSION['InputCoffeBreakSiang'][] = $this->input->post("CoffeBreak_Siang$date");
	$_SESSION['InputLunch$date'][] = $this->input->post("Lunch$date");
	$_SESSION['InputConsumptionRoom$date'][] = $this->input->post("Room$date");
	$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
								}
								unset($_SESSION["Flags"]);

						}
						$data['Rooms'] = $this->Model->get_Roo();
						$_SESSION['JumlahRuangan'] = $this->input->post("Jumlah");
						$JumlahRuangan = $_SESSION['JumlahRuangan'];
						//var_dump($_SESSION['JumlahRuangan']);
						for ($i=0; $i < $JumlahRuangan; $i++)
						{
							$_SESSION['JumlahPeserta'.$i] = $this->input->post("JumlahPeserta".$i);var_dump($_SESSION['JumlahPeserta'.$i]);
							$_SESSION['RoomID[]'] = $this->input->post("RoomID".$i);
								var_dump($_SESSION['RoomID[]']);
						}
$data['Consumption'] = $this->Model->get_Pemesanan_Consumption($_SESSION["EditPemesananID"]);
foreach ($data['Consumption'] as $key)
{
	if ($this->input->post("Consumption_Notes")==null)
	{
	$_SESSION["Consumption_Notes"] = $key["Note"];
	}

}

						$this->load->view('templates/header');
						$this->load->view('pages/Edit_Pemesanan_Konsumsi',$data);
						$this->load->view('templates/footer');
					}
					elseif (isset($_POST['Edit_Hotel_Button']))
					{
						$data["PemesananHotel"] = $this->Model->get_Pemesanan_Hotel($_SESSION["EditPemesananID"]);
						if
							(
								count($this->Model->get_Pemesanan_Hotel($_SESSION["EditPemesananID"]))!=0
								AND
								strcmp($this->input->post("Edited"), "NEW")!=0
								AND
								strcmp($_SESSION['Edited'], "Hotel_true")!=0
							)
						{
							$_SESSION['JumlahHotel'] = count($this->Model->get_Pemesanan_Hotel($_SESSION["EditPemesananID"]));
							$i=1;
							foreach ($data["PemesananHotel"] as $key)
								{
									if ($this->input->post("Hotel_Notes")==null)
									{
										$_SESSION["Hotel_Notes"] = $key['Note'];
									}
									$_SESSION["SingleWanita"][$i] = $key['Jml_singleWanita'];
									$_SESSION["TwinsWanita"][$i] = $key['Jml_twinWanita'];
									$_SESSION["SinglePria"][$i] = $key['Jml_SinglePria'];
									$_SESSION["TwinsPria"][$i] = $key['Jml_TwinPria'];
									$_SESSION["Book_Hotel"][$i] = $key['HotelName'];
									$_SESSION["StartDate"][$i]= $key['TanggalCheckIn'];
									$_SESSION["Enddate"][$i]=$key['TanggalCheckOut'];
									$i=$i+1;
								}
						}
						elseif
						(
	count($this->Model->get_Pemesanan_Hotel($_SESSION["EditPemesananID"]))==0
	OR
	strcmp($this->input->post("Edited"), "NEW")==0
						)
					{
						$_SESSION['Edited']="Hotel_true";
						if (null !== $this->input->post("Jumlah"))
						{
							$_SESSION['JumlahHotel'] = $this->input->post("Jumlah");
						for ($i=1; $i <= $_SESSION['JumlahHotel']; $i++)
						{
							if (isset($_SESSION["SingleWanita"][$i])==False)
							{
								$_SESSION["SingleWanita"][$i] = $this->input->post("JumlahSingleWanita$i");
							}
							if (isset($_SESSION["TwinsWanita"][$i])==False)
							{
								$_SESSION["TwinsWanita"][$i] = $this->input->post("JumlahTwinsWanita$i");
							}
							if (isset($_SESSION["SinglePria"][$i])==False)
							{
								$_SESSION["SinglePria"][$i] = $this->input->post("JumlahSinglePria$i");
							}
							if (isset($_SESSION["TwinsPria"][$i])==False)
							{
								$_SESSION["TwinsPria"][$i] = $this->input->post("JumlahTwinsPria$i");

							}
							if (isset($_SESSION["Book_Hotel"][$i])==False)
							{
								$_SESSION["Book_Hotel"][$i] = $this->input->post("Hotel$i");
							}
							if (isset($_SESSION["StartDate"][$i])==False)
							{
								$_SESSION["StartDate"][$i] = $this->input->post("Date_Start$i");
							}
							if (isset($_SESSION["Enddate"][$i])==False)
							{
								$_SESSION["Enddate"][$i] = $this->input->post("Date_End$i");
							}
						}
					}
						elseif (
							!isset($_SESSION['JumlahHotel']) AND
							null == $this->input->post("Jumlah"))
						{
							$_SESSION['JumlahHotel'] = 0;
						}
					}
					$data['Hotels'] = $this->Model->get_Hotels();
					$data['Transaction_Hotels'] = $this->Model->get_Hotel_transaction();
					$this->load->view('templates/header');
					$this->load->view('pages/Edit_Pemesanan_Hotel',$data);
					$this->load->view('templates/footer');
					}
					elseif (isset($_POST['Edit_Shuttle_Button']))
					{

					unset($_SESSION["PointName"]);
					unset($_SESSION["JumlahPenumpang"]);
					unset($_SESSION["InputPointDate"]);
						$data["PemesananShuttle"] = $this->Model->get_Pemesanan_Shuttle($_SESSION["EditPemesananID"]);
						if
							(
								count($this->Model->get_Pemesanan_Shuttle($_SESSION["EditPemesananID"]))!=0
								AND
								strcmp($this->input->post("Edited"), "NEW")!=0
								AND
								strcmp($_SESSION['Edited'], "Shuttle_true")!=0
							)
						{
		$_SESSION['JumlahShuttle'] = count($this->Model->get_ShuttlePoints());
							$i=0;
							foreach ($data["PemesananShuttle"] as $key)
								{

								if (null == $this->input->post("Shuttle_Notes"))
									{
									$_SESSION["Shuttle_Notes"] = $key['Note'];
									}
									else
									{
										$_SESSION["Shuttle_Notes"] = $this->input->post("Shuttle_Notes");
									}

						$_SESSION["CounterH"] = $_SESSION['JumlahShuttle'];
						$_SESSION['CounterP'] = count($data["PemesananShuttle"]);
							$_SESSION["PointName"][] = $key['ShuttlePoint'];
					$_SESSION["JumlahPenumpang"][] = $key['Passanger_Count'];
							$_SESSION["InputPointDate"][] = $key['Dates'];
							$i=$i+1;
								}

						}
						elseif
						(
	count($this->Model->get_Pemesanan_Shuttle($_SESSION["EditPemesananID"]))==0
	OR
	strcmp($this->input->post("Edited"), "NEW")==0
						)
					{
						$_SESSION['Edited']="Shuttle_true";
											if(null != $this->input->post("JumlahShuttle"))
						{
							if(null != $this->input->post("JumlahPemesanan"))
							{
							$_SESSION["CounterH"] = $this->input->post("JumlahShuttle");
							$_SESSION['CounterP'] = $this->input->post("JumlahPemesanan");
							for ($i=0; $i < $_SESSION["CounterP"]; $i++)
							{
								for ($o=0; $o < $_SESSION["CounterH"]; $o++)
								{
									$_SESSION["PointName".$i][$o] = $this->input->post("InputPointName".$i."[$o]");
									$_SESSION["JumlahPenumpang".$i][$o] = $this->input->post("JumlahPenumpang".$i."[$o]");
									$_SESSION["InputPointDate".$i][$o] = $this->input->post("InputPointDate".$i."[$o]");
								}
							}
							}
						}
						elseif (
							!isset($_SESSION['JumlahPemesanan']) AND
							null == $this->input->post("Jumlah"))
						{
							$_SESSION['JumlahPemesanan'] = 0;
						}
					}


						$data['ShuttlePoint'] = $this->Model->get_ShuttlePoints();
						$this->load->view('templates/header');
						$this->load->view('pages/Edit_Pemesanan_Shuttle',$data);
						$this->load->view('templates/footer');
					}
					elseif (isset($_POST['Edit_Airport_Button']))
					{
	$data["PemesananAirportArrival"]=$this->Model->get_Pemesanan_Airport_Arrival($_SESSION["EditPemesananID"]);
	$data["PemesananAirportDeparture"]=$this->Model->get_Pemesanan_Airport_Departure($_SESSION["EditPemesananID"]);
						if (!isset($_SESSION["JumlahPemesananBusArrival"])
							AND null == $this->input->post("InputType")
							)
						{
							if (
								null==$this->input->post("InputType")
								AND
								null!=$data["PemesananAirportArrival"]
								)
								{
									$_SESSION["JumlahPemesananBusArrival"]= count($data["PemesananAirportArrival"]);
									$x=1;
									foreach ($data["PemesananAirportArrival"] as $keyArrival)
										{
				$_SESSION["ArrivalDate"][$x] = $keyArrival["TanggalBerangkat"];
				$_SESSION["ArrivalPoint"][$x] =$keyArrival["BerangkatDari"];
				$_SESSION["ArrivalDestination"][$x] = $keyArrival["Tujuan"];
				$_SESSION["ArrivalTime"][$x] = $keyArrival["Jam"];
				$_SESSION["ArrivalCapacity"][$x] = $keyArrival["Kapasitas"];
				$_SESSION["ArrivalInformation"][$x] = $keyArrival["Keterangan"];
											$x=$x+1;
										}
								}
						}
						if (
							!isset($_SESSION["JumlahPemesananBusDeparture"])
							AND null == $this->input->post("InputType")
							)
						{
							if (
								null==$this->input->post("InputType")
								AND
								null!=$data["PemesananAirportDeparture"]
								)
							{
									$_SESSION["JumlahPemesananBusDeparture"]= count($data["PemesananAirportDeparture"]);
									$x=1;
									foreach ($data["PemesananAirportDeparture"] as $keyDeparture)
								{
			$_SESSION["DepartureDate"][$x] = $keyDeparture["TanggalBerangkat"];
			$_SESSION["DeparturePoint"][$x] =$keyDeparture["BerangkatDari"];
			$_SESSION["DepartureDestination"][$x] = $keyDeparture["Tujuan"];
			$_SESSION["DepartureTime"][$x] = $keyDeparture["Jam"];
			$_SESSION["DepartureCapacity"][$x] = $keyDeparture["Kapasitas"];
			$_SESSION["DepartureInformation"][$x] = $keyDeparture["Keterangan"];
									$x=$x+1;
								}
							}
						}
						if (null != $this->input->post("InputType"))
						{
							$InputType= $this->input->post("InputType");

							if (strcmp($InputType, "Arrival")==0)
							{
								$_SESSION["JumlahPemesananBusArrival"] = $this->input->post("Jumlah");
								for ($x=1; $x <= $_SESSION["JumlahPemesananBusArrival"]; $x++)
								{
if (isset($_SESSION["ArrivalDate"][$x])==False)
{
$_SESSION["ArrivalDate"][$x] = $this->input->post("ArrivalDate$x");
}
if (isset($_SESSION["ArrivalPoint"][$x])==False)
{
$_SESSION["ArrivalPoint"][$x] = $this->input->post("ArrivalPoint$x");
}
if (isset($_SESSION["ArrivalDestination"][$x])==False)
{
$_SESSION["ArrivalDestination"][$x] = $this->input->post("ArrivalDestination$x");
}
if (isset($_SESSION["ArrivalTime"][$x])==False)
{
$_SESSION["ArrivalTime"][$x] = $this->input->post("ArrivalTime$x");
}
if (isset($_SESSION["ArrivalCapacity"][$x])==False)
{
$_SESSION["ArrivalCapacity"][$x] = $this->input->post("ArrivalCapacity$x");
}
if (isset($_SESSION["ArrivalInformation"][$x])==False)
{
$_SESSION["ArrivalInformation"][$x] = $this->input->post("ArrivalInformation$x");
}
								}
							}
							else
							{
		$_SESSION["JumlahPemesananBusDeparture"] = $this->input->post("Jumlah");
				for ($y=1; $y <= $_SESSION["JumlahPemesananBusDeparture"]; $y++)
								{
if (isset($_SESSION["DepartureDate"][$y])==False) {
$_SESSION["DepartureDate"][$y] = $this->input->post("DepartureDate$y");
}
if (isset($_SESSION["DeparturePoint"][$y])==False) {
$_SESSION["DeparturePoint"][$y] = $this->input->post("DeparturePoint$y");
}
if (isset($_SESSION["DepartureDestination"][$y])==False) {
$_SESSION["DepartureDestination"][$y] = $this->input->post("DepartureDestination$y");
}
if (isset($_SESSION["DepartureTime"][$y])==False) {
$_SESSION["DepartureTime"][$y] = $this->input->post("DepartureTime$y");
}
if (isset($_SESSION["DepartureCapacity"][$y])==False) {
$_SESSION["DepartureCapacity"][$y] = $this->input->post("DepartureCapacity$y");
}
if (isset($_SESSION["DepartureInformation"][$y])==False) {
$_SESSION["DepartureInformation"][$y] = $this->input->post("DepartureInformation$y");
}
								}
							}
						}
						$this->load->view('templates/header');
						$this->load->view('pages/Edit_Pemesanan_Airport',$data);
						$this->load->view('templates/footer');
					}
					else if(isset($_POST['Finish_Button']))
					{
						if (isset($_SESSION["InputProgramName"]))
						{

							$dataPemesanan = array(
								'PemesananID' => $_SESSION["NextPemesananID"],
							'TanggalAwalPemesanan' => $_SESSION["InputAwalPemesanan"],
							'TanggalAkhirPemesanan' => $_SESSION["InputAkhirPemesanan"],
								'PICprogram' => $_SESSION["InputPicProgram"],
								'JumlahPeserta' => $_SESSION["InputJumlahPeserta"],
								'AngkatanID' => $_SESSION["InputAngkatanID"],
								);
							$this->Model->UpdatePemesanan($dataPemesanan,$_SESSION["EditPemesananID"],"pemesanan");

						}
						if (isset($_SESSION["JumlahRuanganKelas"]))
						{

							// echo $_SESSION["Class_Notes"];
								for ($l=1; $l <= $_SESSION["JumlahRuanganKelas"]; $l++)
								{
									if (isset($_SESSION["Class_Notes"]))
									{
										$dataPemesananKelas = array(
							'PemesananID' => $_SESSION["NextPemesananID"],
							'RoomName' => $_SESSION['RoomID'][$l],
						'Jumlah_Peserta'=>$_SESSION['JumlahPeserta'][$l],
									'Layout' => $_SESSION['Layout'][$l],
									'Note' => $_SESSION['Class_Notes'],
									'Status' => "Pending"
										);
									}
									else
									{
									$dataPemesananKelas = array(
									'PemesananID' => $_SESSION["NextPemesananID"],
							'RoomName' => $_SESSION['RoomID'][$l],
						'Jumlah_Peserta'=>$_SESSION['JumlahPeserta'][$l],
									'Layout' => $_SESSION['Layout'][$l],
									'Status' => "Pending"
										);
									}

								$this->Model->UpdatePemesanan($dataPemesananKelas,$_SESSION["EditPemesananID"],"pemesanan_kelas");
								}
						}
						date_default_timezone_set('UTC');
						$date = $_SESSION["InputAwalPemesanan"];
						$end_date = $_SESSION["InputAkhirPemesanan"];
						$i=0;
					while (strtotime($date) <= strtotime($end_date))
							{
							if (isset($_SESSION['Jumlah'.$date]) AND $_SESSION['Jumlah'.$date]>0)
							{
								if (isset($_SESSION["Consumption_Notes"]))
									{
										$dataPemesananKonsumsi = array(
		'PemesananID' => $_SESSION["NextPemesananID"],
		'Tanggal' => $date,
		'JenisKonsumsi' => $_SESSION['Consumption_type'.$date][$i],
		'Jumlah' => $_SESSION['Consumption_Amount'.$date][$i],
		'RuanganKonsumsi'=>$_SESSION['ConsumptionRoom'.$date][$i],
		'Note' => $_SESSION["Consumption_Notes"],
		'Status' => "Pending"
															);
							}
							else
							{
							$dataPemesananKonsumsi = array(
		'PemesananID' => $_SESSION["NextPemesananID"],
		'Tanggal' => $date,
		'JenisKonsumsi' => $_SESSION['Consumption_type'.$date][$i],
		'Jumlah' => $_SESSION['Consumption_Amount'.$date][$i],
		'RuanganKonsumsi'=>$_SESSION['ConsumptionRoom'.$date][$i],
		'Note' => $_SESSION["Consumption_Notes"],
		'Status' => "Pending"
															);
							}
$this->Model->UpdatePemesanan($dataPemesananKonsumsi,$_SESSION["EditPemesananID"],"pemesanan_konsumsi");
$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
$i=$i+1;
							}
							}

						if (isset($_SESSION['JumlahHotel']))
						{
							for ($h=0; $h < $_SESSION['JumlahHotel']; $h++)
							{
								$SMonth[$h] = date('m',strtotime($_SESSION['month_starts'][$h]));
								$EMonth[$h] = date('m',strtotime($_SESSION['month_ends'][$h]));
								if (isset($_SESSION["Hotel_Notes"]))
									{
										$dataPemesananHotel = array(
									'PemesananID'=> $_SESSION["NextPemesananID"],
									'HotelName'=>$_SESSION["Book_Hotel"][$h],
'TanggalCheckIn'=>$_SESSION["year_starts"][$h].'-'.$SMonth[$h].'-'.$_SESSION["day_starts"][$h],
'TanggalCheckOut'=>$_SESSION["year_ends"][$h].'-'.$EMonth[$h].'-'.$_SESSION["day_ends"][$h],
									'Jml_SinglePria'=>$_SESSION["SinglePria"][$h],
									'Jml_TwinPria'=>$_SESSION["TwinsPria"][$h],
									'Jml_singleWanita'=>$_SESSION["SingleWanita"][$h],
									'Jml_twinWanita'=>$_SESSION["TwinsWanita"][$h],
									'Note'=>$_SESSION["Hotel_Notes"],
									'Status' => "Pending"
									);
									}
									else
									{
									$dataPemesananHotel = array(
									'PemesananID'=> $_SESSION["NextPemesananID"],
									'HotelName'=>$_SESSION["Book_Hotel"][$h],
'TanggalCheckIn'=>$_SESSION["year_starts"][$h].'-'.$SMonth[$h].'-'.$_SESSION["day_starts"][$h],
'TanggalCheckOut'=>$_SESSION["year_ends"][$h].'-'.$EMonth[$h].'-'.$_SESSION["day_ends"][$h],
									'Jml_SinglePria'=>$_SESSION["SinglePria"][$h],
									'Jml_TwinPria'=>$_SESSION["TwinsPria"][$h],
									'Jml_singleWanita'=>$_SESSION["SingleWanita"][$h],
									'Jml_twinWanita'=>$_SESSION["TwinsWanita"][$h],

									'Status' => "Pending"
									);
									}
								$this->Model->UpdatePemesanan($dataPemesananHotel,$_SESSION["EditPemesananID"],"pemesanan_hotel");
							}
						}

						if (isset($_SESSION["CounterH"]) AND $_SESSION['CounterP'])
						{
							for ($i=0; $i < $_SESSION["CounterP"]; $i++)
							{
								for ($o=0; $o < $_SESSION["CounterH"]; $o++)
								{
									if ( $_SESSION["JumlahPenumpang".$i][$o]!=0)
									{
									if (isset($_SESSION['Shuttle_Notes']))
									{
										$dataPemesananShuttle = array(
											'PemesananID'=> $_SESSION["NextPemesananID"],
							'ShuttlePoint'=> $_SESSION["PointName$i"][$o],
							'Dates'=> $_SESSION["InputPointDate$i"][$o],
							'Passanger_Count' => $_SESSION["JumlahPenumpang$i"][$o],
							'Note'=> $_SESSION["Shuttle_Notes"],
							'Status' => "Pending"
											);
									}
									else
									{
										$dataPemesananShuttle = array(
											'PemesananID'=> $_SESSION["NextPemesananID"],
											'ShuttlePoint'=> $_SESSION["PointName".$i][$o],
											'Dates'=> $_SESSION["InputPointDate".$i][$o],
										'Passanger_Count' => $_SESSION["JumlahPenumpang".$i][$o],
										'Status' => "Pending"
											);
									}
									$this->Model->UpdatePemesanan($dataPemesananShuttle,$_SESSION["EditPemesananID"],"pemesanan_shuttlebus");
									}

								}
							}
						}
						if (isset($_SESSION["DepartureDate"]))
						{
							for ($x=0; $x < $_SESSION["JumlahPemesananBusDeparture"]; $x++)
							{
								$dataPemesananDepartureBus = array(
										'PemesananID'=> $_SESSION["NextPemesananID"],
										'TanggalBerangkat'=> $_SESSION["DepartureDate"][$x],
										'BerangkatDari'=> $_SESSION["DeparturePoint"][$x],
										'Tujuan' => $_SESSION["DepartureDestination"][$x],
										'Jam'=> $_SESSION["DepartureTime"][$x],
										'Kapasitas'=>$_SESSION["DepartureCapacity"][$x],
										'Keterangan'=>$_SESSION["DepartureInformation"][$x],
										'Status' => "Pending"
										);
								$this->Model->UpdatePemesanan($dataPemesananDepartureBus,$_SESSION["EditPemesananID"],"airportshuttle_departure");
							}

						}
						if (isset($_SESSION["ArrivalDate"]))
						{
							for ($t=0; $t < $_SESSION["JumlahPemesananBusArrival"]; $t++)
							{
								$dataPemesananArrivalBus = array(
										'PemesananID'=> $_SESSION["NextPemesananID"],
										'TanggalBerangkat'=> $_SESSION["ArrivalDate"][$t],
										'BerangkatDari'=>$_SESSION["ArrivalPoint"][$t],
										'Tujuan' => $_SESSION["ArrivalDestination"][$t],
										'Jam'=> $_SESSION["ArrivalTime"][$t],
										'Kapasitas'=>$_SESSION["ArrivalCapacity"][$t],
										'Keterangan'=>$_SESSION["ArrivalInformation"][$t],
										'Status' => "Pending"
										);
								$this->Model->addPemesanan($dataPemesananArrivalBus,'airportshuttle_arrival');
								$this->Model->UpdatePemesanan($dataPemesananArrivalBus,$_SESSION["EditPemesananID"],"airportshuttle_arrival");
							}
						}
					$this->load->view('templates/header');
					$this->load->view('pages/home');
					$this->load->view('templates/footer');
					}
					else
					{
						echo "Something's wrong";
					}
	}
	else
		{
			$this->load->view('pages/Login');
		}
	}
	public function remove_pemesanan()
	{
		$this->Rekap_model->set_jsonPemesanan($this->input->get("NP"),$this->input->get("AP"));
		$this->Rekap_model->set_jsonAirport($this->input->get("NP"),$this->input->get("AP"));
		$this->Rekap_model->set_jsonKonsumsi($this->input->get("NP"),$this->input->get("AP"));
		$this->Rekap_model->set_jsonHotel($this->input->get("NP"),$this->input->get("AP"));
		$this->Rekap_model->set_jsonKelas($this->input->get("NP"),$this->input->get("AP"));
		$this->Rekap_model->set_jsonShuttle($this->input->get("NP"),$this->input->get("AP"));
		$ID = $this->input->get("ID");
		$this->Rekap_model->RemovePemesanan($ID);

		ob_start(); // ensures anything dumped out will be caught
		$url = base_url().'Koor/view_Recaps?tipe=All';
		// this can be set based on whatever
		while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
	}
	public function remove_pemesanan_detail()
	{
		$pemesananID = $this->input->get("pemesanan");
		$contentID = $this->input->get("ID");
		$content = $this->input->get("content");
		if (strcmp($content, "Class")==0)
		{
			$this->Rekap_model->set_jsonKelas($this->input->get("NP"),$this->input->get("AP"));
			$this->Rekap_model->RemovePemesananDetail($contentID,$content);

		ob_start(); // ensures anything dumped out will be caught
		$url = base_url().'Koor/view_Detail?tipe=Classes&id_pemesanan='.$pemesananID;
		// this can be set based on whatever
		while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
		}
		elseif (strcmp($content, "Consumption")==0)
		{
			$this->Rekap_model->set_jsonKonsumsi($this->input->get("NP"),$this->input->get("AP"));
			$this->Rekap_model->RemovePemesananDetail($contentID,$content);

		ob_start(); // ensures anything dumped out will be caught
		$url = base_url().'Koor/view_Detail?tipe=Consumption&id_pemesanan='.$pemesananID;
		// this can be set based on whatever
		while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
		}
		elseif (strcmp($content, "Shuttle")==0)
		{
			$this->Rekap_model->set_jsonShuttle($this->input->get("NP"),$this->input->get("AP"));
			$this->Rekap_model->RemovePemesananDetail($contentID,$content);

		ob_start(); // ensures anything dumped out will be caught
		$url = base_url().'Koor/view_Detail?tipe=Shuttle&id_pemesanan='.$pemesananID;
		// this can be set based on whatever
		while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
		}
		elseif (strcmp($content, "Hotel")==0)
		{
			$this->Rekap_model->set_jsonHotel($this->input->get("NP"),$this->input->get("AP"));
			$this->Rekap_model->RemovePemesananDetail($contentID,$content);

			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Detail?tipe=Hotels&id_pemesanan='.$pemesananID;
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				header( "Location: $url" );

		}
		elseif (strcmp($content, "Airport")==0)
		{
			$Type = $this->input->get("Jenis");
			$TID = $this->input->get("TID");
			$this->Rekap_model->set_jsonAirport($this->input->get("NP"),$this->input->get("AP"));
			$this->Rekap_model->RemovePemesananDetail($contentID,$content,$TID,$Type);

			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Detail?tipe=AirportShuttle&id_pemesanan='.$pemesananID;
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				header( "Location: $url" );
		}

		else
		{
			echo "<h1>ERROR - Failed to revognize content</h1>";
			var_dump($content);
		}
	}
	public function remove_pemesanan_content()
	{
		?>
		<script type="text/javascript">
		alert(<?php echo $content ?>);
		</script>
		<?PHP
		$this->Rekap_model->set_jsonPemesanan($this->input->post("NP"),$this->input->post("AP"));
		$this->Rekap_model->set_jsonAirport($this->input->post("NP"),$this->input->post("AP"));
		$this->Rekap_model->set_jsonKonsumsi($this->input->post("NP"),$this->input->post("AP"));
		$this->Rekap_model->set_jsonHotel($this->input->post("NP"),$this->input->post("AP"));
		$this->Rekap_model->set_jsonKelas($this->input->post("NP"),$this->input->post("AP"));
		$this->Rekap_model->set_jsonShuttle($this->input->post("NP"),$this->input->post("AP"));

		$pemesananID = $this->input->get("pemesanan");
		$content = $this->input->get("content");
		$this->Rekap_model->RemovePemesananContent($pemesananID,$content);

		ob_start(); // ensures anything dumped out will be caught
		$url = base_url().'Koor/view_Recaps?tipe=All';
		// this can be set based on whatever
		while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
	}
	public function edit_Pemesanan()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
			{
				if(strcmp($this->input->get("action"),"Delete")==0)
				{
					$ID = $this->input->get("ID");
					$_SESSION["EditID"] = $ID;
					$this->Model->RemovePemesanan($ID);
					$data['Order'] = $this->Model->get_all_Order();
					$this->load->view('templates/header');
					$this->load->view('pages/ExistingForm',$data);
					$this->load->view('templates/footer');
				}
				else if(strcmp($this->input->get("action"),"Update")==0)
					{
					$ID = $this->input->get("ID");
					$_SESSION["EditID"] = $ID;
					$_SESSION["Warning"]="Kosong";
					$_SESSION['Edited'] = "False";
					if (isset($_SESSION["CounterP"]))
					{
						for ($i=0; $i < $_SESSION["CounterP"]; $i++)
						{
							unset($_SESSION["PointName$i"]);
							unset($_SESSION["JumlahPenumpang$i"]);
							unset($_SESSION["InputPointDate$i"]);
						}
					}
					date_default_timezone_set('UTC');
					$date = "2017-1-1";
					$end_date = "2020-1-1";
					while (strtotime($date) <= strtotime($end_date))
						{
						unset($_SESSION['Consumption_type'.$date]);
						unset($_SESSION['Consumption_Amount'.$date]);
						unset($_SESSION['ConsumptionRoom'.$date]);
						unset($_SESSION['JumlahPagi'.$date]);
						unset($_SESSION['JumlahLunch'.$date]);
						unset($_SESSION['JumlahSiang'.$date]);
						unset($_SESSION['Jumlah'.$date]);
						$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
						}
					unset($_SESSION["NextAirportID"]);
					unset( $_SESSION['IsDefault']);
					unset($_SESSION["JumlahFile"]);
					unset($_SESSION["JumlahFileKonsumsi"]);
					unset($_SESSION["JumlahFileHotel"]);
					unset($_SESSION["JumlahFileShuttle"]);
					unset($_SESSION["JumlahFileAirport"]);
					unset($_SESSION["CounterP"]);
					unset($_SESSION["CounterH"]);
					unset($_SESSION["EditPemesananID"]);
					unset($_SESSION["Shuttle_Notes"]);
					unset($_SESSION["JumlahRuanganKelas"]);
					unset ($_SESSION["InputProgramName"]);
					unset($_SESSION["InputAngkatanID"]);
					unset ($_SESSION["InputProgramID"]);
					unset ($_SESSION["InputNamaAngkatan"]);
					unset ($_SESSION["InputAwalPemesanan"]);
					unset ($_SESSION["InputAkhirPemesanan"]);
					unset ($_SESSION["InputPicProgram"]);
					unset($_SESSION["InputJumlahPeserta"]);
					unset ($_SESSION["InputProgramMulai"]);
					unset ($_SESSION["InputProgramSelesai"]);
					unset ($_SESSION["Flags"]);
					unset($_SESSION["JumlahPeserta"]);
					unset($_SESSION["RoomID"]);
					unset($_SESSION["Layout"]);
					unset($_SESSION["Class_Notes"]);
					unset($_SESSION["Consumption_Notes"]);
					unset($_SESSION['JumlahHotel']);
					unset($_SESSION['SingleWanita']);
					unset($_SESSION["TwinsWanita"]);
					unset($_SESSION["SinglePria"]);
					unset($_SESSION["TwinsPria"]);
					unset($_SESSION["Book_Hotel"]);
					unset($_SESSION["Date_Start"]);
					unset($_SESSION["Date_End"]);
					unset($_SESSION["Hotel_Notes"]);
					unset($_SESSION['ArrivalDate']);
					unset($_SESSION["ArrivalPoint"]);
					unset($_SESSION["ArrivalDestination"]);
					unset($_SESSION["ArrivalTime"]);
					unset($_SESSION["ArrivalCapacity"]);
					unset($_SESSION["ArrivalInformation"]);
					unset($_SESSION['DepartureDate']);
					unset($_SESSION["DeparturePoint"]);
					unset($_SESSION["DepartureDestination"]);
					unset($_SESSION["DepartureTime"]);
					unset($_SESSION["DepartureCapacity"]);
					unset($_SESSION["DepartureInformation"]);
					unset($_SESSION['JumlahPemesananBusDeparture']);
					unset($_SESSION['JumlahPemesananBusArrival']);
					unset($_SESSION["NextPemesananID"]);

					if(isset($_SESSION["CounterP"]))
					{
						for ($i=0; $i < $_SESSION["CounterP"]; $i++)
						{
								unset($_SESSION["JumlahPenumpang".$i]);
						}
					}
					unset($_SESSION["CounterH"]);
					unset($_SESSION['CounterP']);
					//Get Data
					$data['Pemesanan'] = $this->Model->get_next_PemesananID();
					$data['Programs'] = $this->Model->get_prg();
					$data['Angkatans'] = $this->Model->ViewP(0);
					$data['angkatans'] = $this->Model->get_One_view($ID);
					$data['SelectedOrder'] = $this->Model->get_full_Order($ID);
					//Redirects
					$this->load->view('templates/header');
					$this->load->view('pages/Edit_Existing_Form', $data);
					$this->load->view('templates/footer');
					}
					else if(strcmp($this->input->get("tipe"),"ExistingForm2")==0)
					{
					unset($_SESSION["InputAngkatanID"]);
					unset($_SESSION["InputNamaAngkatan"]);
					$ProgramID = $this->input->get("ProgramID");
					$AngkatanID = $this->input->get("AngkatanID");
					$_SESSION["InputProgramID"] = $ProgramID;
					$_SESSION["InputProgramName"] = $this->input->get("ProgramName");
					$AngkatanID = $this->input->get("AngkatanID");
					$_SESSION["InputAngkatanID"] = $AngkatanID;
					$_SESSION["InputNamaAngkatan"] = $this->input->get("NamaAngkatan");
						//Get Data
					$data['Pemesanan'] = $this->Model->get_next_PemesananID();
					$data['Programs'] = $this->Model->get_prg();
					$data['Angkatans'] = $this->Model->ViewP($ProgramID);
				$data['angkatans'] = $this->Model->get_One_view($AngkatanID);
				$data['SelectedOrder'] = $this->Model->get_full_Order($ProgramID);
					//Redirects
					$this->load->view('templates/header');
					$this->load->view('pages/Edit_Existing_Form', $data);
					$this->load->view('templates/footer');
					}
			}

		}
	else
		{
			$this->load->view('pages/Login');
		}
	}
	public function add_detail()
	{
			$tipe = $this->input->get("tipe");
			if ($this->input->get("program")!=NULL)
			{
				$_SESSION["InputProgramName"]=$this->input->get("program");
				$_SESSION["InputNamaAngkatan"]=$this->input->get("angkatan");
				$_SESSION["InputProgramMulai"]=$this->input->get("tanggal_program_mulai");
				$_SESSION["InputProgramSelesai"]=$this->input->get("tanggal_program_selesai");
				$_SESSION["InputPicProgram"]=$this->input->get("PIC");
				$_SESSION["InputJumlahPeserta"]=$this->input->get("JumlahPeserta");
				$_SESSION["IdPemesanan"]=$this->input->get("id_pemesanan");
				$_SESSION["InputAwalPemesanan"]=$this->input->get("AwalPemesanan");
				$_SESSION["InputAkhirPemesanan"]=$this->input->get("AkhirPemesanan");
			}

			$path="";
			if (strcmp($tipe,"Classes")==0)
			{
			$path = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Class_F/';
			}
			else if (strcmp($tipe,"Consumption")==0)
			{
				$path = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Konsumsi_F/';
			}
			else if (strcmp($tipe,"Hotel")==0)
			{
				$path = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Hotel_F/';
			}
			else if (strcmp($tipe,"Shuttle")==0)
			{
				$path = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Shuttle_F/';
			}
			else if (strcmp($tipe,"Airport")==0)
			{
				$path = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Airport_F/';
			}

			if (is_dir($path)==true)
			{
				$DirectoryCount = new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);
				$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
			}
			else {
				$_SESSION["JumlahFile"]=0;
			}

		if (strcmp($tipe,"Classes")==0)
		{
			if (isset($_SESSION["JumlahRuanganKelas"])==false)
			{
			$_SESSION["JumlahRuanganKelas"]=0;
			}
			?>
			<?php
			$data['Rooms'] = $this->Model->get_Roo();
			if ($this->input->post("filled")==true)
			{
				if(null != $this->input->post("Class_Notes"))
				{
					$_SESSION['Class_Notes'] = $this->input->post("Class_Notes");
				}
				if (isset($_SESSION["JumlahRuanganKelas"])==False)
				{
					$_SESSION["JumlahRuanganKelas"]=0;
					$_SESSION["TotalRuanganKelas"]=0;
				}
				else
				{
					$_SESSION["TotalRuanganKelas"]=$_SESSION["JumlahRuanganKelas"];
				}

				if (null != $this->input->post("Jumlah"))
				{
				$JumlahRuanganKelas = $this->input->post("Jumlah");
				$_SESSION["JumlahRuanganKelas"] = $JumlahRuanganKelas;

					$New_JumlahPeserta = $_POST['JumlahPeserta'];
					$New_RoomID = $_POST['RoomID'];
					$New_Layout = $_POST['Class_Layout'];
				$addNew=0;
for ($i=$_SESSION["TotalRuanganKelas"]+1; $i <= $JumlahRuanganKelas; $i++)
					{
	$_SESSION["JumlahPeserta"][$i] = $New_JumlahPeserta[$addNew];
	$_SESSION["RoomID"][$i] = $New_RoomID[$addNew];
	$_SESSION["Layout"][$i] = $New_Layout[$addNew];
	$addNew++;
					}
				}
				if (null != $this->input->post("JumlahFile"))
				{
				$JumlahFile = $this->input->post("JumlahFile");
		for ($i=$_SESSION["JumlahFile"]+1; $i <= $JumlahFile; $i++)
					{

		$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Class_F/';

		if (!is_dir($config['upload_path']))
		{
									mkdir($config['upload_path'], 0777, TRUE);
							}
								$config['allowed_types']        = '*';
								$config['overwrite'] = TRUE;
								$this->load->library('upload', $config);
								if ( ! $this->upload->do_upload('userfile'.$i))
								{
						$error = array('error' => $this->upload->display_errors());
						error_log($error["error"]);
						break;
							}
							else
							{
								$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Class_F/', FilesystemIterator::SKIP_DOTS);
							$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
							 $data['upload_data'] = $this->upload->data();
							}
					}
				}
				if(isset($_POST['Finish_Button']))
			{

				if (isset($_SESSION["JumlahRuanganKelas"]))
				{
						for ($l=1; $l <= $_SESSION["JumlahRuanganKelas"]; $l++)
						{
							if (isset($_SESSION["Class_Notes"]))
							{
								$dataPemesananKelas = array(
							'PemesananID' => $_SESSION["IdPemesanan"],
					'RoomName' => $_SESSION['RoomID'][$l],
				'Jumlah_Peserta'=>$_SESSION['JumlahPeserta'][$l],
							'Layout' => $_SESSION['Layout'][$l],
							'Note' => $_SESSION['Class_Notes'],
							'Status' => "Pending"
								);
							}
							else
							{
							$dataPemesananKelas = array(
							'PemesananID' => $_SESSION["IdPemesanan"],
					'RoomName' => $_SESSION['RoomID'][$l],
				'Jumlah_Peserta'=>$_SESSION['JumlahPeserta'][$l],
							'Layout' => $_SESSION['Layout'][$l],
							'Status' => "Pending"
								);
							}

						$this->Model->addPemesanan($dataPemesananKelas,'pemesanan_kelas');
						}
						ob_start(); // ensures anything dumped out will be caught
					$url = base_url().'Koor/view_Recaps?tipe=All';
					// this can be set based on whatever\
					unset($_SESSION['Class_Notes']);
unset($_SESSION["JumlahRuanganKelas"]);
unset($_SESSION["TotalRuanganKelas"]);
unset($_SESSION["JumlahFile"]);
unset($_SESSION["JumlahPeserta"]);
unset($_SESSION["RoomID"]);
unset($_SESSION["Layout"]);

					while (ob_get_status())
					{
						ob_end_clean();
					}
					// no redirect
					header( "Location: $url" );
				}
			}
		}

			$this->load->view('templates/header');
			$this->load->view('pages/Add_Detail_Class', $data);
			$this->load->view('templates/footer');

		}
		elseif (strcmp($tipe,"Consumption")==0)
		{
			$_SESSION["Flags"] = $this->input->post("Flags");
			if(isset($_SESSION["Flags"])===True)
			{

					date_default_timezone_set('UTC');
					$date = $_SESSION["InputAwalPemesanan"];
					$end_date = $_SESSION["InputAkhirPemesanan"];
					while (strtotime($date) <= strtotime($end_date))
					{
						if (isset($_SESSION['Jumlah'.$date])==False)
						{
							$_SESSION['Jumlah'.$date]=0;
						}
				if (isset($_SESSION['JumlahPagi'.$date])==False)
				{
					$_SESSION['JumlahPagi'.$date]=0;
				}
				if (isset($_SESSION['JumlahLunch'.$date])==False)
				{
					$_SESSION['JumlahLunch'.$date]=0;
				}
				if (isset($_SESSION['JumlahSiang'.$date])==False)
				{
					$_SESSION['JumlahSiang'.$date]=0;
				}
						$Jumlah=$this->input->post("Jumlah$date");
						for ($k=1; $k <= $Jumlah; $k++)
						{
if (null!=$this->input->post("Consumption_type".$date.$k))
							{
if (isset($_SESSION['Consumption_type'.$date][$k])==False)
{
	$_SESSION['Consumption_type'.$date][$k] = $this->input->post("Consumption_type".$date.$k);
}
if (strcmp($this->input->post("Consumption_type".$date.$k),"Lunch")==0)
{
	$_SESSION['JumlahLunch'.$date]++;
}
if (strcmp($this->input->post("Consumption_type".$date.$k),"Coffee Break Pagi")==0)
{
	$_SESSION['JumlahPagi'.$date]++;
}
if (strcmp($this->input->post("Consumption_type".$date.$k),"Coffee Break Siang")==0)
{
	$_SESSION['JumlahSiang'.$date]++;
}
$_SESSION['Jumlah'.$date]=
$_SESSION['JumlahPagi'.$date]+$_SESSION['JumlahLunch'.$date]+$_SESSION['JumlahSiang'.$date];
							}
							if (null!=$this->input->post("JumlahPeserta".$date.$k))
							{
								if (isset($_SESSION['Consumption_Amount'.$date][$k])==False)
								{
								$_SESSION['Consumption_Amount'.$date][$k] = $this->input->post("JumlahPeserta".$date.$k);
								}
							}
							if ($this->input->post("Room".$date.$k))
							{
								if (isset($_SESSION['ConsumptionRoom'.$date][$k])==False)
								{
								$_SESSION['ConsumptionRoom'.$date][$k] = $this->input->post("Room".$date.$k);
								}
							}
						}
						$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
					}
					unset($_SESSION["Flags"]);
			}

			if (null != $this->input->post("JumlahFile"))
				{
				$JumlahFile = $this->input->post("JumlahFile");
		for ($i=$_SESSION["JumlahFile"]+1; $i <= $JumlahFile; $i++)
					{

		$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Konsumsi_F/';

		if (!is_dir($config['upload_path']))
		{
									mkdir($config['upload_path'], 0777, TRUE);
							}
								$config['allowed_types']        = '*';
								$config['overwrite'] = TRUE;
								$this->load->library('upload', $config);
								if ( ! $this->upload->do_upload('userfile'.$i))
								{
						$error = array('error' => $this->upload->display_errors());
						error_log($error["error"]);
						break;
							}
							else
							{
				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Konsumsi_F/', FilesystemIterator::SKIP_DOTS);
							$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
							 $data['upload_data'] = $this->upload->data();
							}
					}
				}
				if(null != $this->input->post("Consumption_Notes"))
				{
					$_SESSION["Consumption_Notes"] = $this->input->post("Consumption_Notes");
				}
				if(isset($_POST['Finish_Button']))
				{
					date_default_timezone_set('UTC');
	$date = $_SESSION["InputAwalPemesanan"];
	$end_date = $_SESSION["InputAkhirPemesanan"];
							$JumlahKonsumsi=0;
				while (strtotime($date) <= strtotime($end_date))
							{
								if (isset($_SESSION['Jumlah'.$date]))
								{
									if ($JumlahKonsumsi==0 )
									{
									$JumlahKonsumsi= $_SESSION['Jumlah'.$date];
									}
									else
									{
									$JumlahKonsumsi=$JumlahKonsumsi+$_SESSION['Jumlah'.$date];
									}
								}
								$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
							}
				date_default_timezone_set('UTC');
				$date = $_SESSION["InputAwalPemesanan"];
				$end_date = $_SESSION["InputAkhirPemesanan"];
				while (strtotime($date) <= strtotime($end_date))
							{

								for ($i=1; $i <= $JumlahKonsumsi; $i++)
								{
									if (isset($_SESSION['Consumption_type'.$date][$i]))
									{
								if (isset($_SESSION["Consumption_Notes"]))
									{
										$dataPemesananKonsumsi = array(
		'PemesananID' => $_SESSION["IdPemesanan"],
		'Tanggal' => $date,
		'JenisKonsumsi' => $_SESSION['Consumption_type'.$date][$i],
		'Jumlah' => $_SESSION['Consumption_Amount'.$date][$i],
		'RuanganKonsumsi'=>$_SESSION['ConsumptionRoom'.$date][$i],
		'Note' => $_SESSION["Consumption_Notes"],
		'Status' => "Pending"
										);
									}
									else
										{
										$dataPemesananKonsumsi = array(
		'PemesananID' => $_SESSION["IdPemesanan"],
		'Tanggal' => $date,
		'JenisKonsumsi' => $_SESSION['Consumption_type'.$date][$i],
		'Jumlah' => $_SESSION['Consumption_Amount'.$date][$i],
		'RuanganKonsumsi'=>$_SESSION['ConsumptionRoom'.$date][$i],
		'Status' => "Pending"
											);
										}

										$this->Model->addPemesanan($dataPemesananKonsumsi,'pemesanan_konsumsi');
									}

								}
								$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
							}
							ob_start(); // ensures anything dumped out will be caught
						$url = base_url().'Koor/view_Recaps?tipe=All';
						// this can be set based on whatever\
						date_default_timezone_set('UTC');
						$date = $_SESSION["InputAwalPemesanan"];
						$end_date = $_SESSION["InputAkhirPemesanan"];
						while (strtotime($date) <= strtotime($end_date))
									{
										unset($_SESSION['Jumlah'.$date]);
										unset($_SESSION['Consumption_type'.$date]);
										unset($_SESSION["Consumption_Notes"]);
										unset($_SESSION['Consumption_Amount'.$date]);
										unset($_SESSION['ConsumptionRoom'.$date]);
										$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
										}
						unset($_SESSION["InputAwalPemesanan"]);
						unset($_SESSION["InputAkhirPemesanan"]);
						unset($_SESSION["Consumption_Notes"]);

						while (ob_get_status())
						{
							ob_end_clean();
						}
						// no redirect
						header( "Location: $url" );
				}
			$_SESSION['JumlahRuangan'] = $this->input->post("Jumlah");
			$data['Rooms'] = $this->Model->get_Roo();
			$JumlahRuangan = $_SESSION['JumlahRuangan'];

			$this->load->view('templates/header');
			$this->load->view('pages/Add_Detail_Consumption',$data);
			$this->load->view('templates/footer');
		}
		elseif (strcmp($tipe,"Hotel")==0)
		{
			if(null != $this->input->post("Hotel_Notes"))
				{
					$_SESSION['Hotel_Notes'] = $this->input->post("Hotel_Notes");
				}
			if (isset($_SESSION["JumlahHotel"])==False)
			{
				$_SESSION["JumlahHotel"]=0;
			}
			elseif (null !== $this->input->post("Jumlah"))
			{
				$_SESSION['JumlahHotel'] = $this->input->post("Jumlah");
			for ($i=0; $i <= $_SESSION['JumlahHotel']; $i++)
			{
				if (isset($_SESSION["SingleWanita"][$i])==False)
				{
	$_SESSION["SingleWanita"][$i] = $this->input->post("JumlahSingleWanita$i");
				}
				if (isset($_SESSION["TwinsWanita"][$i])==False)
				{
	$_SESSION["TwinsWanita"][$i] = $this->input->post("JumlahTwinsWanita$i");
				}
				if (isset($_SESSION["SinglePria"][$i])==False)
				{
	$_SESSION["SinglePria"][$i] = $this->input->post("JumlahSinglePria$i");
				}
				if (isset($_SESSION["TwinsPria"][$i])==False)
				{
		$_SESSION["TwinsPria"][$i] = $this->input->post("JumlahTwinsPria$i");
				}
				if (isset($_SESSION["Book_Hotel"][$i])==False)
				{
		$_SESSION["Book_Hotel"][$i] = $this->input->post("Hotel$i");
				}
				if (isset($_SESSION["Date_Start"][$i])==False)
				{
		$_SESSION["Date_Start"][$i] = $this->input->post("Date_Start$i");
				}
				if (isset($_SESSION["Date_End"][$i])==False)
				{
		$_SESSION["Date_End"][$i] = $this->input->post("Date_End$i");
				}
					}

			}
				if (null != $this->input->post("JumlahFile"))
				{
				$JumlahFile = $this->input->post("JumlahFile");
		for ($i=$_SESSION["JumlahFile"]+1; $i <= $JumlahFile; $i++)
					{

		$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Hotel_F/';

		if (!is_dir($config['upload_path']))
		{
									mkdir($config['upload_path'], 0777, TRUE);
							}
								$config['allowed_types']        = '*';
								$config['overwrite'] = TRUE;
								$this->load->library('upload', $config);
								if ( ! $this->upload->do_upload('userfile'.$i))
								{
						$error = array('error' => $this->upload->display_errors());
						error_log($error["error"]);
						break;
							}
							else
							{
				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Hotel_F/', FilesystemIterator::SKIP_DOTS);
							$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
							 $data['upload_data'] = $this->upload->data();
							}
					}
				}
				if(isset($_POST['Finish_Button']))
			{
				for ($h=1; $h <= $_SESSION['JumlahHotel']; $h++)
				{
					if (isset($_SESSION["Hotel_Notes"]))
						{
							$dataPemesananHotel = array(
						'PemesananID'=> $_SESSION["IdPemesanan"],
						'HotelName'=>$_SESSION["Book_Hotel"][$h],
						'TanggalCheckIn'=>$_SESSION["Date_Start"][$h],
						'TanggalCheckOut'=>$_SESSION["Date_End"][$h],
						'Jml_SinglePria'=>$_SESSION["SinglePria"][$h],
						'Jml_TwinPria'=>$_SESSION["TwinsPria"][$h],
						'Jml_singleWanita'=>$_SESSION["SingleWanita"][$h],
						'Jml_twinWanita'=>$_SESSION["TwinsWanita"][$h],
						'Note'=>$_SESSION["Hotel_Notes"],
						'Status' => "Pending"
						);
						}
						else
						{
						$dataPemesananHotel = array(
						'PemesananID'=> $_SESSION["IdPemesanan"],
						'HotelName'=>$_SESSION["Book_Hotel"][$h],
						'TanggalCheckIn'=>$_SESSION["Date_Start"][$h],
						'TanggalCheckOut'=>$_SESSION["Date_End"][$h],
						'Jml_SinglePria'=>$_SESSION["SinglePria"][$h],
						'Jml_TwinPria'=>$_SESSION["TwinsPria"][$h],
						'Jml_singleWanita'=>$_SESSION["SingleWanita"][$h],
						'Jml_twinWanita'=>$_SESSION["TwinsWanita"][$h],

						'Status' => "Pending"
						);
						}
						$this->Model->addPemesanan($dataPemesananHotel,'pemesanan_hotel');
				}
				ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=All';
			// this can be set based on whatever\
			unset($_SESSION["JumlahHotel"]);
			unset($_SESSION["SingleWanita"]);
			unset($_SESSION["TwinsWanita"]);
			unset($_SESSION["SinglePria"]);
			unset($_SESSION["TwinsPria"]);
			unset($_SESSION["Book_Hotel"]);
			unset($_SESSION["Date_Start"]);
			unset($_SESSION["Date_End"]);
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
			}
			$data['Hotels'] = $this->Model->get_Hotels();
$data['Transaction_Hotels'] = $this->Model->get_Hotel_transaction();
			$this->load->view('templates/header');
			$this->load->view('pages/Add_Detail_Hotel',$data);
			$this->load->view('templates/footer');
		}
		elseif (strcmp($tipe,"Shuttle")==0)
		{
			if(null != $this->input->post("Shuttle_Notes"))
				{
					$_SESSION['Shuttle_Notes'] = $this->input->post("Shuttle_Notes");
				}
			if(null != $this->input->post("JumlahShuttle"))
			{
				if(null != $this->input->post("JumlahPemesanan"))
				{
				$_SESSION["CounterH"] = $this->input->post("JumlahShuttle");
				$_SESSION['CounterP'] = $this->input->post("JumlahPemesanan");
				for ($i=0; $i < $_SESSION["CounterP"]; $i++)
				{
					for ($o=0; $o < $_SESSION["CounterH"]; $o++)
					{
						$_SESSION["PointName$i"][$o] = $this->input->post("InputPointName".$i.'['.$o.']');
						$_SESSION["JumlahPenumpang$i"][$o] = $this->input->post("JumlahPenumpang".$i.'['.$o.']');
						$_SESSION["InputPointDate$i"][$o] = $this->input->post("InputPointDate".$i.'['.$o.']');
					}
				}
				}
			}
			if (null != $this->input->post("JumlahFile"))
				{
				$JumlahFile = $this->input->post("JumlahFile");
		for ($i=$_SESSION["JumlahFile"]+1; $i <= $JumlahFile; $i++)
					{

		$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Shuttle_F/';

		if (!is_dir($config['upload_path']))
		{
									mkdir($config['upload_path'], 0777, TRUE);
							}
								$config['allowed_types']        = '*';
								$config['overwrite'] = TRUE;
								$this->load->library('upload', $config);
								if ( ! $this->upload->do_upload('userfile'.$i))
								{
						$error = array('error' => $this->upload->display_errors());
						error_log($error["error"]);
						break;
							}
							else
							{
				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Shuttle_F/', FilesystemIterator::SKIP_DOTS);
							$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
							 $data['upload_data'] = $this->upload->data();
							}
					}
				}
				if(isset($_POST['Finish_Button']))
				{
					for ($i=0; $i < $_SESSION["CounterP"]; $i++)
					{
						for ($o=0; $o < $_SESSION["CounterH"]; $o++)
						{
							if ( $_SESSION["JumlahPenumpang".$i][$o]!=0)
							{
							if (isset($_SESSION['Shuttle_Notes']))
							{
								$dataPemesananShuttle = array(
									'PemesananID'=> $_SESSION["IdPemesanan"],
					'ShuttlePoint'=> $_SESSION["PointName$i"][$o],
					'Dates'=> $_SESSION["InputPointDate$i"][$o],
					'Passanger_Count' => $_SESSION["JumlahPenumpang$i"][$o],
					'Note'=> $_SESSION["Shuttle_Notes"],
					'Status' => "Pending"
									);
							}
							else
							{
								$dataPemesananShuttle = array(
									'PemesananID'=> $_SESSION["IdPemesanan"],
									'ShuttlePoint'=> $_SESSION["PointName".$i][$o],
									'Dates'=> $_SESSION["InputPointDate".$i][$o],
								'Passanger_Count' => $_SESSION["JumlahPenumpang".$i][$o],
								'Status' => "Pending"
									);
							}
							$this->Model->addPemesanan($dataPemesananShuttle,'pemesanan_shuttlebus');
							}

						}
					}
					ob_start(); // ensures anything dumped out will be caught
				$url = base_url().'Koor/view_Recaps?tipe=All';
				// this can be set based on whatever\
				for ($i=0; $i < $_SESSION["CounterP"]; $i++)
				{
						unset($_SESSION["PointName$i"]);
						unset($_SESSION["JumlahPenumpang$i"]);
						unset($_SESSION["InputPointDate$i"]);
				}
				unset($_SESSION["CounterH"]);
				unset($_SESSION['CounterP']);
				while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
				}
			$data['ShuttlePoint'] = $this->Model->get_ShuttlePoints();

			$this->load->view('templates/header');
			$this->load->view('pages/Add_Detail_Shuttle',$data);
			$this->load->view('templates/footer');
		}
		elseif (strcmp($tipe,"Airport")==0)
		{
			if (null!=$this->input->post("NextAirportID"))
			{
				$_SESSION["NextAirportID"]=$this->input->post("NextAirportID");
			}
			if (isset($_SESSION["JumlahPemesananBusArrival"])==False)
			{
				$_SESSION["JumlahPemesananBusArrival"]=0;
			}

			if (isset($_SESSION["JumlahPemesananBusDeparture"])==False)
			{
				$_SESSION["JumlahPemesananBusDeparture"]=0;
			}

			if (null != $this->input->post("InputType"))
			{
				$InputType= $this->input->post("InputType");

				if (strcmp($InputType, "Arrival")==0)
				{
			$_SESSION["JumlahPemesananBusArrival"] = $this->input->post("Jumlah");
					for ($x=1; $x <=$_SESSION["JumlahPemesananBusArrival"]; $x++)
					{
						if (isset($_SESSION["ArrivalDate"][$x])==False)
							{
			$_SESSION["ArrivalDate"][$x] = $this->input->post("ArrivalDate$x");
							}
						if (isset($_SESSION["ArrivalPoint"][$x])==False)
							{
		$_SESSION["ArrivalPoint"][$x] = $this->input->post("ArrivalPoint$x");
							}
						if (isset($_SESSION["ArrivalDestination"][$x])==False)
							{
$_SESSION["ArrivalDestination"][$x] = $this->input->post("ArrivalDestination$x");
							}
						if (isset($_SESSION["ArrivalTime"][$x])==False)
							{
		$_SESSION["ArrivalTime"][$x] = $this->input->post("ArrivalTime$x");
							}
						if (isset($_SESSION["ArrivalCapacity"][$x])==False)
							{
		$_SESSION["ArrivalCapacity"][$x] = $this->input->post("ArrivalCapacity$x");
							}
						if (isset($_SESSION["ArrivalInformation"][$x])==False)
							{
$_SESSION["ArrivalInformation"][$x] = $this->input->post("ArrivalInformation$x");
							}
					}
				}
				else
				{
		$_SESSION["JumlahPemesananBusDeparture"] = $this->input->post("Jumlah");
					for ($y=1; $y <= $_SESSION["JumlahPemesananBusDeparture"]; $y++)
					{
						if (isset($_SESSION["DepartureDate"][$y])==False)
							{
	$_SESSION["DepartureDate"][$y] = $this->input->post("DepartureDate$y");
							}
							if (isset($_SESSION["DeparturePoint"][$y])==False)
							{
	$_SESSION["DeparturePoint"][$y] = $this->input->post("DeparturePoint$y");
							}
							if (isset($_SESSION["DepartureDestination"][$y])==False)
							{
	$_SESSION["DepartureDestination"][$y] = $this->input->post("DepartureDestination$y");
							}
							if (isset($_SESSION["DepartureTime"][$y])==False)
							{
	$_SESSION["DepartureTime"][$y] = $this->input->post("DepartureTime$y");
							}
							if (isset($_SESSION["DepartureCapacity"][$y])==False)
							{
	$_SESSION["DepartureCapacity"][$y] = $this->input->post("DepartureCapacity$y");
							}
							if (isset($_SESSION["DepartureInformation"][$y])==False)
							{
	$_SESSION["DepartureInformation"][$y] = $this->input->post("DepartureInformation$y");
							}
					}
				}
			}
			if (null != $this->input->post("JumlahFile"))
				{
				$JumlahFile = $this->input->post("JumlahFile");
		for ($i=$_SESSION["JumlahFile"]+1; $i <= $JumlahFile; $i++)
					{


		$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport_F/';

		if (!is_dir($config['upload_path']))
		{
									mkdir($config['upload_path'], 0777, TRUE);
							}
								$config['allowed_types']        = '*';
								$config['overwrite'] = TRUE;
								$this->load->library('upload', $config);
								if ( ! $this->upload->do_upload('userfile'.$i))
								{
						$error = array('error' => $this->upload->display_errors());
						error_log($error["error"]);
						break;
							}
							else
							{
				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Airport_F/', FilesystemIterator::SKIP_DOTS);
							$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
							 $data['upload_data'] = $this->upload->data();
							}
					}
					if(null != $this->input->post("Airport_Notes"))
					{
						$_SESSION["Airport_Notes"] = $this->input->post("Airport_Notes");
					}
				}
				if(isset($_POST['Finish_Button']))
				{
					if (isset($_SESSION["Airport_Notes"]))
					{
						$dataPemesananAirport = array(
						'AirportShuttleID' => $_SESSION["NextAirportID"],
						'PemesananID' => $_SESSION["IdPemesanan"],
						'Notes' => $_SESSION["Airport_Notes"],
						'status' => "Pending",
												 );
					}
					else
					{
						$dataPemesananAirport = array(
						'AirportShuttleID' => $_SESSION["NextAirportID"],
						'PemesananID' => $_SESSION["IdPemesanan"],
						'status' => "Pending",
												 );
					}
					$this->Model->addPemesanan($dataPemesananAirport,'pemesanan_airportshuttle');
					if (isset($_SESSION["DepartureDate"]))
					{
						for ($x=1; $x <= $_SESSION["JumlahPemesananBusDeparture"]; $x++)
						{
							$dataPemesananDepartureBus = array(
							'AirportShuttleID' => $_SESSION["NextAirportID"],
							'PemesananID' => $_SESSION["IdPemesanan"],
							'TanggalBerangkat'=> $_SESSION["DepartureDate"][$x],
							'BerangkatDari'=> $_SESSION["DeparturePoint"][$x],
							'Tujuan' => $_SESSION["DepartureDestination"][$x],
							'Jam'=> $_SESSION["DepartureTime"][$x],
							'Kapasitas'=>$_SESSION["DepartureCapacity"][$x],
							'Keterangan'=>$_SESSION["DepartureInformation"][$x],
									);
							$this->Model->addPemesanan($dataPemesananDepartureBus,'airportshuttle_departure');
						}
					}
					if (isset($_SESSION["ArrivalDate"]))
					{
						for ($t=1; $t <= $_SESSION["JumlahPemesananBusArrival"]; $t++)
						{
							$dataPemesananArrivalBus = array(
							'AirportShuttleID' => $_SESSION["NextAirportID"],
							'TanggalBerangkat'=> $_SESSION["ArrivalDate"][$t],
							'PemesananID' => $_SESSION["IdPemesanan"],
							'BerangkatDari'=>$_SESSION["ArrivalPoint"][$t],
							'Tujuan' => $_SESSION["ArrivalDestination"][$t],
							'Jam'=> $_SESSION["ArrivalTime"][$t],
							'Kapasitas'=>$_SESSION["ArrivalCapacity"][$t],
							'Keterangan'=>$_SESSION["ArrivalInformation"][$t],
									);
							$this->Model->addPemesanan($dataPemesananArrivalBus,'airportshuttle_arrival');
						}
					}
					ob_start(); // ensures anything dumped out will be caught
				$url = base_url().'Koor/view_Recaps?tipe=All';
				// this can be set based on whatever\
				unset($_SESSION["JumlahPemesananBusArrival"]);
				unset($_SESSION["ArrivalDate"]);
				unset($_SESSION["ArrivalPoint"]);
				unset($_SESSION["ArrivalPoint"]);
				unset($_SESSION["ArrivalTime"]);
				unset($_SESSION["ArrivalCapacity"]);
				unset($_SESSION["ArrivalInformation"]);

				unset($_SESSION["JumlahPemesananBusDeparture"]);
				unset($_SESSION["DepartureDate"]);
				unset($_SESSION["DeparturePoint"]);
				unset($_SESSION["DepartureDestination"]);
				unset($_SESSION["DepartureTime"]);
				unset($_SESSION["DepartureCapacity"]);
				unset($_SESSION["DepartureInformation"]);
				unset($_SESSION["Airport_Notes"]);
				while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
				}
			$data['AirportID'] = $this->Model->get_Pemesanan_Airport_ID();

			$this->load->view('templates/header');
			$this->load->view('pages/Add_Detail_Airport',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			echo "$tipe,is not found!";
		}
}






	public function add_Pemesanan()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
					if(null != $this->input->post("Layout"))
					{
						$_SESSION["Class_Layout"] = $this->input->post("Layout");
					}
					if(null != $this->input->post("Class_Notes"))
					{
						$_SESSION['Class_Notes'] = $this->input->post("Class_Notes");
					}
					if(null != $this->input->post("Consumption_Notes"))
					{
						$_SESSION["Consumption_Notes"] = $this->input->post("Consumption_Notes");
					}
					if(null != $this->input->post("Hotel_Notes"))
					{
						$_SESSION["Hotel_Notes"] = $this->input->post("Hotel_Notes");
					}
					if(null != $this->input->post("Shuttle_Notes"))
					{
						$_SESSION["Shuttle_Notes"] = $this->input->post("Shuttle_Notes");
					}
					if(null != $this->input->post("Airport_Notes"))
					{
						$_SESSION["Airport_Notes"] = $this->input->post("Airport_Notes");
					}

					if (isset($_POST['Next_Button']))
					{
						$_SESSION["InputProgramMulai"] = $this->input->post("ProgramDimulai");
						$_SESSION["InputProgramSelesai"] = $this->input->post("ProgramSelesai");
						$_SESSION["InputAwalPemesanan"] = $this->input->post("AwalPemesanan");
						$_SESSION["InputAkhirPemesanan"] = $this->input->post("AkhirPemesanan");
						$_SESSION["InputPicProgram"] = $this->input->post("picProgram");
						$_SESSION["InputJumlahPeserta"] = $this->input->post("JumlahPeserta");
						$_SESSION["NextPemesananID"] = $this->input->post("NextPemesananID");
						if (
								is_null($_SESSION["InputProgramMulai"])
								OR
								is_null($_SESSION["InputProgramSelesai"])
								OR
								strcmp($_SESSION["InputAwalPemesanan"],"")==0
								OR
								strcmp($_SESSION["InputAkhirPemesanan"],"")==0
								OR
								strcmp($_SESSION["InputPicProgram"],"")==0
								OR
								strcmp($_SESSION["InputJumlahPeserta"],"")==0
							)
							{
								var_dump($_SESSION["InputProgramMulai"]);
								var_dump($_SESSION["InputProgramSelesai"]);
								var_dump($_SESSION["InputAwalPemesanan"]);
								var_dump($_SESSION["InputAkhirPemesanan"]);
								var_dump($_SESSION["InputPicProgram"]);
								var_dump($_SESSION["InputJumlahPeserta"]);
								$AngkatanID = $this->input->get("AngkatanID");
								$_SESSION["InputAngkatanID"] = $AngkatanID;
								$_SESSION["Warning"] = "Data Tidak Lengkap";
								$_SESSION["InputNamaAngkatan"] = $this->input->get("NamaAngkatan");
								//Get Data
								$data['Pemesanan'] = $this->Model->get_next_PemesananID();
								$data['Programs'] = $this->Model->get_prg();
								$data['Angkatans'] = $this->Model->ViewP($AngkatanID);
								$data['angkatans'] = $this->Model->get_One_view($AngkatanID);

								//Redirects

								$this->load->view('templates/header');
								$this->load->view('pages/NewForm', $data);
								$this->load->view('templates/footer');
							}
							else
							{
								$_SESSION["Warning"]="Kosong";
								$data['Rooms'] = $this->Model->get_Roo();
								$_SESSION["JumlahRuanganKelas"]=0;
								$_SESSION["JumlahFile"]=0;
								$_SESSION["JumlahFileKonsumsi"]=0;
								$_SESSION["JumlahFileHotel"]=0;
								$_SESSION["JumlahFileShuttle"]=0;
								$_SESSION["JumlahFileAirport"]=0;
								$this->load->view('templates/header');
								$this->load->view('pages/Pemesanan_NewClass',$data);
								$this->load->view('templates/footer');
							}
					}


					if(isset($_POST['Class_Button']))
					{
						if (strcmp($_SESSION["Warning"], "Kosong")==0)
						{
							if (isset($_SESSION["JumlahRuanganKelas"])==False)
							{
								$_SESSION["JumlahRuanganKelas"]=0;
								$_SESSION["TotalRuanganKelas"]=0;
							}
							else
							{
								$_SESSION["TotalRuanganKelas"]=$_SESSION["JumlahRuanganKelas"];
							}
							if (isset($_SESSION["JumlahFile"])==False)
							{
								$_SESSION["JumlahFile"]=0;
							}

							if (null != $this->input->post("Jumlah"))
							{
							$JumlahRuanganKelas = $this->input->post("Jumlah");
							$_SESSION["JumlahRuanganKelas"] = $JumlahRuanganKelas;

								$New_JumlahPeserta = $_POST['JumlahPeserta'];
								$New_RoomID = $_POST['RoomID'];
								$New_Layout = $_POST['Class_Layout'];
							$addNew=0;
		for ($i=$_SESSION["TotalRuanganKelas"]+1; $i <= $JumlahRuanganKelas; $i++)
								{
				$_SESSION["JumlahPeserta"][$i] = $New_JumlahPeserta[$addNew];
				$_SESSION["RoomID"][$i] = $New_RoomID[$addNew];
				$_SESSION["Layout"][$i] = $New_Layout[$addNew];
				$addNew++;
								}
							}
							if (null != $this->input->post("JumlahFile"))
							{
							$JumlahFile = $this->input->post("JumlahFile");
					for ($i=$_SESSION["JumlahFile"]+1; $i <= $JumlahFile; $i++)
								{

					$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Class/';

					if (!is_dir($config['upload_path']))
					{
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    	$config['allowed_types']        = '*';
                    	$config['overwrite'] = TRUE;
                    	$this->load->library('upload', $config);
                    	if ( ! $this->upload->do_upload('userfile'.$i))
                    	{
                	$error = array('error' => $this->upload->display_errors());
                	error_log($error["error"]);
                	break;
                		}
                		else
                		{
       				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Class/', FilesystemIterator::SKIP_DOTS);
                		$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
                		 $data['upload_data'] = $this->upload->data();
                		}
								}
							}
								$data['Rooms'] = $this->Model->get_Roo();
								$this->load->view('templates/header');
							$this->load->view('pages/Pemesanan_NewClass',$data);
								$this->load->view('templates/footer');
						}

					}
					else if(isset($_POST['Consumption_Button']))
					{
						if( isset($_SESSION['IsDefault']) AND strcmp( $_SESSION['IsDefault'],"true")==0)
						{
							date_default_timezone_set('UTC');
							$date = $this->input->post("Default-TanggalAwal");
							$end_date = $this->input->post("Default-TanggalAkhir");
							while (strtotime($date) <= strtotime($end_date))
							{
								// var_dump($date);
								$Jumlah=3;
								$_SESSION['JumlahPagi'.$date]=1;
								$_SESSION['JumlahLunch'.$date]=1;
								$_SESSION['JumlahSiang'.$date]=1;
								$_SESSION['Jumlah'.$date]=3;

								for ($k=1; $k <= $Jumlah; $k++)
									{
										if($k%2==0)
										{
											$_SESSION['Consumption_type'.$date][$k] = "Lunch";
											$_SESSION['Consumption_Amount'.$date][$k] = $this->input->post("DefaultLunch");
											$_SESSION['ConsumptionRoom'.$date][$k] = $this->input->post("DefaultLunchRoom");
										}
										elseif($k%3==0)
										{
											$_SESSION['Consumption_type'.$date][$k] = "Coffee Break Siang";
											$_SESSION['Consumption_Amount'.$date][$k] = $this->input->post("DefaultNoonCoffee");
											$_SESSION['ConsumptionRoom'.$date][$k] = $this->input->post("DefaultNoonRoom");
											
										}
										else
										{
											$_SESSION['Consumption_type'.$date][$k] = "Coffee Break Pagi";
											$_SESSION['Consumption_Amount'.$date][$k] = $this->input->post("DefaultMorningCoffee");
											$_SESSION['ConsumptionRoom'.$date][$k] = $this->input->post("DefaultMorningRoom");
										}
										
									}
							$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
							}
							 $_SESSION['IsDefault']=false;
						}
						$_SESSION["Flags"] = $this->input->post("Flags");
						if(isset($_SESSION["Flags"])===True)
						{
							if($_SESSION["Flags"]==="Default")
							{
								date_default_timezone_set('UTC');
								$date = $_SESSION["InputAwalPemesanan"];
								$end_date = $_SESSION["InputAkhirPemesanan"];
								while (strtotime($date) <= strtotime($end_date))
								{
								//  var_dump($this->input->post("JumlahPagi".$date));
								if($this->input->post("JumlahP".$date)!=null)
								{
									// $_SESSION['Consumption_Amount'.$date][0] = $this->input->post("JumlahP".$date);
								}
								if($this->input->post("JumlahL".$date)!=null)
								{
									// $_SESSION['Consumption_Amount'.$date][0] = $this->input->post("JumlahL".$date);
								}
								if($this->input->post("JumlahS".$date)!=null)
								{
									// $_SESSION['Consumption_Amount'.$date][0] = $this->input->post("JumlahS".$date);
								}

								
								$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
								}
							}
						else
						{
								date_default_timezone_set('UTC');
								$date = $_SESSION["InputAwalPemesanan"];
								$end_date = $_SESSION["InputAkhirPemesanan"];
								while (strtotime($date) <= strtotime($end_date))
								{
									if (isset($_SESSION['Jumlah'.$date])==False)
									{
										$_SESSION['Jumlah'.$date]=0;
									}
							if (isset($_SESSION['JumlahPagi'.$date])==False)
							{
								$_SESSION['JumlahPagi'.$date]=0;
							}
							if (isset($_SESSION['JumlahLunch'.$date])==False)
							{
								$_SESSION['JumlahLunch'.$date]=0;
							}
							if (isset($_SESSION['JumlahSiang'.$date])==False)
							{
								$_SESSION['JumlahSiang'.$date]=0;
							}
									$Jumlah=$this->input->post("Jumlah$date");
									for ($k=1; $k <= $Jumlah; $k++)
									{
		if (null!=$this->input->post("Consumption_type".$date.$k))
										{
			if (isset($_SESSION['Consumption_type'.$date][$k])==False)
			{
				$_SESSION['Consumption_type'.$date][$k] = $this->input->post("Consumption_type".$date.$k);
			}
		if (strcmp($this->input->post("Consumption_type".$date.$k),"Lunch")==0)
			{
				$_SESSION['JumlahLunch'.$date]++;
			}
		if (strcmp($this->input->post("Consumption_type".$date.$k),"Coffee Break Pagi")==0)
			{
				$_SESSION['JumlahPagi'.$date]++;
			}
		if (strcmp($this->input->post("Consumption_type".$date.$k),"Coffee Break Siang")==0)
			{
				$_SESSION['JumlahSiang'.$date]++;
			}
			$_SESSION['Jumlah'.$date]=
$_SESSION['JumlahPagi'.$date]+$_SESSION['JumlahLunch'.$date]+$_SESSION['JumlahSiang'.$date];
										}
										if (null!=$this->input->post("JumlahPeserta".$date.$k))
										{
											if (isset($_SESSION['Consumption_Amount'.$date][$k])==False)
											{
											$_SESSION['Consumption_Amount'.$date][$k] = $this->input->post("JumlahPeserta".$date.$k);
											}
										}
										if ($this->input->post("Room".$date.$k))
										{
											if (isset($_SESSION['ConsumptionRoom'.$date][$k])==False)
											{
											$_SESSION['ConsumptionRoom'.$date][$k] = $this->input->post("Room".$date.$k);
											}
										}
									}
									$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
								}
							}
								unset($_SESSION["Flags"]);
						}

						if (null != $this->input->post("JumlahFileKonsumsi"))
							{
							$JumlahFile = $this->input->post("JumlahFileKonsumsi");
					for ($i=$_SESSION["JumlahFileKonsumsi"]+1; $i <= $JumlahFile; $i++)
								{

					$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Konsumsi/';

					if (!is_dir($config['upload_path']))
					{
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    	$config['allowed_types']        = '*';
                    	$config['overwrite'] = TRUE;
                    	$this->load->library('upload', $config);
                    	if ( ! $this->upload->do_upload('userfile'.$i))
                    	{
                	$error = array('error' => $this->upload->display_errors());
                	error_log($error["error"]);
                	break;
                		}
                		else
                		{
       				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Konsumsi/', FilesystemIterator::SKIP_DOTS);
                		$_SESSION["JumlahFileKonsumsi"]=iterator_count($DirectoryCount);
                		 $data['upload_data'] = $this->upload->data();
                		}
								}
							}



						$_SESSION['JumlahRuangan'] = $this->input->post("Jumlah");
						$_SESSION['IsDefault']="";
						$data['Rooms'] = $this->Model->get_Roo();
						$JumlahRuangan = $_SESSION['JumlahRuangan'];
						$this->load->view('templates/header');
						$this->load->view('pages/Pemesanan_NewConsumption',$data);
						$this->load->view('templates/footer');
					}
					else if(isset($_POST['Hotel_Button']))
					{
						if (isset($_SESSION["JumlahHotel"])==False)
						{
							$_SESSION["JumlahHotel"]=0;
						}
						elseif (null !== $this->input->post("Jumlah"))
						{
							$_SESSION['JumlahHotel'] = $this->input->post("Jumlah");
						for ($i=0; $i <= $_SESSION['JumlahHotel']; $i++)
						{
							if (isset($_SESSION["SingleWanita"][$i])==False)
							{
				$_SESSION["SingleWanita"][$i] = $this->input->post("JumlahSingleWanita$i");
							}
							if (isset($_SESSION["TwinsWanita"][$i])==False)
							{
				$_SESSION["TwinsWanita"][$i] = $this->input->post("JumlahTwinsWanita$i");
							}
							if (isset($_SESSION["SinglePria"][$i])==False)
							{
				$_SESSION["SinglePria"][$i] = $this->input->post("JumlahSinglePria$i");
							}
							if (isset($_SESSION["TwinsPria"][$i])==False)
							{
					$_SESSION["TwinsPria"][$i] = $this->input->post("JumlahTwinsPria$i");
							}
							if (isset($_SESSION["Book_Hotel"][$i])==False)
							{
					$_SESSION["Book_Hotel"][$i] = $this->input->post("Hotel$i");
							}
							if (isset($_SESSION["Date_Start"][$i])==False)
							{
					$_SESSION["Date_Start"][$i] = $this->input->post("Date_Start$i");
							}
							if (isset($_SESSION["Date_End"][$i])==False)
							{
					$_SESSION["Date_End"][$i] = $this->input->post("Date_End$i");
							}
								}

						}
							if (null != $this->input->post("JumlahFileHotel"))
							{
							$JumlahFile = $this->input->post("JumlahFileHotel");
					for ($i=$_SESSION["JumlahFileHotel"]+1; $i <= $JumlahFile; $i++)
								{

					$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Hotel/';

					if (!is_dir($config['upload_path']))
					{
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    	$config['allowed_types']        = '*';
                    	$config['overwrite'] = TRUE;
                    	$this->load->library('upload', $config);
                    	if ( ! $this->upload->do_upload('userfile'.$i))
                    	{
                	$error = array('error' => $this->upload->display_errors());
                	error_log($error["error"]);
                	break;
                		}
                		else
                		{
       				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Hotel/', FilesystemIterator::SKIP_DOTS);
                		$_SESSION["JumlahFileHotel"]=iterator_count($DirectoryCount);
                		 $data['upload_data'] = $this->upload->data();
                		}
								}
							}
						$data['Hotels'] = $this->Model->get_Hotels();
			$data['Transaction_Hotels'] = $this->Model->get_Hotel_transaction();
						$this->load->view('templates/header');
						$this->load->view('pages/Pemesanan_NewHotel',$data);
						$this->load->view('templates/footer');
					}
					else if(isset($_POST['Shuttle_Button']))
					{
						if(null != $this->input->post("JumlahShuttle"))
						{
							if(null != $this->input->post("JumlahPemesanan"))
							{
							$_SESSION["CounterH"] = $this->input->post("JumlahShuttle");
							$_SESSION['CounterP'] = $this->input->post("JumlahPemesanan");
							for ($i=0; $i < $_SESSION["CounterP"]; $i++)
							{
								for ($o=0; $o < $_SESSION["CounterH"]; $o++)
								{
									$_SESSION["PointName$i"][$o] = $this->input->post("InputPointName".$i.'['.$o.']');
									$_SESSION["JumlahPenumpang$i"][$o] = $this->input->post("JumlahPenumpang".$i.'['.$o.']');
									$_SESSION["InputPointDate$i"][$o] = $this->input->post("InputPointDate".$i.'['.$o.']');
								}
							}
							}
						}
						if (null != $this->input->post("JumlahFileShuttle"))
							{
							$JumlahFile = $this->input->post("JumlahFileShuttle");
					for ($i=$_SESSION["JumlahFileShuttle"]+1; $i <= $JumlahFile; $i++)
								{

					$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Shuttle/';

					if (!is_dir($config['upload_path']))
					{
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    	$config['allowed_types']        = '*';
                    	$config['overwrite'] = TRUE;
                    	$this->load->library('upload', $config);
                    	if ( ! $this->upload->do_upload('userfile'.$i))
                    	{
                	$error = array('error' => $this->upload->display_errors());
                	error_log($error["error"]);
                	break;
                		}
                		else
                		{
       				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Shuttle/', FilesystemIterator::SKIP_DOTS);
                		$_SESSION["JumlahFileShuttle"]=iterator_count($DirectoryCount);
                		 $data['upload_data'] = $this->upload->data();
                		}
								}
							}
						$data['ShuttlePoint'] = $this->Model->get_ShuttlePoints();
						$this->load->view('templates/header');
						$this->load->view('pages/Pemesanan_NewShuttle',$data);
						$this->load->view('templates/footer');


					}
					else if(isset($_POST['Airport_Button']))
					{
						if (null!=$this->input->post("NextAirportID"))
						{
							$_SESSION["NextAirportID"]=$this->input->post("NextAirportID");
						}
						if (isset($_SESSION["JumlahPemesananBusArrival"])==False)
						{
							$_SESSION["JumlahPemesananBusArrival"]=0;
						}
						if (isset($_SESSION["JumlahPemesananBusDeparture"])==False)
						{
							$_SESSION["JumlahPemesananBusDeparture"]=0;
						}
						if (null != $this->input->post("InputType"))
						{
							$InputType= $this->input->post("InputType");

							if (strcmp($InputType, "Arrival")==0)
							{
						$_SESSION["JumlahPemesananBusArrival"] = $this->input->post("Jumlah");
								for ($x=1; $x <=$_SESSION["JumlahPemesananBusArrival"]; $x++)
								{
									if (isset($_SESSION["ArrivalDate"][$x])==False)
										{
						$_SESSION["ArrivalDate"][$x] = $this->input->post("ArrivalDate$x");
										}
									if (isset($_SESSION["ArrivalPoint"][$x])==False)
										{
					$_SESSION["ArrivalPoint"][$x] = $this->input->post("ArrivalPoint$x");
										}
									if (isset($_SESSION["ArrivalDestination"][$x])==False)
										{
			$_SESSION["ArrivalDestination"][$x] = $this->input->post("ArrivalDestination$x");
										}
									if (isset($_SESSION["ArrivalTime"][$x])==False)
										{
					$_SESSION["ArrivalTime"][$x] = $this->input->post("ArrivalTime$x");
										}
									if (isset($_SESSION["ArrivalCapacity"][$x])==False)
										{
					$_SESSION["ArrivalCapacity"][$x] = $this->input->post("ArrivalCapacity$x");
										}
									if (isset($_SESSION["ArrivalInformation"][$x])==False)
										{
			$_SESSION["ArrivalInformation"][$x] = $this->input->post("ArrivalInformation$x");
										}
								}
							}
							else
							{
					$_SESSION["JumlahPemesananBusDeparture"] = $this->input->post("Jumlah");
								for ($y=1; $y <= $_SESSION["JumlahPemesananBusDeparture"]; $y++)
								{
									if (isset($_SESSION["DepartureDate"][$y])==False)
										{
				$_SESSION["DepartureDate"][$y] = $this->input->post("DepartureDate$y");
										}
										if (isset($_SESSION["DeparturePoint"][$y])==False)
										{
				$_SESSION["DeparturePoint"][$y] = $this->input->post("DeparturePoint$y");
										}
										if (isset($_SESSION["DepartureDestination"][$y])==False)
										{
				$_SESSION["DepartureDestination"][$y] = $this->input->post("DepartureDestination$y");
										}
										if (isset($_SESSION["DepartureTime"][$y])==False)
										{
				$_SESSION["DepartureTime"][$y] = $this->input->post("DepartureTime$y");
										}
										if (isset($_SESSION["DepartureCapacity"][$y])==False)
										{
				$_SESSION["DepartureCapacity"][$y] = $this->input->post("DepartureCapacity$y");
										}
										if (isset($_SESSION["DepartureInformation"][$y])==False)
										{
				$_SESSION["DepartureInformation"][$y] = $this->input->post("DepartureInformation$y");
										}
								}
							}
						}
						if (null != $this->input->post("JumlahFileAirport"))
							{
							$JumlahFile = $this->input->post("JumlahFileAirport");
					for ($i=$_SESSION["JumlahFileAirport"]+1; $i <= $JumlahFile; $i++)
								{


					$config['upload_path']= './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport/';

					if (!is_dir($config['upload_path']))
					{
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    	$config['allowed_types']        = '*';
                    	$config['overwrite'] = TRUE;
                    	$this->load->library('upload', $config);
                    	if ( ! $this->upload->do_upload('userfile'.$i))
                    	{
                	$error = array('error' => $this->upload->display_errors());
                	error_log($error["error"]);
                	break;
                		}
                		else
                		{
       				$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/Airport/', FilesystemIterator::SKIP_DOTS);
                		$_SESSION["JumlahFileAirport"]=iterator_count($DirectoryCount);
                		 $data['upload_data'] = $this->upload->data();
                		}
								}
							}
						$data['AirportID'] = $this->Model->get_Pemesanan_Airport_ID();
						$this->load->view('templates/header');
						$this->load->view('pages/Pemesanan_NewAirport',$data);
						$this->load->view('templates/footer');
					}
					else if(isset($_POST['Finish_Button']))
					{
						$config['upload_path'] = './uploads/';
						$config['allowed_types'] = '*';
						$config['overwrite'] = TRUE;
						$this->load->library('upload', $config);
						if (isset($_SESSION["InputProgramName"]))
						{
							$UserID = $this->session->userdata['logged_in']['UserID'];
							$dataPemesanan = array(
								'PemesananID' => $_SESSION["NextPemesananID"],
							'TanggalAwalPemesanan' => $_SESSION["InputAwalPemesanan"],
							'TanggalAkhirPemesanan' => $_SESSION["InputAkhirPemesanan"],
								'PICprogram' => $_SESSION["InputPicProgram"],
								'JumlahPeserta' => $_SESSION["InputJumlahPeserta"],
								'AngkatanID' => $_SESSION["InputAngkatanID"],
								'UserID' =>$UserID,
								);
							$this->Model->addPemesanan($dataPemesanan,'pemesanan');
						}
						if (isset($_SESSION["JumlahRuanganKelas"]))
						{
								for ($l=1; $l <= $_SESSION["JumlahRuanganKelas"]; $l++)
								{
									if (isset($_SESSION["Class_Notes"]))
									{
										$dataPemesananKelas = array(
									'PemesananID' => $_SESSION["NextPemesananID"],
							'RoomName' => $_SESSION['RoomID'][$l],
						'Jumlah_Peserta'=>$_SESSION['JumlahPeserta'][$l],
									'Layout' => $_SESSION['Layout'][$l],
									'Note' => $_SESSION['Class_Notes'],
									'Status' => "Pending"
										);
									}
									else
									{
									$dataPemesananKelas = array(
									'PemesananID' => $_SESSION["NextPemesananID"],
							'RoomName' => $_SESSION['RoomID'][$l],
						'Jumlah_Peserta'=>$_SESSION['JumlahPeserta'][$l],
									'Layout' => $_SESSION['Layout'][$l],
									'Status' => "Pending"
										);
									}

								$this->Model->addPemesanan($dataPemesananKelas,'pemesanan_kelas');
								}
						}
						if (isset($_SESSION['JumlahFile']) AND $_SESSION['JumlahFile']>0)
						{

						////FILE
$src = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Class';
$dst = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Class_F';
$dir = opendir($src);
@mkdir($dst);
while(false !== ( $file = readdir($dir)) )
	{
		if (( $file != '.' ) && ( $file != '..' ))
			{
				if ( is_dir($src . '/' . $file) )
				{
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            	}
            	else
            	{
                	copy($src . '/' . $file,$dst . '/' . $file);
            	}
        	}
    }
closedir($dir);
$dir=$src;
if (is_dir($dir))
{
     $objects = scandir($dir);
     foreach ($objects as $object)
     {
       if ($object != "." && $object != "..")
       {
       		if (is_dir($dir."/".$object))
        	{
        	   rmdir($dir."/".$object);
       		}
       		else
       		{
        	   unlink($dir."/".$object);
       		}
       }
     }
     rmdir($dir);
}
						}
	date_default_timezone_set('UTC');
	$date = $_SESSION["InputAwalPemesanan"];
	$end_date = $_SESSION["InputAkhirPemesanan"];
							$JumlahKonsumsi=0;
				while (strtotime($date) <= strtotime($end_date))
							{
								if (isset($_SESSION['Jumlah'.$date]))
								{
									if ($JumlahKonsumsi==0 )
									{
									$JumlahKonsumsi= $_SESSION['Jumlah'.$date];
									}
									else
									{
									$JumlahKonsumsi=$JumlahKonsumsi+$_SESSION['Jumlah'.$date];
									}
								}
								$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
							}
				date_default_timezone_set('UTC');
				$date = $_SESSION["InputAwalPemesanan"];
				$end_date = $_SESSION["InputAkhirPemesanan"];
				while (strtotime($date) <= strtotime($end_date))
							{

								for ($i=1; $i <= $JumlahKonsumsi; $i++)
								{
									if (isset($_SESSION['Consumption_type'.$date][$i]))
									{
								if (isset($_SESSION["Consumption_Notes"]))
									{
										$dataPemesananKonsumsi = array(
		'PemesananID' => $_SESSION["NextPemesananID"],
		'Tanggal' => $date,
		'JenisKonsumsi' => $_SESSION['Consumption_type'.$date][$i],
		'Jumlah' => $_SESSION['Consumption_Amount'.$date][$i],
		'RuanganKonsumsi'=>$_SESSION['ConsumptionRoom'.$date][$i],
		'Note' => $_SESSION["Consumption_Notes"],
		'Status' => "Pending"
										);
									}
									else
										{
										$dataPemesananKonsumsi = array(
		'PemesananID' => $_SESSION["NextPemesananID"],
		'Tanggal' => $date,
		'JenisKonsumsi' => $_SESSION['Consumption_type'.$date][$i],
		'Jumlah' => $_SESSION['Consumption_Amount'.$date][$i],
		'RuanganKonsumsi'=>$_SESSION['ConsumptionRoom'.$date][$i],
		'Status' => "Pending"
											);
										}
										$this->Model->addPemesanan($dataPemesananKonsumsi,'pemesanan_konsumsi');
									}

								}
								$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
							}
if (isset($_SESSION['JumlahFileKonsumsi']) AND $_SESSION['JumlahFileKonsumsi']>0)
						{
////FILE

	$src = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Konsumsi';
	$dst = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Konsumsi_F';
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
closedir($dir);
$dir=$src;
if (is_dir($dir))
{
     $objects = scandir($dir);
     foreach ($objects as $object)
     {
       if ($object != "." && $object != "..")
       {
       		if (is_dir($dir."/".$object))
        	{
        	   rmdir($dir."/".$object);
       		}
       		else
       		{
        	   unlink($dir."/".$object);
       		}
       }
     }
     rmdir($dir);
}
						}


						if (isset($_SESSION['JumlahHotel']))
						{
							for ($h=1; $h <= $_SESSION['JumlahHotel']; $h++)
							{
								if (isset($_SESSION["Hotel_Notes"]))
									{
										$dataPemesananHotel = array(
									'PemesananID'=> $_SESSION["NextPemesananID"],
									'HotelName'=>$_SESSION["Book_Hotel"][$h],
									'TanggalCheckIn'=>$_SESSION["Date_Start"][$h],
									'TanggalCheckOut'=>$_SESSION["Date_End"][$h],
									'Jml_SinglePria'=>$_SESSION["SinglePria"][$h],
									'Jml_TwinPria'=>$_SESSION["TwinsPria"][$h],
									'Jml_singleWanita'=>$_SESSION["SingleWanita"][$h],
									'Jml_twinWanita'=>$_SESSION["TwinsWanita"][$h],
									'Note'=>$_SESSION["Hotel_Notes"],
									'Status' => "Pending"
									);
									}
									else
									{
									$dataPemesananHotel = array(
									'PemesananID'=> $_SESSION["NextPemesananID"],
									'HotelName'=>$_SESSION["Book_Hotel"][$h],
									'TanggalCheckIn'=>$_SESSION["Date_Start"][$h],
									'TanggalCheckOut'=>$_SESSION["Date_End"][$h],
									'Jml_SinglePria'=>$_SESSION["SinglePria"][$h],
									'Jml_TwinPria'=>$_SESSION["TwinsPria"][$h],
									'Jml_singleWanita'=>$_SESSION["SingleWanita"][$h],
									'Jml_twinWanita'=>$_SESSION["TwinsWanita"][$h],

									'Status' => "Pending"
									);
									}
								$this->Model->addPemesanan($dataPemesananHotel,'pemesanan_hotel');
							}
						}
if (isset($_SESSION['JumlahFileHotel']) AND $_SESSION['JumlahFileHotel']>0)
						{
////FILE

	$src = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Hotel';
	$dst = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Hotel_F';
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
closedir($dir);
$dir=$src;
if (is_dir($dir))
{
     $objects = scandir($dir);
     foreach ($objects as $object)
     {
       if ($object != "." && $object != "..")
       {
       		if (is_dir($dir."/".$object))
        	{
        	   rmdir($dir."/".$object);
       		}
       		else
       		{
        	   unlink($dir."/".$object);
       		}
       }
     }
     rmdir($dir);
}
						}

						if (isset($_SESSION["CounterH"]) AND $_SESSION['CounterP'])
						{
							for ($i=0; $i < $_SESSION["CounterP"]; $i++)
							{
								for ($o=0; $o < $_SESSION["CounterH"]; $o++)
								{
									// if ( $_SESSION["JumlahPenumpang".$i][$o]!=0)
									// {
									if (isset($_SESSION['Shuttle_Notes']))
									{
										$dataPemesananShuttle = array(
											'PemesananID'=> $_SESSION["NextPemesananID"],
							'ShuttlePoint'=> $_SESSION["PointName$i"][$o],
							'Dates'=> $_SESSION["InputPointDate$i"][$o],
							'Passanger_Count' => $_SESSION["JumlahPenumpang$i"][$o],
							'Note'=> $_SESSION["Shuttle_Notes"],
							'Status' => "Pending"
											);
									}
									else
									{
										$dataPemesananShuttle = array(
											'PemesananID'=> $_SESSION["NextPemesananID"],
											'ShuttlePoint'=> $_SESSION["PointName".$i][$o],
											'Dates'=> $_SESSION["InputPointDate".$i][$o],
										'Passanger_Count' => $_SESSION["JumlahPenumpang".$i][$o],
										'Status' => "Pending"
											);
									}
									$this->Model->addPemesanan($dataPemesananShuttle,'pemesanan_shuttlebus');
									// }

								}
							}
						}
if (isset($_SESSION['JumlahFileShuttle']) AND $_SESSION['JumlahFileShuttle']>0)
						{
////FILE

	$src = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Shuttle';
	$dst = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Shuttle_F';
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
closedir($dir);
$dir=$src;
if (is_dir($dir))
{
     $objects = scandir($dir);
     foreach ($objects as $object)
     {
       if ($object != "." && $object != "..")
       {
       		if (is_dir($dir."/".$object))
        	{
        	   rmdir($dir."/".$object);
       		}
       		else
       		{
        	   unlink($dir."/".$object);
       		}
       }
     }
     rmdir($dir);
}
						}
if (isset($_SESSION['JumlahFileAirport']) AND $_SESSION['JumlahFileAirport']>0)
					{
////FILE
	$src = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport';
	$dst = './uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/Airport_F';
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
closedir($dir);
$dir=$src;
if (is_dir($dir))
{
     $objects = scandir($dir);
     foreach ($objects as $object)
     {
       if ($object != "." && $object != "..")
       {
       		if (is_dir($dir."/".$object))
        	{
        	   rmdir($dir."/".$object);
       		}
       		else
       		{
        	   unlink($dir."/".$object);
       		}
       }
     }
     rmdir($dir);
}
					}
					if (isset($_SESSION["NextAirportID"]))
					{
						if (isset($_SESSION["Airport_Notes"]))
						{
							$dataPemesananAirport = array(
							'AirportShuttleID' => $_SESSION["NextAirportID"],
							'PemesananID' => $_SESSION["NextPemesananID"],
							'Notes' => $_SESSION["Airport_Notes"],
							'status' => "Pending",
													 );
						}
						else
						{
							$dataPemesananAirport = array(
							'AirportShuttleID' => $_SESSION["NextAirportID"],
							'PemesananID' => $_SESSION["NextPemesananID"],
							'status' => "Pending",
													 );
						}

						$this->Model->addPemesanan($dataPemesananAirport,'pemesanan_airportshuttle');

					}
						if (isset($_SESSION["DepartureDate"]))
						{
							for ($x=1; $x <= $_SESSION["JumlahPemesananBusDeparture"]; $x++)
							{
								$dataPemesananDepartureBus = array(
								'AirportShuttleID' => $_SESSION["NextAirportID"],
								'PemesananID' => $_SESSION["NextPemesananID"],
								'TanggalBerangkat'=> $_SESSION["DepartureDate"][$x],
								'BerangkatDari'=> $_SESSION["DeparturePoint"][$x],
								'Tujuan' => $_SESSION["DepartureDestination"][$x],
								'Jam'=> $_SESSION["DepartureTime"][$x],
								'Kapasitas'=>$_SESSION["DepartureCapacity"][$x],
								'Keterangan'=>$_SESSION["DepartureInformation"][$x],
										);
								$this->Model->addPemesanan($dataPemesananDepartureBus,'airportshuttle_departure');
							}
						}
						if (isset($_SESSION["ArrivalDate"]))
						{
							for ($t=1; $t <= $_SESSION["JumlahPemesananBusArrival"]; $t++)
							{
								$dataPemesananArrivalBus = array(
								'AirportShuttleID' => $_SESSION["NextAirportID"],
								'TanggalBerangkat'=> $_SESSION["ArrivalDate"][$t],
								'PemesananID' => $_SESSION["NextPemesananID"],
								'BerangkatDari'=>$_SESSION["ArrivalPoint"][$t],
								'Tujuan' => $_SESSION["ArrivalDestination"][$t],
								'Jam'=> $_SESSION["ArrivalTime"][$t],
								'Kapasitas'=>$_SESSION["ArrivalCapacity"][$t],
								'Keterangan'=>$_SESSION["ArrivalInformation"][$t],
										);
								$this->Model->addPemesanan($dataPemesananArrivalBus,'airportshuttle_arrival');
							}
						}
					$this->load->view('templates/header');
					$_SESSION["SUCCESS"] = true;
					$this->load->view('pages/home');
					$this->load->view('templates/footer');
					}
				}
				else
					{
						$this->load->view('pages/Login');
					}
	}
}

function recurse_copy($src="",$dst="")
{

	$src = './uploads/'.$_SESSION["InputProgramName"].'/Class';
	$dst = './uploads/'.$_SESSION["InputProgramName"].'/Finished';
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}


	public function remove_file($file="",$filename="")
	{
		$file = $this->input->get("file");
		$filename = $this->input->get("filename");
		if (unlink('./uploads/'.$this->input->get("NP").'/'.$this->input->get("AK").'/'.$file.'/'.$filename))
		{
			if (strcmp($file, "Class")==0)
			{

			$DirectoryCount = new FilesystemIterator('./uploads/'.$this->input->get("NP").'/'.$this->input->get("AK").'/'.$file.'/', FilesystemIterator::SKIP_DOTS);
            $_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
			$data['Rooms'] = $this->Model->get_Roo();
			$this->load->view('templates/header');
			$this->load->view('pages/Pemesanan_NewClass',$data);
			$this->load->view('templates/footer');
			}
			if (strcmp($file, "Class_F")==0)
			{
				ob_start(); // ensures anything dumped out will be caught
				if(strcmp($this->input->get("From"),"ADD")==0)
				{
					$url = base_url().'Koor/add_detail?tipe=Classes';
				}
				else
				{
					if(strcmp($this->input->get("go"),"ALL")==0)
					{
						$url = base_url().'Koor/view_Recaps?tipe=Classes';	
					}
					else
					{
						$url = base_url().'Koor/view_Recaps?tipe=Classes&id_pemesanan='.$this->input->get("id_pemesanan");
					}
					
				}
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
			}
			if (strcmp($file, "Konsumsi")==0)
			{
			$DirectoryCount = new FilesystemIterator('./uploads/'.$this->input->get("NP").'/'.$_SESSION["InputNamaAngkatan"].'/'.$file.'/', FilesystemIterator::SKIP_DOTS);
            $_SESSION["JumlahFileKonsumsi"]=iterator_count($DirectoryCount);
			$data['Rooms'] = $this->Model->get_Roo();
			// echo $DirectoryCount;
			$this->load->view('templates/header');
			$this->load->view('pages/Pemesanan_NewConsumption',$data);
			$this->load->view('templates/footer');
			}
			if (strcmp($file, "Konsumsi_F")==0)
			{
				ob_start(); // ensures anything dumped out will be caught
				if(strcmp($this->input->get("From"),"ADD")==0)
				{
					$url = base_url().'Koor/add_detail?tipe=Consumption';
				}
				else
				{
					if(strcmp($this->input->get("go"),"ALL")==0)
					{
						$url = base_url().'Koor/view_Recaps?tipe=Consumption';	
					}
					else
					{
						$url = base_url().'Koor/view_Recaps?tipe=Consumption&id_pemesanan='.$this->input->get("id_pemesanan");
					}
					
				}
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
			}
			if (strcmp($file, "Hotel")==0)
			{
			$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/'.$file.'/', FilesystemIterator::SKIP_DOTS);
            $_SESSION["JumlahFileHotel"]=iterator_count($DirectoryCount);
            $data['Hotels'] = $this->Model->get_Hotels();
			$data['Transaction_Hotels'] = $this->Model->get_Hotel_transaction();
			$this->load->view('templates/header');
			$this->load->view('pages/Pemesanan_NewHotel',$data);
			$this->load->view('templates/footer');
			}
			if (strcmp($file, "Hotel_F")==0)
			{
				ob_start(); // ensures anything dumped out will be caught
				if(strcmp($this->input->get("From"),"ADD")==0)
				{
					$url = base_url().'Koor/add_detail?tipe=Hotel';
				}
				else
				{
					if(strcmp($this->input->get("go"),"ALL")==0)
					{
						$url = base_url().'Koor/view_Recaps?tipe=Hotels';	
					}
					else
					{
						$url = base_url().'Koor/view_Recaps?tipe=Hotels&id_pemesanan='.$this->input->get("id_pemesanan");	
					}
				}
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
			}
			if (strcmp($file, "Shuttle")==0)
			{
			$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/'.$file.'/', FilesystemIterator::SKIP_DOTS);
           $_SESSION["JumlahFileShuttle"]=iterator_count($DirectoryCount);
            $data['ShuttlePoint'] = $this->Model->get_ShuttlePoints();
			$this->load->view('templates/header');
			$this->load->view('pages/Pemesanan_NewShuttle',$data);
			$this->load->view('templates/footer');
			}
			if (strcmp($file, "Shuttle_F")==0)
			{
				ob_start(); // ensures anything dumped out will be caught
				if(strcmp($this->input->get("From"),"ADD")==0)
				{
					$url = base_url().'Koor/add_detail?tipe=Shuttle';
				}
				else
				{
					if(strcmp($this->input->get("go"),"ALL")==0)
					{
						$url = base_url().'Koor/view_Recaps?tipe=ShuttleBus';	
					}
					else
					{
						$url = base_url().'Koor/view_Recaps?tipe=ShuttleBus&id_pemesanan='.$this->input->get("id_pemesanan");	
					}
					
				}
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
			}
			if (strcmp($file, "Airport")==0)
			{
			$DirectoryCount = new FilesystemIterator('./uploads/'.$_SESSION["InputProgramName"].'/'.$_SESSION["InputNamaAngkatan"].'/'.'/'.$file.'/', FilesystemIterator::SKIP_DOTS);
           $_SESSION["JumlahFileAirport"]=iterator_count($DirectoryCount);
           	$data['AirportID'] = $this->Model->get_Pemesanan_Airport_ID();
			$this->load->view('templates/header');
			$this->load->view('pages/Pemesanan_NewAirport',$data);
			$this->load->view('templates/footer');
			}
			if (strcmp($file, "Airport_F" )==0)
			{
				ob_start(); // ensures anything dumped out will be caught
				if(strcmp($this->input->get("From"),"ADD")==0)
				{
					$url = base_url().'Koor/add_detail?tipe=Airport';
				}
				else
				{
					if(strcmp($this->input->get("go"),"ALL")==0)
					{
						$url = base_url().'Koor/view_Recaps?tipe=AirportShuttle';
					}
					else
					{
						$url = base_url().'Koor/view_Recaps?tipe=AirportShuttle&id_pemesanan='.$this->input->get("id_pemesanan");
					}
				}
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
			}
		}
		else
		{
			?>
			<h1>ERROR</h1>
			<?php
		}

	}

	public function go_adds($tipe="")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{

					$tipe = $this->input->get("tipe");

					if($tipe=="NewForm")
					{
					$_SESSION["Warning"]="Kosong";
					$_SESSION['Edited'] = "False";
					if (isset($_SESSION["CounterP"]))
					{
					for ($i=0; $i < $_SESSION["CounterP"]; $i++)
						{
							unset($_SESSION["PointName$i"]);
							unset($_SESSION["JumlahPenumpang$i"]);
							unset($_SESSION["InputPointDate$i"]);
						}
					}
					date_default_timezone_set('UTC');
					$date = "2017-1-1";
					$end_date = "2020-1-1";
					while (strtotime($date) <= strtotime($end_date))
						{
						unset($_SESSION['Consumption_type'.$date]);
						unset($_SESSION['Consumption_Amount'.$date]);
						unset($_SESSION['ConsumptionRoom'.$date]);
						unset($_SESSION['JumlahPagi'.$date]);
						unset($_SESSION['JumlahLunch'.$date]);
						unset($_SESSION['JumlahSiang'.$date]);
						unset($_SESSION['Jumlah'.$date]);
						$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
						}
						unset( $_SESSION['IsDefault']);
					unset($_SESSION["JumlahFile"]);
					unset($_SESSION["JumlahFileKonsumsi"]);
					unset($_SESSION["JumlahFileHotel"]);
					unset($_SESSION["JumlahFileShuttle"]);
					unset($_SESSION["JumlahFileAirport"]);
					unset($_SESSION["CounterP"]);
					unset($_SESSION["CounterH"]);
					unset($_SESSION["CounterP"]);
					unset($_SESSION["CounterH"]);
					unset($_SESSION["EditPemesananID"]);
					unset($_SESSION["Shuttle_Notes"]);
					unset($_SESSION["NextAirportID"]);
					unset($_SESSION["JumlahRuanganKelas"]);
					unset ($_SESSION["InputProgramName"]);
					unset($_SESSION["InputAngkatanID"]);
					unset ($_SESSION["InputProgramID"]);
					unset ($_SESSION["InputNamaAngkatan"]);
					unset ($_SESSION["InputAwalPemesanan"]);
					unset ($_SESSION["InputAkhirPemesanan"]);
					unset ($_SESSION["InputPicProgram"]);
					unset($_SESSION["InputJumlahPeserta"]);
					unset ($_SESSION["InputProgramMulai"]);
					unset ($_SESSION["InputProgramSelesai"]);
					unset ($_SESSION["Flags"]);
					unset($_SESSION["JumlahPeserta"]);
					unset($_SESSION["RoomID"]);
					unset($_SESSION["Layout"]);
					unset($_SESSION["Class_Notes"]);
					unset($_SESSION["Consumption_Notes"]);
					unset($_SESSION['JumlahHotel']);
					unset($_SESSION['SingleWanita']);
					unset($_SESSION["TwinsWanita"]);
					unset($_SESSION["SinglePria"]);
					unset($_SESSION["TwinsPria"]);
					unset($_SESSION["Book_Hotel"]);
					unset($_SESSION["Date_Start"]);
					unset($_SESSION["Date_End"]);
					unset($_SESSION["Hotel_Notes"]);
					unset($_SESSION['ArrivalDate']);
					unset($_SESSION["ArrivalPoint"]);
					unset($_SESSION["ArrivalDestination"]);
					unset($_SESSION["ArrivalTime"]);
					unset($_SESSION["ArrivalCapacity"]);
					unset($_SESSION["ArrivalInformation"]);
					unset($_SESSION['DepartureDate']);
					unset($_SESSION["DeparturePoint"]);
					unset($_SESSION["DepartureDestination"]);
					unset($_SESSION["DepartureTime"]);
					unset($_SESSION["DepartureCapacity"]);
					unset($_SESSION["DepartureInformation"]);
					unset($_SESSION['JumlahPemesananBusDeparture']);
					unset($_SESSION['JumlahPemesananBusArrival']);
					unset($_SESSION["NextPemesananID"]);

					if(isset($_SESSION["CounterP"]))
					{
						for ($i=1; $i <= $_SESSION["CounterP"]; $i++)
						{
								unset($_SESSION["JumlahPenumpang".$i]);
						}
					}
					unset($_SESSION["CounterH"]);
					unset($_SESSION['CounterP']);
					//Get Data
					$data['Pemesanan'] = $this->Model->get_next_PemesananID();
					$data['Programs'] = $this->Model->get_prg();
					$data['Angkatans'] = $this->Model->ViewP(0);
					$data['angkatans'] = $this->Model->get_One_view(0);
					//Redirects
					$this->load->view('templates/header');
					$this->load->view('pages/NewForm', $data);
					$this->load->view('templates/footer');
					}
					else if($tipe=="NewForm2")
					{
						$_SESSION["Warning"]="Kosong";
					unset($_SESSION["InputAngkatanID"]);
					unset($_SESSION["InputNamaAngkatan"]);
					$ID = $this->input->get("ProgramID");
					$_SESSION["InputProgramID"] = $ID;

					$_SESSION["InputProgramName"] = $this->input->get("ProgramName");
						//Get Data
					$data['Pemesanan'] = $this->Model->get_next_PemesananID();
					$data['Programs'] = $this->Model->get_prg();
					$data['Angkatans'] = $this->Model->ViewP($ID);
					$data['angkatans'] = $this->Model->get_One_view(0);
					//Redirects
					$this->load->view('templates/header');
					$this->load->view('pages/NewForm', $data);
					$this->load->view('templates/footer');
					}
					else if($tipe=="NewForm3")
					{
					$AngkatanID = $this->input->get("AngkatanID");
					$_SESSION["InputAngkatanID"] = $AngkatanID;
					$_SESSION["InputNamaAngkatan"] = $this->input->get("NamaAngkatan");
						//Get Data
					$data['Pemesanan'] = $this->Model->get_next_PemesananID();
					$data['Programs'] = $this->Model->get_prg();
					$data['Angkatans'] = $this->Model->ViewP($AngkatanID);
					$data['angkatans'] = $this->Model->get_One_view($AngkatanID);
					//Redirects
					$this->load->view('templates/header');
					$this->load->view('pages/NewForm', $data);
					$this->load->view('templates/footer');
					}
					else if ($tipe=="ExistingForm")
					{
						$data['Order'] = $this->Model->get_all_Order();
						$this->load->view('templates/header');
						$this->load->view('pages/ExistingForm',$data);
						$this->load->view('templates/footer');
					}
					else
					{
						var_dump($tipe);
					}
				}
				else
					{
						$this->load->view('pages/Login');
					}
	}


	}
		public function view_recaps($ID=0,$tipe="")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
					$data['namadepan'] = ($this->session->userdata['logged_in']['namadepan']);
					$ID = $this->input->get('ID');
					$tipe = $this->input->get('tipe');
					$id_pesan = $this->input->get('id_pemesanan');
					$this->load->model('Rekap_model');

					if($tipe=="All")
					{
$data['Rekap_All'] = $this->Rekap_model->get_All_Recaps();
		$this->load->view('templates/header');
		$this->load->view('pages/View_Recap_All',$data);
		$this->load->view('templates/footer');
					}
					else if(($tipe=="Classes" || $tipe=="Class") && $id_pesan != NULL)
					{
						$data['Rekap_Classes'] = $this->Rekap_model->get_Class_Recaps($id_pesan);
						$data['id_pemesanan']="true";
						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_Class',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="Classes" || $tipe=="Class")
					{
						$data['Rekap_Classes'] = $this->Rekap_model->get_Classes_Recaps();
						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_Class',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="Consumption" && $id_pesan != NULL)
					{
						$data['Rekap_Consumption'] = $this->Rekap_model->get_Cons_Recaps($id_pesan);
						$data['id_pemesanan']="true";

						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_Consumption',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="Consumption")
					{
						$data['Rekap_Consumption'] = $this->Rekap_model->get_Consumption_Recaps();
						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_Consumption',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="Hotels" && $id_pesan != NULL)
					{
						$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotel_Recaps($id_pesan);
						$data['id_pemesanan']="true";

						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_Hotels',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="Hotels")
					{
						$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotels_Recaps();
						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_Hotels',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="ShuttleBus" && $id_pesan != NULL)
					{
						$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_Shuttle_Recaps($id_pesan);
						$data['id_pemesanan']="true";

						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_ShuttleBus',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="ShuttleBus")
					{
						$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_ShuttleBus_Recaps();
						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_ShuttleBus',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="AirportShuttle" && $id_pesan != NULL)
					{
						$data['Rekap_AirportBus'] = $this->Rekap_model->get_Airport_Recaps($id_pesan);
						$data['id_pemesanan']="true";

						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_AirportBus',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="AirportShuttle")
					{
						$data['Rekap_AirportBus'] = $this->Rekap_model->get_AirportBus_Recaps();
						$this->load->view('templates/header');
						$this->load->view('pages/View_Recap_AirportBus',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="ShuttlePoint")
					{
						$this->Model->RemovePoint($ID);
						$data['ShuttlePoints'] = $this->Model->get_ShuttlePoints();
						$this->load->view('templates/header');
						$this->load->view('pages/ManageShuttlePoints',$data);
						$this->load->view('templates/footer');
					}
					else
					{
						echo "something is wrong";
					}
				}
				else
				{
					$this->load->view('pages/Login');
				}
		}
		else
		{
					$ID = $this->input->get('ID');
					$tipe = $this->input->get('tipe');
					$this->load->model('Model');

					if($tipe=="Program")
					{
						$this->Model->RemoveProgram($ID);
						$data['Programs'] = $this->Model->get_prg();
						$this->load->view('templates/header');
						$this->load->view('pages/ManagePrograms',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="User")
					{
						$this->Model->RemoveUser($ID);
						$data['title'] = ucfirst('Deleted');
						$data['Users'] = $this->Model->get_data();
						$this->load->view('templates/header');
						$this->load->view('pages/ManageUsers',$data);
						$this->load->view('templates/footer');
					}
		}
	}

	public function view_detail($ID=0,$tipe="")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
					$ID = $this->input->get('ID');
					$tipe = $this->input->get('tipe');
					$id_pesan = $this->input->get('id_pemesanan');
					$this->load->model('Rekap_model');

					if($tipe=="Classes")
					{
						$data['Rekap_Classes'] = $this->Rekap_model->get_Detail_Class($id_pesan);
						$data['Rooms'] = $this->Rekap_model->get_Room();
						$this->load->view('templates/header');
						$this->load->view('pages/View_Detail_Class',$data);
						$this->load->view('templates/footer');

					} else if($tipe=="Consumption"){
						$data['Rekap_Consumption'] = $this->Rekap_model->get_Detail_Consumption($id_pesan);
						$this->load->view('templates/header');
						$this->load->view('pages/View_Detail_Consumption',$data);
						$this->load->view('templates/footer');

					}else if($tipe=="Hotels"){
						$data['Rekap_Hotels'] = $this->Rekap_model->get_Detail_Hotel($id_pesan);
						$this->load->view('templates/header');
						$this->load->view('pages/View_Detail_Hotels',$data);
						$this->load->view('templates/footer');

					}else if($tipe=="Shuttle")
					{
						// $data['Rekap_ShuttleBus'] = $this->Rekap_model->get_ShuttleBus_Recaps();
						$data['Rekap_Shuttle'] = $this->Rekap_model->get_Detail_Shuttle($id_pesan);
						$this->load->view('templates/header');
						$this->load->view('pages/View_Detail_Shuttle',$data);
						$this->load->view('templates/footer');

					}else if($tipe=="AirportShuttle"){
						$data['Rekap_AirportBus'] = $this->Rekap_model->get_Detail_AirportBus($id_pesan);
						$this->load->view('templates/header');
						$this->load->view('pages/View_Detail_AirportBus',$data);
						$this->load->view('templates/footer');

					}else if($tipe=="ShuttlePoint"){
						$this->Model->RemovePoint($ID);
						$data['ShuttlePoints'] = $this->Model->get_ShuttlePoints();
						$this->load->view('templates/header');
						$this->load->view('pages/ManageShuttlePoints',$data);
						$this->load->view('templates/footer');

					}else{
						echo "something is wrong";
					}
				}
				else
				{
					$this->load->view('pages/Login');
				}
		}
		else
		{
					$ID = $this->input->get('ID');
					$tipe = $this->input->get('tipe');
					$this->load->model('Model');

					if($tipe=="Program")
					{
						$this->Model->RemoveProgram($ID);
						$data['Programs'] = $this->Model->get_prg();
						$this->load->view('templates/header');
						$this->load->view('pages/ManagePrograms',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="User")
					{
						$this->Model->RemoveUser($ID);
						$data['title'] = ucfirst('Deleted');
						$data['Users'] = $this->Model->get_data();
						$this->load->view('templates/header');
						$this->load->view('pages/ManageUsers',$data);
						$this->load->view('templates/footer');
					}
		}
	}

	//download to excel
	public function export_excel(){
		$tipe = $this->input->get('tipe');
		$id_pesan = $this->input->get('id_pemesanan');

		if($tipe=="Consumption"){
			$data = array( 'title' => 'Data Pemesanan Konsumsi per Tanggal '.date("Y-m-d"),
			'info_pemesanan' =>$this->Export_model->get_Info_Pemesanan($id_pesan),
			'data_konsumsi' => $this->Export_model->get_Consumption_per_Pemesanan_ID($id_pesan)
			);

			$this->load->view('export_excel/vw_pemesanan_konsumsi',$data);

		}else if($tipe=="Hotel"){
			$data = array( 'title' => 'Data Pemesanan Hotel per Tanggal '.date("Y-m-d"),
			'info_pemesanan' =>$this->Export_model->get_Info_Pemesanan($id_pesan),
			'data_hotel' => $this->Export_model->get_Hotel_per_Pemesanan_ID($id_pesan)
			);

			$this->load->view('export_excel/vw_pemesanan_hotel',$data);
		}else if($tipe=="Shuttle"){
			$data = array( 'title' => 'Data Pemesanan Shuttle per Tanggal '.date("Y-m-d"),
			'info_pemesanan' =>$this->Export_model->get_Info_Pemesanan($id_pesan),
			'data_shuttle' => $this->Export_model->get_Shuttle_per_Pemesanan_ID($id_pesan)
			);

			$this->load->view('export_excel/vw_pemesanan_shuttle',$data);
		}

		else if($tipe=="Airport_Shuttle"){
			$data = array( 'title' => 'Data Pemesanan Airport Shuttle per Tanggal '.date("Y-m-d"),
			'info_pemesanan' =>$this->Export_model->get_Info_Pemesanan($id_pesan),
			'data_airport_shuttle_arrival' => $this->Export_model->get_AirportShuttle_Arrival_per_Pemesanan_ID($id_pesan),
			'data_airport_shuttle_departure' => $this->Export_model->get_AirportShuttle_Departure_per_Pemesanan_ID($id_pesan)
			);

			$this->load->view('export_excel/vw_pemesanan_airport_shuttle',$data);
		}else if($tipe=="Class"){
			$data = array( 'title' => 'Data Pemesanan Kelas per Tanggal '.date("Y-m-d"),
			'info_pemesanan' =>$this->Export_model->get_Info_Pemesanan($id_pesan),
			'data_class' => $this->Export_model->get_Class_per_Pemesanan_ID($id_pesan)
			);

			$this->load->view('export_excel/vw_pemesanan_class',$data);
		}
	}

	//change status pemesanan
	public function update_status(){
		$tipe = $this->input->get('tipe');
		$id_pesan = $this->input->get('id_pemesanan');
		$status = $this->input->get('status');
		$status_id = $this->input->get('status_id');

		if($status != NULL && $status=="pending") {
			if($tipe=="Class"){
				$this->Rekap_model->update_status_approve($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Classes'] = $this->Rekap_model->get_Class_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Classes'] = $this->Rekap_model->get_Classes_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Class',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="Hotel"){
				$this->Rekap_model->update_status_approve_hotel($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotel_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotels_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Hotels',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="ShuttleBus"){
				$this->Rekap_model->update_status_approve_shuttlebus($id_pesan);

				if($status_id == "true"){
					$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_Shuttle_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_ShuttleBus_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_ShuttleBus',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="AirportShuttle"){
				$this->Rekap_model->update_status_approve_airportshuttle($id_pesan);

				if($status_id == "true"){
					$data['Rekap_AirportBus'] = $this->Rekap_model->get_Airport_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_AirportBus'] = $this->Rekap_model->get_AirportBus_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_AirportBus',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="Consump"){
				$this->Rekap_model->update_status_approve_consump($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Consumption'] = $this->Rekap_model->get_Cons_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Consumption'] = $this->Rekap_model->get_Consumption_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Consumption',$data);
				$this->load->view('templates/footer');
			}

		}else if($status != NULL && $status=="approved"){
			if($tipe=="Class"){
				$this->Rekap_model->update_status_booked($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Classes'] = $this->Rekap_model->get_Class_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Classes'] = $this->Rekap_model->get_Classes_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Class',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="Hotel"){
				$this->Rekap_model->update_status_booked_hotel($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotel_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotels_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Hotels',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="ShuttleBus"){
				$this->Rekap_model->update_status_booked_shuttlebus($id_pesan);

				if($status_id == "true"){
					$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_Shuttle_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_ShuttleBus_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_ShuttleBus',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="AirportShuttle"){
				$this->Rekap_model->update_status_booked_airportshuttle($id_pesan);

				if($status_id == "true"){
					$data['Rekap_AirportBus'] = $this->Rekap_model->get_Airport_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_AirportBus'] = $this->Rekap_model->get_AirportBus_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_AirportBus',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="Consump"){
				$this->Rekap_model->update_status_booked_consump($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Consumption'] = $this->Rekap_model->get_Cons_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Consumption'] = $this->Rekap_model->get_Consumption_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Consumption',$data);
				$this->load->view('templates/footer');
			}
		}else if($status != NULL && $status=="rejected"){
			if($tipe=="Class"){
				$this->Rekap_model->update_status_rejected($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Classes'] = $this->Rekap_model->get_Class_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Classes'] = $this->Rekap_model->get_Classes_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Class',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="Hotel"){
				$this->Rekap_model->update_status_rejected_hotel($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotel_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotels_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Hotels',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="ShuttleBus"){
				$this->Rekap_model->update_status_rejected_shuttlebus($id_pesan);

				if($status_id == "true"){
					$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_Shuttle_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_ShuttleBus_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_ShuttleBus',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="AirportShuttle"){
				$this->Rekap_model->update_status_rejected_airportshuttle($id_pesan);

				if($status_id == "true"){
					$data['Rekap_AirportBus'] = $this->Rekap_model->get_Airport_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_AirportBus'] = $this->Rekap_model->get_AirportBus_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_AirportBus',$data);
				$this->load->view('templates/footer');
			}else if($tipe=="Consump"){
				$this->Rekap_model->update_status_rejected_consump($id_pesan);

				if($status_id == "true"){
					$data['Rekap_Consumption'] = $this->Rekap_model->get_Cons_Recaps($id_pesan);
					$data['id_pemesanan']="true";
				}else{
					$data['Rekap_Consumption'] = $this->Rekap_model->get_Consumption_Recaps();
				}

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_Consumption',$data);
				$this->load->view('templates/footer');
			}
		}else if($status != NULL && $status=="booked"){
			echo "";
		}
	}

	//confirm rejected
	public function reject_confirm(){
		$tipe = $this->input->get('tipe');
		$id_pesan = $this->input->get('id_pemesanan');
		$status = $this->input->get('status');
		$status_id = $this->input->get('status_id');

		$data['tipe'] = $tipe;
		$data['id_pesan'] = $id_pesan;
		$data['status'] = $status;
		$data['status_id'] = $status_id;

		$data['Info_Pemesanan'] = $this->Export_model->get_Info_Pemesanan($id_pesan);

		$this->load->view('templates/header');
		$this->load->view('pages/Reject_Confirmation',$data);
		$this->load->view('templates/footer');

	}
	//status rejected
	public function reject_status(){
		$tipe = $this->input->post('tipe');
		$id_pesan = $this->input->post('id_pesan');
		$UserID = $this->input->post('user_id');
		$status_id = $this->input->post('status_id');
		$UserID_koor = $this->input->post('id_user_koor');

		$tgl_buat = $this->input->post('tgl_buat');
		$checkers_note = $this->input->post('checkers_note');

		if($tipe=="Class"){
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);

			//add to notifikasi table
			$this->Rekap_model->insert_notifikasi($id_pesan,$tipe,$UserID, $UserID_koor);

			if($status_id == "true"){
				$data['Rekap_Classes'] = $this->Rekap_model->get_Class_Recaps($id_pesan);
				$data['id_pemesanan']="true";
			}else{
				$data['Rekap_Classes'] = $this->Rekap_model->get_Classes_Recaps();
			}

			$this->load->view('templates/header');
			$this->load->view('pages/View_Recap_Class',$data);
			$this->load->view('templates/footer');
		}else if($tipe=="Hotel"){
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);

			//add to notifikasi table
			$this->Rekap_model->insert_notifikasi($id_pesan,$tipe,$UserID, $UserID_koor);

			if($status_id == "true"){
				$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotel_Recaps($id_pesan);
				$data['id_pemesanan']="true";
			}else{
				$data['Rekap_Hotels'] = $this->Rekap_model->get_Hotels_Recaps();
			}

			$this->load->view('templates/header');
			$this->load->view('pages/View_Recap_Hotels',$data);
			$this->load->view('templates/footer');
		}else if($tipe=="ShuttleBus"){
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);

			//add to notifikasi table
			$this->Rekap_model->insert_notifikasi($id_pesan,$tipe,$UserID, $UserID_koor);

			if($status_id == "true"){
				$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_Shuttle_Recaps($id_pesan);
				$data['id_pemesanan']="true";
			}else{
				$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_ShuttleBus_Recaps();
			}

			$this->load->view('templates/header');
			$this->load->view('pages/View_Recap_ShuttleBus',$data);
			$this->load->view('templates/footer');
		}else if($tipe=="AirportShuttle"){
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);

			//add to notifikasi table
			$this->Rekap_model->insert_notifikasi($id_pesan,$tipe,$UserID, $UserID_koor);

			if($status_id == "true"){
				$data['Rekap_AirportBus'] = $this->Rekap_model->get_Airport_Recaps($id_pesan);
				$data['id_pemesanan']="true";
			}else{
				$data['Rekap_AirportBus'] = $this->Rekap_model->get_AirportBus_Recaps();
			}

			$this->load->view('templates/header');
			$this->load->view('pages/View_Recap_AirportBus',$data);
			$this->load->view('templates/footer');
		}else if($tipe=="Consump"){
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);

			//add to notifikasi table
			$this->Rekap_model->insert_notifikasi($id_pesan,$tipe,$UserID, $UserID_koor);

			if($status_id == "true"){
				$data['Rekap_Consumption'] = $this->Rekap_model->get_Cons_Recaps($id_pesan);
				$data['id_pemesanan']="true";
			}else{
				$data['Rekap_Consumption'] = $this->Rekap_model->get_Consumption_Recaps();
			}

			$this->load->view('templates/header');
			$this->load->view('pages/View_Recap_Consumption',$data);
			$this->load->view('templates/footer');
		}
	}

	//notifikasi
	public function notification(){

		$UserID = $this->input->get("UserID");

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
					$data['notifikasi'] = $this->Rekap_model->get_notifikasi_per_user($UserID);

					$this->load->view('templates/header');
					$this->load->view('pages/View_Notification',$data);
					$this->load->view('templates/footer');
				}
				else
				{
					$this->load->view('pages/Login');
				}
		}
	}
	public function update_pemesanan_content()
	{
		$jumlah = $this ->input->post("Jumlah");
		$content = $this->input->get("Content");
		if (strcmp($content,"All")==0)
		{

			for ($i=1; $i <= $jumlah ; $i++)
			{
				$p = $i-1;
				$ID = $this->input->post("PemesananID[$p]");
				$NamaProgram = $this->input->post("NP[$p]");
				$AP = $this->input->post("AP[$p]");
				$tanggalAwalPemesanan = $this->input->post("tanggalAwalPemesanan[$p]");
				$tanggalAkhirPemesanan = $this->input->post("tanggalAkhirPemesanan[$p]");
				$JumlahPeserta = $this->input->post("JumlahPeserta[$p]");
				$PIC = $this->input->post("PIC[$p]");
				$data = array
				(
					'PemesananID' => $ID,
					'TanggalAwalPemesanan' => $tanggalAwalPemesanan,
					'TanggalAkhirPemesanan' => $tanggalAkhirPemesanan,
					'PICprogram' => $PIC,
					'JumlahPeserta' => $JumlahPeserta
				);
				if(isset($tanggalAwalPemesanan))
				{
					if (is_dir($_SERVER['DOCUMENT_ROOT']."/UPPS/assets/JSON/".$NamaProgram."/".$AP))
					{
						$String1= $_SERVER['DOCUMENT_ROOT']."/UPPS/assets/JSON/".$NamaProgram."/".$AP;
						$String2 = $_SERVER['DOCUMENT_ROOT']."/UPPS/assets/JSON/".$NamaProgram."/".$tanggalAwalPemesanan;
						echo (rename($String1,$String2));
					}
				}
				$this->Rekap_model->set_jsonPemesanan($NamaProgram,$tanggalAwalPemesanan);
				$this->Rekap_model->update_Pemesanan_all($ID,$data);
			}

			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=All';
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
		}
		elseif (strcmp($content,"Class")==0)
		{
			$this->Rekap_model->set_jsonKelas($this->input->post("NP"),$this->input->post("AP"));
			for ($i=1; $i <= $jumlah ; $i++)
			{
				$p = $i-1;
				$classID = $this->input->post("ClassID[$p]");
				$RuangKelas = $this->input->post("ruanganKelas[$p]");
				$JumlahPeserta = $this->input->post("jumlahPeserta[$p]");
				$ClassNote  = $this->input->post("Note");
				$LayoutKelas = $this->input->post("layoutKelas[$p]");
				$pemesananID = $this->input->post("id_pemesanan");
				$data = array
				(
					'ClassID' => $classID,
					'PemesananID' => $pemesananID,
					'RoomName' => $RuangKelas,
					'Jumlah_Peserta' => $JumlahPeserta,
					'Note' => $ClassNote,
					'Layout' => $LayoutKelas,
					'CheckerNotes'=>"",
					'CheckerID'=>0,
					'TanggalBuat'=>"",
					'status' => "Pending"
				);

				$this->Rekap_model->update_Pemesanan_class($classID,$data);
				$data = array
				(
					'StatusAkhirPemesanan' => "Pending"
				);
				$this->Rekap_model->update_notifikasi($pemesananID,$data);

			}

			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Detail?tipe=Classes&id_pemesanan='.$pemesananID;
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
		}
		elseif (strcmp($content,"Consumption")==0)
		{
			$this->Rekap_model->set_jsonKonsumsi($this->input->post("NP"),$this->input->post("AP"));
			for ($i=1; $i <= $jumlah ; $i++)
			{
				$p = $i-1;
				$consumptionID = $this->input->post("consumptionID[$p]");
				$ruangKonsum = $this->input->post("RuanganKonsumsi[$p]");
				$jumlahKonsum = $this->input->post("JumlahKonsumsi[$p]");
				$noteKonsum  = $this->input->post("Note");
				$jenisKonsum = $this->input->post("Consumption_type[$p]");
				$tanggalKonsum = $this->input->post("TanggalKonsumsi[$p]");
			$pemesananID = $this->input->post("id_pemesanan");
				$data = array
				(
					'KonsumsiID' => $consumptionID,
					'PemesananID' => $pemesananID,
					'Tanggal' => $tanggalKonsum,
					'JenisKonsumsi' => $jenisKonsum,
					'Jumlah' => $jumlahKonsum,
					'RuanganKonsumsi' => $ruangKonsum,
					'Note' => $noteKonsum,
					'CheckerNotes'=>"",
					'CheckerID'=>0,
					'TanggalBuat'=>"",
					'status' => "Pending"
				);
				$this->Rekap_model->update_Pemesanan_consumption($consumptionID,$data);
				$data = array
				(
					'StatusAkhirPemesanan' => "Pending"
				);
				$this->Rekap_model->update_notifikasi($pemesananID,$data);
			}

			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Detail?tipe=Consumption&id_pemesanan='.$pemesananID;
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
		}
		elseif (strcmp($content,"Hotel")==0)
		{
			$this->Rekap_model->set_jsonHotel($this->input->post("NP"),$this->input->post("AP"));
			for ($i=1; $i <= $jumlah ; $i++)
			{
				$p = $i-1;
				$PemesananHotelID = $this->input->post("hotelID[$p]");
				$HotelName = $this->input->post("NamaHotel[$p]");
				$TanggalCheckIn = $this->input->post("TanggalCheckIn[$p]");
				$noteHotel = $this->input->post("Note");
				$TanggalCheckOut  = $this->input->post("TanggalCheckOut[$p]");
				$Jml_SinglePria = $this->input->post("SingleP[$p]");
				$Jml_TwinPria = $this->input->post("DoubleP[$p]");
				$Jml_singleWanita = $this->input->post("SingleP[$p]");
				$Jml_twinWanita = $this->input->post("DoubleP[$p]");
			$pemesananID = $this->input->post("id_pemesanan");

				$data = array
				(
					'PemesananHotelID' => $PemesananHotelID,
					'PemesananID' => $pemesananID,
					'HotelName' => $HotelName,
					'TanggalCheckIn' => $TanggalCheckIn,
					'TanggalCheckOut' => $TanggalCheckOut,
					'Jml_SinglePria' => $Jml_SinglePria,
					'Jml_TwinPria' => $Jml_TwinPria,
					'Jml_singleWanita' =>$Jml_singleWanita,
					'Jml_twinWanita' => $Jml_twinWanita,
					'CheckerNotes'=>"",
					'CheckerID'=>0,
					'TanggalBuat'=>"",
					'status' => "Pending",
					'Note' => $this->input->post("Note")
				);
				$this->Rekap_model->update_Pemesanan_hotel($PemesananHotelID,$data);
				$data = array
				(
					'StatusAkhirPemesanan' => "Pending"
				);
				$this->Rekap_model->update_notifikasi($pemesananID,$data);
			}

			ob_start(); // ensures anything dumped out will be caught

			$url = base_url().'Koor/view_Detail?tipe=Hotels&id_pemesanan='.$pemesananID;
			// this can be set based on whatever
			while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
		}	elseif (strcmp($content,"Airport")==0)
			{
				$this->Rekap_model->set_jsonAirport($this->input->post("NP"),$this->input->post("AP"));
				for ($i=1; $i <= $jumlah ; $i++)
				{
					$p = $i-1;
					$JumlahAsli = $this->input->post("JumlahAsli");
					$TID=$this->input->post("TID[$p]");
					$AirportShuttleID = $this->input->post("airportID");
					$Notes = $this->input->post("Note");
					$pemesananID = $this->input->post("id_pemesanan");
					$TanggalBerangkat = $this->input->post("TanggalBerangkat[$p]");
					$Keberangkatan = $this->input->post("Keberangkatan[$p]");
					$Tujuan = $this->input->post("Tujuan[$p]");
					$Jam = $this->input->post("Jam[$p]");
					$Kapasitas = $this->input->post("Kapasitas[$p]");
					$Keterangan = $this->input->post("Keterangan[$p]");
					$table =$this->input->post("airportType[$p]");
					if ($this->input->post("airportType[$p]")==null)
					{
						$table=$this->input->post("airportTypeB[$p]");
					}
					$data = array
					(
						'AirportShuttleID' => $AirportShuttleID,
						'PemesananID' => $pemesananID,
						'Notes' => $Notes,
						'CheckerNotes'=>"",
						'CheckerID'=>0,
						'TanggalBuat'=>"",
						'status' => "Pending",
					);
					$this->Rekap_model->update_Pemesanan_Airport($AirportShuttleID,$data);
					$data = array
					(
						'AirportShuttleID' => $AirportShuttleID,
						'PemesananID' => $pemesananID,
						'TanggalBerangkat' => $TanggalBerangkat,
						'BerangkatDari' => $Keberangkatan,
						'Tujuan' => $Tujuan,
						'Jam' => $Jam,
						'Kapasitas' => $Kapasitas,
						'Keterangan' => $Keterangan
					);
					if (strcmp($table,"Arrival")==0 AND $i>$JumlahAsli)
					{
						$this->Rekap_model->add_Pemesanan_Airport_AD($AirportShuttleID,$data,"Arrival");
					}
					elseif (strcmp($table,"Arrival")==0)
					{
						$this->Rekap_model->update_Pemesanan_Airport_AD($AirportShuttleID,$data,"Arrival",$TID);
					}
					elseif (strcmp($table,"Departure")==0 AND $i>$JumlahAsli)
					{
						$this->Rekap_model->add_Pemesanan_Airport_AD($AirportShuttleID,$data,"Departure");
					}
					elseif (strcmp($table,"Departure")==0)
					{
						$this->Rekap_model->update_Pemesanan_Airport_AD($AirportShuttleID,$data,"Departure",$TID);
					}

					$data = array
					(
						'StatusAkhirPemesanan' => "Pending"
					);
					$this->Rekap_model->update_notifikasi($pemesananID,$data);
				}

				ob_start(); // ensures anything dumped out will be caught

				$url = base_url().'Koor/view_Detail?tipe=AirportShuttle&id_pemesanan='.$pemesananID;
				// this can be set based on whatever
				while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
			}
			elseif (strcmp($content,"Shuttle")==0)
			{
				$this->Rekap_model->set_jsonShuttle($this->input->post("NP"),$this->input->post("AP"));
				for ($i=1; $i <= $jumlah ; $i++)
				{
					$p = $i-1;
					$ShuttleID = $this->input->post("shuttleID[$p]");
					$pemesananID = $this->input->post("id_pemesanan");
					$Point = $this->input->post("ShuttlePoint[$p]");
					$Passanger = $this->input->post("Passanger[$p]");
					$ShuttleNote  = $this->input->post("Note");
					$Dates = $this->input->post("ShuttleDate[$p]");
					$data = array
					(
						'ShuttleID' => $ShuttleID,
						'ShuttlePoint' => $Point,
						'PemesananID' => $pemesananID,
						'Dates' => $Dates,
						'Passanger_Count' => $Passanger,
						'Note' => $ShuttleNote,
						'CheckerNotes'=>"",
						'CheckerID'=>0,
						'TanggalBuat'=>"",
						'status' => "Pending"
					);

					$this->Rekap_model->update_Pemesanan_shuttle($ShuttleID,$data);
					$data = array
					(
						'StatusAkhirPemesanan' => "Pending"
					);
					$this->Rekap_model->update_notifikasi($pemesananID,$data);

				}

				ob_start(); // ensures anything dumped out will be caught
				$url = base_url().'Koor/view_Detail?tipe=Shuttle&id_pemesanan='.$pemesananID;
				// this can be set based on whatever
				while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
			}

	}

	public function update_files()
	{
		if (null != $this->input->post("JumlahFile"))
			{
				$ProgramName =$this->input->post("Name");
				$NamaAngkatan = $this->input->post("Angkatan");
				$JumlahFile = $this->input->post("JumlahFile");
				for ($i=1; $i <= $JumlahFile; $i++)
					{

						$config['upload_path']= './uploads/'.$ProgramName.'/'.$NamaAngkatan.'/'.'/Class_F/';

					if (!is_dir($config['upload_path']))
					{
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    	$config['allowed_types']        = '*';
                    	$config['overwrite'] = TRUE;
                    	$this->load->library('upload', $config);
                    	if ( ! $this->upload->do_upload('userfile'.$i))
                    	{
                	$error = array('error' => $this->upload->display_errors());
                	error_log($error["error"]);
                	break;
                		}
                		else
                		{
                		 $data['upload_data'] = $this->upload->data();
                		}
								}
							}
	}
	public function additional_files($NP="",$AK="",$FLD="")
	{
		$ID = $this->input->get("ID");
		$NP=$this->input->get("Program");
		$AK=$this->input->get("angkatan");
		$FLD=$this->input->get("folder");
		if (null != $this->input->post("JumlahFile"))
		{
			$JumlahFile = $this->input->post("JumlahFile");
			for ($i=$_SESSION["JumlahFile"]+1; $i <= $JumlahFile; $i++)
			{
				$config['upload_path']= './uploads/'.$NP.'/'.$AK.'/'.'/'.$FLD.'/';
				if (!is_dir($config['upload_path']))
				{
					mkdir($config['upload_path'], 0777, TRUE);
				}
				$config['allowed_types']        = '*';
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('userfile'.$i))
				{
					$error = array('error' => $this->upload->display_errors());
					error_log($error["error"]);
					break;
				}
				else
				{
					$DirectoryCount = new FilesystemIterator('./uploads/'.$NP.'/'.$AK.'/'.$FLD.'/', FilesystemIterator::SKIP_DOTS);
					$_SESSION["JumlahFile"]=iterator_count($DirectoryCount);
					$data['upload_data'] = $this->upload->data();
				}
			}
		}
		if (strcmp($FLD,"Class_F")==0)
		{
			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=Classes&id_pemesanan='.$ID;
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
		}
		if (strcmp($FLD,"Konsumsi_F")==0)
		{
			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=Consumption&id_pemesanan='.$ID;
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
		}
		if (strcmp($FLD,"Hotel_F")==0)
		{
			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=Hotels&id_pemesanan='.$ID;
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
		}
		if (strcmp($FLD,"Shuttle_F")==0)
		{
			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=ShuttleBus&id_pemesanan='.$ID;
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
		}
		if (strcmp($FLD,"Airport_F")==0)
		{
			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=AirportShuttle&id_pemesanan='.$ID;
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
		}
		if (strcmp($FLD,"")==0)
		{
			ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'Koor/view_Recaps?tipe=All';
			// this can be set based on whatever
			while (ob_get_status())
				{
					ob_end_clean();
				}
				// no redirect
				header( "Location: $url" );
		}
	}


}
