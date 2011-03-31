<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

class Frontsite_Controller extends MY_Controller
{
	var $data=array();
	
	function __construct()
 	{
		parent::__construct();
		$this->load->library('user_agent');
		if ($this->agent->is_mobile())
		{
			$this->site_config->site_skin='mobile';
			
			
		}
		$this->data['site_skin']='../../skins/'.$this->site_config->site_skin.'/views/';
		
		$this->load->model('side_panel/side_panel_model');
		$this->load->model('page_management/the_page_model');
		$this->load->model('post_management/the_post_model');
		$this->load->model('category_management/category_model');
		$this->load->model('template_model');
		$this->data['side_panel']=$this->load->view('skin_engine/side_panel',$this->data,true);
		
	}
}