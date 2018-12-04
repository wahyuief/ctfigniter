<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('profile_m');
  }

	public function index()
	{
		if (!$this->session->has_userdata('ctfigniter')) {
			redirect(base_url('auth/login'));
		}
		$id = $this->session->userdata('ctfigniter')['user_id'];
		$profile = $this->profile_m->select_where($id);
		$score = array();
		$table = '<tr><td>{title}</td><td>{solved_time}</td></tr>';
		$td = '';
		$solvers = $this->profile_m->solvers($id);
		if ($solvers) {
			foreach ($solvers as $row) {
				$score[] = $row['score'];
				$td .= $this->parser->parse_string($table, $row, TRUE);
			}
		}
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo Profile',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'dashboard/profile',
			'fullname' => $profile['fullname'],
			'email' => $profile['email'],
			'last_login' => $profile['last_login'],
			'solvers' => $td,
			'score' => array_sum($score),
			'csrf' 	=> array(
				array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				)
			)
		);
		$this->parser->parse('layout', $data);
	}

	public function edit()
	{
		if (!$this->session->has_userdata('ctfigniter')) {
			redirect(base_url('auth/login'));
		} else if (!$_POST) {
			show_404();
		}
		$id = $this->session->userdata('ctfigniter')['user_id'];
		if (empty($this->input->post('password'))) {
			$password = $this->profile_m->select_where($id)['password'];
		} else {
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[3]|max_length[20]|callback_fullname_check');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]');
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'fullname' => humanize($this->input->post('fullname')),
				'email' => $this->input->post('email'),
				'password' => $password
			);
			if ($this->profile_m->edit($data, $id) === TRUE) {
				$this->session->set_flashdata('success', 'Profile was successfully updated');
				redirect(base_url('profile'));
			}
		}
	}

	public function user($id)
	{
		$profile = $this->profile_m->select_where($id);
		if (empty($id)) {
			redirect(base_url('profile'));
		} else if (empty($profile)) {
			show_404();
		} else if ($profile['visible'] === '0') {
			show_404();
		}
		$score = array();
		$table = '<tr><td>{title}</td><td>{solved_time}</td></tr>';
		$td = '';
		$solvers = $this->profile_m->solvers($id);
		if ($solvers) {
			foreach ($solvers as $row) {
				$score[] = $row['score'];
				$td .= $this->parser->parse_string($table, $row, TRUE);
			}
		}
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo Profile',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'dashboard/profile',
			'fullname' => $profile['fullname'],
			'email' => $profile['email'],
			'last_login' => $profile['last_login'],
			'solvers' => $td,
			'score' => array_sum($score)
		);
		$this->parser->parse('layout', $data);
	}

	public function logout()
	{
		if (!$this->session->has_userdata('ctfigniter')) {
			redirect(base_url('auth/login'));
		}
		$id = $this->session->userdata('ctfigniter')['user_id'];
		$this->db->update('users', ['last_login'=>date('Y-m-d H:i:s')], ['id'=>$id]);
		$this->session->unset_userdata('ctfigniter');
		redirect(base_url('auth/login'));
	}

	public function fullname_check($string)
	{
		if (preg_match('/^[a-zA-Z ]+$/i', $string)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('fullname_check', 'The {field} only allow characters with spaces');
			return FALSE;
		}
	}
}
