<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pm_add extends Master_Controller {

	function index()
	{
		$this->load->model('category_management/category_model');
		$this->data['bcum']="Page Management";
		$this->data['bcum2']="Add New";
		$this->load->view('pm_add',$this->data);
		if($this->input->post('save'))
		{
			if($this->input->post('the_page_parent')==0)
				$get_total=$this->the_page_model->get_just_parent();
			else
				$get_total=$this->the_page_model->get_by_parent($this->input->post('the_page_parent'));
			$total_page=$get_total->num_rows;
			
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
				$this->the_page_model->the_page_link_to='frontsite/site_contact';
			elseif($this->input->post('the_page_type_id')==4)
				$this->the_page_model->the_page_link_to=$this->input->post('static_link');
			elseif($this->input->post('the_page_type_id')==5)
				$this->the_page_model->the_page_link_to='frontsite/gallery';
			$this->the_page_model->the_page_parent=$this->input->post('the_page_parent');
			$this->the_page_model->the_page_enabled=1;
			$this->the_page_model->the_page_order=$total_page+1;
			$this->the_page_model->add_new();
			redirect('page_management/pm_home');
		}
	}
}