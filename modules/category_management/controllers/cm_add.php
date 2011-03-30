<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cm_add extends Master_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->data['bcum']="Category Management";
		$this->data['bcum2']="Add New";
		if($this->input->post('save'))
		{
			$this->category_model->category_name=$this->input->post('category_name');
			$this->category_model->category_url=url_title($this->input->post('category_name'),'dash',TRUE);
			$this->category_model->category_desc=$this->input->post('category_desc');
			$this->category_model->add_new();
			redirect('category_management/cm_home');
		}
		$this->load->view('cm_add',$this->data);
	}
}