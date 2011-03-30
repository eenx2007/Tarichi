<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_library extends Master_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->data['img_list']=directory_map('./image_library/',1);
		$this->data['bcum']="Image Library";
		$this->load->view('image_library_management',$this->data);
	}
}