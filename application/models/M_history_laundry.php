<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_history_laundry extends CI_Model
{

	public function get_list($include_delete = "no", $id = null)
	{
		$this->db->select([
			'history_laundry.id',
			'history_laundry.nama_barang',
			'history_laundry.nama_ukuran',
			'history_laundry.from_nama_ruangan',
			'history_laundry.to_nama_ruangan',
			'history_laundry.state',
			'history_laundry.created_at',
		]);
		$this->db->from('history_laundry');

		if ($include_delete == "no") {
			$this->db->where('history_laundry.deleted_at', null);
		}

		if ($id != null) {
			$this->db->where('history_laundry.id', $id);
		}

		$this->db->order_by('history_laundry.id', 'desc');
		$query = $this->db->get();

		return $query;
	}
}
                        
/* End of file M_history_laundry.php */
