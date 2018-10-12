<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoreboard_m extends CI_Model {
  public function solvers()
  {
    $this->db->select('users.id as id, users.score as score, fullname');
    $this->db->select_max('solvers.created_at');
    $this->db->from('solvers');
    $this->db->join('challenges', 'solvers.chall_id = challenges.id');
    $this->db->join('users', 'solvers.user_id = users.id');
    $this->db->where('users.visible', '1');
    $this->db->group_by('fullname');
    $this->db->order_by('score', 'DESC');
    $this->db->order_by('created_at', 'ASC');
    $query = $this->db->get();
    return !empty($query)?$query->result_array():false;
  }
}
