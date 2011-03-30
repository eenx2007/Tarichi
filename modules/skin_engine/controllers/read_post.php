<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Read_post extends Frontsite_Controller {

	function index()
	{
		$cap=$this->template_model->get_captcha();
		$this->data['captcha']=$cap;
		$year=$this->uri->segment(2);
		$month=$this->uri->segment(3);
		$day=$this->uri->segment(4);
		$url_title=$this->uri->segment(5);
		$query=$this->the_post_model->read($year,$month,$day,$url_title);
		
		$total=$query->num_rows;
		if($total<>0)
		{
			$row=$query->row();
			$this->data['sp_id']=$row->the_post_id;
			$this->data['sp_title']=$row->the_post_title;
			$this->data['sp_date']=mdate($this->data['site_date_format'],$row->the_post_date);
			$this->data['sp_day']=$row->the_post_day;
			$this->data['sp_month']=$row->the_post_month;
			$this->data['sp_year']=$row->the_post_year;
			
			$this->data['sp_content']=$row->the_post_content;
			$this->data['sp_comment']=$row->the_post_comment;
			$this->data['read_post']='yes';
			$this->data['querycomment']=$this->comment_model->get_comment($row->the_post_id,$this->site_config->site_comment_moderation);
			$this->data['sp_totalcomment']=$this->data['querycomment']->num_rows;
			$this->data['site_slogan']=$row->the_post_title;
			$comments=array();
			$i=0;
			foreach($this->data['querycomment']->result() as $rowscomment)
			{
				$i++;
				$comments[$i]['id']=$rowscomment->comment_id;
				if($rowscomment->comment_website<>'')
					$comments[$i]['sender']='<a href="'.$rowscomment->comment_website.'">'.$rowscomment->comment_name.'</a>';
				else
					$comments[$i]['sender']=$rowscomment->comment_name;
				$comments[$i]['date']=mdate($this->data['site_date_format'],$rowscomment->comment_date);
				$comments[$i]['content']=$rowscomment->comment_content;
				$comments[$i]['email']=$rowscomment->comment_email;
				$j=0;
				$querycom2=$this->comment_model->get_by_parent($rowscomment->comment_id,$this->site_config->site_comment_moderation);
				$comments[$i]['subcomment']=$querycom2->num_rows;
				foreach($querycom2->result() as $rowscom2)
				{
					$j++;
					$comments[$i]['child'][$j]['id']=$rowscom2->comment_id;
					$comments[$i]['child'][$j]['sender']=$rowscom2->comment_name;
					$comments[$i]['child'][$j]['date']=mdate($this->data['site_date_format'],$rowscom2->comment_date);
					$comments[$i]['child'][$j]['content']=$rowscom2->comment_content;
					$comments[$i]['child'][$j]['email']=$rowscom2->comment_email;
				}
				
			}
			$this->data['comments']=$comments;
			$querytag=$this->the_tag_model->get_per_post($row->the_post_id);
			$totaltag=$querytag->num_rows;
			$this->data['sp_tags']='';
			$z=0;
			foreach($querytag->result() as $rowstag)
			{
				$z++;
				$this->data['sp_tags'].=anchor('tag/'.$rowstag->the_tag_name_url,$rowstag->the_tag_name);	
				if($z<>$totaltag)
					$this->data['sp_tags'].=', ';
			}
			$this->load->view('../../skins/'.$this->site_config->site_skin.'/views/read_post',$this->data);
		}
		else
		{
			$this->data['site_slogan']='Halaman tidak dapat ditampilkan';
			$this->data['messages']='cek URL anda apakah benar seperti ini ? <br /><code>'.site_url($this->uri->uri_string()).'</code>';
			$this->load->view('../../skins/'.$this->site_config->site_skin.'/views/blank_page',$this->data);
		}
	}
	
	function send_comment($the_post_id)
	{
		if($this->input->post('comment_name'))
		{
			$this->load->helper('string');
			$the_title=trim(htmlentities($this->input->post('comment_name')));
			$the_email=trim($this->input->post('comment_email'));
			$the_website=prep_url($this->input->post('comment_website'));
			$comment_content=$this->input->post('comment_content');
			$the_comment=quotes_to_entities(nl2br(strip_tags(reduce_multiples($comment_content,"\n"))));
			$this->comment_model->comment_name=$the_title;
			$this->comment_model->comment_email=$the_email;
			$this->comment_model->comment_website=$the_website;
			$this->comment_model->comment_date=time();
			$this->comment_model->comment_content=$the_comment;
			$this->comment_model->the_post_id=$the_post_id;
			$this->comment_model->parent_comment_id=$this->input->post('parent_comment_id');
			$this->comment_model->add_comment();
			$uri_string=$this->input->post('uristring');
			redirect($uri_string);
		}
	}
	
	function refresh_captcha()
	{
		$this->load->model('template_model');
		$cap=$this->template_model->get_captcha();
		echo '{"time":"'.$cap['time'].'","word":"'.$cap['word'].'"}';
	
	}
}