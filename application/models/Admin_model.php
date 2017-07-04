<?php

class Admin_model extends MY_Model {

  private $table = "administrators";

  function __construct()
  {
     parent::__construct($this->table);
  }
}
?>
