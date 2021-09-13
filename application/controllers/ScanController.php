<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ScanController extends CI_Controller
{

	protected $id_admin;
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_ruangan');
		$this->load->model('M_ukuran');
		$this->load->model('M_scan');

		$this->id_admin = $this->session->userdata(SESI . 'id');
		$this->datetime = date('Y-m-d H:i:s');
	}

	public function index()
	{
		$arr_ruangan = $this->M_ruangan->get_list("no", null);
		$arr_ukuran  = $this->M_ukuran->get_list("no", null);
		$data = [
			'title'       => APP_NAME . " | Scan",
			'content'     => 'scan/main',
			'vitamin_js'  => 'scan/main_js',
			'arr_ruangan' => $arr_ruangan,
			'arr_ukuran'  => $arr_ukuran,
		];

		$this->template->render($data);
	}

	public function cek_kode()
	{
		$from_id_ruangan   = trim($this->input->get('from_id_ruangan'));
		$from_nama_ruangan = trim($this->input->get('from_nama_ruangan'));
		$kode              = trim($this->input->get('kode'));

		$arr = $this->M_ukuran->get_list("no", null, $kode);

		if ($arr->num_rows() == 0) {
			echo json_encode([
				'code'    => 404,
				'message' => "Barang Tidak Ditemukan",
			]);
			exit;
		} elseif ($from_id_ruangan != $arr->row()->id_ruangan) {
			echo json_encode([
				'code'    => 400,
				'message' => "Barang " . $arr->row()->nama_barang . " Ukuran " . $arr->row()->nama_ukuran . " (" . $arr->row()->kode . ") Tidak Berada Di Ruangan " . $from_nama_ruangan,
			]);
			exit;
		} else {
			echo json_encode([
				'code'        => 200,
				'message'     => "OK",
				'nama_barang' => $arr->row()->nama_barang,
				'nama_ukuran' => $arr->row()->nama_ukuran,
			]);
			exit;
		}
	}

	public function store()
	{
		$this->db->trans_begin();

		$data = $this->input->post('data');

		foreach ($data as $item) {
			$decode = json_decode($item);

			$from_id_ruangan   = $decode->from_id_ruangan;
			$from_nama_ruangan = $decode->from_nama_ruangan;
			$to_id_ruangan     = $decode->to_id_ruangan;
			$to_nama_ruangan   = $decode->to_nama_ruangan;
			$kode              = $decode->kode;
			$nama_barang       = $decode->nama_barang;
			$nama_ukuran       = $decode->nama_ukuran;

			$arr_ukuran = $this->M_core->get('ukuran', '*', ['kode' => $kode]);

			$id_barang = $arr_ukuran->row()->id_barang;
			$id_ukuran = $arr_ukuran->row()->id;

			$state = ($from_id_ruangan == 1) ? "out" : "in";

			$data = [
				'id_barang'         => $id_barang,
				'nama_barang'       => $nama_barang,
				'id_ukuran'         => $id_ukuran,
				'nama_ukuran'       => $nama_ukuran,
				'from_id_ruangan'   => $from_id_ruangan,
				'from_nama_ruangan' => $from_nama_ruangan,
				'to_id_ruangan'     => $to_id_ruangan,
				'to_nama_ruangan'   => $to_nama_ruangan,
				'state'             => $state,
				'created_at'        => $this->datetime,
				'created_by'        => $this->session->userdata(SESI . 'id'),
				'created_name'      => $this->session->userdata(SESI . 'name'),
			];
			$exec = $this->M_core->store('history_laundry', $data);

			if (!$exec) {
				$this->db->trans_rollback();
				echo json_encode([
					'code'    => 500,
					'message' => 'Proses Simpan Scan Gagal, Tidak terhubung dengan Database. Silahkan Coba Kembali',
				]);
				exit;
			}

			$exec = $this->M_scan->update_ukuran($id_ukuran, $to_id_ruangan, $state);

			if (!$exec) {
				$this->db->trans_rollback();
				echo json_encode([
					'code'    => 500,
					'message' => 'Proses Update Barang Gagal, Tidak terhubung dengan Database. Silahkan Coba Kembali',
				]);
				exit;
			}
		}

		$this->db->trans_commit();
		echo json_encode([
			'code'    => 200,
			'message' => 'Proses Simpan Scan Berhasil',
		]);
		exit;
	}
}
        
    /* End of file  ScanController.php */
