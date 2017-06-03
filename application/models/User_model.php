<?php

class User_model extends MY_Model {

  private $table = "users";

  function __construct()
  {
     parent::__construct($this->table);
  }


}
