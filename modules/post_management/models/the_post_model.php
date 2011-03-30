<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class The_post_model extends CI_Model {

	var $category_id='';
	var $the_post_title='';
	var $the_post_title_url='';
	var $the_post_content='';
	var $the_post_date='';
	var $the_post_day='';
	var $the_post_month='';
	var $the_post_year='';
	var $the_post_total_comment='';
	var $the_post_total_view='';
	var $user_id='';
	var $the_post_comment='';
	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_new()
	{
		$this->db->set('category_id',$this->category_id);
		$this->db->set('the_post_title',$this->the_post_title);
		$this->db->set('the_post_title_url',$this->the_post_title_url);
		$this->db->set('the_post_content',$this->the_post_content);
		$this->db->set('the_post_date',$this->the_post_date);
		$this->db->set('the_post_day',$this->the_post_day);
		$this->db->set('the_post_month',$this->the_post_month);
		$this->db->set('the_post_year',$this->the_post_year);
		$this->db->set('the_post_total_comment',$this->the_post_total_comment);
		$this->db->set('the_post_total_view',$this->the_post_total_view);
		$this->db->set('user_id',$this->user_id);
		$this->db->set('the_post_comment',$this->the_post_comment);
		$this->db->insert('the_post');
		return $this->db->insert_id();
	}
	
	function total_post_all()
	{
		$query=$this->db->get('the_post');
		return $query->num_rows;
	}
	
	function total_per_category_all($category_id)
	{
		$this->db->where('category_id',$category_id);
		$query=$this->db->get('the_post');
		return $query->num_rows;
	}
	
	function get_all($site_per_page_post=0,$start=0)
	{
		$this->db->limit($site_per_page_post,$start);
		$this->db->join('category','category.category_id=the_post.category_id');
		$this->db->order_by('the_post.the_post_date','DESC');
		$query=$this->db->get('the_post');
		return $query;
	}
	
	function get_all_panel()
	{
		
		$this->db->join('category','category.category_id=the_post.category_id');
		$this->db->order_by('the_post.the_post_date','DESC');
		$query=$this->db->get('the_post');
		return $query;
	}
	
	function read($year='',$month='',$day='',$url_title='')
	{
		$this->db->where('the_post_year',$year);
		$this->db->where('the_post_month',$month);
		$this->db->where('the_post_day',$day);
		$this->db->where('the_post_title_url',$url_title);
		$query=$this->db->get('the_post');
		return $query;
	}
	
	function get_per_category($category_id,$site_per_page_post=5,$start=0)
	{
		$this->db->where('category_id',$category_id);
		$this->db->limit($site_per_page_post,$start);
		$this->db->order_by('the_post_date','DESC');
		$query=$this->db->get('the_post');
		return $query;
	}	
	
	function get_all_per_category($category_id)
	{
		$this->db->where('category_id',$category_id);
		$this->db->order_by('category_id','DESC');
		$query=$this->db->get('the_post');
		return $query->num_rows;
	}
	
	function get_by_id($the_post_id)
	{
		$this->db->where('the_post_id',$the_post_id);
		$query=$this->db->get('the_post');
		return $query->row();
	}
	
	function update($the_post_id)
	{
		$this->db->set('category_id',$this->category_id);
		$this->db->set('the_post_title',$this->the_post_title);
		$this->db->set('the_post_title_url',$this->the_post_title_url);
		$this->db->set('the_post_content',$this->the_post_content);
		$this->db->set('the_post_comment',$this->the_post_comment);
		$this->db->where('the_post_id',$the_post_id);
		$this->db->update('the_post');
	}
	
	function delete($the_post_id)
	{
		$this->db->where('the_post_id',$the_post_id);
		$this->db->delete('the_post');
	}
	
	function archives()
	{
		$this->db->group_by('the_post_year');
		$this->db->select('COUNT(the_post_year) as total');
		$this->db->select('the_post_year');
		$query=$this->db->get('the_post');
		return $query;
	}
	
	function search_item($keywords)
	{
		$this->db->like('the_post_content',$keywords);
		$query=$this->db->get('the_post');
		return $query;	
	}
	
	
}