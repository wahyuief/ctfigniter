<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities_m extends CI_Model {
  public function activities()
  {
    $this->db->select('users.id as id, fullname, title, challenges.score as score, solvers.created_at as solved_time');
    $this->db->from('solvers');
    $this->db->join('challenges', 'solvers.chall_id = challenges.id');
    $this->db->join('users', 'solvers.user_id = users.id');
    $this->db->where('users.visible', '1');
    $this->db->order_by('solved_time', 'DESC');
    $this->db->limit('17');
    $query = $this->db->get();
    return !empty($query)?$query->result_array():false;
  }
}
