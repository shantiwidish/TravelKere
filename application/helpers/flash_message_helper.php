<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function set_message_error($text){
  $CI = & get_instance();
  $CI->session->set_flashdata('message_error', $text);
}

function get_message_error(){
  $CI = & get_instance();
  $message = $CI->session->flashdata('message_error');

  if($message!=NULL){
    echo "<div class='box box-default'>
    <div class='box-header with-border bg-red'>
      <h3 class='box-title'>
        <p>".$message."</p>
      </h3>
      <div class='box-tools pull-right'>
        <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
        <button type='button' class='btn btn-box-tool' data-widget='remove'><i class='fa fa-remove'></i></button>
      </div>
    </div>
  </div>";
  }
}
