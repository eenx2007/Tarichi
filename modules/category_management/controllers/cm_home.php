<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cm_home extends Master_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->data['query']=$this->category_model->get_all();
		$this->data['bcum']="Category Management";
		$this->load->view('cm_home',$this->data);
	}
	
	function delete($category_id)
	{
		$category_id=$this->uri->segment(4);
		$this->category_model->delete($category_id);	
		redirect('category_management/cm_home');	
	}
}