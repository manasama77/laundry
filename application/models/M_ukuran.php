<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_ukuran extends CI_Model
{

	public function get_list($include_delete = "no", $id = null, $kode = null)
	{
		$this->db->select([
			'ukuran.id',
			'ukuran.nama as nama_ukuran',
			'ukuran.kode',
			'ukuran.jumlah_laundry',
			'ukuran.jumlah_pakai',
			'ukuran.limit_laundry',
			'ukuran.limit_pakai',
			'ukuran.created_at',
			'ukuran.updated_at',
			'ukuran.deleted_at',
			'ukuran.id_barang',
			'ukuran.id_ruangan',
			'barang.nama as nama_barang',
			'ruangan.nama as nama_ruangan',
		]);
		$this->db->from('ukuran');
		$this->db->join('barang', 'barang.id = ukuran.id_barang', 'left');
		$this->db->join('ruangan', 'ruangan.id = ukuran.id_ruangan', 'left');

		if ($include_delete == "no") {
			$this->db->where('ukuran.deleted_at', null);
		}

		if ($id != null) {
			$this->db->where('ukuran.id', $id);
		}

		if ($kode != null) {
			$this->db->where('ukuran.kode', $kode);
		}

		$this->db->order_by('ukuran.id', 'desc');
		$query = $this->db->get();

		return $query;
	}
}
                        
/* End of file M_ukuran.php */
