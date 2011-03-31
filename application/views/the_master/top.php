<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/blueprint/screen.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/blueprint/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/blueprint/mystyle.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/blueprint/buttons_icon.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/blueprint/css_table.css"/>

<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery.hoverIntent.js"></script>


<script type="text/javascript">
	

	$(document).ready(function(){
		
			var bapakselect=$('.selected').parent();
			$(bapakselect).show();
			$('.dropdownbtn',bapakselect).css('background-position','-96px -192px');
			$('.dropdownbtn').click(function(){
				
				var bapak=$(this).parent();
				$('ul',bapak).slideToggle();	
				
				$('#content_right').height($('#html').height());
				
			});
			
			
			
							   });
</script>

<title>Backpanel | tarichi 2.0 sembada</title>
</head>
<body>
	<div class="container">
    	<div class="span-24" id="header">
        	<div id="logo" style="width:250px;float:left;">
        		<a href="<?php echo site_url('the_master');?>" title="<?php echo lang('caption_btd');?>"><img src="<?php echo base_url();?>assets/blueprint/images/logo.png" alt="tarichi logo" /></a>
            </div>
            <div id="breadcrumb">
		
        		<span class="the_bread_item"><a href="<?php echo site_url('the_master');?>"><?php echo $site_name;?></a> </span>
        
        
        		<span class="the_bread_item"><font size="3">&raquo;</font> <?php echo $bcum;?></span>
        		<? if(isset($bcum2)) { ?>
                <span class="the_bread_item"><font size="3">&raquo;</font> <?php echo $bcum2;?></span>
                <? } ?>
        
    		</div>
            
        </div>
            
      
       
            
           
        <div id="content" class="span-24">
       	<div id="left_content">

        	<ul> <? if($this->session->userdata('user_login'))
					{ ?>
            	<li><a href="javascript:void(0);" class="dropdownbtn"><?php echo lang('caption_logged_as');?> <?php echo $this->session->userdata('username');?></a>
                	<div><span></span></div>
                    <ul>
                    	<li><a href="<?php echo site_url('the_master/my_profile');?>"><?php echo lang('caption_edit_profile');?></a></li>
                        <li><a href="<?php echo site_url('the_master/logout');?>">Logout</a></li>
                    </ul>
                </li>
                	
                    <li><a href="javascript:void(0);" class="general_configbtn dropdownbtn"><?php echo lang('caption_general_configuration');?></a>
                    	<div><span></span></div><ul>
                    		<li <? if($this->uri->segment(2)=="site_config") echo 'class="selected"'; ?>><a href="<?php echo site_url('the_master/site_config');?>" class="site_configbtn"><?php echo lang('caption_site_configuration');?></a></li>
                            <li <? if($this->uri->segment(2)=="module_management") echo 'class="selected"'; ?>><a href="<?php echo site_url('the_master/module_management');?>" class="module_mbtn"><?php echo lang('caption_module_management');?></a></li>
                            <li <? if($this->uri->segment(1)=="skin_chooser") echo 'class="selected"'; ?>><a href="<?php echo site_url('skin_chooser');?>" class="skin_chooserbtn">Skins Chooser</a></li>
                            <li <? if($this->uri->segment(1)=="side_panel") echo 'class="selected"'; ?>><a href="<?php echo site_url('side_panel');?>" class="side_panelbtn">side_panel</a></li>
                            <li <? if($this->uri->segment(1)=="image_library") echo 'class="selected"'; ?>><a href="<?php echo site_url('image_library');?>" class="imagelibbtn">Images Library</a></li>
                            <li <? if($this->uri->segment(2)=="site_preview") echo 'class="selected"'; ?>><a href="<?php echo site_url('the_master/site_preview');?>" class="view_site">Site Preview</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="content_mbtn dropdownbtn"><?php echo lang('caption_basic_cms');?></a>
                    	<div><span></span></div><ul>
                        	<li <? if($this->uri->segment(1)=="static_home_page") echo 'class="selected"'; ?>><a href="<?php echo site_url('static_home_page');?>" class="static_homebtn">Static Home Page</a></li>
                        	<li <? if($this->uri->segment(1)=="page_management") echo 'class="selected"'; ?>><a href="<?php echo site_url('page_management/pm_home');?>" class="static_pagebtn">Pages</a></li>
                            <li <? if($this->uri->segment(1)=="category_management") echo 'class="selected"'; ?>><a href="<?php echo site_url('category_management/cm_home');?>" class="categorybtn">Categories</a></li>
                            <li <? if($this->uri->segment(1)=="post_management") echo 'class="selected"'; ?>><a href="<?php echo site_url('post_management/psm_home');?>" class="postbtn">Posts</a></li>
                            <li <? if($this->uri->segment(1)=="comment_management") echo 'class="selected"'; ?>><a href="<?php echo site_url('comment_management');?>" class="commentbtn">Comments</a></li>
                            
                        </ul>
                    </li>
                    
                    <li><a href="javascript:void(0);" class="dropdownbtn">Add on Module</a>
                    	<div><span></span></div><ul>
                        	<? $query=$this->global_model->get_module();
							foreach($query->result() as $rowsmodule)
							{ ?>
                            <li <? if($this->uri->segment(1)==$rowsmodule->add_on_id) echo 'class="selected"'; ?>><a href="<?php echo site_url($rowsmodule->add_on_id);?>"><?php echo $rowsmodule->add_on_name;?></a></li>
                            <? } ?>
                        </ul>
                    </li>
                    <? } ?>
 					
                </ul>
      	</div>
       	<div id="right_content">
         	