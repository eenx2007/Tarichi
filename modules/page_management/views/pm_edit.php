<? $this->load->view('the_master/top'); ?>	
<script type="text/javascript" src="<?php echo base_url();?>jquery/tiny_mce/jquery.tinymce.js"></script>
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
				$('#image_library').hide();	
				$('#imglibbtn').click(function(){
								$('#image_library').fadeToggle('fast');	
								$('#image_library').load('<?php echo site_url('ajax_things/image_library');?>');
											   });
				
				$('#imglibbtn2').click(function(){
								$('#image_library2').fadeToggle('fast');
								$('#image_library2').load('<?php echo site_url('ajax_things/image_library2');?>');
												});
				$('#the_page_content').tinymce({
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
				$('#the_url_title').hide();
				$('#the_page_title').keyup(function(){
					    var url_title=$(this).val();
						$('#the_url_title').fadeIn();
						if(url_title=='')
						{
							$('#the_url_title').html('Please insert title');
						}
						else
						{
							$.post('<?php echo site_url('the_master/url_checker');?>',{ the_url : url_title},function(data){
									$('#the_url_title').html('<?php echo site_url('the_page');?>/'+data+'<br />');	
									$('#normal_link_to').val('the_page/'+data);
																					   });						   
						}
												   });
				$('#per_category_page').hide();
				$('#static_link_page').hide();
				$('#contact_page').hide();
				$('#page_type_id').change(function(){
						var page_type_id=$(this).val();
						if(page_type_id == '1')
						{
							$('#per_category_page').slideUp();
							$('#contact_page').slideUp();
							$('#static_link_page').slideUp();
							$('#normal_page').slideDown();
						}
						else if (page_type_id == '2')
						{
							$('#static_link_page').slideUp();
							$('#normal_page').slideUp();
							$('#contact_page').slideUp();
							$('#per_category_page').slideDown();
							$.post('<?php echo site_url('the_master/page_type_selector/per_category');?>', { the_pt_id : page_type_id },function(data){
										$('#per_category').html(data);
										
										});
						}
						else if(page_type_id == '3')
						{
							$('#per_category_page').slideUp();	
							$('#static_link_page').slideUp();
							$('#normal_page').slideUp();
							$('#contact_page').slideDown();
							
						}
						else if(page_type_id == '4')
						{
							$('#per_category_page').slideUp();
							$('#normal_page').slideUp();
							$('#contact_page').slideUp();
							$('#static_link_page').slideDown();
						}
						else if(page_type_id == '5')
						{
							$('#per_category_page').slideUp();	
							$('#static_link_page').slideUp();
							$('#normal_page').slideUp();
							$('#contact_page').slideUp();
						}	
						
												   });
				
					  var page_type_id2='<?php echo $row->the_page_type_id;?>';
					  if(page_type_id2 == '1')
					  {
						  $('#per_category_page').slideUp();
						  $('#contact_page').slideUp();
						  $('#static_link_page').slideUp();
						  $('#normal_page').slideDown();
					  }
					  else if (page_type_id2 == '2')
					  {
						  $('#static_link_page').slideUp();
						  $('#normal_page').slideUp();
						  $('#contact_page').slideUp();
						  $('#per_category_page').slideDown();
						  var ct_id='<?php echo $row->the_page_link_to;?>';
						  $.post('<?php echo site_url('page_management/pm_home/page_type_selector/per_category');?>', { the_pt_id : page_type_id2, cat_id : ct_id },function(data){
									  $('#per_category').html(data);
									  
									  });
					  }
					  else if(page_type_id2 == '3')
					  {
						  $('#per_category_page').slideUp();	
						  $('#static_link_page').slideUp();
						  $('#normal_page').slideUp();
						  $('#contact_page').slideDown();
						  
					  }
					  else if(page_type_id2 == '4')
					  {
						  $('#per_category_page').slideUp();
						  $('#normal_page').slideUp();
						  $('#contact_page').slideUp();
						  $('#static_link_page').slideDown();
					  }
					  else if(page_type_id2 == '5')
					  {
						  $('#per_category_page').slideUp();	
						  $('#static_link_page').slideUp();
						  $('#normal_page').slideUp();
						  $('#contact_page').slideUp();
					  }	
						
												  
				
								   });
	</script><?php echo form_open('page_management/pm_edit/index/'.$the_page_id);?>
    
        <div class="formbox penuh">
    	<div class="formboxtitle">
 
                Edit page
 
            
        </div>
        <div class="t_r_even formboxitem" style="text-align:right;">
        	<input type="submit" value="Save" name="save" class="savebtn"> <a href="<?php echo site_url('page_management/pm_home');?>" class="discardbtn">Discard</a>
        </div>
        <div class="formboxitem" style="clear:both;">
            <label>Page Type</label><br />
                <? $page_type_id=array();
                    $querypt=$this->the_page_model->get_page_type();
                    foreach($querypt->result() as $rowspt)
                    {
                        $page_type_id[$rowspt->the_page_type_id]=$rowspt->the_page_type_name;
                    }
                    echo form_dropdown('the_page_type_id',$page_type_id,$row->the_page_type_id,'id="page_type_id"');
                ?> 
         </div>

        <div class="tigaperempat border">
            <div id="normal_page">
                <div class="formboxitem">
	                <label>Title</label><br /><span id="the_url_title" style="font-size:10px;color:#CC0;"></span>
    	            <input type="hidden" name="normal_link_to" id="normal_link_to" value="<?php echo $row->the_page_link_to;?>">
        	        <input type="text" name="the_page_title" style="width:95%;" id="the_page_title" value="<?php echo $row->the_page_title;?>">
            	</div>
                <div class="formboxitem">
	                <textarea name="the_page_content" style="width:95%;height:400px;" id="the_page_content" class="tinymce_content"><?php echo $row->the_page_content;?></textarea>
                </div>
            </div>
            <div id="per_category_page">
 				<div class="formboxitem">
   	               <label>Category</label> <select name="per_category" id="per_category"></select> <br />
                	<span class="small">* Choose one category to be linked with this menu</span>
                </div>
            </div>
            <div id="contact_page">
                * Coming soon
            </div>
            <div id="static_link_page">
                <div class="formboxitem">
	                <label>Web Link</label> <input type="text" name="static_link" id="static_link" value="http://"><br />
    	            <span class="small">* Just a link to a page / website</span>
                </div>
            </div>
        </div>
        <div class="seperempat last">
            <div class="formboxitem">
            	 <div id="image_library" style="position:absolute;margin-left:-475px;width:500px;margin-top:-5px;">
                    <img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif"  />	
                </div>
            	<a href="javascript:void(0);" class="imageuploaderbtn" id="imglibbtn">Open Image Uploader</a>
            </div>
            <div class="formboxitem">	
            	<div id="image_library2" class="" style="position:absolute;margin-left:-475px;width:500px;margin-top:-5px;display:none;">
        		<img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif"  />	
         	</div>
                <a href="javascript:void(0);" class="imagelibrarybtn" id="imglibbtn2">Open Image Library</a>
            </div>
            <div class="formboxitem">
            	<label>Menu Title</label><br />
            	<?php echo form_input('the_page_menu',$row->the_page_menu);?> 
            </div>
            <div class="formboxitem">
                <label>Parent Page</label><br />
                <? $the_page_parent=array();
                   $querypp=$this->the_page_model->get_parent();
                   $the_page_parent[0]='None';
                   foreach($querypp->result() as $rowspp)
                   {
                        $the_page_parent[$rowspp->the_page_id]=$rowspp->the_page_menu;   
                   }
                   echo form_dropdown('the_page_parent',$the_page_parent,$row->the_page_parent);
                ?>
            </div>
			
        </div>
    </div>
    <?php echo form_close();?>
<? $this->load->view('the_master/footer'); ?>