<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flag extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('flag_m');
		if (!$this->session->has_userdata('ctfigniter')) {
			redirect(base_url('auth/login'));
		}
  }

	public function verify($id)
	{
		if (empty($id)) {
			redirect(base_url('challenges'));
		} else if ($this->flag_m->select_where($id) < 1) {
			redirect(base_url('challenges'));
		}
		$flag = $this->input->post('flag');
		$user = $this->session->userdata('ctfigniter')['user_id'];
		$verify = $this->flag_m->verify($id, $flag, $user);
		if ($verify === FALSE) {
			$this->session->set_flashdata('error', 'Flag is incorrect');
			redirect(base_url('challenges'));
		} else if ($verify === 'HAVE') {
			$this->session->set_flashdata('warning', 'Your have been solved this challenge');
			redirect(base_url('challenges'));
		} else if ($verify === TRUE) {
			$this->session->set_flashdata('success', 'Flag is correct');
			redirect(base_url('challenges'));
		} else {
			$this->session->set_flashdata('error', 'Error');
			redirect(base_url('challenges'));
		}

	}

}
