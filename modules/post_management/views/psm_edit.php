<? $this->load->view('the_master/top'); ?>	
<script type="text/javascript" src="<?=base_url();?>jquery/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
					
					$('.delete_tag').click(function(){
						var tc_id=$(this).attr('alt');
						var bapak=$(this).parent();
						$.post('<?=site_url('ajax_things/delete_tag');?>',{ the_tag_connector_id : tc_id },function(){
							$(bapak).fadeOut('fast');					
						});
		
					});
			
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
								$('#image_library').load('<?=site_url('ajax_things/image_library');?>');
											   });
					
					$('#imglibbtn2').click(function(){
									$('#image_library2').fadeToggle('fast');
									$('#image_library2').load('<?=site_url('ajax_things/image_library2');?>');
													});			   
								   
					$('#the_post_content').tinymce({
					script_url : '<?=base_url();?>jquery/tiny_mce/tiny_mce.js',					  
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
				$('#the_post_title').keyup(function(){
					    var url_title=$(this).val();
						$('#the_url_title').fadeIn();
						$.post('<?=site_url('the_master/url_checker');?>',{ the_url : url_title},function(data){
								$('#the_url_title').html('<?=site_url('read');?>/<?=date('Y/m/d');?>/'+data+'<br />');	
								
																				   });						   
												   });
								   });
	</script>
    <?=form_open('post_management/psm_edit/index/'.$row->the_post_id);?>
    
    <div class="formbox penuh">
    	<div class="formboxtitle">
       		Edit Post
       	</div>
       	<div class="formboxitem t_r_even" style="text-align:right;">
                <input type="submit" value="Save" name="save" class="savebtn"> <a href="<?=site_url('post_management/psm_home');?>" class="discardbtn">Discard</a>
        </div>
        <div class="tigaperempat border">
           	<div class="formboxitem">
                <label>Post Title</label> <br /><span id="the_url_title" style="font-size:10px;color:#CC0;"></span>
                <input type="text" name="the_post_title" id="the_post_title" style="width:95%;" value="<?=$row->the_post_title;?>" />
            </div>
            <div class="formboxitem">
                <textarea name="the_post_content" id="the_post_content" class="tinymce_content" style="width:95%;height:400px;"><?=$row->the_post_content;?></textarea>
            </div>
        </div>
        <div class="seperempat last">
        	<div class="formboxitem">
            	<div id="image_library" style="position:absolute;margin-left:-475px;width:500px;margin-top:-5px;">
                    <img src="<?=base_url();?>blueprint/images/ajax_start.gif"  />	
                </div>
            	<a href="javascript:void(0);" class="imageuploaderbtn" id="imglibbtn">Image Uploader</a>
            </div>   
            <div class="formboxitem">
            	<div id="image_library2" class="" style="position:absolute;margin-left:-475px;width:500px;margin-top:-5px;display:none;">
        		<img src="<?=base_url();?>blueprint/images/ajax_start.gif"  />	
         		</div>
            	<a href="javascript:void(0);" class="imagelibrarybtn" id="imglibbtn2">Image Library</a>
            </div>
            <div class="formboxitem">
                <label>Category</label> <br />
                <?
                    $category_id=array();
                    $querycat=$this->category_model->get_all();
                    foreach($querycat->result() as $rowscat)
                    {
                        $category_id[$rowscat->category_id]=$rowscat->category_name;
                    }
                    echo form_dropdown('category_id',$category_id,$row->category_id);
                ?>
            </div>
            <div class="formboxitem">
            	<label>Allow Comment ?</label><br />
                <? $the_post_comment=array('0'=>'Yes','1'=>'No');
					echo form_dropdown('the_post_comment',$the_post_comment,$row->the_post_comment); ?>
            </div>
            <div class="formboxitem">
            	<label>Tags</label>
                <textarea name="the_tag_name" id="the_tag_name" style="width:95%;height:100px;"></textarea>
                <span class="small">Comma separated (ex: Tarichi, Eenx, Goblogan)</span>
            </div>
           
            <div class="formboxitem">
            	<label>Tags added</label><br /><br />
                <?
					$querytag=$this->the_tag_model->get_per_post($row->the_post_id);
					foreach($querytag->result() as $rowstag)
					{
				?>
                	<span class="tag_item"><?=$rowstag->the_tag_name;?> <img src="<?=base_url();?>blueprint/images/delete_small.png" alt="<?=$rowstag->the_tag_connector_id;?>" style="position:relative;margin-bottom:0;cursor:pointer;" class="delete_tag" /></span>
                <? } ?>
            </div>    
            
        </div>
    </div>
    <?=form_close();?>
	<? $this->load->view('the_master/footer'); ?>