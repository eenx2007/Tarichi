<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pm_home extends Master_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->data['page_type']="home";
		$this->data['bcum']="Page Management";
		$this->data['query']=$this->the_page_model->get_just_parent();
		$this->load->view('pm_home',$this->data);
	}
	
	function delete($the_page_id)
	{
		$the_page_id=$this->uri->segment(4);
		$this->the_page_model->delete($the_page_id);
		redirect('page_management/pm_home');
	}
	
	function enabling_page()
	{
		if($this->input->post('the_page_id'))
		{
			$this->the_page_model->enabling($this->input->post('the_page_id'),$this->input->post('the_page_enabled'));
				
		}
	}
	
	function save_order()
	{
		$order_data=$this->input->post('tostring');
		$last_order=$order_data;
		$array_order=split(',',$last_order);
		$querypage=$this->the_page_model->get_just_parent();
		$totalpage=$querypage->num_rows;
		for($i=0;$i<=$totalpage-1;$i++)
		{
			$pisah_awal=split('_',$array_order[$i]);
			$row=$this->the_page_model->get_detail($pisah_awal[1]);
			$this->the_page_model->the_page_order=$i+1;
			$this->the_page_model->update_order($pisah_awal[1]);
		}
		echo '<span>Order Saved</span>';	
	}
	
	function page_type_selector($the_type)
	{
		
		if($the_type=="per_category")
		{
			
			if($this->input->post('the_pt_id'))
			{
				$this->load->model('category_management/category_model');
				$query=$this->category_model->get_all();
				foreach($query->result() as $rows)
				{
					$query=$this->category_model->get_all();
					if($this->input->post('cat_id')=='category/'.$rows->category_url)
						echo '<option value="category/'.$rows->category_url.'" selected="selected">'.$rows->category_name.'</option>';		
					else
						echo '<option value="category/'.$rows->category_url.'">'.$rows->category_name.'</option>';	
				}
			}
		}
	}
}