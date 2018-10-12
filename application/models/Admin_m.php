<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {
  public function select($table) {
    $this->db->limit(1);
    $query = $this->db->get($table);
    return !empty($query)?$query->row_array():false;
  }
  public function select_where($table, $where) {
    $query = $this->db->get_where($table, $where);
    return !empty($query)?$query->row_array():false;
  }
  public function statistics($table)
  {
    $query = $this->db->get($table);
    return !empty($query)?$query->num_rows():false;
  }
  public function challenges()
  {
    $this->db->select('challenges.id as id, challenges.title as title, description, flag, link, score, challenges.category as cat_id, challenges.visible as visible, challenges.created_at as publish, categories.title as category');
    $this->db->from('challenges');
    $this->db->join('categories', 'challenges.category = categories.id');
    $this->db->order_by('category', 'ASC');
    $query = $this->db->get();
    return !empty($query)?$query->result_array():false;
  }
  public function add_challenge($data)
  {
    if ($this->db->insert('challenges', $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function edit_challenge($data, $id)
  {
    if ($this->db->update('challenges', $data, ['id'=>$id])) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function categories()
  {
    $this->db->order_by('title', 'ASC');
    $query = $this->db->get('categories');
    return !empty($query)?$query->result_array():false;
  }
  public function add_category($title)
  {
    if ($this->db->insert('categories', ['title'=>$title])) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function edit_category($title, $id)
  {
    if ($this->db->update('categories', ['title'=>$title], ['id'=>$id])) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function users()
  {
    $this->db->order_by('fullname', 'ASC');
    $query = $this->db->get('users');
    return !empty($query)?$query->result_array():false;
  }
  public function add_user($data)
  {
    if ($this->db->insert('users', $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function edit_user($data, $id)
  {
    if ($this->db->update('users', $data, ['id'=>$id])) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function settings()
  {
    $this->db->limit(1);
    $query = $this->db->get('settings');
    return !empty($query)?$query->result_array():false;
  }
  public function setting_website($data)
  {
    if ($this->db->update('settings', $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function setting_email($data)
  {
    if ($this->db->update('settings', $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function visible($table, $value, $id = NULL)
  {
    if ($this->db->update($table, ['visible'=>$value], ['id'=>$id])) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function stop($table, $value)
  {
    if ($this->db->update($table, $value)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
}
