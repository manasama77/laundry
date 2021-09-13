<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HistoryLaundryController extends CI_Controller
{

	protected $id_admin;
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_history_laundry');

		$this->id_admin = $this->session->userdata(SESI . 'id');
		$this->datetime = date('Y-m-d H:i:s');
	}

	public function index()
	{
		$arr = $this->M_history_laundry->get_list("no", null);
		$data = [
			'title'      => APP_NAME . " | History Laundry",
			'content'    => 'history_laundry/main',
			'vitamin_js' => 'history_laundry/main_js',
			'arr'        => $arr,
		];

		$this->template->render($data);
	}
}
        
    /* End of file  HistoryLaundryController.php */
