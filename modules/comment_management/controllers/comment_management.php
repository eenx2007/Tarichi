<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_management extends Master_Controller {

	function index()
	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('comment_management/index');
		$config['total_rows'] = $this->comment_model->get_total();
		$config['uri_segment'] = 3;
		$config['per_page'] = 10; 
		$config['cur_tag_open'] = '<span class="selected">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config); 
		$start=$this->uri->segment(3);
		$this->data['the_pagination']=$this->pagination->create_links();
		$this->data['start']=$start;
		$this->data['bcum']="Comment Management";
		$this->load->view('comment_management',$this->data);	
	}
	
}