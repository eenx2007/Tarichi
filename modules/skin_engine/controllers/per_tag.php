<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Per_tag extends Frontsite_Controller {

	function index($the_tag_name_url)
	{
		$this->load->library('pagination');
		$config['base_url'] = site_url('tag/'.$the_tag_name_url);
		$config['total_rows'] = $this->the_tag_model->total_per_tag_all($the_tag_name_url);
		$config['uri_segment'] = 3;
		$config['per_page'] = $this->site_config->site_per_page_post; 
		$config['cur_tag_open'] = '<span class="selected">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config); 
		$start=$this->uri->segment(3);
		$this->data['the_pagination']=$this->pagination->create_links();
		
		$querypost=$this->the_tag_model->get_by_tag($the_tag_name_url,$this->site_config->site_per_page_post,$start);
		$the_post=array();
		$i=0;
		foreach($querypost->result() as $rowspost)
		{
			$i++;
			$querycomm=$this->comment_model->get_comment($rowspost->the_post_id,$this->data['site_comment_moderation']);
			$the_post[$i]['totalcomment']=$querycomm->num_rows;
			$the_post[$i]['title']='<a href="'.site_url('read/'.$rowspost->the_post_year.'/'.$rowspost->the_post_month.'/'.$rowspost->the_post_day.'/'.$rowspost->the_post_title_url).'">'.$rowspost->the_post_title.'</a>';
			$the_post[$i]['date']=mdate($this->data['site_date_format'],$rowspost->the_post_date);
			$the_post[$i]['day']=$rowspost->the_post_day;
			$the_post[$i]['month']=$rowspost->the_post_month;
			$the_post[$i]['year']=$rowspost->the_post_year;
			
			$the_post[$i]['link_to_comment']=site_url('read/'.$rowspost->the_post_year.'/'.$rowspost->the_post_month.'/'.$rowspost->the_post_day.'/'.$rowspost->the_post_title_url.'#comment_list');
			if($this->data['site_split_post']>0)
					$the_post[$i]['content']=word_limiter(strip_tags($rowspost->the_post_content),$this->data['site_split_post']);
				else
				{
					$pecah=explode('<p><!-- pagebreak --></p>',$rowspost->the_post_content);
					$the_post[$i]['content']=$pecah[0].' <a href="'.site_url('read/'.$rowspost->the_post_year.'/'.$rowspost->the_post_month.'/'.$rowspost->the_post_day.'/'.$rowspost->the_post_title_url).'">Read More</a>';	
				}
			$querytag=$this->the_tag_model->get_per_post($rowspost->the_post_id);
				$totaltag=$querytag->num_rows;
				$the_post[$i]['tags']='';
				$z=0;
				foreach($querytag->result() as $rowstag)
				{
					$z++;
					$the_post[$i]['tags'].=anchor('tag/'.$rowstag->the_tag_name_url,$rowstag->the_tag_name);	
					if($z<>$totaltag)
						$the_post[$i]['tags'].=', ';
				}
		}
		$this->data['the_post']=$the_post;
		$this->data['totalpost']=$querypost->num_rows;
		$this->data['site_slogan']='Tag : '.$the_tag_name_url;
		$this->load->view('../../skins/'.$this->site_config->site_skin.'/views/content',$this->data);
	}
}