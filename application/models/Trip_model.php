<?php

class Trip_model extends MY_Model {

  private $table = "trips";
  private $joinTable = array("travellers","trip_groups","users");

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

  function get_all_trip($asArray=FALSE){
    $this->db->select('trips.*, travellers.image, travellers.phone_number, users.id as traveller_id, users.fullname');
    $this->db->where("role = 1 AND trips.isActive = 1 AND trips.isPublic = 1");
    $this->db->join($this->joinTable[1], $this->table.'.id = '.$this->joinTable[1].".trip_id", 'left');
    $this->db->join($this->joinTable[0], $this->joinTable[0].'.user_id = '.$this->joinTable[1].".traveller_id", 'left');
    $this->db->join($this->joinTable[2], $this->joinTable[1].'.traveller_id = '.$this->joinTable[2].".id", 'left');
    $query = $this->db->get($this->table);
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  function get_all_my_trip($traveller_id,$asArray=FALSE){
    $this->db->select('trips.*, travellers.image, travellers.phone_number,users.id as traveller_id, users.fullname');
    $this->db->where("role = 1 AND (traveller_id = ".$traveller_id
                    ." OR trip_id IN (select trip_id from trip_groups where traveller_id = ".$traveller_id."))");
    $this->db->join($this->joinTable[1], $this->table.'.id = '.$this->joinTable[1].".trip_id", 'left');
    $this->db->join($this->joinTable[0], $this->joinTable[0].'.user_id = '.$this->joinTable[1].".traveller_id", 'left');
    $this->db->join($this->joinTable[2], $this->joinTable[1].'.traveller_id = '.$this->joinTable[2].".id", 'left');
    $query = $this->db->get($this->table);
    // echo $this->db->last_query();die();
    if($asArray)
      return $query->result_array();
    return $query->result();
  }

  function search_trip($destination_id=NULL, $budget=0, $day=NULL,$asArray=FALSE){
    $where_query = "";
    if($destination_id){
      $where_query .= " AND destination_id IN (".implode(",",$destination_id).")";
    }
    if($budget==1){
      $where_query .= " AND budget < 100000 ";
    }
    if($budget==2){
      $where_query .= " AND (budget > 100000 AND budget < 500000) ";
    }
    if($budget==3){
      $where_query .= " AND (budget > 500000 AND budget < 1000000) ";
    }
    if($budget==4){
      $where_query .= " AND budget > 1000000 ";
    }
    if($day){
      $day -=1;
      if($day>3)
        $where_query .= " AND DATEDIFF(end_at,start_at) > ".$day;
      else
        $where_query .= " AND DATEDIFF(end_at,start_at) = ".$day;
    }
    $this->db->select('trips.*, travellers.image, travellers.phone_number,users.id as traveller_id, users.fullname');
    $this->db->where("role = 1 AND trips.isActive = 1 AND trips.isPublic = 1 ".$where_query);
    $this->db->join($this->joinTable[1], $this->table.'.id = '.$this->joinTable[1].".trip_id", 'left');
    $this->db->join($this->joinTable[0], $this->joinTable[0].'.user_id = '.$this->joinTable[1].".traveller_id", 'left');
    $this->db->join($this->joinTable[2], $this->joinTable[1].'.traveller_id = '.$this->joinTable[2].".id", 'left');
    $query = $this->db->get($this->table);
    // echo $this->db->last_query();die();
    if($asArray)
      return $query->result_array();
    return $query->result();
  }
}
?>
