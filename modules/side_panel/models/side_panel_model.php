<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Side_panel_model extends CI_Model {

	var $side_panel_type='';
	var $side_panel_title='';
	var $side_panel_status='';
	var $side_panel_config='';
	var $side_panel_order='';
	var $side_panel_position='';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_new($side_panel_status)
	{
		$this->db->where('side_panel_status',$side_panel_status);
		$querycek=$this->db->get('side_panel');
		$totalcek=$querycek->num_rows;
		$side_panel_order=$totalcek+1;
		$this->db->set('side_panel_type',$this->side_panel_type);
		$this->db->set('side_panel_title',$this->side_panel_title);
		$this->db->set('side_panel_order',$side_panel_order);
		$this->db->set('side_panel_status',$this->side_panel_status);
		$this->db->insert('side_panel');
		
	}
	
	function get_all($side_panel_status)
	{
		$this->db->order_by('side_panel_order');
		$this->db->where('side_panel_status',$side_panel_status);
		$query=$this->db->get('side_panel');
		return $query;
	}
	
	function get_by_id($side_panel_id)
	{
		$this->db->where('side_panel_id',$side_panel_id);
		$query=$this->db->get('side_panel');
		return $query->row();
	}
	
	function update_order($side_panel_id)
	{
		$this->db->set('side_panel_order',$this->side_panel_order);
		$this->db->where('side_panel_id',$side_panel_id);
		$this->db->update('side_panel');
	}
	
	function update_side_panel($side_panel_id)
	{
		$this->db->set('side_panel_title',$this->side_panel_title);
		$this->db->set('side_panel_config',$this->side_panel_config);
		$this->db->where('side_panel_id',$side_panel_id);
		$this->db->update('side_panel');
	}
	
	function delete_side_panel($side_panel_id)
	{
		$querycek=$this->db->get_where('side_panel',array('side_panel_id'=>$side_panel_id));
		$rowcek=$querycek->row();
		$order_no=$rowcek->side_panel_order;
		$side_panel_status=$rowcek->side_panel_status;
		$this->db->where('side_panel_status',$side_panel_status);
		$queryall=$this->db->get('side_panel');
		$totalall=$queryall->num_rows;
		$startno=$order_no+1;
		if($order_no<>$totalall)
		{
			for($i=$startno;$i<=$totalall;$i++)
			{
				$this->db->set('side_panel_order',$i-1);
				$this->db->where('side_panel_order',$i);
				$this->db->where('side_panel_status',$side_panel_status);
				$this->db->update('side_panel');
				
			}
		}
		$this->db->where('side_panel_id',$side_panel_id);
		$this->db->delete('side_panel');
	}

}