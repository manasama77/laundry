<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_scan extends CI_Model
{

	public function update_ukuran($id_ukuran, $id_ruangan, $state)
	{
		if ($state == "in") {
			$this->db->set('jumlah_laundry', 'jumlah_laundry + 1', false);
		} elseif ($state == "out") {
			$this->db->set('jumlah_pakai', 'jumlah_pakai + 1', false);
		}
		$exec = $this->db
			->set('id_ruangan', $id_ruangan)
			->where('id', $id_ukuran)
			->update('ukuran');

		return $exec;
	}
}
                        
/* End of file M_scan.php */
