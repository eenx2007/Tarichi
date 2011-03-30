<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Global_model extends CI_Model {

	var $username='';
	var $password='';
	var $last_login='';
	var $nama_lengkap='';

	var $add_on_id='';
	var $add_on_name='';
	var $add_on_def_controller='';
	var $add_on_def_setting='';
	var $js_script_generated='';
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_my_profile($user_id)
	{
		$query=$this->db->get_where('user',array('user_id'=>$user_id));
		return $query->row();
	}
	
	function update_profile($user_id)
	{
		$this->db->set('username',$this->username);
		if($this->password<>'')
			$this->db->set('password',$this->password);
		$this->db->set('nama_lengkap',$this->nama_lengkap);
		$this->db->where('user_id',$user_id);
		$this->db->update('user');
		
	}
	
	function update_skin($site_skin)
	{
		$this->db->set('site_skin',$site_skin);
		$this->db->update('site_config');
	}
	
	function cek_module($add_on_id)
	{
		$this->db->where('add_on_id',$add_on_id);
		$query=$this->db->get('add_on');	
		return $query->num_rows;
	}
	
	function get_module_detail($add_on_id)
	{
		$this->db->where('add_on_id',$add_on_id);
		$query=$this->db->get('add_on');	
		return $query;		
	}
	
	function add_module()
	{
		$this->db->set('add_on_id',$this->add_on_id);
		$this->db->set('add_on_name',$this->add_on_name);
		$this->db->set('add_on_def_controller',$this->add_on_def_controller);
		$this->db->set('add_on_def_setting',$this->add_on_def_setting);
		$this->db->insert('add_on');	
	}
	
	function get_module()
	{
		$query=$this->db->get('add_on');
		return $query;	
	}
	
	function delete_module($add_on_id)
	{
		$this->db->where('add_on_id',$add_on_id);
		$this->db->delete('add_on');	
	}
	
	function update_module($add_on_id)
	{
		$this->db->set('add_on_def_setting',$this->add_on_def_setting);
		$this->db->set('js_script_generated',$this->global_model->js_script_generated);
		$this->db->where('add_on_id',$add_on_id);
		$this->db->update('add_on');
	}
	
	
}