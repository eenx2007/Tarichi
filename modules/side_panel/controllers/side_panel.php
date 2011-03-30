<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Side_panel extends Master_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('side_panel_model');
	}

	function index()
	{
		$this->data['bcum']="Side Panel";
		$this->load->view('side_panel',$this->data);
	}
	
	function side_panel_list($side_panel_status)
	{
		$data['query']=$this->side_panel_model->get_all($side_panel_status);
		$data['side_panel_status']=$side_panel_status;
		$this->load->view('side_panel_list',$data);
	}
	
	function save_side_panel()
	{
		$this->side_panel_model->side_panel_type=$this->input->post('side_panel_type');
		$this->side_panel_model->side_panel_title=$this->input->post('side_panel_title');
		$this->side_panel_model->side_panel_status=$this->input->post('side_panel_status');
		$this->side_panel_model->add_new($this->input->post('side_panel_status'));
		echo $this->input->post('side_panel_status');
	}
	
	function delete_side_panel()
	{
		$side_panel_id=$this->input->post('side_panel_id');
		$this->side_panel_model->delete_side_panel($side_panel_id);
		
	}
	
	function save_side_panel_order()
	{
		$order_data=$this->input->post('tostring');
		$last_order=$order_data;
		$array_order=split(',',$last_order);
		$queryslide=$this->side_panel_model->get_all($this->input->post('side_panel_status'));
		$totalslide=$queryslide->num_rows;
		for($i=0;$i<=$totalslide-1;$i++)
		{
			$pisah_awal=split('_',$array_order[$i]);
			$row=$this->side_panel_model->get_by_id($pisah_awal[1]);
			$this->side_panel_model->side_panel_order=$i+1;
			$this->side_panel_model->update_order($pisah_awal[1]);
			
		}
		echo 'Test Success';
	}
	
	function update_side_panel()
	{
		$this->side_panel_model->side_panel_title=$this->input->post('side_panel_title');
		$this->side_panel_model->side_panel_config=$this->input->post('side_panel_config');
		$this->side_panel_model->update_side_panel($this->input->post('side_panel_id'));
		
	}
}