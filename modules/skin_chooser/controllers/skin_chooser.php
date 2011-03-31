<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skin_chooser extends Master_Controller {

	function index()
	{
		$this->lang->load('skin_chooser', $this->site_config->site_language);
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->data['skin_list']=directory_map('./skins/',1);
		
		$this->data['bcum']="Skins";
		$this->load->view('skins',$this->data);
	}
}