<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('admin_m');
		if (!$this->session->has_userdata('ctfigniter') || !$this->session->userdata('ctfigniter')['level'] > 0) {
			redirect(base_url());
		}
  }

	public function index()
	{
		redirect(base_url('admin/statistics'));
	}

	public function statistics()
	{
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo Admin',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'statistics',
			'users' => $this->admin_m->statistics('users'),
			'challenges' => $this->admin_m->statistics('challenges'),
			'categories' => $this->admin_m->statistics('categories'),
			'solvers' => $this->admin_m->statistics('solvers'),
		);
		$this->parser->parse('admin/layout', $data);
	}

	public function challenges()
	{
		$new = date('Y-m-d H:i:s');
		$new = str_replace('-', '/', $new);
		$new = date('Y-m-d H:i:s',strtotime($new . "-2 days"));
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo Admin',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' => 'challenges',
			'data' => $this->admin_m->challenges(),
			'categories' => $this->admin_m->categories(),
			'new' => $new,
			'csrf' => array(
				array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				)
			)
		);
		$this->parser->parse('admin/layout', $data);
	}

	public function add_challenge()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required|is_unique[challenges.title]');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('flag', 'Flag', 'trim|required|is_unique[challenges.flag]');
		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		$this->form_validation->set_rules('score', 'Score', 'trim|required');
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'flag' => $this->input->post('flag'),
				'link' => $this->input->post('link'),
				'score' => $this->input->post('score'),
				'category' => $this->input->post('category'),
				'author' => $this->session->userdata('ctfigniter')['user_id']
			);
			if ($this->admin_m->add_challenge($data) === TRUE) {
				$this->session->set_flashdata('success', 'Challenge was successfully added');
				redirect(base_url('admin/challenges'));
			}
		} else {
			redirect(base_url('admin/challenges'));
		}
	}

	public function edit_challenge($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('flag', 'Flag', 'trim|required');
		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		$this->form_validation->set_rules('score', 'Score', 'trim|required');
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'flag' => $this->input->post('flag'),
				'link' => $this->input->post('link'),
				'score' => $this->input->post('score'),
				'category' => $this->input->post('category')
			);
			if ($this->admin_m->edit_challenge($data, $id) === TRUE) {
				$this->session->set_flashdata('success', 'Challenge was successfully updated');
				redirect(base_url('admin/challenges'));
			}
		} else {
			redirect(base_url('admin/challenges'));
		}
	}

	public function categories()
	{
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo Admin',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'categories',
			'data' => $this->admin_m->categories(),
			'csrf' => array(
				array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				)
			)
		);
		$this->parser->parse('admin/layout', $data);
	}

	public function add_category() {
		$title = $this->input->post('title');
		$this->form_validation->set_rules('title', 'Category', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			if ($this->admin_m->add_category($title)) {
				$this->session->set_flashdata('success', 'Category was successfully added');
				redirect(base_url('admin/categories'));
			}
		} else {
			redirect(base_url('admin/categories'));
		}
	}

	public function edit_category($id) {
		$title = $this->input->post('title');
		$this->form_validation->set_rules('title', 'Category', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			if ($this->admin_m->edit_category($title, $id)) {
				$this->session->set_flashdata('success', 'Category has been updated');
				redirect(base_url('admin/categories'));
			}
		} else {
			redirect(base_url('admin/categories'));
		}
	}

	public function users()
	{
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo Admin',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'users',
			'data' => $this->admin_m->users(),
			'csrf' => array(
				array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				)
			)
		);
		$this->parser->parse('admin/layout', $data);
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

	public function add_user()
	{
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[3]|max_length[20]|is_unique[users.fullname]|callback_fullname_check');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'fullname' => humanize($this->input->post('fullname')),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			);
			if ($this->admin_m->add_user($data) === TRUE) {
				$this->session->set_flashdata('success', 'User was successfully added');
				redirect(base_url('admin/users'));
			}
		} else {
			redirect(base_url('admin/users'));
		}
	}

	public function edit_user($id)
	{
		if (empty($this->input->post('password'))) {
			$password = $this->admin_m->select_where('users', ['id'=>$id])['password'];
		} else {
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[3]|max_length[20]|callback_fullname_check');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('level', 'Level', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'fullname' => humanize($this->input->post('fullname')),
				'email' => $this->input->post('email'),
				'password' => $password,
				'level' => $this->input->post('level')
			);
			if ($this->admin_m->edit_user($data, $id) === TRUE) {
				$this->session->set_flashdata('success', 'User was successfully updated');
				redirect(base_url('admin/users'));
			}
		} else {
			redirect(base_url('admin/users'));
		}
	}

	public function settings()
	{
		$data = array(
			'title' => $this->settings_m->web_title() . ' &raquo Admin',
			'web_title' => $this->settings_m->web_title(),
			'web_desc' => $this->settings_m->web_desc(),
			'page' 	=> 'settings',
			'data' => $this->admin_m->settings(),
			'chall' => $this->admin_m->select('challenges')['visible'],
			'csrf' => array(
				array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				)
			)
		);
		$this->parser->parse('admin/layout', $data);
	}

	public function setting_website()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description')
			);
			if ($this->admin_m->setting_website($data) === TRUE) {
				$this->session->set_flashdata('success', 'Website configuration was successfully updated');
				redirect(base_url('admin/settings'));
			}
		} else {
			redirect(base_url('admin/settings'));
		}
	}

	public function setting_email()
	{
		$this->form_validation->set_rules('host', 'SMTP Host', 'trim|required');
		$this->form_validation->set_rules('port', 'SMTP Port', 'trim|required');
		$this->form_validation->set_rules('user', 'SMTP User', 'trim|required');
		$this->form_validation->set_rules('pass', 'SMTP Pass', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'smtp_host' => $this->input->post('host'),
				'smtp_port' => $this->input->post('port'),
				'smtp_user' => $this->input->post('user'),
				'smtp_pass' => $this->input->post('pass')
			);
			if ($this->admin_m->setting_email($data) === TRUE) {
				$this->session->set_flashdata('success', 'Email configuration was successfully updated');
				redirect(base_url('admin/settings'));
			}
		} else {
			redirect(base_url('admin/settings'));
		}
	}

	public function stop_chal($value)
	{
		if ($this->admin_m->stop('challenges', ['visible'=>$value]) === TRUE) {
			redirect(base_url('admin/settings'));
		} else {
			redirect(base_url('admin/settings'));
		}
	}

	public function stop_registration($value)
	{
		if ($this->admin_m->stop('settings', ['registration'=>$value]) === TRUE) {
			redirect(base_url('admin/settings'));
		} else {
			redirect(base_url('admin/settings'));
		}
	}

	public function show_chal($value, $id)
	{
		if ($this->admin_m->visible('challenges', $value, $id) === TRUE) {
			redirect(base_url('admin/challenges'));
		} else {
			redirect(base_url('admin/challenges'));
		}
	}

	public function show_user($value, $id)
	{
		if ($this->admin_m->visible('users', $value, $id) === TRUE) {
			redirect(base_url('admin/users'));
		} else {
			redirect(base_url('admin/users'));
		}
	}
}
