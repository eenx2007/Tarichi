<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_home_page extends Master_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$query=$this->db->get('static_home_page');
		$this->data['row']=$query->row();
		$this->data['bcum']="Static Home Page";
		$this->load->view('static_home_page',$this->data);
	}
	
	function save()
	{
		$this->db->set('static_home_page_title',$this->input->post('static_home_page_title'));
		$this->db->set('static_home_page_content',$this->input->post('static_home_page_content'));
		$this->db->update('static_home_page');
	}
}