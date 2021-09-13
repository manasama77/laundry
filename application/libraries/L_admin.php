<?php
defined('BASEPATH') or exit('No direct script access allowed');

class L_admin
{

	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('M_core', 'mcore');
		$this->ci->load->helper(['cookie', 'string']);
	}

	public function render($data)
	{
		$check_cookies = $this->check_cookies();

		if ($check_cookies === TRUE) {
			$this->render_view($data);
		} else {
			$check_session = $this->check_session();

			if ($check_session === TRUE) {
				$this->render_view($data);
			} else {
				$this->reject();
			}
		}
	}

	public function check_cookies()
	{
		$cookies = get_cookie(KUE);

		if ($cookies === NULL) {
			return FALSE;
		} else {
			$where = [
				'cookies'    => $cookies,
				'is_active'  => 'yes',
				'deleted_at' => null,
			];
			$arr = $this->ci->mcore->get('admin', '*', $where);

			if ($arr->num_rows() == 1) {
				$id              = $arr->row()->id;
				$username        = $arr->row()->username;
				$name            = $arr->row()->name;
				$cookies_db      = $arr->row()->cookies;
				$is_active       = $arr->row()->is_active;
				$profile_picture = $arr->row()->profile_picture;

				if ($profile_picture == NULL) {
					$profile_picture = base_url('public/img/pp/default_avatar.svg');
				} else {
					$profile_picture = (is_file(FCPATH . 'public/img/pp/default_avatar.svg')) ? base_url('public/img/pp/default_avatar.svg') : $profile_picture;
				}

				if ($cookies == $cookies_db) {
					return $this->reset_session($id, $username, $name, $is_active, $profile_picture);
				}
				return FALSE;
			} else {
				return FALSE;
			}
		}
	}

	public function check_session()
	{
		$id              = $this->ci->session->userdata(SESI . 'id');
		$username        = $this->ci->session->userdata(SESI . 'username');
		$name            = $this->ci->session->userdata(SESI . 'name');
		$is_active       = $this->ci->session->userdata(SESI . 'is_active');
		$profile_picture = $this->ci->session->userdata(SESI . 'profile_picture');

		if ($id && $username && $name && $is_active) {
			if ($is_active == "yes") {
				return TRUE;
			} else {
				return false;
			}
		}
		return FALSE;
	}

	public function render_view($data)
	{
		if (file_exists(APPPATH . 'views/pages/admin/' . $data['content'] . '.php')) {
			$this->ci->load->view('layouts/admin/main', $data, FALSE);
		} else {
			show_404();
		}
	}

	public function reject()
	{
		$this->ci->session->set_flashdata('expired', 'Sesi berakhir');
		redirect('logout');
	}

	public function reset_session($id, $username, $name, $is_active, $profile_picture)
	{
		$this->ci->session->set_userdata(SESI . 'id', $id);
		$this->ci->session->set_userdata(SESI . 'username', $username);
		$this->ci->session->set_userdata(SESI . 'name', $name);
		$this->ci->session->set_userdata(SESI . 'is_active', $is_active);
		$this->ci->session->set_userdata(SESI . 'profile_picture', $profile_picture);

		return $this->check_session();
	}
}
                                                
/* End of file L_admin.php */
