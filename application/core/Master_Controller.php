<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

class Master_Controller extends MY_Controller
{
	
	function __construct()
 	{
		parent::__construct();
		$logged=$this->session->userdata('user_login');
		$segment=$this->uri->segment(2);
		if($logged==0 and $segment != 'login_form')
			redirect('the_master/login_form');
		//model loader
		
	}
}