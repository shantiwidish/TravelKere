<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TravelApi{

  protected $_ci;                 // CodeIgniter instance
  protected $_base_url;

  function __construct($url = '')
	{
		$this->_ci = & get_instance();
    $this->load->library('curl');
    if($url != '')
      $this->_base_url = $url;
	}

  function get_agents($path='/api/agents/'){
      return $this->curl->simple_get($this->_base_url.$path);
  }

  function get_agent_by_id($id, $path='/api/agents/'){
      return $this->curl->simple_get($this->_base_url.$path.$id.".json");
  }

  function get_destinations($path='/api/destinations/'){
      return $this->curl->simple_get($this->_base_url.$path);
  }

  function get_destination_by_id($id, $path='/api/destinations/'){
      return $this->curl->simple_get($this->_base_url.$path.$id.".json");
  }

  function get_schedules($path='/api/schedules/'){
      return $this->curl->simple_get($this->_base_url.$path);
  }

  function get_schedule_by_id($id, $path='/api/schedules/'){
      return $this->curl->simple_get($this->_base_url.$path.$id.".json");
  }

  function book_trip($data, $path='/api/schedules/'){
      return $this->curl->simple_post($this->_base_url.$path, $data, array(CURLOPT_BUFFERSIZE => 10));
  }

  function update_trip($id, $data, $path='/api/schedules/'){
      return $this->curl->simple_post($this->_base_url.$path.$id, $data, array(CURLOPT_BUFFERSIZE => 10));
  }

  function cancel_trip($id, $path='/api/schedules/'){
      return $this->curl->simple_delete($this->_base_url.$path.$id); 
  }

}
