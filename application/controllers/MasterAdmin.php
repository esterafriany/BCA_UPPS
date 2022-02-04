<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MasterAdmin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Export_model');
		$this->load->model('Rekap_model');

	}
	//25-Jul-17
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

	public function go_views($ID=0,$tipe="")//angkatan
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
					$ID=$this->input->get("ID");
					$tipe=$this->input->get("tipe");
					$this->load->model('Model');
					if($tipe=="Program")
					{
						$data['Views'] = $this->Model->viewP($ID);
						if($data['Views']==NULL)
						{
							$data['message_display'] = 'Add Something first';
							$data['ID'] = $ID;
							$this->load->view('templates/header');
							$this->load->view('pages/addAngkatan',$data);
							$this->load->view('templates/footer');
						}
						else
						{
							$this->load->view('templates/header');
							$this->load->view('pages/ViewsProgram',$data);
							$this->load->view('templates/footer');
						}
					}
					else
					{
						var_dump($tipe);
						echo "something goes wrong..";
					}

				}
				else
					{
						$this->load->view('templates/header');
						$this->load->view('pages/home',$data);
						$this->load->view('templates/footer');
					}
		}
		else
		{
					$ID=$this->input->get("ID");
					$tipe=$this->input->get("tipe");
					$this->load->model('Model');
					if($tipe=="Program")
					{
						$data['Views'] = $this->Model->viewP($ID);
						$this->load->view('templates/header');
						$this->load->view('pages/ViewsProgram',$data);
						$this->load->view('templates/footer');
					}
					else
					{
						var_dump($tipe);
						echo "something goes wrong..";
					}
		}
	}

	public function go_manages($tipe = "")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE){
			if(isset($this->session->userdata['logged_in'])) {
				$tipe=$this->input->get("tipe");
				$this->load->model('Model');
				if($tipe=="Program")
				{
					$data['Programs'] = $this->Model->get_prg();
					$this->load->view('templates/header');
					$this->load->view('pages/ManagePrograms',$data);
					$this->load->view('templates/footer');
				} else if ($tipe=="User") {
					$data['Users'] = $this->Model->get_data();
					$data['title'] = ucfirst("Manage");
					$this->load->view('templates/header');
					$this->load->view('pages/ManageUsers',$data);
					$this->load->view('templates/footer');
				} else if ($tipe=="Room") {
					$data['Rooms'] = $this->Model->get_Roo();
					$this->load->view('templates/header');
					$this->load->view('pages/ManageRooms',$data);
					$this->load->view('templates/footer');
				} else if ($tipe=="Hotels") {
					$data['Hotels'] = $this->Model->get_Hotels();
					$this->load->view('templates/header');
					$this->load->view('pages/ManageHotels',$data);
					$this->load->view('templates/footer');
				} else if ($tipe=="ShuttlePoint") {
					$data['ShuttlePoints'] = $this->Model->get_ShuttlePoints();
					$this->load->view('templates/header');
					$this->load->view('pages/ManageShuttlePoints',$data);
					$this->load->view('templates/footer');
				} else {
					var_dump($tipe);
				}
			} else {
$this->load->view('pages/Login');
			}
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

					if($tipe=="Program")
					{
					$this->load->view('templates/header');
					$this->load->view('pages/AddPrg');
					$this->load->view('templates/footer');
					}
					else if($tipe=="User")
					{
					$this->load->model('Model');
					$data['Users'] = $this->Model->row();
					$this->load->view('templates/header');
					$this->load->view('pages/AddUser',$data);
					$this->load->view('templates/footer');
					}
					else if($tipe=="Room")
					{
					$this->load->view('templates/header');
					$this->load->view('pages/AddRoo');
					$this->load->view('templates/footer');
					}
					else if($tipe=="Angkatan")
					{
						$ID=$this->input->get("ID");
						$tipe=$this->input->get("tipe");
						$this->load->model('Model');
						$data['Views'] = $this->Model->viewP($ID);
						$this->load->view('templates/header');
						$this->load->view('pages/addAngkatan',$data);
						$this->load->view('templates/footer');
					}
					else if($tipe=="Hotels")
					{
					$this->load->view('templates/header');
					$this->load->view('pages/AddHotel');
					$this->load->view('templates/footer');
					}
					else if($tipe=="ShuttlePoint")
					{
					$this->load->view('templates/header');
					$this->load->view('pages/AddShuttlePoint');
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
		else
		{
			if($tipe=="Program")
			{
				$this->load->view('templates/header');
				$this->load->view('pages/AddPrg');
				$this->load->view('templates/footer');
			}
			else if($tipe=="User")
			{
				$this->load->model('Model');
				$data['Users'] = $this->Model->row();
				$this->load->view('templates/header');
				$this->load->view('pages/AddUser',$data);
				$this->load->view('templates/footer');
			}
			else if($tipe=="Room")
			{
				$this->load->view('templates/header');
				$this->load->view('pages/AddRoo');
				$this->load->view('templates/footer');
			}
		}
	}

	public function do_adds($tipe="")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
					$tipe = $this->input->get('tipe');
					$this->load->model('Model');

					if($tipe=="Program")
					{
						$ProgramName = $this->input->post('NewPrg');
						if($ProgramName == NULL)
						{
							$data['message_display'] = 'Data harus diisi !';
							$this->load->model('Model');
							$data['Users'] = $this->Model->row();
							$this->load->view('templates/header');
							$this->load->view('pages/AddPrg',$data);
							$this->load->view('templates/footer');
						}
						else
						{
							$data = array(
								'ProgramName' => $ProgramName
								);
							$this->Model->addProgram($data,'program');
							$data['Programs'] = $this->Model->get_prg();
							$this->load->view('templates/header');
							$this->load->view('pages/ManagePrograms',$data);
							$this->load->view('templates/footer');
						}
					}
					else if($tipe=="User")
					{
						$NamaDepan = $this->input->post('NewNamaDepan');
						$NamaBelakang = $this->input->post('NewNamaBelakang');
						$Gender = $this->input->post('Gender');
						$Email = $this->input->post('NewEmail');
						$Username = $this->input->post('NewUsername');
						$Password = $this->input->post('NewPassword');
						$Role = $this->input->post('Role');
						$data['Users'] = $this->Model->get_data();

			if($NamaDepan == NULL OR $NamaBelakang == NULL OR $Gender == NULL OR $Email == NULL OR $Username == NULL OR $Password == NULL OR $Role == NULL )
			{
				$data['message_display'] = 'Data harus diisi !';
				$this->load->model('Model');
				$data['Users'] = $this->Model->row();
				$this->load->view('templates/header');
				$this->load->view('pages/AddUser',$data);
				$this->load->view('templates/footer');
			}
			else if($Role<=0)
			{
				$data['message_display'] = 'Select User\'s role  ';
				$this->load->model('Model');
				$data['Users'] = $this->Model->row();
				$this->load->view('templates/header');
				$this->load->view('pages/AddUser',$data);
				$this->load->view('templates/footer');
			}
			else
			{
				$UsersV = $this->Model->get_data();
				if(in_array_r($Username, $UsersV))
				{
					$data['message_display'] = 'Username already taken  ';
					$this->load->model('Model');
					$data['Users'] = $this->Model->row();
					$this->load->view('templates/header');
					$this->load->view('pages/AddUser',$data);
					$this->load->view('templates/footer');
				}
				else
				{
				$data = array(
					'NamaDepan' => $NamaDepan,
					'NamaBelakang' => $NamaBelakang,
					'Gender' => $Gender,
					'Email' => $Email,
					'Username' => $Username,
					'Password' => $Password,
					'RoleID' => $Role
							);
				$this->Model->addUser($data,'user');
				ob_start(); // ensures anything dumped out will be caught
				$url = base_url().'/MasterAdmin/go_manages?tipe=User';
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
					else if($tipe=="Room")
					{
						$RoomName = $this->input->post('NewRoom');
						if($RoomName == NULL)
						{
							$data['message_display'] = 'Data harus diisi !';
							$this->load->model('Model');
							$data['Users'] = $this->Model->row();
							$this->load->view('templates/header');
							$this->load->view('pages/AddRoo',$data);
							$this->load->view('templates/footer');
						}
						else
						{
							$data = array(
								'RoomName' => $RoomName
								);
							$this->Model->addRoom($data,'program');
							$data['Rooms'] = $this->Model->get_Roo();
							$this->load->view('templates/header');
							$this->load->view('pages/ManageRooms',$data);
							$this->load->view('templates/footer');
						}
					}
					else if($tipe=="Angkatan")
					{
						$NamaAngkatan = $this->input->post('newName');
						$ProgramID = $this->input->post('ProgramID');
						$ProgramMulai = $this->input->post('tanggalMulai');
						$ProgramSelesai = $this->input->post('tanggalSelesai');
						if( $NamaAngkatan==NULL OR $ProgramID==NULL OR $ProgramMulai ==NULL OR $ProgramSelesai==NULL)
						{
							$data['Views'] = $this->Model->viewP($ProgramID);
							$data['message_display'] = 'Data harus diisi !';
							$this->load->model('Model');
							$data['Users'] = $this->Model->row();
							$this->load->view('templates/header');
							$this->load->view('pages/AddAngkatan',$data);
							$this->load->view('templates/footer');
						}
						else
						{
							$data = array(
								'NamaAngkatan' => $NamaAngkatan,
								'ProgramID'=>$ProgramID,
								'ProgramMulai'=>$ProgramMulai,
								'ProgramSelesai'=>$ProgramSelesai
								);

							$this->Model->addView($data,'angkatan');
							$ID = $this->input->post('ProgramID');
							$data['Views'] = $this->Model->viewP($ID);

							$this->load->view('templates/header');
							$this->load->view('pages/ViewsProgram',$data);
							$this->load->view('templates/footer');

						}
					}
					else if($tipe=="Hotels")
					{
						$HotelName = $this->input->post('NewHotel');
						if($HotelName == NULL)
						{
							$data['message_display'] = 'Data harus diisi !';
							$this->load->model('Model');
							$data['Users'] = $this->Model->row();
							$this->load->view('templates/header');
							$this->load->view('pages/AddHotel',$data);
							$this->load->view('templates/footer');
						}
						else
						{
							$data = array(
								'HotelName' => $HotelName
								);
							$this->Model->addHotel($data,'Hotel');
							$data['Hotels'] = $this->Model->get_hotels();
							$this->load->view('templates/header');
							$this->load->view('pages/ManageHotels',$data);
							$this->load->view('templates/footer');
						}
					}
					else if($tipe=="ShuttlePoint")
					{
						$PointName = $this->input->post('NewShuttlePoint');
						if($PointName == NULL)
						{
							$data['message_display'] = 'Data harus diisi !';
							$this->load->model('Model');
							$data['Users'] = $this->Model->row();
							$this->load->view('templates/header');
							$this->load->view('pages/AddShuttlePoint',$data);
							$this->load->view('templates/footer');
						}
						else
						{
							$data = array(
								'PointName' => $PointName
								);
							$this->Model->addPoint($data,'ShuttlePoints');
							$data['ShuttlePoints'] = $this->Model->get_hotels();
							$data['ShuttlePoints'] = $this->Model->get_ShuttlePoints();
							$data['message_display'] = 'Data Telah Di Tambahkan, Hubungi Developer Untuk Melakukan Maintenance Agar Dapat Melakukan Configurasi Pada Pemesanan dan Rekap';
							$this->load->view('templates/header');
							$this->load->view('pages/ManageShuttlePoints',$data);
							$this->load->view('templates/footer');
						}
					}
					else
					{
						var_dump($tipe);
						echo "Something went wrong";
					}
				}
				else
					{
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
							$this->load->model('Model');
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
						$data = array (
									'Password' => $Password
								);
						$this->load->model('Model');
						$this->Model->UpdateUser($data,$ID);
						$data['title'] = ucfirst('Updated');

						$data['Users'] = $this->Model->get_data();
						$this->load->view('templates/header');
						$this->load->view('pages/home',$data);
						$this->load->view('templates/footer');
					}else{
						$this->load->view('templates/header');
						$this->load->view('pages/home',$data);
						$this->load->view('templates/footer');
					}
				}
				else
				{
				$Password = $this->input->post('NewPassword');
				$data = array
				(
					'Password' => $Password
				);
				$this->load->model('Model');
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
				$this->load->view('pages/Login');
		}
	}
	public function go_Edits($ID=0,$tipe="")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in']))
			{
				$ID = $this->input->get('ID');
				$tipe = $this->input->get('tipe');
				$this->load->model('Model');
				if($tipe=="Program")
				{
					$data['Programs'] = $this->Model->get_one_prg($ID);
					$this->load->view('templates/header');
					$this->load->view('pages/EditPrg',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="User")
				{
					$data['Users'] = $this->Model->get_one_data($ID);
					$data['Roles'] = $this->Model->row();
					$this->load->view('templates/header');
					$this->load->view('pages/EditUser',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="Room")
				{
					$data['Rooms'] = $this->Model->get_one_room($ID);
					$this->load->view('templates/header');
					$this->load->view('pages/EditRoom',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="Angkatan")
				{
					$data['Views'] = $this->Model->get_one_view($ID);
					$this->load->view('templates/header');
					$this->load->view('pages/EditAngkatan',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="Hotels")
				{
					$data['Hotels'] = $this->Model->get_one_hotel($ID);
					$this->load->view('templates/header');
					$this->load->view('pages/EditHotel',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="ShuttlePoint")
				{
					$data['ShuttlePoints'] = $this->Model->get_One_ShuttlePoint($ID);
					$this->load->view('templates/header');
					$this->load->view('pages/EditPoint',$data);
					$this->load->view('templates/footer');
				}
			} else 
			{
				$this->load->view('pages/Login');
			}
		} else {
			if(tipe=="User") {
				$data['Users'] = $this->Model->get_one_data($ID);
				$data['Roles'] = $this->Model->row();
				$this->load->view('templates/header');
				$this->load->view('pages/EditUser',$data);
				$this->load->view('templates/footer');
			}
			else if($tipe=="Angkatan")
			{
				$data['Views'] = $this->Model->get_one_view($ID);
				$this->load->view('templates/header');
				$this->load->view('pages/EditAngkatan',$data);
				$this->load->view('templates/footer');
			}
		}
	}
	public function do_edits($ID=0,$tipe="")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			if(isset($this->session->userdata['logged_in']))
				{
					$ID = $this->input->post('selectedID');
					$tipe = $this->input->post('tipe');
					$this->load->model('Model');
					if($tipe=="Program")
					{
						$ProgramName = $this->input->post('NewPrg');
						if($ProgramName==NULL)
						{
							$data['message_display'] = 'Data harus diisi !';
							$data['Programs'] = $this->Model->get_one_prg($ID);
							$this->load->view('templates/header');
							$this->load->view('pages/EditPrg',$data);
							$this->load->view('templates/footer');
						}
						else
						{
							$data = array('ProgramName' => $ProgramName);
							$this->Model->UpdateProgram($data,$ID);
							$data['Programs'] = $this->Model->get_prg();
							$this->load->view('templates/header');
							$this->load->view('pages/ManagePrograms',$data);
							$this->load->view('templates/footer');
						}
					}
					else if ($tipe=="User")
					{
						$NamaDepan = $this->input->post('NewNamaDepan');
						$NamaBelakang = $this->input->post('NewNamaBelakang');
						$Gender = $this->input->post('Gender');
						$Email = $this->input->post('NewEmail');
						$Username = $this->input->post('NewUsername');
						$Password = $this->input->post('NewPassword');
						$Role = $this->input->post('Role');

						if($NamaDepan==NULL OR $NamaBelakang==NULL OR $Gender==NULL OR $Email==NULL OR $Username==NULL OR $Password==NULL)
						{
							ob_start(); // ensures anything dumped out will be caught
							$url = base_url().'/MasterAdmin/go_Edits?ID='.$ID.'&tipe=User&Message=Data harus diisi !';
							// this can be set based on whatever
							while (ob_get_status())
								{
									ob_end_clean();
								}
								// no redirect
								header( "Location: $url" );
						}
						else if($Role<=0)
						{
							ob_start(); // ensures anything dumped out will be caught
							$url = base_url().'/MasterAdmin/go_Edits?ID='.$ID.'&tipe=User&Message=Select User\'s Role';
							// this can be set based on whatever
							while (ob_get_status())
								{
									ob_end_clean();
								}
								// no redirect
								header( "Location: $url" );

						}
						else
						{
							$CurrentUN = $this->Model->get_one_data($ID);
							$UsersV = $this->Model->get_data();
							if(in_array_r($Username, $UsersV) AND strcmp($Username,$CurrentUN[0]['Username'])!=0)
							{
								ob_start(); // ensures anything dumped out will be caught
								$url = base_url().'/MasterAdmin/go_Edits?ID='.$ID.'&tipe=User&Message=Username already taken';
								// this can be set based on whatever
								while (ob_get_status())
									{
										ob_end_clean();
									}
									// no redirect
									header( "Location: $url" );
							}
							else
							{
								$data = array(
									'NamaDepan' => $NamaDepan,
									'NamaBelakang' => $NamaBelakang,
									'Gender' => $Gender,
									'Email' => $Email,
									'Username' => $Username,
									'Password' => $Password,
									'RoleID' => $Role
									);
								$this->Model->UpdateUser($data,$ID);
								$data['title'] = ucfirst('Updated');
								$data['Users'] = $this->Model->get_data();
								$this->load->view('templates/header');
								$this->load->view('pages/ManageUsers',$data);
								$this->load->view('templates/footer');
							}
						}
					}
					else if($tipe=="Room")
					{
						$RoomName = $this->input->post('NewRoom');
						if($RoomName==NULL)
						{
							$data['message_display'] = 'Data harus diisi !';
							$this->input->post('selectedID');
							$data['Rooms'] = $this->Model->get_one_room($ID);
							$this->load->view('templates/header');
							$this->load->view('pages/EditRoom',$data);
							$this->load->view('templates/footer');

						}
						else
						{
						$data = array('RoomName' => $RoomName);
						$this->Model->UpdateRoom($data,$ID);
						$data['Rooms'] = $this->Model->get_roo();
						$this->load->view('templates/header');
						$this->load->view('pages/ManageRooms',$data);
						$this->load->view('templates/footer');
						}
					}
					else if($tipe=="Angkatan")
					{
						$NamaAngkatan = $this->input->post('newName');
						$ProgramMulai = $this->input->post('TanggalMulai');
						$ProgramSelesai = $this->input->post('TanggalSelesai');
						if($NamaAngkatan==NULL OR $ProgramMulai==NULL OR $ProgramSelesai==NULL)
						{
							$data['message_display'] = 'Data harus diisi !';
							$data['Views'] = $this->Model->get_one_view($ID);
							$this->load->view('templates/header');
							$this->load->view('pages/EditAngkatan',$data);
							$this->load->view('templates/footer');

						}
						else
						{
							$data = array(
							'NamaAngkatan' => $NamaAngkatan,
							'ProgramMulai' => $ProgramMulai,
							'ProgramSelesai' => $ProgramSelesai,
							);

						$this->Model->UpdateView($data,$ID);

						$ID = $this->input->post('prgID');
						$data['Views'] = $this->Model->viewP($ID);

						$this->load->view('templates/header');
						$this->load->view('pages/ViewsProgram',$data);
						$this->load->view('templates/footer');

						}
					}
					else if($tipe=="Hotels")
						{
							$HotelName = $this->input->post('NewHotel');
							if($HotelName==NULL)
							{
								$data['message_display'] = 'Data harus diisi !';
								$ID = $this->input->post('selectedID');
								$data['Hotels'] = $this->Model->get_one_hotel($ID);
								$this->load->view('templates/header');
								$this->load->view('pages/EditHotel',$data);
								$this->load->view('templates/footer');
							}
							else
							{
								$data = array('HotelName' => $HotelName);
								$this->Model->UpdateHotel($data,$ID);
								$data['Hotels'] = $this->Model->get_Hotels();
								$this->load->view('templates/header');
								$this->load->view('pages/ManageHotels',$data);
								$this->load->view('templates/footer');
							}
						}
						else if($tipe=="ShuttlePoint")
						{
							$PointName = $this->input->post('NewShuttlePoint');
							if($PointName==NULL)
							{
								$data['message_display'] = 'Data harus diisi !';
								$ID = $this->input->post('selectedID');
								$data['ShuttlePoints'] = $this->Model->get_One_ShuttlePoint($ID);
								$this->load->view('templates/header');
								$this->load->view('pages/EditPoint',$data);
								$this->load->view('templates/footer');

							}
							else
							{
								$data = array('PointName' => $PointName);
								$this->Model->UpdatePoint($data,$ID);
								$data['ShuttlePoints'] = $this->Model->get_ShuttlePoints();
								$data['message_display'] = 'Data Telah Di Perbarui, Hubungi Developer Untuk Melakukan Maintenance Agar Dapat Melakukan Configurasi Pada Pemesanan dan Rekap';
								//$data['Hotels'] = $this->Model->get_Hotels();
								$this->load->view('templates/header');
								$this->load->view('pages/ManageShuttlePoints',$data);
								$this->load->view('templates/footer');
							}
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
			$url = base_url().'MasterAdmin/view_Recaps?tipe=Classes&id_pemesanan='.$this->input->get("id_pemesanan");
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
			$url = base_url().'MasterAdmin/view_Recaps?tipe=Consumption&id_pemesanan='.$this->input->get("id_pemesanan");
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
			$url = base_url().'MasterAdmin/view_Recaps?tipe=Hotels&id_pemesanan='.$this->input->get("id_pemesanan");
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
			$url = base_url().'MasterAdmin/view_Recaps?tipe=ShuttleBus&id_pemesanan='.$this->input->get("id_pemesanan");
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
			if (strcmp($file, "Airport_F")==0)
			{
				ob_start(); // ensures anything dumped out will be caught
			$url = base_url().'MasterAdmin/view_Recaps?tipe=AirportShuttle&id_pemesanan='.$this->input->get("id_pemesanan");
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


	public function do_deletes($ID=0,$tipe="")
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE){
			if(isset($this->session->userdata['logged_in'])) {
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
				else if($tipe=="Room")
				{
					$this->Model->RemoveRoom($ID);
					$data['Rooms'] = $this->Model->get_roo();
					$this->load->view('templates/header');
					$this->load->view('pages/ManageRooms',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="Angkatan")
				{
					$this->Model->RemoveAngkatan($ID);
					$data['Programs'] = $this->Model->get_prg();


					$ID = $this->input->get('ProgramID');
					$data['Views'] = $this->Model->viewP($ID);
					echo "a";echo $ID;
					$this->load->view('templates/header');
					$this->load->view('pages/ViewsProgram',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="Hotels")
				{
					$this->Model->RemoveHotel($ID);
					$data['Hotels'] = $this->Model->get_Hotels();
					$this->load->view('templates/header');
					$this->load->view('pages/ManageHotels',$data);
					$this->load->view('templates/footer');
				}
				else if($tipe=="ShuttlePoint")
				{
					$this->Model->RemovePoint($ID);
					$data['ShuttlePoints'] = $this->Model->get_ShuttlePoints();
					$data['message_display'] = 'Data Telah Di Hapus, Hubungi Developer Untuk Melakukan Maintenance Agar Dapat Melakukan Configurasi Pada Pemesanan dan Rekap';
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

		}else if($tipe=="Hotels"){
			$data = array( 'title' => 'Data Pemesanan Hotel per Tanggal '.date("Y-m-d"),
			'info_pemesanan' =>$this->Export_model->get_Info_Pemesanan($id_pesan),
			'data_hotel' => $this->Export_model->get_Hotel_per_Pemesanan_ID($id_pesan)
			);

			$this->load->view('export_excel/vw_pemesanan_hotel',$data);
		}else if($tipe=="Shuttle"){
			$data = array( 'title' => 'Data Pemesanan Shuttle per Tanggal '.date("Y-m-d"),
			'info_pemesanan' =>$this->Export_model->get_Info_Pemesanan($id_pesan),
			'data_shuttle' => $this->Export_model->get_Shuttle_per_Pemesanan_ID($id_pesan),
			'numberOfOrder' => $this->Export_model->countOrderbyID($id_pesan)
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

	//download rekap all to excel
	public function exportRecap_excel(){
		$tipe = $this->input->get('tipe');
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$data['msg'] = NULL;
		$diff = (strtotime($date_to) - strtotime($date_from)) / (60*60*24);

		if($tipe=="Consumption"){
			$data = array( 'title' => 'Data Pemesanan Konsumsi per Tanggal '.date("Y-m-d"),
						'data_konsumsi' => $this->Export_model->get_Consumption_All_Recap($date_from, $date_to),
						'CountRow' => $this->Export_model->CountJumlahRekapKonsum($date_from, $date_to),
						'count_tanggal' => $this->Export_model->get_Count_Tanggal2($date_from, $date_to),
						'ordered_date' => $this->Export_model->get_Ordered_Date2($date_from, $date_to),
						'count_rows' => $this->Export_model->get_Count_Rows2($date_from, $date_to),
						'count_date' => $this->Export_model->get_Count_Date2($date_from, $date_to),
						'date_from' => $date_from,
						'date_to' => $date_to
						);

			$this->load->view('export_excel/vw_all_pemesanan_konsumsi',$data);
		}else if($tipe=="Hotels"){
			$data = array( 'title' => 'Data Pemesanan Hotel per Tanggal '.date("Y-m-d"),
			'data_hotel' => $this->Export_model->get_Hotel_All_Recap($date_from, $date_to),
			'date_from' => $date_from,
			'date_to' => $date_to
			);

			$this->load->view('export_excel/vw_all_pemesanan_hotel',$data);
		}else if($tipe=="Shuttle"){
			//cek interval date
			if($diff  > 4 ){
				$data['Rekap_ShuttleBus'] = $this->Rekap_model->get_ShuttleBus_Recaps();
				$data['msg'] = "Interval tanggal tidak lebih dari 5 hari!";

				$this->load->view('templates/header');
				$this->load->view('pages/View_Recap_ShuttleBus',$data);
				$this->load->view('templates/footer');
				//echo $diff;
			}else{
				$data = array( 'title' => 'Data Pemesanan Shuttle per Tanggal '.date("Y-m-d"),
				'data_shuttle' => $this->Export_model->get_Shutlebus_All_Recap($date_from, $date_to),
				'count_tanggal' => $this->Export_model->get_Count_Tanggal($date_from, $date_to),
				'count_rows' => $this->Export_model->get_Count_Rows($date_from, $date_to),
				'ordered_date' => $this->Export_model->get_Ordered_Date($date_from, $date_to),
				'distinct_rows' => $this->Export_model->get_Count_Rows_Disctinct($date_from, $date_to)
				);

				$this->load->view('export_excel/vw_all_pemesanan_shuttle',$data);
			}
		}

		else if($tipe=="Airport_Shuttle"){
			$data = array( 'title' => 'Data Pemesanan Hotel per Tanggal '.date("Y-m-d"),
			'data_bus' => $this->Export_model->get_Airport_Shuttle_All_Recap($date_from, $date_to),
			'date_from' => $date_from,
			'date_to' => $date_to
			);

			$this->load->view('export_excel/vw_all_pemesanan_airport_shuttle',$data);
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

	if($status != NULL && $status=="Pending") {
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
		}else if($tipe=="Hotels"){
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
		}else if($tipe=="Consumption"){
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
		}else if($tipe=="Hotels"){
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
		}else if($tipe=="Consumption"){
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
		}else if($tipe=="Hotels"){
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
		}else if($tipe=="Consumption"){
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

		if($tipe=="Class")
		{
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);
			$data = array
			(
				'PemesananID' => $id_pesan,
				'Tipe' => $tipe,
				'UserID' => $UserID_koor,
				'CheckerID' => $UserID,
				'StatusAkhirPemesanan' => "rejected"
			);
			$this->Rekap_model->insert_notifikasi($id_pesan,$data);

			if($status_id == "true"){
				$data['Rekap_Classes'] = $this->Rekap_model->get_Class_Recaps($id_pesan);
				$data['id_pemesanan']="true";
			}else{
				$data['Rekap_Classes'] = $this->Rekap_model->get_Classes_Recaps();
			}

			$this->load->view('templates/header');
			$this->load->view('pages/View_Recap_Class',$data);
			$this->load->view('templates/footer');
		}
		else if($tipe=="Hotels")
		{
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);

			//add to notifikasi table
			$data = array
			(
				'PemesananID' => $id_pesan,
				'Tipe' => $tipe,
				'UserID' => $UserID_koor,
				'CheckerID' => $UserID,
				'StatusAkhirPemesanan' => "rejected"
			);
			$this->Rekap_model->insert_notifikasi($id_pesan,$data);

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
			$data = array
			(
				'PemesananID' => $id_pesan,
				'Tipe' => $tipe,
				'UserID' => $UserID_koor,
				'CheckerID' => $UserID,
				'StatusAkhirPemesanan' => "rejected"
			);
			$this->Rekap_model->insert_notifikasi($id_pesan,$data);

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
			$data = array
			(
				'PemesananID' => $id_pesan,
				'Tipe' => $tipe,
				'UserID' => $UserID_koor,
				'CheckerID' => $UserID,
				'StatusAkhirPemesanan' => "rejected"
			);
			$this->Rekap_model->insert_notifikasi($id_pesan,$data);
			if($status_id == "true"){
				$data['Rekap_AirportBus'] = $this->Rekap_model->get_Airport_Recaps($id_pesan);
				$data['id_pemesanan']="true";
			}else{
				$data['Rekap_AirportBus'] = $this->Rekap_model->get_AirportBus_Recaps();
			}

			$this->load->view('templates/header');
			$this->load->view('pages/View_Recap_AirportBus',$data);
			$this->load->view('templates/footer');
		}else if($tipe=="Consumption")
		{
			$this->Rekap_model->update_status_rejected($id_pesan,$checkers_note,$UserID,$tgl_buat, $tipe);
			$data = array
			(
				'PemesananID' => $id_pesan,
				'Tipe' => $tipe,
				'UserID' => $UserID_koor,
				'CheckerID' => $UserID,
				'StatusAkhirPemesanan' => "rejected"
			);
			$this->Rekap_model->insert_notifikasi($id_pesan,$data);
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
		else {
			show_404();
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
					$this->load->view('templates/header');
						$this->load->view('pages/home',$data);
						$this->load->view('templates/footer');
				}
		}
	}

	public function Privilaged($newRoleid=0)
	{
		$newRoleid=$this->input->get("newRoleid");
		$this->session->userdata['logged_in']['RoleID']=$newRoleid;
		ob_start(); // ensures anything dumped out will be caught
		$url = 'http://localhost/UPPS/MasterAdmin/view_Recaps?tipe=All';
		// this can be set based on whatever
		while (ob_get_status())
			{
				ob_end_clean();
			}
			// no redirect
			header( "Location: $url" );
	}
}

	function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
	}
