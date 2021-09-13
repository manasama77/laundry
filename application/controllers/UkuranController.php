<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UkuranController extends CI_Controller
{

	protected $id_admin;
	protected $admin_name;
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_ruangan');
		$this->load->model('M_barang');
		$this->load->model('M_ukuran');

		$this->id_admin = $this->session->userdata(SESI . 'id');
		$this->admin_name = $this->session->userdata(SESI . 'name');
		$this->datetime = date('Y-m-d H:i:s');
	}

	public function index()
	{
		$arr = $this->M_ukuran->get_list("no", null);
		$data = [
			'title'      => APP_NAME . " | Ukuran",
			'content'    => 'ukuran/main',
			'vitamin_js' => 'ukuran/main_js',
			'arr'        => $arr,
		];

		$this->template->render($data);
	}

	public function add()
	{
		$arr_ruangan = $this->M_ruangan->get_list("no", 1);
		$arr_barang  = $this->M_barang->get_list("no");
		$data = [
			'title'       => APP_NAME . " | Tambah Ukuran",
			'content'     => 'ukuran/form',
			'vitamin_js'  => 'ukuran/form_js',
			'arr_ruangan' => $arr_ruangan,
			'arr_barang'  => $arr_barang,
		];

		$this->template->render($data);
	}

	public function store()
	{
		$this->db->trans_begin();

		$id_barang      = $this->input->post('id_barang');
		$nama           = $this->input->post('nama');
		$kode           = $this->input->post('kode');
		$id_ruangan     = $this->input->post('id_ruangan');
		$jumlah_laundry = $this->input->post('jumlah_laundry');
		$jumlah_pakai   = $this->input->post('jumlah_pakai');
		$limit_laundry  = $this->input->post('limit_laundry');
		$limit_pakai    = $this->input->post('limit_pakai');
		$created_at     = $this->datetime;
		$updated_at     = $this->datetime;
		$data           = compact('id_barang', 'nama', 'kode', 'id_ruangan', 'jumlah_laundry', 'jumlah_pakai', 'limit_laundry', 'limit_pakai', 'created_at', 'updated_at');
		$exec           = $this->M_core->store('ukuran', $data);

		if (!$exec) {
			$this->db->trans_rollback();
			return show_error("Proses Tambah Ukuran gagal");
		}

		$nama_barang     = $this->M_core->get('barang', 'nama', ['id'  => $id_barang])->row()->nama;
		$id_ukuran       = $this->db->insert_id();
		$to_nama_ruangan = $this->M_core->get('ruangan', 'nama', ['id' => $id_ruangan])->row()->nama;


		$data = [
			'id_barang'         => $id_barang,
			'nama_barang'       => $nama_barang,
			'id_ukuran'         => $id_ukuran,
			'nama_ukuran'       => $nama,
			'from_id_ruangan'   => null,
			'from_nama_ruangan' => null,
			'to_id_ruangan'     => $id_ruangan,
			'to_nama_ruangan'   => $to_nama_ruangan,
			'state'             => 'init',
			'created_at'        => $created_at,
			'created_by'        => $this->id_admin,
			'created_name'      => $this->admin_name,
		];
		$exec = $this->M_core->store('history_laundry', $data);

		if (!$exec) {
			$this->db->trans_rollback();
			return show_error("Proses Store History Laundry gagal");
		}

		$this->session->set_flashdata('success', 'Tambah Ukuran Berhasil');
		$this->db->trans_commit();
		redirect('ukuran/add');
	}

	public function edit($id = null)
	{
		if ($id == null) {
			return show_404();
		}

		$arr_ruangan = $this->M_ruangan->get_list("no");
		$arr_barang  = $this->M_barang->get_list("no");
		$arr         = $this->M_ukuran->get_list("no", $id);

		$data = [
			'title'       => APP_NAME . " | Edit Ukuran",
			'content'     => 'ukuran/form_edit',
			'vitamin_js'  => 'ukuran/form_edit_js',
			'id'          => $id,
			'arr_ruangan' => $arr_ruangan,
			'arr_barang'  => $arr_barang,
			'arr'         => $arr,
		];

		$this->template->render($data);
	}

	public function update()
	{
		$this->db->trans_begin();

		$id             = $this->input->post('id');
		$id_barang      = $this->input->post('id_barang');
		$nama           = $this->input->post('nama');
		$kode           = $this->input->post('kode');
		$id_ruangan     = $this->input->post('id_ruangan');
		$jumlah_laundry = $this->input->post('jumlah_laundry');
		$jumlah_pakai   = $this->input->post('jumlah_pakai');
		$updated_at     = $this->datetime;
		$data           = compact('id_barang', 'nama', 'kode', 'id_ruangan', 'jumlah_laundry', 'jumlah_pakai', 'updated_at');
		$where          = ['id' => $id];
		$exec           = $this->M_core->update('ukuran', $data, $where);

		if (!$exec) {
			$this->db->trans_rollback();
			return show_error("Proses Update Ukuran gagal");
		}

		$this->session->set_flashdata('success', 'Update Ukuran Berhasil');
		$this->db->trans_commit();
		redirect('ukuran');
	}

	public function delete()
	{
		$this->db->trans_begin();

		$id         = $this->input->post('id');
		$deleted_at = $this->datetime;
		$data       = compact('deleted_at');
		$where      = compact('id');
		$exec       = $this->M_core->update('ukuran', $data, $where);
		if (!$exec) {
			$this->db->trans_rollback();
			echo json_encode([
				'code' => 500,
				'status_text' => 'Proses Delete Ukuran gagal'
			]);
			exit;
		}

		$this->db->trans_commit();
		$this->session->set_flashdata('success', 'Delete Ukuran Berhasil');
		echo json_encode([
			'code' => 200,
			'status_text' => 'Proses Delete Ukuran Berhasil'
		]);
		exit;
	}

	public function print($id = null)
	{
		if ($id == null) {
			return show_404();
		}

		$kode = $this->M_core->get('ukuran', 'kode', ['id' => $id])->row()->kode;
		$data = ['kode' => $kode];
		$this->load->view('pages/admin/ukuran/print', $data, FALSE);
	}
}
        
    /* End of file  UkuranController.php */
