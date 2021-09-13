<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

	protected $datetime;
	protected $id_admin;

	public function __construct()
	{
		parent::__construct();
		$this->datetime = date('Y-m-d H:i:s');
		$this->id_admin = $this->session->userdata(SESI . 'id');
	}


	public function index()
	{
		$cookies = get_cookie(KUE);

		if ($cookies != NULL) {
			$this->_check_cookies($cookies);
		} else {
			$check_session = $this->_check_session();
			if ($check_session === true) {
				redirect('dashboard');
				exit;
			}

			$data = [
				'title' => APP_NAME . ' | Member Sign In'
			];
			return $this->load->view('login', $data, FALSE);
		}
	}

	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$remember = $this->input->post('remember');

		$where = [
			'username'   => $username,
			'deleted_at' => null,
		];
		$arr_user = $this->M_core->get('admin', 'id, username, password, name, is_active, profile_picture, created_at, updated_at', $where, null, null, 1);

		if ($arr_user->num_rows() == 0) {
			$this->session->set_flashdata('username_value', $username);
			$this->session->set_flashdata('username_state', 'is-invalid');
			$this->session->set_flashdata('username_state_message', 'Username Not Found');
			redirect('login');
		} elseif ($arr_user->row()->is_active == 'no') {
			$msg = 'Account has disabled by Admin';
			$this->session->set_flashdata('username_value', $username);
			$this->session->set_flashdata('username_state', 'is-invalid');
			$this->session->set_flashdata('username_state_message', $msg);
			redirect('login');
		} elseif (password_verify(UYAH . $password, $arr_user->row()->password) == false) {
			$this->session->set_flashdata('username_value', $username);
			$this->session->set_flashdata('username_state', 'is-valid');
			$this->session->set_flashdata('username_state_message', null);
			$this->session->set_flashdata('password_state', 'is-invalid');
			$this->session->set_flashdata('password_state_message', 'Password wrong!');
			redirect('login');
		} else {
			if ($remember) {
				$this->_set_cookie();
			}

			$id              = $arr_user->row()->id;
			$username        = $arr_user->row()->username;
			$name            = $arr_user->row()->name;
			$is_active       = $arr_user->row()->is_active;
			$profile_picture = $arr_user->row()->profile_picture;

			$this->session->set_userdata([
				SESI . 'id'              => $id,
				SESI . 'username'        => $username,
				SESI . 'name'            => $name,
				SESI . 'is_active'       => $is_active,
				SESI . 'profile_picture' => $profile_picture,
			]);
			redirect('dashboard');
		}
	}

	public function logout(): void
	{
		delete_cookie(KUE);
		$data = [
			SESI . 'id',
			SESI . 'username',
			SESI . 'name',
			SESI . 'is_active',
			SESI . 'profile_picture',
		];
		$this->session->unset_userdata($data);
		$this->session->set_flashdata('logout', 'Logout Success');
		redirect('login');
	}

	public function _set_cookie(): string
	{
		$key_cookies = random_string('alnum', 64);
		set_cookie(KUE, $key_cookies, 86400);
		return $key_cookies;
	}

	public function _set_session($id, $username, $name, $cookies, $is_active, $profile_picture): void
	{
		$data = [
			SESI . 'id'              => $id,
			SESI . 'username'        => $username,
			SESI . 'name'            => $name,
			SESI . 'is_active'       => $is_active,
			SESI . 'profile_picture' => $profile_picture,
		];
		$this->session->set_userdata($data);

		$data = [
			'cookies'    => $cookies,
			'updated_at' => $this->datetime,
		];
		$where = ['id' => $id];
		$this->M_core->update('admin', $data, $where);
	}

	public function _check_cookies($cookies): void
	{
		$where_cookies = [
			'cookies'    => $cookies,
			'is_active'  => 'yes',
			'deleted_at' => null,
		];
		$check_cookies = $this->M_core->get('admin', '*', $where_cookies);

		if ($check_cookies->num_rows() == 1) {
			$id              = $check_cookies->row()->id;
			$username        = $check_cookies->row()->username;
			$name            = $check_cookies->row()->name;
			$is_active       = $check_cookies->row()->is_active;
			$profile_picture = base_url() . "public/img/pp/default_avatar.svg";

			$this->_set_session($id, $username, $name, $cookies, $is_active, $profile_picture);
			$this->session->set_flashdata('first_login', 'Login Success, Never share your Username and Password to the others');
			redirect('dashboard');
		} else {
			delete_cookie(KUE);
			redirect(site_url('logout'));
		}
	}

	public function _check_session()
	{
		$id       = $this->session->userdata(SESI . 'id');
		$username = $this->session->userdata(SESI . 'username');

		if (!$id && !$username) {
			return false;
		}

		$where = [
			'id'         => $id,
			'username'   => $username,
			'is_active'  => 'yes',
			'deleted_at' => null,
		];

		$count = $this->M_core->count('admin', $where);

		if ($count == 0) {
			return false;
		}

		return true;
	}
}
        
/* End of file  LoginController.php */
