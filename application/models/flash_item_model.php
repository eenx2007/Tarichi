<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Flash_item_model extends CI_Model {

    var $flash_item_title = '';
    var $flash_item_desc = '';
    var $flash_item_image = '';
	var $flash_item_link_to = '';
	var $flash_item_order = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all()
	{
		$this->db->order_by('flash_item_order');
		$query=$this->db->get('flash_item');
		return $query->result();
	}
    
   

}