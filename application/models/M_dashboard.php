<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('floating_helper');
	}


	public function get_card()
	{
		$count_barang  = $this->_count_barang();
		$count_ukuran  = $this->_count_ukuran();
		$count_ruangan = $this->_count_ruangan();

		$return = [
			'count_barang'  => $count_barang,
			'count_ukuran'  => $count_ukuran,
			'count_ruangan' => $count_ruangan,
		];

		return $return;
	}

	protected function _count_barang()
	{
		$count = $this->db->where('deleted_at', null)->count_all_results('barang');
		return check_float($count);
	}

	protected function _count_ukuran()
	{
		$count = $this->db->where('deleted_at', null)->count_all_results('ukuran');
		return check_float($count);
	}

	protected function _count_ruangan()
	{
		$arr_ruangan = $this->db->from('ruangan')->where('deleted_at', null)->get();

		$data = [];
		foreach ($arr_ruangan->result() as $item) {
			$id_ruangan   = $item->id;
			$nama_ruangan = $item->nama;

			$count_ukuran = $this->db->where('deleted_at', null)->where('id_ruangan', $id_ruangan)->count_all_results('ukuran');

			$data[$nama_ruangan] = $count_ukuran;
		}

		return $data;
	}
}
                        
/* End of file M_dashboard.php */
