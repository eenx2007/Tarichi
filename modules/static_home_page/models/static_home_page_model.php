<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Static_home_page_model extends CI_Model {

	function get_home()
	{
		$query=$this->db->get('static_home_page');
		return $query;	
	}

}