<?php

defined('BASEPATH') or exit('No direct script access allowed');

class InitController extends CI_Controller
{

	protected $current_datetime;

	public function __construct()
	{
		parent::__construct();
		$this->current_datetime = date('Y-m-d H:i:s');
	}

	public function init()
	{
		$this->db->trans_begin();

		$this->_truncate();

		$username = "admin";
		$password = password_hash(UYAH . "admin123)", PASSWORD_BCRYPT);
		$name = "Admin";
		$profile_picture = "default_avatar.svg";
		$is_active = "yes";
		$is_active = ";
	}

	protected function _truncate()
	{
		$this->db->truncate('admin');
		$this->db->truncate('barang');
		$this->db->truncate('history_laundry');
		$this->db->truncate('ruangan');
		$this->db->truncate('ukuran');
	}
}
        
/* End of file  InitController.php */
