<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model {

	var $category_name='';
	var $category_url='';
	var $category_desc='';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_all()
	{
		$query=$this->db->get('category');
		return $query;
	}	
	
	function add_new()
	{
		$this->db->set('category_name',$this->category_name);
		$this->db->set('category_url',$this->category_url);
		$this->db->set('category_desc',$this->category_desc);
		$this->db->insert('category');
	}
	
	function get_category($category_url)
	{
		$this->db->where('category_url',$category_url);
		$query=$this->db->get('category');
		if($query->num_rows<>0)
			return $query->row();
		else 
			return 'kosong';
	}
	
	function get_by_id($category_id)
	{
		$this->db->where('category_id',$category_id);
		$query=$this->db->get('category');
		return $query;
	}
	
	function update($category_id)
	{
		$queryget=$this->db->get_where('category',array('category_id'=>$category_id));
		$rowget=$queryget->row();
		
		$querycekpage=$this->db->get_where('the_page',array('the_page_link_to'=>'category/'.$rowget->category_url));
		$totalcekpage=$querycekpage->num_rows();
		if($totalcekpage<>0)
		{
			$rowcekpage=$querycekpage->row();
			
			$this->db->set('the_page_link_to','category/'.$this->category_url);
			$this->db->where('the_page_id',$rowcekpage->the_page_id);
			$this->db->update('the_page');
		}
		$this->db->set('category_name',$this->category_name);
		$this->db->set('category_url',$this->category_url);
		$this->db->set('category_desc',$this->category_desc);
		$this->db->where('category_id',$category_id);
		$this->db->update('category');
		
	}
	
	function delete($category_id)
	{
		$this->db->where('category_id',$category_id);
		$this->db->delete('category');
	}
	
	function search_item($keywords)
	{
		$this->db->like('category_name',$keywords);
		$query=$this->db->get('category');
		return $query;	
	}
	
}