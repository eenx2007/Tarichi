<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Read_page extends Frontsite_Controller {

	function index($the_page_title_url)
	{
		$query=$this->the_page_model->get_page($the_page_title_url);
		$total=$query->num_rows;
		if($total<>0)
		{
			$row=$query->row();
			$this->data['page_title']=$row->the_page_title;
			$this->data['page_content']=$row->the_page_content;
			$this->data['site_slogan']=$row->the_page_title;
			$this->load->view('../../skins/'.$this->site_config->site_skin.'/views/the_page',$this->data);
		}
		else
		{
			$this->data['site_slogan']='Halaman tidak dapat ditampilkan';
			$this->data['messages']='cek URL anda apakah benar seperti ini ? <br /><code>'.site_url($this->uri->uri_string()).'</code>';
			$this->load->view('../../skins/'.$this->site_config->site_skin.'/views/blank_page',$this->data);
		}	
	}
	
}