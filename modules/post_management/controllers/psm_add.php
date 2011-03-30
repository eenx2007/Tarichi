<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psm_add extends Master_Controller {

	function index()
	{
		$this->data['bcum']="Post Management";
		$this->data['bcum2']="Add New";
		if($this->input->post('save'))
		{
			$this->the_post_model->category_id=$this->input->post('category_id');
			$this->the_post_model->the_post_title=$this->input->post('the_post_title');
			$this->the_post_model->the_post_title_url=url_title($this->input->post('the_post_title'),'dash',TRUE);
			$this->the_post_model->the_post_content=$this->input->post('the_post_content');
			$this->the_post_model->the_post_date=time();
			$this->the_post_model->the_post_day=date('d');
			$this->the_post_model->the_post_month=date('m');
			$this->the_post_model->the_post_year=date('Y');
			$this->the_post_model->the_post_total_comment=0;
			$this->the_post_model->the_post_total_view=0;
			$this->the_post_model->user_id=$this->session->userdata('user_login');
			$this->the_post_model->the_post_comment=$this->input->post('the_post_comment');
			$the_post_id=$this->the_post_model->add_new();
			if($this->input->post('the_tag_name')<>'')
			{	
				
				$this->the_tag_model->insert_new($the_post_id,$this->input->post('the_tag_name'));
			}
			redirect('post_management/psm_home');
		}
		$this->load->view('psm_add',$this->data);
	}
}