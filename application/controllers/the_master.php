<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class The_master extends Master_Controller {


	function index()
	{
		$this->load->model('page_management/the_page_model');
		$this->load->model('side_panel/side_panel_model');
		$this->load->model('category_management/category_model');
		$this->load->model('post_management/the_post_model');
		$this->data['bcum']="Dashboard";
		$this->load->view('the_master/content',$this->data);
		
	}
	
	function login_form()
	{
		if($this->input->post('login'))
		{
			$this->db->where('username',$this->input->post('username'));
			$this->db->where('password',md5($this->input->post('password')));
			$query=$this->db->get('user');
			$totalcek=$query->num_rows;
			if($totalcek<>0)
			{
				$rowcek=$query->row();
				$this->session->set_userdata('user_login',$rowcek->user_id);
				$this->session->set_userdata('username',$rowcek->username);
				redirect('the_master');
			}	
		}
		$this->data['bcum']="Login Form";
		$this->load->view('the_master/content',$this->data);
		
	}
	
	function login()
	{
		if($this->input->post('login'))
		{
			$this->db->where('username',$this->input->post('username'));
			$this->db->where('password',md5($this->input->post('password')));
			$query=$this->db->get('user');
			$totalcek=$query->num_rows;
			if($totalcek<>0)
			{
				$rowcek=$query->row();
				$this->session->set_userdata('user_login',$rowcek->user_id);
				$this->session->set_userdata('username',$rowcek->username);
				redirect('the_master');
			}	
		}
	}
	
	function url_checker()
	{
		$the_url=$this->input->post('the_url');
		
		echo url_title($the_url,'dash',TRUE);
	}
	
	
	
	
	function site_config()
	{
		$this->load->helper('directory');
		$lang_list=directory_map(APPPATH.'language/',1);
		$the_lang=array();
		foreach($lang_list as $langs)
		{
			$the_lang[$langs]=$langs;	
		}
		$this->data['the_lang']=$the_lang;
		$query=$this->db->get('site_config');
		$this->data['row']=$query->row();
		$this->data['bcum']=lang('caption_site_configuration');
		$this->load->view('the_master/site_config',$this->data);
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('the_master');
	}

	function module_management()
	{
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->data['module_list']=directory_map('./modules/',1);
		$this->data['bcum']="Modul Management";
		$this->load->view('the_master/module_management',$this->data);
	}

	
	
	function credits()
	{
		$this->data['bcum']="Credits";
		$this->load->view('the_master/credits',$this->data);	
	}
	
	
	function my_profile()
	{
		$this->data['bcum']='My Profile';
		$this->data['row']=$this->global_model->get_my_profile($this->session->userdata('user_login'));
		
		$this->load->view('the_master/my_profile',$this->data);
	}
	
	function site_preview()
	{
		$this->data['bcum']="Site Preview";
		$this->load->view('the_master/site_preview',$this->data);	
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */