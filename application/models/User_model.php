<?php

class User_model extends MY_Model {

  private $table = "users";

  function __construct()
  {
     parent::__construct($this->table);
  }

  public function hidemypassword($password){
    return md5($this->config->item('salt').$password);
  }

  public function authentication($username, $password){
    $this->db->where("username = '".$username."' and password ='".$password."'");
    $query = $this->db->get($this->table);
    return $query->result();
  }


}
