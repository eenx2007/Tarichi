<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $site_name;?> | <?php echo $site_slogan;?></title>
</head>
<style>
	
	body{
		background:url(<?php echo $base_site_url;?>blueprint/images/site_bg.jpg);
		padding:0;
		margin:0;	
		font-size:12px;
	}
	
	img{
		width:100%;	
	}
	
	#header{
		background:#036;
		color:#FFF;
		padding-top:5px;	
		padding-bottom:5px;
	}
	
	#menu{
		border-bottom:1px solid #666;
		float:left;
		background:#999;
		margin-top:0;
		padding-top:5px;
		padding-bottom:5px;
		text-align:center;
		width:100%;
	}
	
	#menu a{
		font-size:small;	
		text-decoration:none;
		color:#FFF;
		
	}
	#menu ul{
		display:inline;
	}
	
	#menu ul li{
		display:block;	
		float:left;
		padding-left:3px;
		padding-right:3px;
	}
	
	#menu ul li ul{
		display:none;	
	}
	
	.the_post{
		padding-top:10px;	
		width:100%;
		float:left;
		padding-left:2px;
		padding-right:3px;
		border-bottom:solid 1px #D4D4D4;
		border-top:1px solid #F4F4F4;
	}
	
	.the_post h3{
		margin-bottom:2px;
	}
	.the_post h3 a{
		color:#036;
		text-decoration:none;	
	}
	
	h1,h2,h3{
		font-size:16px;
	}
	
	.pagination{
		clear:both;
		padding-top:10px;
		padding-bottom:10px;
		text-align:center;	
		width:100%;
		
		background:url(<?php echo $base_site_url;?>blueprint/images/before_footer.png);
	}
	
	.pagination a{
		padding-top:5px;
		padding-bottom:5px;
		padding-left:10px;
		padding-right:10px;
		color:#066;
		font-weight:bold;
		margin-bottom:0;
		
	}
	
	.pagination .selected{
		padding-top:5px;
		padding-bottom:5px;
		padding-left:10px;
		padding-right:10px;
	}
	
	#footer{
		padding-left:3px;
		padding-right:3px;
		padding-top:10px;
		background: url(<?php echo $base_site_url;?>blueprint/images/footerbg.png) repeat-x;	
		color:#FFF;
		margin-top:0;
		clear:both;
	}
	
	.comment_box{
		float:left;
		width:100%;
		border-top:1px solid #F4F4F4;	
		border-bottom:solid 1px #D4D4D4;
		padding-bottom:5px;
		padding-top:5px;
		background:#D4D4D4;
		margin-top:10px;
	}
	
	#comment_list img{
		width:30px;
		height:30px;	
	}
	
	.comment_title{
		border-bottom:solid 1px #FFF;
		padding-bottom:5px;
	}
	#capimage{
		width:100%;	
	}
	
	.comment_box{
		clear:both;
	}
	
	
</style>
<body>
	<div class="container">
    	<div id="header">
      		<?php echo $site_name;?><br />
			<?php echo $site_slogan;?>
        </div>
        <div id="menu">
			<ul><?php echo $this->template_model->create_menu('Beranda',$this->uri->uri_string());?></ul>
        </div>