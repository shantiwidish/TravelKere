<?php

class User_model extends MY_Model {

  private $table = "users";
  private $joinTable = array("travellers","administrators");

  function __construct()
  {
     parent::__construct($this->table);
  }

  public function hidemypassword($password){
    return md5($this->config->item('salt').$password);
  }

  public function authentication($username, $password){
    $this->db->where("isActive = 1 and username = '".$username."' and password ='".$password."'");
    $this->db->join($this->joinTable[0], $this->table.'.id = '.$this->joinTable[0].".user_id", 'left');
    $this->db->join($this->joinTable[1], $this->table.'.id = '.$this->joinTable[1].".user_id", 'left');
    $query = $this->db->get($this->table);
    // echo $this->db->last_query();die();
    return $query->result();
  }

  public function checkIfAdmin($user_id){
    $this->db->where("user_id = ".$user_id);
    $query = $this->db->get($this->joinTable[1]);
    // echo $this->db->last_query();die();
    return $query->result();
  }

  public function add_user($data, $isAdmin = 0){
    $this->db->trans_start();
    $this->db->insert($this->table, $data[0]);
    $data[1]["user_id"] = $this->db->insert_id();
    $this->db->insert($this->joinTable[$isAdmin], $data[1]);
    $this->db->trans_complete();
  }

  public function update_user($id, $data, $isAdmin = 0){
    $this->db->trans_start();
    $this->db->where('user_id', $id);
    $this->db->update($this->joinTable[$isAdmin], $data);
    $this->db->trans_complete();
  }

  public function delete_user($id, $isAdmin = 0){
    $this->db->where('user_id', $id);
    $this->db->delete($this->joinTable[$isAdmin]);
  }

  public function get_traveller_by_id($id, $asArray=FALSE){
    $this->db->where('id', $id);
    $this->db->join($this->joinTable[0], $this->table.'.id = '.$this->joinTable[0].".user_id");
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

}
