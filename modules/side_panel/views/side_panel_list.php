
<script type="text/javascript" src="<?php echo base_url();?>jquery/ui/ui.sortable.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#sortable<?php echo $side_panel_status;?>').sortable({
								opacity: 0.6,
								
								stop: function() {
									$('#loader_thing').show();
									var kearray=$('#sortable<?php echo $side_panel_status;?>').sortable("toArray");
									var kestring=kearray.toString();
									var s_panel_status='<?php echo $side_panel_status;?>';
									$.post('<?php echo site_url('side_panel/save_side_panel_order');?>',{ tostring : kestring, side_panel_status : s_panel_status }, function(data){
											$('#loader_thing').fadeOut('slow');
																											  });
								
								}
										
										});						  
							  });
	
</script>	

	<ul id="sortable<?php echo $side_panel_status;?>" style="clear:both;margin-left:-9px;">
	<?
	foreach($query->result() as $rows)
	{
	?><script type="text/javascript">
	$(document).ready(function(){
			
			$('#slide_btn_<?php echo $rows->side_panel_id;?>').click(function(){
					$('#config_thing_<?php echo $rows->side_panel_id;?>').slideToggle();
																	  });
			
			$('#savebtn_<?php echo $rows->side_panel_id;?>').click(function(){
					var s_p_id = <?php echo $rows->side_panel_id;?>;
					var s_p_title=$('#side_panel_title_<?php echo $rows->side_panel_id;?>').val();
					var s_p_config = $('#side_panel_config_<?php echo $rows->side_panel_id;?>').val();
					$.post('<?php echo site_url('side_panel/update_side_panel');?>', { side_panel_id : s_p_id, side_panel_title : s_p_title, side_panel_config : s_p_config },function(data){
											$('#config_thing_<?php echo $rows->side_panel_id;?>').slideUp();
																																				});
																	});
			
			
							   });
	</script>
		<div id="<?php echo $rows->side_panel_order;?>_<?php echo $rows->side_panel_id;?>" style="cursor:move;" class="the_page_item span-9">
			<div class="span-5">
				<strong><?php echo $rows->side_panel_type;?></strong>
                
			</div>
			<div class="span-4 last" style="text-align:right;">
				<img src="<?php echo base_url();?>blueprint/images/slide_down.png" id="slide_btn_<?php echo $rows->side_panel_id;?>" style="cursor:pointer;" title="edit" /> <img src="<?php echo base_url();?>blueprint/images/delete_small.png" class="deletebtn" id="<?php echo $side_panel_status;?>" style="cursor:pointer;" title="delete" alt="<?php echo $rows->side_panel_id;?>" />
            </div>
            
            <div class="span-9" id="config_thing_<?php echo $rows->side_panel_id;?>" style="display:none;">
        		<div class="formboxitem">
				  	<input type="text" name="side_panel_title_<?php echo $rows->side_panel_id;?>" id="side_panel_title_<?php echo $rows->side_panel_id;?>" value="<?php echo $rows->side_panel_title;?>" style="width:95%;" />
                </div>
        		<? if($rows->side_panel_type=="last_comment") 
				{
					?>
                    <div class="formboxitem">
                    <label>No. to Show </label> <?  $no_to_show=array();
													for($i=10;$i>=1;$i--)
													{ 
														$no_to_show[$i]=$i;
													} 
													echo form_dropdown('side_panel_config_'.$rows->side_panel_id,$no_to_show,$rows->side_panel_config,'id="side_panel_config_'.$rows->side_panel_id.'"'); ?>
                    </div>
                <? } elseif($rows->side_panel_type=="free_text")
				{ ?>
                	<div class="formboxitem">
                    	<textarea name="free_text" style="width:95%;" id="side_panel_config_<?php echo $rows->side_panel_id;?>"><?php echo $rows->side_panel_config;?></textarea>
                    </div>
                <? } elseif($rows->side_panel_type=="post_by_category")
				{ ?>
                	<div class="formboxitem">
                	<? $category_id=array();
					   $querycat=$this->category_model->get_all();
					   foreach($querycat->result() as $rowscat)
					   {
						   $category_id[$rowscat->category_id]=$rowscat->category_name;
					   }
					   echo form_dropdown('side_panel_config_'.$rows->side_panel_id,$category_id,$rows->side_panel_config,'id="side_panel_config_'.$rows->side_panel_id.'"');
					   ?>
                    </div>
                <? } ?>
                <div class="formboxitem">
                	<a href="#" class="savebtn" id="savebtn_<?php echo $rows->side_panel_id;?>">Save</a>
                </div>
                    
        	</div>
            
        </div>
        
    <? } ?>
    
</ul>

