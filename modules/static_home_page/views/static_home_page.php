<? $this->load->view('the_master/top'); ?>	
 <script type="text/javascript" src="<?php echo base_url();?>jquery/tiny_mce/jquery.tinymce.js"></script>
 
 	<script type="text/javascript" src="<?php echo base_url();?>jquery/ui/ui.core.js"></script>
 	<link rel="stylesheet" href="<?php echo base_url();?>jquery/ui/themes/ui-lightness/jquery.ui.all.css">

<script type="text/javascript">
	$(document).ready(function(){
					var mouse_is_inside=false;
					var mouse_is_inside2=false;
					var combined= $('#imglibbtn').add($('#image_library'));
					var combined2= $('#imglibbtn2').add($('#image_library2'));
					$(combined).hover(function(){
							mouse_is_inside=true;
											   },function(){
							mouse_is_inside=false;
										   });
					$(combined2).hover(function(){
							mouse_is_inside2=true;
											   },function(){
							mouse_is_inside2=false;
										   });
					
					$('body').mouseup(function(){
								if(! mouse_is_inside)
									$('#image_library').hide();
								if(! mouse_is_inside2)
									$('#image_library2').hide();
											});
					$('#loader_image').hide();
								   
					$('#imglibbtn').click(function(){
									$('#image_library').fadeToggle('fast');	
									$('#image_library').load('<?php echo site_url('ajax_things/image_library');?>');
												   });
					
					$('#imglibbtn2').click(function(){
									$('#image_library2').fadeToggle('open');
									$('#image_library2').load('<?php echo site_url('ajax_things/image_library2');?>');
													});		
			$('#save').click(function(){
					$('#loader_image').show();
					var s_h_p_title = $('#static_home_page_title').val();
					var s_h_p_content = $('#static_home_page_content').val();
					$.post('<?php echo site_url('static_home_page/save');?>',{
										  static_home_page_title : s_h_p_title,
										  static_home_page_content : s_h_p_content
									   }, function(data){
										   $('#loader_image').hide();
									   	});
					
									  });
			
			$('#static_home_page_content').tinymce({
					script_url : '<?php echo base_url();?>jquery/tiny_mce/tiny_mce.js',					  
					relative_urls : false,

					theme : "advanced",
					plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
					theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pastetext,pasteword,bullist,numlist,blockquote,|,undo,redo,|,link,unlink,anchor,image,media,code",
					theme_advanced_buttons2 : "insertdate,inserttime,hr,|,sub,sup,|,charmap,emotions,|,fullscreen,pagebreak,|,fontsizeselect,formatselect,preview,cite",
					theme_advanced_buttons3 : "",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom"
										  });	
							   });
</script>


	
    
   
    <div class="tigaperempat formbox">
    	
        <div class="formboxtitle">
            Static Home Page
        </div>
        <div class="t_r_even formboxitem">
    	 <a href="javascript:void(0);" class="savebtn" id="save">Save</a> <img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif" id="loader_image" style="position:fixed;" />
    	</div>
        <div class="formboxitem">
        	<label>Title</label><br />
        	<input type="text" name="static_home_page_title" value="<?php echo $row->static_home_page_title;?>" id="static_home_page_title" style="width:98%;">
        </div>
        <div class="formboxitem">
            <textarea id="static_home_page_content" name="static_home_page_type" class="tinymce_content" style="width:98%;"><?php echo $row->static_home_page_content;?></textarea>
       	</div>
        
    </div>
    <div class="seperempat last formbox">
    	<div class="formboxtitle">
        	Tools
        </div>
        
        
        <div class="formboxitem">
    		<div id="image_library" class="" style="position:absolute;margin-left:-475px;width:500px;margin-top:-5px;display:none;">
        		<img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif"  />	
         	</div>
         	<a href="javascript:void(0);" class="imageuploaderbtn" id="imglibbtn">Image Uploader</a>
        </div>
        <div class="formboxitem">
        	<div id="image_library2" class="" style="position:absolute;margin-left:-475px;width:500px;margin-top:-5px;display:none;">
        		<img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif"  />	
         	</div>
        	<a href="javascript:void(0);" class="imagelibrarybtn" id="imglibbtn2">Image Library</a>
        </div>
    </div>
     

<? $this->load->view('the_master/footer'); ?>