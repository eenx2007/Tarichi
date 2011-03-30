<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psm_home extends Master_Controller {

	function index()
	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('page_management/pm_home');
		$config['total_rows'] = $this->the_post_model->total_post_all();
		$config['uri_segment'] = 4;
		$config['per_page'] = 10; 
		$config['cur_tag_open'] = '<span class="selected">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config); 
		$start=$this->uri->segment(4);
		$this->data['the_pagination']=$this->pagination->create_links();
		$this->data['start']=$start;
		$this->data['bcum']="Post Management";
		$this->load->view('psm_home',$this->data);
	}
	
	function delete($the_post_id)
	{
		$this->the_post_model->delete($the_post_id);
		redirect('the_master/post_management/home');	
	}
}