<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comment_model extends CI_Model {

	var $comment_name='';
	var $comment_email='';
	var $comment_website='';
	var $comment_date='';
	var $comment_content='';
	var $the_post_id='';
	var $parent_comment_id='';
	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function add_comment()
	{
		$querycek=$this->db->get_where('the_post',array('the_post_id'=>$this->the_post_id));
		$rowcek=$querycek->row();
		$total_comment=$rowcek->the_post_total_comment;
		$new_total_comment=$total_comment+1;
		
		$this->db->set('the_post_total_comment',$new_total_comment);
		$this->db->where('the_post_id',$this->the_post_id);
		$this->db->update('the_post');
		
		$this->db->set('comment_name',$this->comment_name);
		$this->db->set('comment_email',$this->comment_email);
		$this->db->set('comment_website',$this->comment_website);
		$this->db->set('comment_date',$this->comment_date);
		$this->db->set('comment_content',$this->comment_content);
		$this->db->set('the_post_id',$this->the_post_id);
		$this->db->set('parent_comment_id',$this->parent_comment_id);
		$this->db->insert('comment');
	}
	
	function get_comment($the_post_id,$site_comment_moderation)
	{
		if($site_comment_moderation==1)
		{
			$this->db->where('comment_status',1);	
		}
		$this->db->where('the_post_id',$the_post_id);
		$this->db->where('parent_comment_id',0);
		$this->db->order_by('comment_date','ASC');
		$query=$this->db->get('comment');
		return $query;
	}
	
	function get_by_parent($parent_comment_id,$site_comment_moderation)
	{
		if($site_comment_moderation==1)
		{
			$this->db->where('comment_status',1);	
		}
		$this->db->where('parent_comment_id',$parent_comment_id);
		$this->db->order_by('comment_date','ASC');
		$query=$this->db->get('comment');
		return $query;
	}
	
	function get_last_comment($to_show=10,$site_comment_moderation)
	{
		$this->db->join('the_post','the_post.the_post_id=comment.the_post_id');
		$this->db->limit($to_show);
		if($site_comment_moderation==1)
		{
			$this->db->where('comment.comment_status',1);	
		}
		$this->db->order_by('comment.comment_date','DESC');
		$query=$this->db->get('comment');
		return $query;
	}
	
	function get_pending($pending="no",$start=0)
	{
		$this->db->join('the_post','the_post.the_post_id=comment.the_post_id');
		$this->db->limit(10,$start);
		if($pending=="yes")
			$this->db->where('comment_status',0);
		$this->db->order_by('comment.comment_date','DESC');
		$query=$this->db->get('comment');
		return $query;	
	}
	
	function approve($comment_id)
	{
		$this->db->set('comment_status',1);
		$this->db->where('comment_id',$comment_id);
		$this->db->update('comment');
	}
	
	function delete($comment_id)
	{
		$this->db->where('comment_id',$comment_id);
		$this->db->delete('comment');
	}
	
	function get_total()
	{
		$query=$this->db->get('comment');
		return $query->num_rows;
	}
	
    
   

}