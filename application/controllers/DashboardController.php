<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
	protected $id_admin;
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_dashboard');
		$this->load->model('M_admin');

		$this->id_admin = $this->session->userdata(SESI . 'id');
		$this->datetime = date('Y-m-d H:i:s');
	}


	public function index()
	{
		$card = $this->M_dashboard->get_card();
		$data = [
			'title'      => APP_NAME . " | Dashboard",
			'content'    => 'dashboard/main',
			'vitamin_js' => 'dashboard/main_js',
			'card'       => $card,
		];

		$this->template->render($data);
	}
}
        
/* End of file  DashboardController.php */
