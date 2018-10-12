<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challenges_m extends CI_Model {
  public function challenges()
  {
    $this->db->select('challenges.id as id, category, challenges.title as title, challenges.score as score, challenges.created_at as publish, description, link, users.fullname as author');
    $this->db->from('challenges');
    $this->db->join('categories', 'challenges.category = categories.id');
    $this->db->join('users', 'challenges.author = users.id');
    $this->db->where('challenges.visible', '1');
    $this->db->order_by('category', 'ASC');
    $query = $this->db->get();
    return !empty($query)?$query->result_array():false;
  }
  public function categories()
  {
    $this->db->select('categories.id as id, categories.title as title');
    $this->db->from('challenges');
    $this->db->join('categories', 'challenges.category = categories.id');
    $this->db->where('challenges.visible', '1');
    $this->db->group_by('category');
    $this->db->order_by('category', 'ASC');
    $query = $this->db->get();
    return !empty($query)?$query->result_array():false;
  }
  public function solvers($chall, $user)
  {
    $this->db->select('*');
    $this->db->from('solvers');
    $this->db->join('challenges', 'solvers.chall_id = challenges.id');
    $this->db->join('users', 'solvers.user_id = users.id');
    $this->db->where('chall_id', $chall);
    $this->db->where('user_id', $user);
    $query = $this->db->get();
    return !empty($query)?$query->num_rows():false;
  }
}
