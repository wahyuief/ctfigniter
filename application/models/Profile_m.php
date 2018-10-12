<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_m extends CI_Model {
  public function select_where($id) {
    $query = $this->db->get_where('users', ['id'=>$id], 1);
    return !empty($query)?$query->row_array():false;
  }
  public function solvers($id)
  {
    $this->db->select('solvers.created_at as solved_time, score, title');
    $this->db->from('solvers');
    $this->db->join('challenges', 'solvers.chall_id = challenges.id');
    $this->db->where('user_id', $id);
    $this->db->order_by('solved_time', 'DESC');
    $query = $this->db->get();
    return !empty($query)?$query->result_array():false;
  }
}
