<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends Frontsite_Controller {

	function index()
	{
		$this->load->helper('xml');  
        $this->load->helper('text');  
       	$data['feed_name'] = $this->site_config->site_name;  
        $data['encoding'] = 'utf-8';  
        $data['feed_url'] = site_url('feed');  
        $data['page_description'] = $this->site_config->site_default_description;  
        $data['page_language'] = 'en-en';  
        $data['creator_email'] = $this->site_config->site_main_email;  
        $data['posts'] = $this->the_post_model->get_all($this->site_config->site_per_page_post,0);  
       	header("Content-Type: application/rss+xml");
  
        $this->load->view('rss', $data);  
	}
}