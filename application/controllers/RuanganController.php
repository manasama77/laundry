<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RuanganController extends CI_Controller
{

	protected $id_admin;
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_ruangan');

		$this->id_admin = $this->session->userdata(SESI . 'id');
		$this->datetime = date('Y-m-d H:i:s');
	}

	public function index()
	{
		$arr = $this->M_ruangan->get_list("no", null);
		$data = [
			'title'      => APP_NAME . " | Ruangan",
			'content'    => 'ruangan/main',
			'vitamin_js' => 'ruangan/main_js',
			'arr'        => $arr,
		];

		$this->template->render($data);
	}

	public function add()
	{
		$data = [
			'title'   => APP_NAME . " | Tambah Ruangan",
			'content' => 'ruangan/form',
		];

		$this->template->render($data);
	}

	public function store()
	{
		$nama       = $this->input->post('nama');
		$created_at = $this->datetime;
		$data       = compact('nama', 'created_at');
		$exec       = $this->M_core->store('ruangan', $data);

		if (!$exec) {
			return show_error("Proses tambah ruangan gagal", 500);
		}

		$this->session->set_flashdata('success', 'Tambah Ruangan Berhasil');
		redirect('ruangan');
	}

	public function edit()
	{
		$id  = $this->input->get('id');
		$arr = $this->M_ruangan->get_list("no", $id);
		$data = [
			'title'   => APP_NAME . " | Edit Ruangan",
			'content' => 'ruangan/form_edit',
			'arr'     => $arr,
		];

		$this->template->render($data);
	}

	public function update()
	{
		$id         = $this->input->post('id');
		$nama       = $this->input->post('nama');
		$updated_at = $this->datetime;
		$data       = compact('nama', 'updated_at');
		$where      = compact('id');
		$exec       = $this->M_core->update('ruangan', $data, $where);

		if (!$exec) {
			return show_error("Proses Edit ruangan gagal", 500);
		}

		$this->session->set_flashdata('success', 'Edit Ruangan Berhasil');
		redirect('ruangan');
	}

	public function delete()
	{
		$id         = $this->input->post('id');
		$deleted_at = $this->datetime;
		$data       = compact('deleted_at');
		$where      = compact('id');
		$exec       = $this->M_core->update('ruangan', $data, $where);

		if (!$exec) {
			echo json_encode([
				'code' => 500,
				'status_text' => 'Proses Delete ruangan gagal'
			]);
			exit;
		}

		$this->session->set_flashdata('success', 'Delete Ruangan Berhasil');
		echo json_encode([
			'code' => 200,
			'status_text' => 'Proses Delete ruangan Berhasil'
		]);
		exit;
	}
}
        
    /* End of file  RuanganController.php */
