<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Psm_edit extends Master_Controller {

	function index($the_post_id)
	{
		$this->data['bcum']="Post Management";
		$this->data['bcum2']="Edit";
		$this->data['row']=$this->the_post_model->get_by_id($this->uri->segment(4));
		if($this->input->post('save'))
		{
			$this->the_post_model->category_id=$this->input->post('category_id');
			$this->the_post_model->the_post_title=$this->input->post('the_post_title');
			$this->the_post_model->the_post_title_url=url_title($this->input->post('the_post_title'),'dash',TRUE);
			$this->the_post_model->the_post_content=$this->input->post('the_post_content');
			$this->the_post_model->the_post_comment=$this->input->post('the_post_comment');
			$this->the_post_model->update($this->uri->segment(4));
			if($this->input->post('the_tag_name')<>'')
				$this->the_tag_model->insert_new($this->uri->segment(4),$this->input->post('the_tag_name'));
			redirect('post_management/psm_home');	
		}
		$this->load->view('psm_edit',$this->data);
	}
}