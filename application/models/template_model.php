<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template_model extends CI_Model {
	
	function create_menu($home_cap='Home',$open_page='',$open_tag='<li>',$close_tag='</li>')
	{
		$top_menu='';
		$querymenu=$this->the_page_model->show_parent_menu();
		$selected=' class="selected_menu"';
		$top_menu.=$open_tag.'<a href="'.base_url();
		$top_menu.='"';
		if($open_page=='/')
			$top_menu.=$selected;
		$top_menu.='>'.$home_cap.'</a>'.$close_tag;
		foreach($querymenu as $rowsmenu)
		{
		    $top_menu.=$open_tag.'<a href="'.site_url($rowsmenu->the_page_link_to).'"';
			if($open_page==$rowsmenu->the_page_link_to)
				$top_menu.=$selected;
			$top_menu.='>'.$rowsmenu->the_page_menu.'</a>';
            $querysubmenu=$this->the_page_model->show_child_menu($rowsmenu->the_page_id);
			$totalsubmenu=$querysubmenu->num_rows;
			if($totalsubmenu<>0)
			{ 
            	$top_menu.='<ul>';
			    foreach($querysubmenu->result() as $rowssubmenu)
				{
                	 $top_menu.=$open_tag.'<a href="'.site_url($rowssubmenu->the_page_link_to).'">'.$rowssubmenu->the_page_menu.'</a>'.$close_tag;
               	}
                $top_menu.='</ul>';
			} 
            $top_menu.=$close_tag;
         }
		 return $top_menu;
	}
	
	function get_captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
			
			'img_path'	 => './captcha/',
			'img_url'	 => base_url().'captcha/',
			'img_width'	 => '150',
			'img_height' => 30,
			'expiration' => 7200
			);
		
		$cap = create_captcha($vals);
		return $cap;
	}

	function search_box($classbox='btncari',$valuebox='Cari Disini',$idbox='cari_disini',$classbtn='tblcari',$valuebtn='Cari')
	{
		$formbox=form_open('frontsite/cari').'<input type="text" name="globa_search" class="'.$classbox.'" value="'.$valuebox.'" id="'.$idbox.'" /> <input type="submit" value="'.$valuebtn.'" class="'.$classbtn.'" />'.form_close();
		return $formbox;
	}
	

	function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}

	
}