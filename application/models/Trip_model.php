<?php

class Trip_model extends MY_Model {

  private $table = "trips";
  private $joinTable = array("travellers","trip_groups");

  function __construct()
  {
     parent::__construct($this->table);
  }

  function add_trip($data){
    $this->db->trans_start();
    $this->db->insert($this->table, $data[0]);
    $data[1]["trip_id"] = $this->db->insert_id();
    $this->db->insert($this->joinTable[1], $data[1]);
    $this->db->trans_complete();
  }

  function add_trip_group($data){
    $this->db->trans_start();
    $this->db->insert($this->joinTable[1], $data);
    $this->db->trans_complete();
  }
}
?>
