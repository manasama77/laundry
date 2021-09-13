<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{

	public function get_list($include_delete = "no", $id = null)
	{
		$this->db->select([
			'barang.id',
			'barang.nama',
			'barang.created_at',
			'barang.updated_at',
			'barang.deleted_at',
		]);
		$this->db->from('barang');

		if ($include_delete == "no") {
			$this->db->where('barang.deleted_at', null);
		}

		if ($id != null) {
			$this->db->where('barang.id', $id);
		}

		$this->db->order_by('barang.id', 'desc');
		$query = $this->db->get();

		return $query;
	}
}
                        
/* End of file M_barang.php */
