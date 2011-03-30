<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivo_image_slider extends Master_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$query=$this->global_model->get_module_detail('nivo_image_slider');
		$row=$query->row();
		$this->data['detailnya']=split(',',$row->add_on_def_setting);
		$this->data['bcum']="Nivo Image Slider";
		$this->load->view('nivo_image_slider',$this->data);
		
	}
	
	function save_config()
	{
		$confignya='$("#'.$this->input->post('elementx').'").nivoSlider({controlNav:'.$this->input->post('control_nav').',animSpeed:'.$this->input->post('anim_speed').',pauseTime:'.$this->input->post('pause_time').',captionOpacity:'.$this->input->post('opacityx').'});';
		$this->global_model->add_on_def_setting=$this->input->post('elementx').','.$this->input->post('control_nav').','.$this->input->post('anim_speed').','.$this->input->post('pause_time').','.$this->input->post('opacityx');
		$this->global_model->js_script_generated=$confignya;
		$this->global_model->update_module('nivo_image_slider');
	}
}