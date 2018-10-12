<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challenges extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('challenges_m');
		if (!$this->session->has_userdata('ctfigniter')) {
			redirect(base_url('auth/login'));
		}
  }

	public function index()
	{
		$new = date('Y-m-d H:i:s');
		$new = str_replace('-', '/', $new);
		$new = date('Y-m-d H:i:s',strtotime($new . "-2 days"));
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo; Challenges',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'dashboard/challenges',
			'challenges' => $this->challenges_m->challenges(),
			'categories' => $this->challenges_m->categories(),
			'new' => $new,
			'csrf' 	=> array(
				array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				)
			)
		);
		$this->parser->parse('layout', $data);
	}
}
