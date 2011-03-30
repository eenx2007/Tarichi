<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imglib_model extends CI_Model {

	var $img_name='';
	var $img_name_thumb='';
	var $img_title='';
	var $img_desc='';
	var $img_file_type='';
	var $img_file_size='';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_image()
	{
		$this->db->set('img_name',$this->img_name);
		$this->db->set('img_name_thumb',$this->img_name_thumb);
		$this->db->set('img_file_type',$this->img_file_type);
		$this->db->set('img_file_size',$this->img_file_size);
		$this->db->insert('img_lib');
	}
	
	function get_by_thumb($img_name_thumb)
	{
		$this->db->where('img_name_thumb',$img_name_thumb);
		$query=$this->db->get('img_lib');
		return $query->row();
	}
}