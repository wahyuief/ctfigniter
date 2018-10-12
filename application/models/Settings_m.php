<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_m extends CI_Model {
  public function web_title() {
    $this->db->limit(1);
    $query = $this->db->get('settings');
    return !empty($query)?$query->row_array()['title']:false;
  }
  public function web_desc() {
    $this->db->limit(1);
    $query = $this->db->get('settings');
    return !empty($query)?$query->row_array()['description']:false;
  }
  public function email() {
    $this->db->limit(1);
    $query = $this->db->get('settings');
    return !empty($query)?$query->row_array():false;
  }
  public function registration() {
    $this->db->limit(1);
    $query = $this->db->get('settings');
    return !empty($query)?$query->row_array()['registration']:false;
  }
}
