<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
    parent::__construct();
		// $this->load->model('auth_m');
  }

	public function index()
	{
		$data = array(
			'title' => $this->settings_m->web_title(),
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'dashboard/home',
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
