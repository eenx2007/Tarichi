<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class The_tag_model extends CI_Model {

	var $the_tag_id='';
	var $the_tag_name='';
	var $the_tag_connector_id='';
	var $the_post_id = '';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function insert_new($the_post_id='',$the_tag_name='')
	{
		$pisah=split(',',$the_tag_name);
		foreach($pisah as $tag_name)
		{
			$querycek=$this->db->get_where('the_tag',array('the_tag_name'=>trim($tag_name)));
			$totalcek=$querycek->num_rows;
			if($totalcek==0)
			{
				$this->db->set('the_tag_name_url',url_title(trim($tag_name)));
				$this->db->set('the_tag_name',trim($tag_name));
				$this->db->insert('the_tag');
			}
			$this->db->set('the_tag_name',trim($tag_name));
			$this->db->set('the_post_id',$the_post_id);
			$this->db->insert('the_tag_connector');
		}
	
	}
	
	function get_per_post($the_post_id)
	{
		$this->db->where('the_tag_connector.the_post_id',$the_post_id);
		$this->db->join('the_tag','the_tag.the_tag_name=the_tag_connector.the_tag_name');
		$query=$this->db->get('the_tag_connector');
		return $query;
	}
	
	function delete($the_tag_connector_id)
	{
		$this->db->where('the_tag_connector_id',$the_tag_connector_id);
		$this->db->delete('the_tag_connector');
	}
	
	function get_cloud()
	{
		$this->db->join('the_tag','the_tag.the_tag_name=the_tag_connector.the_tag_name');
		$this->db->order_by('the_tag_connector.the_tag_name','Random');
		$this->db->group_by('the_tag_connector.the_tag_name');
		$this->db->select('COUNT(the_tag_connector.the_tag_name) as total');
		$this->db->select('the_tag_connector.the_tag_name');
		$this->db->select('the_tag.the_tag_name_url');
		$query=$this->db->get('the_tag_connector');
		return $query;
	}
	
	function get_by_tag($the_tag_name_url,$limit,$start=0)
	{
		$this->db->limit($limit,$start);
		$this->db->join('the_post','the_post.the_post_id=the_tag_connector.the_post_id');
		$this->db->join('the_tag','the_tag.the_tag_name=the_tag_connector.the_tag_name');
		$this->db->where('the_tag.the_tag_name_url',$the_tag_name_url);
		$query=$this->db->get('the_tag_connector');
		return $query;
	}
	
	function total_per_tag_all($the_tag_name_url)
	{
		$this->db->join('the_post','the_post.the_post_id=the_tag_connector.the_post_id');
		$this->db->join('the_tag','the_tag.the_tag_name=the_tag_connector.the_tag_name');
		$this->db->where('the_tag.the_tag_name_url',$the_tag_name_url);
		$query=$this->db->get('the_tag_connector');
		return $query->num_rows;
	}
	
}