<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class The_page_model extends CI_Model {

    var $the_page_title='';
	var $the_page_title_url='';
	var $the_page_menu='';
	var $the_page_content='';
	var $the_page_last_edit='';
	var $the_page_type_id='';
	var $the_page_link_to='';
	var $the_page_parent='';
	var $the_page_enabled='';
	var $the_page_order='';
	var $the_page_type_name='';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_new()
	{
		$this->db->set('the_page_title',$this->the_page_title);
		$this->db->set('the_page_title_url',$this->the_page_title_url);
		$this->db->set('the_page_menu',$this->the_page_menu);
		$this->db->set('the_page_content',$this->the_page_content);
		$this->db->set('the_page_last_edit',$this->the_page_last_edit);
		$this->db->set('the_page_type_id',$this->the_page_type_id);
		$this->db->set('the_page_link_to',$this->the_page_link_to);
		$this->db->set('the_page_parent',$this->the_page_parent);
		$this->db->set('the_page_enabled',$this->the_page_enabled);
		$this->db->set('the_page_order',$this->the_page_order);
		$this->db->insert('the_page');
	}
	
	function edit($the_page_id)
	{
		$this->db->set('the_page_title',$this->the_page_title);
		$this->db->set('the_page_title_url',$this->the_page_title_url);
		$this->db->set('the_page_menu',$this->the_page_menu);
		$this->db->set('the_page_content',$this->the_page_content);
		$this->db->set('the_page_last_edit',$this->the_page_last_edit);
		$this->db->set('the_page_type_id',$this->the_page_type_id);
		$this->db->set('the_page_link_to',$this->the_page_link_to);
		$this->db->set('the_page_parent',$this->the_page_parent);
		$this->db->set('the_page_enabled',$this->the_page_enabled);
		$this->db->where('the_page_id',$the_page_id);
		$this->db->update('the_page');
	}
	
	function show_parent_menu()
	{
		$this->db->where('the_page_enabled',1);
		$this->db->where('the_page_parent',0);
		$this->db->order_by('the_page_order');
		$query=$this->db->get('the_page');
		return $query->result();
	}
	
	function show_child_menu($parent_id)
	{
		$this->db->where('the_page_enabled',1);
		$this->db->where('the_page_parent',$parent_id);
		$this->db->order_by('the_page_order');
		$query=$this->db->get('the_page');
		return $query;
	}
	
	function get_all()
	{
		$this->db->order_by('the_page.the_page_order');
		$this->db->join('the_page_type','the_page_type.the_page_type_id=the_page.the_page_type_id');
		$query=$this->db->get('the_page');
		return $query;
	}
	
	function get_just_parent()
	{
		$this->db->where('the_page.the_page_parent',0);
		$this->db->order_by('the_page.the_page_order');
		$this->db->join('the_page_type','the_page_type.the_page_type_id=the_page.the_page_type_id');
		$query=$this->db->get('the_page');
		return $query;
	}
	
	function get_by_parent($the_page_id)
	{
		$this->db->where('the_page.the_page_parent',$the_page_id);
		$this->db->order_by('the_page.the_page_order');
		$this->db->join('the_page_type','the_page_type.the_page_type_id=the_page.the_page_type_id');
		$query=$this->db->get('the_page');
		return $query;
	}
	
	function get_page_type()
	{
		$query=$this->db->get('the_page_type');
		return $query;
	}
	
	function get_parent()
	{
		$this->db->order_by('the_page_parent');
		$query=$this->db->get('the_page');
		return $query;
	}
	
	function get_page($the_page_title_url)
	{
		$this->db->where('the_page_title_url',$the_page_title_url);
		$query=$this->db->get('the_page');
		return $query;
	}
	
	function get_page_by_id($the_page_id)
	{
		$this->db->where('the_page_id',$the_page_id);
		$query=$this->db->get('the_page');
		return $query;
	}
	
	function get_detail($the_page_id)
	{
		$this->db->where('the_page_id',$the_page_id);
		$query=$this->db->get('the_page');
		return $query->row();
	}
	
	function update_order($the_page_id)
	{
		$this->db->set('the_page_order',$this->the_page_order);
		$this->db->where('the_page_id',$the_page_id);
		$this->db->update('the_page');
	}
	
	function delete($the_page_id)
	{
		$querycek=$this->db->get_where('the_page',array('the_page_id'=>$the_page_id));
		$rowcek=$querycek->row();
		$order_no=$rowcek->the_page_order;
		
		$this->db->where('the_page_parent',$rowcek->the_page_parent);
		$queryall=$this->db->get('the_page');
		$totalall=$queryall->num_rows;
		$startno=$order_no+1;
		if($order_no<>$totalall)
		{
			for($i=$startno;$i<=$totalall;$i++)
			{
				$this->db->set('the_page_order',$i-1);
				$this->db->where('the_page_order',$i);
				$this->db->where('the_page_parent',$rowcek->the_page_parent);
				$this->db->update('the_page');
			}
		}
		
		$this->db->where('the_page_id',$the_page_id);
		$this->db->delete('the_page');
		
		
	}
	
	function enabling($the_page_id,$the_page_enabled)
	{
		$this->db->set('the_page_enabled',$the_page_enabled);
		$this->db->where('the_page_id',$the_page_id);
		$this->db->update('the_page');	
	}
    
   

}