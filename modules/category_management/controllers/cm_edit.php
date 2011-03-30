<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cm_edit extends Master_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index($category_id=0)
	{
		$this->data['bcum']="Category Management";
		$this->data['bcum2']="Edit";
		$category_id=$this->uri->segment(4);
		$querycat=$this->category_model->get_by_id($category_id);
		$this->data['row']=$querycat->row();
		if($this->input->post('save'))
		{
			$this->category_model->category_name=$this->input->post('category_name');
			$this->category_model->category_url=url_title($this->input->post('category_name'),'dash',TRUE);
			$this->category_model->category_desc=$this->input->post('category_desc');
			$this->category_model->update($category_id);
			redirect('category_management/cm_home');
		}
		$this->load->view('cm_edit',$this->data);
		
	}
}