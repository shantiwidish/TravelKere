<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_input($form_data, $key, $options){
  if(isset($form_data))
    echo "value='".$form_data['username']."' ";
  foreach ($options as $key => $value) {
    echo $value;
  }
}
