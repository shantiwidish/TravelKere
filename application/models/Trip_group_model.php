<?php

class Trip_group_model extends MY_Model {

  private $table = "trip_groups";
  private $joinTable = array("travellers","trips","users");

  function __construct()
  {
     parent::__construct($this->table);
  }

  function get_groups_by_trip($trip_id, $asArray=FALSE){
    $this->db->select('trip_groups.*, travellers.image, users.id as traveller_id, users.fullname');
    $this->db->where($this->table.".trip_id = ".$trip_id);
    $this->db->join($this->joinTable[0], $this->table.'.traveller_id = '.$this->joinTable[0].".user_id", 'left');
    $this->db->join($this->joinTable[2], $this->table.'.traveller_id = '.$this->joinTable[2].".id", 'left');
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  function get_trip_group($trip_id, $traveller_id, $asArray=FALSE){
    $this->db->where("trip_id = ".$trip_id." AND traveller_id=".$traveller_id);
    $this->db->join($this->joinTable[1], $this->table.'.trip_id = '.$this->joinTable[1].".id", 'left');
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  function cancel_trip($trip_id, $traveller_id){
    $this->db->where("trip_id = ".$trip_id." AND traveller_id=".$traveller_id);
    $this->db->delete($this->table);
  }
}
?>
