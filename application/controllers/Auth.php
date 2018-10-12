<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('auth_m');
		if ($this->session->has_userdata('ctfigniter')) {
			redirect(base_url());
		}
  }

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			if ($this->auth_m->login($email, $password) === TRUE) {
				$data = $this->auth_m->select_where($email);
				if ($data['verify'] > 0) {
					$sess = array(
						'user_id' => $data['id'],
						'email' => $data['email'],
						'level' => $data['level']
					);
					$this->session->set_userdata('ctfigniter', $sess);
					redirect(base_url('challenges'));
				} else {
					$this->session->set_flashdata('warning', 'Your account isn\'t verified, check your email');
					redirect(base_url('auth/login'));
				}
			} else {
				$this->session->set_flashdata('error', 'Username or password is incorrect');
				redirect(base_url('auth/login'));
			}
		} else {
			$data = array(
				'title' => $this->settings_m->web_title() . ' &raquo; Login',
				'web_title' => $this->settings_m->web_title(),
				'web_desc' => $this->settings_m->web_desc(),
				'page' 	=> 'auth/login',
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

	public function register()
	{
		$fullname = humanize($this->input->post('fullname'));
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[3]|max_length[20]|is_unique[users.fullname]|callback_fullname_check');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
		if ($this->form_validation->run() === TRUE) {
			if ($this->settings_m->registration() > 0) {
				if ($this->auth_m->register($fullname, $email, $password) === TRUE) {
					$this->session->set_flashdata('success', 'Your email confirmation has been sent');
					redirect(base_url('auth/login'));
				} else {
					$this->session->set_flashdata('error', 'Registration failed');
					redirect(base_url('auth/register'));
				}
			} else {
				$this->session->set_flashdata('error', 'Registration failed');
				redirect(base_url('auth/register'));
			}
		} else {
			$data = array(
				'title' => $this->settings_m->web_title() . ' &raquo; Register',
				'web_title' => $this->settings_m->web_title(),
				'web_desc' => $this->settings_m->web_desc(),
				'registration' => $this->settings_m->registration(),
				'page' 	=> 'auth/register',
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

	public function fullname_check($string)
	{
		if (preg_match('/^[a-zA-Z ]+$/i', $string)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('fullname_check', 'The {field} only allow characters with spaces');
			return FALSE;
		}
	}

	public function verify()
	{
		$token = $this->uri->segment(3);
		if (isset($token)) {
			$this->session->set_flashdata('token', $token);
			redirect(base_url('auth/verify'));
		}
		$token = $this->session->flashdata('token');
		$data = $this->auth_m->select_token($token);
		if (empty($data['email']) || $token == '') {
			$this->session->set_flashdata('error', 'Your email confirmation token is invalid');
			redirect(base_url('auth/login'));
		}

		if ($this->auth_m->verify($data['email'], $data['verify']) === TRUE) {
			$this->session->set_flashdata('success', 'Your email has been successfully verified');
			redirect(base_url('auth/login'));
		} else {
			$this->session->set_flashdata('warning', 'Your account has been verified');
			redirect(base_url('auth/login'));
		}
	}

	public function forgot()
	{
		$email = $this->input->post('email');
		$check = $this->auth_m->select_where($email);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() === TRUE) {
			if (!empty($check)) {
				if ($this->auth_m->forgot($check['email'], $check['fullname']) === TRUE) {
					$this->session->set_flashdata('success', 'Password reset confirmation has been sent');
					redirect(base_url('auth/forgot'));
				} else {
					$this->session->set_flashdata('error', 'Password reset confirmation failed to send');
					redirect(base_url('auth/forgot'));
				}
			} else {
				$this->session->set_flashdata('warning', 'Email not found');
				redirect(base_url('auth/forgot'));
			}
		} else {
			$data = array(
				'title' => $this->settings_m->web_title() . ' &raquo; Forgot Password',
				'web_title' => $this->settings_m->web_title(),
				'web_desc' => $this->settings_m->web_desc(),
				'page' 	=> 'auth/forgot',
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

	public function reset()
	{
		$token = $this->uri->segment(3);
		if (isset($token)) {
			$this->session->set_userdata('token', $token);
			redirect(base_url('auth/reset'));
		}
		$token = $this->session->userdata('token');
		$email = $this->auth_m->select_token($token)['email'];
		if (empty($email) || $token == '') {
			$this->session->set_flashdata('error', 'Your reset confirmation token is invalid');
			$this->session->unset_userdata('token');
			redirect(base_url('auth/login'));
		}
		$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
		if ($this->form_validation->run() === TRUE) {
			if ($this->auth_m->reset($email, $password) === TRUE) {
				$this->session->set_flashdata('success', 'Your password has been successfully changed');
				$this->session->unset_userdata('token');
				redirect(base_url('auth/login'));
			}
		} else {
			$data = array(
				'title' => $this->settings_m->web_title() . ' &raquo; Reset Password',
				'web_title' => $this->settings_m->web_title(),
				'web_desc' => $this->settings_m->web_desc(),
				'page' => 'auth/reset',
				'email' => $email,
				'csrf' => array(
					array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					)
				)
			);
			$this->parser->parse('layout', $data);
		}
	}
}
