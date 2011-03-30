<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

class MY_Controller extends MX_Controller
{
	var $data=array();
	var $site_config='';
	function __construct()
 	{
		parent::__construct();
		$query=$this->db->get('site_config');
		$this->site_config=$query->row();
		$this->data['site_name']=$this->site_config->site_name;
		$this->data['site_comment_moderation']=$this->site_config->site_comment_moderation;
		$this->data['site_date_format']=$this->site_config->site_date_format;
		$this->data['site_skin']=$this->site_config->site_skin;
		$this->data['site_slogan']=$this->site_config->site_slogan;
		$this->data['site_language']=$this->site_config->site_language;
		$this->lang->load('caption', $this->site_config->site_language);
		$this->base_site_url=base_url().'skins/'.$this->site_config->site_skin.'/';
		$this->data['base_site_url']=$this->base_site_url;
		$this->data['site_slogan']=$this->site_config->site_slogan;
		$this->data['site_main_email']=$this->site_config->site_main_email;
		$this->data['site_default_keywords']=$this->site_config->site_default_keywords;
		$this->data['site_default_description']=$this->site_config->site_default_description;
		$this->data['site_split_post']=$this->site_config->site_split_post;
		$this->data['site_per_page_post']=$this->site_config->site_per_page_post;
		
		
	}
}