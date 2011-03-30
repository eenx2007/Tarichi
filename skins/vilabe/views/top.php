<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_site_url;?>blueprint/screen.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_site_url;?>blueprint/own_s.css"/>
<script type="text/javascript" src="<?php echo $base_site_url;?>jquery/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?php echo $base_site_url;?>jquery/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo $base_site_url;?>/jquery/jquery.scrollTo.js"></script>
<meta name="keywords" content="<?php echo $site_default_keywords;?>" />
<meta name="description" content="<?php echo $site_default_description;?>" />
<title><?php echo $site_name;?> | <?php echo $site_slogan;?></title>
</head>

<body>
<script type="text/javascript">
	$(document).ready(function(){
		$('#menu ul li').hoverIntent(
					function(){
						$('ul',this).fadeIn('fast');
					},
					function(){
						$('ul',this).fadeOut();
					});
		$('#backtotop').click(function(){
			$.scrollTo('#header',500);
		});
							
	});
</script>
	
	<div class="container">
    	<div class="span-24" id="header">
        	<div class="span-6" id="logo">
            	<a href="<?php echo base_url();?>"><img src="<?php echo $base_site_url;?>blueprint/images/logo.png" /></a>
            </div>
            <div class="span-18 last" id="menu">
            	<ul>
                	<?php echo $this->template_model->create_menu('Beranda',$this->uri->uri_string());?>
                </ul>
            </div>
        </div>
    </div>
    <div id="kotakkotak">
        <div id="splashword" class="container">
        	<div class="span-16" id="katasplash">
            	<h3><?php echo $site_slogan;?></h3>
                <span>Belajarlah untuk tetap tenang</span>
            </div>
            <div class="span-8 last" id="searchitem">
            	<?php echo form_open('skin_engine/search_now');?>
                    <div class="searchboxbig span-7">
                        <input type="text" name="searchbox" id="searchbox" class="searchbox" />
                    </div>
                    <div class="searchbuttonbig span-1 last">
                        <input type="submit" value="" class="searchbutton" name="searchbutton" />
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="span-24">