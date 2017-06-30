<?php

class MY_Model extends CI_Model {
  private $table;

  function __construct($tablename)
  {
    $this->table = $tablename;
  }


  public function add_data($data){
    $this->db->insert($this->table, $data);
  }

  public function update_data($id, $data){
    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
    // echo $this->db->last_query();die();
  }

  public function delete_by_id($id){
    $this->db->where('id', $id);
    $this->db->delete($this->table);
  }

  public function get_all($asArray=FALSE){
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  public function get_by_id($id, $asArray=FALSE){
    $this->db->where('id', $id);
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  public function get_by_multi_id($data_id, $asArray=FALSE){
    $this->db->where_in('id', $data_id);
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  public function get_by_column($columns, $data, $asArray=FALSE){
    $where_sql = "";
    foreach ($columns as $key => $value) {
      if($key > 0)
          $where_sql .= " OR ";
      $where_sql .= $value." = '".$data[$value]."'";
    }
    $this->db->where($where_sql);
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  public function get_by_keys($columns, $data, $asArray=FALSE){
    $where_sql = "";
    foreach ($columns as $key => $value) {
      if($key > 0)
          $where_sql .= " AND ";
      $where_sql .= $value." = '".$data[$value]."'";
    }
    $this->db->where($where_sql);
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

}
