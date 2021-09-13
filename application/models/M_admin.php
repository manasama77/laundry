<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
	}


	public function get_list($include_delete = "no", $id = null)
	{
		$this->db->select([
			'admin.id',
			'admin.username',
			'admin.name',
			'admin.profile_picture',
			'admin.is_active',
			'admin.id_ruangan',
			'admin.created_at',
			'ruangan.nama as nama_ruangan',
		]);
		$this->db->from('admin');
		$this->db->join('ruangan', 'ruangan.id = admin.id_ruangan', 'left');

		if ($include_delete == "no") {
			$this->db->where('admin.deleted_at', null);
		}

		if ($id != null) {
			$this->db->where('admin.id', $id);
		}

		$this->db->order_by('admin.id', 'desc');
		$query = $this->db->get();

		return $query;
	}
}
                        
/* End of file M_member.php */
