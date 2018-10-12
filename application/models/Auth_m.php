<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends CI_Model {
  function email_config() {
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => $this->settings_m->email()['smtp_host'],
      'smtp_port' => $this->settings_m->email()['smtp_port'],
      'smtp_user' => $this->settings_m->email()['smtp_user'],
      'smtp_pass' => $this->settings_m->email()['smtp_pass'],
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );
    return $config;
  }
  public function login($email, $password) {
    $query = $this->db->get_where('users', ['email'=>$email], 1);
    $data = $query->row_array();
    if ($query->num_rows() > 0) {
      if (password_verify($password, $data['password']) === TRUE) {
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }
  public function register($fullname, $email, $password) {
    $data = array(
      'fullname' => $fullname,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT),
      'token' => sha1(mt_rand())
    );
    $this->load->library('email', $this->email_config());
    $this->email->set_newline("\r\n");
    $this->email->from('ctf@vulner.id', 'Vulner.CTF');
    $this->email->to($data['email']);
    $this->email->subject('Email Confirmation');
    $data_email = array(
      'website' => $this->settings_m->web_title(),
      'title' => 'Email Confirmation',
      'fullname' => $data['fullname'],
      'token' => $data['token'],
    );
    $message = $this->load->view('email_verify', $data_email, TRUE);
    $this->email->message($message);
    if ($this->email->send()) {
      $this->db->insert('users', $data);
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function select_where($email) {
    $query = $this->db->get_where('users', ['email'=>$email], 1);
    return !empty($query)?$query->row_array():false;
  }
  public function select_token($token) {
    $query = $this->db->get_where('users', ['token'=>$token], 1);
    return !empty($query)?$query->row_array():false;
  }
  public function verify($email, $verify) {
    if ($this->db->update('users', ['verify'=>'1'], ['email'=>$email])) {
      if ($verify < 1) {
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }
  public function forgot($email, $fullname) {
    $token = sha1(mt_rand());
    $this->load->library('email', $this->email_config());
    $this->email->set_newline("\r\n");
    $this->email->from('ctf@vulner.id', 'Vulner.CTF');
    $this->email->to($email);
    $this->email->subject('Password Reset');
    $data = array(
      'website' => $this->settings_m->web_title(),
      'title' => 'Password Reset',
      'fullname' => $fullname,
      'token' => $token,
    );
    $message = $this->load->view('email_reset', $data, TRUE);
    $this->email->message($message);

    if ($this->email->send()) {
      $this->db->update('users', ['token'=>$token], ['email'=>$email]);
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function reset($email, $password) {
    $token = sha1(mt_rand());
    if ($this->db->update('users', ['password'=>$password], ['email'=>$email])) {
      $this->db->update('users', ['token'=>$token], ['email'=>$email]);
      return TRUE;
    } else {
      return FALSE;
    }
  }
}
