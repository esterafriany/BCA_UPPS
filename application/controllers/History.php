<?php
Class History extends CI_Controller
{
  public function __construct() {
  parent::__construct();

  $this->load->helper('security');

  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->load->library('session');
  $this->load->model('login_database');
  $this->load->model('Rekap_model');
  $this->load->model('Model');
  }
  public function index()
  {
    $data['Rekap_All'] = $this->Rekap_model->get_All_Recaps();
		$this->load->view('templates/header');
		$this->load->view('pages/ViewHistory',$data);
		$this->load->view('templates/footer');
  }


  //Debug purposes
  public function setJSON()
  {

    $this->Rekap_model->set_jsonPemesanan();
    $this->Rekap_model->set_jsonAirport();
    $this->Rekap_model->set_jsonKonsumsi();
    $this->Rekap_model->set_jsonHotel();
    $this->Rekap_model->set_jsonKelas();
    $this->Rekap_model->set_jsonShuttle();
    $this->load->view('pages/History_TEST');
    echo "DONE";
    echo $JumlahHistory;
  }
	
	//Debug purposes
	public function KelasDEBUG()
	{

    $this->Rekap_model->set_jsonKelasDEBUG();
    echo "DONE";
	}


	public function ClassLegacy()
	{
		$data['Classes'] = $this->Rekap_model->get_Detail_Class($this->input->get("PemesananID"));
		$this->load->view('pages/LegacyClasses',$data);
	}

	public function HotelLegacy()
	{
    $data['Hotels'] = $this->Rekap_model->get_Detail_Hotel($this->input->get("PemesananID")); 
		$this->load->view('pages/LegacyHotel',$data); 
	}
	public function AirportLegacy() {
		$data['AirportBus'] = $this->Rekap_model->get_Detail_AirportBus($this->input->get("PemesananID"));
		$this->load->view('pages/LegacyAirport',$data); 
	}

	public function ShuttleLegacy()
	{
		$data['ShuttlePoints'] = $this->Model->get_ShuttlePoints();
		$data['Shuttle'] = $this->Rekap_model->get_Detail_Shuttle($this->input->get("PemesananID")); 
		$this->load->view('pages/LegacyShuttle',$data); 
	}

	public function ConsumptionLegacy()
	{
		$data['Consump'] = $this->Rekap_model->get_Detail_Consumption($this->input->get("PemesananID")); 
		$this->load->view('pages/LegacyConsumption',$data); 
	}


}

?>
