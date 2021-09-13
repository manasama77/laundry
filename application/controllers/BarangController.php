<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BarangController extends CI_Controller
{

	protected $id_admin;
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_barang');

		$this->id_admin = $this->session->userdata(SESI . 'id');
		$this->datetime = date('Y-m-d H:i:s');
	}

	public function index()
	{
		$arr = $this->M_barang->get_list("no", null);
		$data = [
			'title'      => APP_NAME . " | Barang",
			'content'    => 'barang/main',
			'vitamin_js' => 'barang/main_js',
			'arr'        => $arr,
		];

		$this->template->render($data);
	}

	public function add()
	{
		$data = [
			'title'      => APP_NAME . " | Tambah Barang",
			'content'    => 'barang/form',
			'vitamin_js' => 'barang/form_js',
		];

		$this->template->render($data);
	}

	public function store()
	{
		$this->db->trans_begin();

		$nama       = $this->input->post('nama');
		$created_at = $this->datetime;
		$updated_at = $this->datetime;
		$data       = compact('nama', 'created_at', 'updated_at');
		$exec       = $this->M_core->store('barang', $data);

		if (!$exec) {
			$this->db->trans_rollback();
			return show_error("Proses Tambah barang gagal");
		}

		$this->session->set_flashdata('success', 'Tambah Barang Berhasil');
		$this->db->trans_commit();
		redirect('barang');
	}

	public function edit($id = null)
	{
		if ($id == null) {
			return show_404();
		}

		$arr = $this->M_barang->get_list("no", $id);

		$data = [
			'title'      => APP_NAME . " | Edit Barang",
			'content'    => 'barang/form_edit',
			'vitamin_js' => 'barang/form_edit_js',
			'arr'        => $arr,
		];

		$this->template->render($data);
	}

	public function update()
	{
		$this->db->trans_begin();

		$id         = $this->input->post('id');
		$nama       = $this->input->post('nama');
		$updated_at = $this->datetime;
		$data       = compact('nama', 'updated_at');
		$where      = ['id' => $id];
		$exec       = $this->M_core->update('barang', $data, $where);

		if (!$exec) {
			$this->db->trans_rollback();
			return show_error("Proses Edit barang gagal");
		}

		$this->session->set_flashdata('success', 'Edit Barang Berhasil');
		$this->db->trans_commit();
		redirect('barang');
	}

	public function delete()
	{
		$this->db->trans_begin();

		$id         = $this->input->post('id');
		$deleted_at = $this->datetime;
		$data       = compact('deleted_at');
		$where      = compact('id');
		$exec       = $this->M_core->update('barang', $data, $where);
		if (!$exec) {
			$this->db->trans_rollback();
			echo json_encode([
				'code' => 500,
				'status_text' => 'Proses Delete barang gagal'
			]);
			exit;
		}

		$this->db->trans_commit();
		$this->session->set_flashdata('success', 'Delete Barang Berhasil');
		echo json_encode([
			'code' => 200,
			'status_text' => 'Proses Delete barang Berhasil'
		]);
		exit;
	}

	public function show_ukuran($id = null)
	{
		if ($id == null) {
			echo json_encode([
				'code'     => 404,
				'response' => "ID Barang tidak ditemukan, silahkan coba kembali",
			]);
			exit;
		}

		$arr = $this->M_core->get('ukuran_barang', 'ukuran', ['id_barang' => $id]);

		echo json_encode([
			'code'     => 200,
			'response' => $arr->result_array(),
		]);
	}
}
        
    /* End of file  BarangController.php */
