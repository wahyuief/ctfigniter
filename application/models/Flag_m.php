<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flag_m extends CI_Model {
  public function select_where($id) {
    $query = $this->db->get_where('challenges', ['id'=>$id], 1);
    return !empty($query)?$query->num_rows():false;
  }
  public function verify($id, $flag, $user) {
    $this->db->select('flag, challenges.score as chall_score, users.score as user_score');
    $this->db->from('solvers');
    $this->db->join('challenges', 'solvers.chall_id = challenges.id');
    $this->db->join('users', 'solvers.user_id = users.id');
    $this->db->where('challenges.id', $id);
    $this->db->where('challenges.flag', $flag);
    $this->db->where('challenges.visible', '1');
    $this->db->where('users.id', $user);
    $solvers = $this->db->get();
    $challenges = $this->db->get_where('challenges', ['id'=>$id, 'flag'=>$flag], 1);
    $users = $this->db->get_where('users', ['id'=>$user], 1);
    $chall_score = $challenges->row_array()['score'];
    $get_score = $chall_score + $users->row_array()['score'];
    if ($solvers->num_rows() < 1) {
      if ($challenges->num_rows() > 0) {
        $this->db->insert('solvers', ['user_id'=>$user, 'chall_id'=>$id]);
        $this->db->update('users', ['score'=>$get_score], ['id'=>$user]);
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return HAVE;
    }
  }
}
