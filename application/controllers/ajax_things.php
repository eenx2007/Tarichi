<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_things extends Master_Controller {

	function image_library()
	{
		$this->load->view('the_master/image_library');	
	}
	
	function upload_image()
	{
		$config['upload_path'] = './image_library/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '6000';
		$this->load->library('upload', $config);
		$gambar = "img_name";
		if ( ! $this->upload->do_upload($gambar))
		{
			$error = $this->upload->display_errors();
			
			echo "{";
			echo        "error: '".$error."'\n";
			echo "}";
		}	
		else
		{
			$data = $this->upload->data();
			$this->load->library('image_lib');
			$config['image_library'] = 'gd2';
			$config['source_image'] = './image_library/'.$data['file_name'];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 150;
			$config['height'] = 150;
			
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();
			$config['image_library'] = 'gd2';
			$config['source_image'] = './gambar_upload/'.$data['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 450;
			$config['height'] = 450;
			
			$this->image_lib->initialize($config); 
			
			$this->image_lib->resize();
			
			$nama_file_gambar=$data['file_name'];
			$nama_file_thumb=$data['raw_name']."_thumb".$data['file_ext'];
			
			$this->session->set_flashdata('img_name_thumb',$nama_file_thumb);
			
			
			$msg_balik=$nama_file_thumb;
			//$msg_balik.='<a href="javascript:;" onmousedown="$(\'#isi_post\').tinymce().execCommand(\'mceInsertContent\',false,\''.$vargambar.'\');">Masukkan ke Postingan</a>';
			echo '{"nama_file_gambar" : "'.$nama_file_gambar.'", "nama_file_thumb" : "'.$nama_file_thumb.'"}';
			
		}	
	}
	
	function show_image($nama_file_gambar, $nama_file_thumb)
	{
		$data['nama_file_gambar']=$nama_file_gambar;
		$data['nama_file_thumb']=$nama_file_thumb;
		$this->load->view('the_master/upload_image',$data);
		
	}
	
	function save_comment($the_post_id)
	{
		$this->load->helper('string');
		$the_title=trim(htmlentities($this->input->post('comment_name')));
		$the_email=trim($this->input->post('comment_email'));
		$the_website=prep_url($this->input->post('comment_website'));
		$the_comment=quotes_to_entities(nl2br(strip_tags($this->input->post('comment_content'),'br')));
		$this->comment_model->comment_name=$the_title;
		$this->comment_model->comment_email=$the_email;
		$this->comment_model->comment_website=$the_website;
		$this->comment_model->comment_date=time();
		$this->comment_model->comment_content=$the_comment;
		$this->comment_model->the_post_id=$the_post_id;
		$this->comment_model->parent_comment_id=0;
		$this->comment_model->add_comment();
		
		echo '<li>';
		echo '<div class="comment_box"><span class="comment_name">';
		if($the_website<>'')
			echo '<a href="'.$the_website.'">'.$the_title.'</a>';
		else
			echo $the_title;
		echo '</span></div><div class="comment_date">'.date('d/m/Y h:i:s').'</div>';
		echo '<hr />';
		echo $the_comment;
		echo '</li>';
	}
	
	function save_site_config()
	{
		$this->db->set('site_name',$this->input->post('site_name'));
		$this->db->set('site_slogan',$this->input->post('site_slogan'));
		$this->db->set('site_date_format',$this->input->post('site_date_format'));
		$this->db->set('site_default_keywords',$this->input->post('site_default_keywords'));
		$this->db->set('site_home_page_type',$this->input->post('site_home_page_type'));
		$this->db->set('site_per_page_post',$this->input->post('site_per_page_post'));
		$this->db->set('site_status',$this->input->post('site_status'));
		$this->db->set('site_comment_moderation',$this->input->post('site_comment_moderation'));
		$this->db->set('site_main_email',$this->input->post('site_main_email'));
		$this->db->set('site_split_post',$this->input->post('site_split_post'));
		$this->db->set('site_language',$this->input->post('site_language'));
		$this->db->update('site_config');
		
	}
	
	function load_sub_menu($the_page_id)
	{
		$data['query']=$this->the_page_model->get_by_parent($the_page_id);
		$this->load->view('the_master/load_sub_menu',$data);
	}
	
	
	
	
	
	
	
	
	
	
	
	function approve_comment()
	{
		if($this->input->post('comment_id'))
		{
			$this->comment_model->approve($this->input->post('comment_id'));	
		}
	}
	
	function delete_comment()
	{
		if($this->input->post('comment_id'))
		{
			$this->comment_model->delete($this->input->post('comment_id'));	
		}
	}
	
	function update_skin()
	{
		if($this->input->post('site_skin'))
		{
			$this->global_model->update_skin($this->input->post('site_skin'));
			
		}
	}
	
	
	
	function image_library2()
	{
		$this->load->helper('directory');
		$this->load->helper('file');
		$data['img_list']=directory_map('./image_library/',1);
		$data['bcum']="Image Library";
		$this->load->view('the_master/image_library2',$data);	
	}
	
	
	
	function delete_tag()
	{
		if($this->input->post('the_tag_connector_id'))
		{
			$this->the_tag_model->delete($this->input->post('the_tag_connector_id'));	
		}
	}
	
	function activate_module()
	{
		$this->global_model->add_on_id=$this->input->post('add_on_id');
		$this->global_model->add_on_name=$this->input->post('add_on_name');
		$this->global_model->add_on_def_controller=$this->input->post('add_on_def_controller');
		$this->global_model->add_on_def_setting=$this->input->post('add_on_def_setting');
		$this->global_model->add_module();
	}
	
	function deactivate_module()
	{
		$this->global_model->delete_module($this->input->post('add_on_id'));	
	}
}

