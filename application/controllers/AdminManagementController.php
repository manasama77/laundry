<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminManagementController extends CI_Controller
{
	protected $id_admin;
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_admin');
		$this->load->model('M_ruangan');

		$this->id_admin = $this->session->userdata(SESI . 'id');
		$this->datetime = date('Y-m-d H:i:s');
	}


	public function index()
	{
		$arr_ruangan = $this->M_ruangan->get_list("no");
		$arr         = $this->M_admin->get_list("no");
		$data = [
			'title'       => APP_NAME . " | Dashboard",
			'content'     => 'admin_management/main',
			'vitamin_js'  => 'admin_management/main_js',
			'arr_ruangan' => $arr_ruangan,
			'arr'         => $arr,
		];

		$this->template->render($data);
	}

	public function store()
	{
		$username        = $this->input->post('username');
		$password        = password_hash(UYAH . $this->input->post('password'), PASSWORD_BCRYPT);
		$name            = $this->input->post('name');
		$profile_picture = 'default_avatar.svg';
		$id_ruangan      = $this->input->post('id_ruangan');

		$where = [
			'username'   => $username,
			'deleted_at' => null,
		];
		$count_username = $this->M_core->count('admin', $where);

		if ($count_username > 0) {
			echo json_encode([
				'code' => 400,
				'status_text' => "Username Already Registered",
			]);
			exit;
		}

		$data = [
			'username'        => $username,
			'password'        => $password,
			'name'            => $name,
			'is_active'       => 'yes',
			'id_ruangan'      => $id_ruangan,
			'profile_picture' => $profile_picture,
			'created_at'      => $this->datetime,
			'updated_at'      => $this->datetime,
			'deleted_at'      => null,
		];
		$exec = $this->M_core->store('admin', $data);

		if (!$exec) {
			echo json_encode([
				'code' => 500,
				'status_text' => "Create New Admin Failed",
			]);
			exit;
		}

		echo json_encode([
			'code' => 200,
			'status_text' => "Create New Admin Success",
		]);
		exit;
	}

	public function update()
	{
		$id         = $this->input->post('id');
		$name       = $this->input->post('name');
		$is_active  = $this->input->post('is_active');
		$id_ruangan = $this->input->post('id_ruangan');

		$data = [
			'name'       => $name,
			'is_active'  => $is_active,
			'id_ruangan' => $id_ruangan,
			'updated_at' => $this->datetime,
		];
		$where = [
			'deleted_at' => null,
			'id'         => $id,
		];
		$exec = $this->M_core->update('admin', $data, $where);

		if (!$exec) {
			echo json_encode([
				'code' => 500,
				'status_text' => "Update Admin Failed",
			]);
			exit;
		}

		echo json_encode([
			'code' => 200,
			'status_text' => "Update Admin Success",
		]);
		exit;
	}

	public function delete()
	{
		$id   = $this->input->post('id');

		$data  = ['deleted_at' => $this->datetime];
		$where = ['id'         => $id];
		$exec  = $this->M_core->update('admin', $data, $where);

		if (!$exec) {
			echo json_encode([
				'code' => 500,
				'status_text' => "Delete Admin Failed",
			]);
			exit;
		}

		echo json_encode([
			'code' => 200,
			'status_text' => "Delete Admin Success",
		]);
		exit;
	}

	public function reset()
	{
		$id       = $this->input->post('id');
		$password = password_hash(UYAH . $this->input->post('password'), PASSWORD_BCRYPT);

		$data = [
			'password'   => $password,
			'updated_at' => $this->datetime,
		];
		$where = [
			'deleted_at' => null,
			'id'         => $id,
		];
		$exec = $this->M_core->update('admin', $data, $where);

		if (!$exec) {
			echo json_encode([
				'code' => 500,
				'status_text' => "Reset Password Admin Failed",
			]);
			exit;
		}

		echo json_encode([
			'code' => 200,
			'status_text' => "Reset Password Admin Success",
		]);
		exit;
	}
}
        
/* End of file  AdminManagementController.php */
