<?php
Class User_Authentication extends CI_Controller {

public function __construct() {
parent::__construct();

$this->load->helper('security');

$this->load->helper('form');
$this->load->library('form_validation');
$this->load->library('session');
$this->load->model('login_database');
$this->load->model('Rekap_model');
}
public function index()
{
$this->load->view('Login');
}
		public function Login()
		{
			if(!file_exists(APPPATH.'views/pages/Login.php'))
			{
				show_404();
			}

			//$this->load->view('templates/header');
			$this->load->view('pages/Login.php');
			//$this->load->view('templates/footer');

		}


public function user_login_process()
{
	$this->load->model('Rekap_model');
	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

	if ($this->form_validation->run() == FALSE)
	{
		if(isset($this->session->userdata['logged_in']))
		{
			$this->load->view('pages/Home');
		}
		else
		{
			$this->load->view('pages/Login');
		}
	}
	else
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
						);
		$result = $this->login_database->login($data);
		if ($result == TRUE)
		{
			$username = $this->input->post('username');
			$result = $this->login_database->read_user_information($username);
			if ($result[0]->RoleID == 1)
			{
				$_SESSION["CompleteControl"] = "Allowed";
			}
			else
			{
				$_SESSION["CompleteControl"] = "NotAllowed";
			}
			if ($result != false)
			{
				$session_data = array(
					'username' => $result[0]->Username,
					'email' => $result[0]->Email,
					'namadepan' => $result[0]->NamaDepan,
					'namabelakang' => $result[0]->NamaBelakang,
					'gender' => $result[0]->Gender,
					'password' => $result[0]->Password,
					'UserID' => $result[0]->UserID,
					'RoleID' => $result[0]->RoleID,
					'jlh_notifikasi' => $this->Rekap_model->get_num_notifikasi($result[0]->UserID)
				);// Add user data in session

				$this->session->set_userdata('logged_in', $session_data);

				$data['title'] = ucfirst('Welcome,'.$username);

				$data['jumlah_notifikasi'] =  $this->Rekap_model->get_num_notifikasi($result[0]->UserID); //
				$CurrentDate = date('Y-m-d');
				$EndDate = date ("Y-m-d", strtotime("+5 day", strtotime($CurrentDate)));
				//echo($CurrentDate .' - '.$EndDate);
				$data['Rekap_All'] = $this->Rekap_model->get_All_5days_Recaps($CurrentDate,$EndDate);
				$this->load->view('templates/header', $data);
				$this->load->view('pages/Home',$data);
				$this->load->view('templates/footer');
			}
		}
		else
		{
			$data = array(
				'error_message' => 'Invalid Username or Password'
							);
			$this->load->view('pages/Login', $data);
		}
	}
}
	public function logout()
	{
	// Removing session data
		$sess_array = array(
			'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('pages/Login', $data);
	}

}

?>
