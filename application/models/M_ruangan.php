<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_ruangan extends CI_Model
{

	public function get_list($include_delete = "no", $id = null)
	{
		$this->db->select([
			'id',
			'nama',
			'created_at',
			'updated_at',
			'deleted_at',
		]);
		$this->db->from('ruangan');

		if ($include_delete == "no") {
			$this->db->where('deleted_at', null);
		}

		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();

		return $query;
	}
}
                        
/* End of file M_ruangan.php */
