<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TravelApi{

  protected $_ci;                 // CodeIgniter instance
  protected $_base_url;

  function __construct($params = null)
	{
		$this->_ci = & get_instance();
    $this->_ci->load->library('curl');
    if($params != null)
      $this->_base_url = $params['url'];
	}

  function get_locations($path='/api/locations/'){
      return $this->_ci->curl->simple_get($this->_base_url.$path);
  }

  function get_search_locations($search_key, $path='/api/locations/search/'){
      return $this->_ci->curl->simple_get($this->_base_url.$path.$search_key);
  }

  function get_destinations($path='/api/destinations/'){
      return $this->_ci->curl->simple_get($this->_base_url.$path);
  }

  function get_search_destinations($seach_key, $path='/api/destinations/search/'){
      return $this->_ci->curl->simple_get($this->_base_url.$path.urlencode($search_key));
  }

  function get_destination_by_id($id, $path='/api/destinations/'){
      return $this->_ci->curl->simple_get($this->_base_url.$path.$id.".json");
  }

  function booked_trip($data, $path='/api/listed/'){
      return $this->_ci->curl->simple_post($this->_base_url.$path, $data, array(CURLOPT_BUFFERSIZE => 10));
  }

  function cancel_trip($id, $path='/api/schedules/'){
      return $this->_ci->curl->simple_delete($this->_base_url.$path.$id);
  }

}
