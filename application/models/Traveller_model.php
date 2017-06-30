<?php

class Traveller_model extends MY_Model {

  private $table = "travellers";

  function __construct()
  {
     parent::__construct($this->table);
  }
}
?>
