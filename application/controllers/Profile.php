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
			'score' => array_sum($score)
		);
		$this->parser->parse('layout', $data);
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
}
