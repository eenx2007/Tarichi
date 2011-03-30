<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_now extends Frontsite_Controller {

	function index()
	{
		if($this->input->post('searchbox'))
		{
			$keyword=htmlentities($this->input->post('searchbox'));
			$this->data['search_key']=$keyword;
			$this->data['site_slogan']='Search Result for '.$keyword;
			$querycat=$this->category_model->search_item($keyword);
			$querypost=$this->the_post_model->search_item($keyword);
			$categories=array();
			$the_post=array();
			$this->data['cat_total']=$querycat->num_rows;
			$this->data['post_total']=$querypost->num_rows;
			$i=0;
			foreach($querycat->result() as $rowscat)
			{
				$i++;
				$categories[$i]['result']=anchor('category/'.$rowscat->category_url,$rowscat->category_name);	
			}
			$i=0;
			foreach($querypost->result() as $rowspost)
			{
				$i++;
				$the_post[$i]['result']=anchor('read/'.$rowspost->the_post_year.'/'.$rowspost->the_post_month.'/'.$rowspost->the_post_day.'/'.$rowspost->the_post_title_url,$rowspost->the_post_title,array('title'=>word_limiter(strip_tags($rowspost->the_post_content),100)));
			}	
			
			$this->data['the_post']=$the_post;
			$this->data['categories']=$categories;
			$this->load->view('../../skins/'.$this->site_config->site_skin.'/views/search_result',$this->data);
		}
	}
}