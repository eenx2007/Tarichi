<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pm_edit extends Master_Controller {

	function index($the_page_id)
	{
		$this->data['bcum']="Page Management";
		$this->data['bcum2']="Edit";
		$query=$this->the_page_model->get_page_by_id($this->uri->segment(4));
		$this->data['row']=$query->row();
		$this->data['the_page_id']=$this->uri->segment(4);
		$this->load->view('pm_edit',$this->data);
		if($this->input->post('save'))
		{
			$this->the_page_model->the_page_title=$this->input->post('the_page_title');
			$this->the_page_model->the_page_title_url=url_title($this->input->post('the_page_title'),'dash',TRUE);
			$this->the_page_model->the_page_menu=$this->input->post('the_page_menu');
			$this->the_page_model->the_page_content=$this->input->post('the_page_content');
			$this->the_page_model->the_page_last_edit=time();
			$this->the_page_model->the_page_type_id=$this->input->post('the_page_type_id');
			if($this->input->post('the_page_type_id')==1)
				$this->the_page_model->the_page_link_to=$this->input->post('normal_link_to');
			elseif($this->input->post('the_page_type_id')==2)
				$this->the_page_model->the_page_link_to=$this->input->post('per_category');
			elseif($this->input->post('the_page_type_id')==3)
				$this->the_page_model->the_page_link_to=site_url('frontsite/site_contact');
			elseif($this->input->post('the_page_type_id')==4)
				$this->the_page_model->the_page_link_to=$this->input->post('static_link');
			elseif($this->input->post('the_page_type_id')==5)
				$this->the_page_model->the_page_link_to=site_url('frontsite/gallery');
			$this->the_page_model->the_page_parent=$this->input->post('the_page_parent');
			$this->the_page_model->the_page_enabled=1;
			
			$this->the_page_model->edit($this->uri->segment(4));
			redirect('page_management/pm_home');
		}
	}
	
}