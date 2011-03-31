<? $this->load->view('the_master/top'); ?>	
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.core.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery/ui/themes/ui-lightness/jquery.ui.all.css">


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/ui/themes/redmond/ui.dialog.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/ui/themes/redmond/ui.resizable.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.dialog.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.resizable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.draggable.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.sortable.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
				
				
				$('.view_sub_menu').click(function(){
						var sekarang=$('img',this).attr('src');
						if(sekarang=="<?php echo base_url();?>assets/blueprint/images/submenu_square.png")
							$('img',this).attr('src','<?php echo base_url();?>assets/blueprint/images/close_square.png');	
						else
							$('img',this).attr('src','<?php echo base_url();?>assets/blueprint/images/submenu_square.png');
							var bapak=$(this).parent();
							$('.the_sub_menu',bapak).slideToggle();
							
												   });
												   
				$('.enabling').click(function(){
						var sekarang=$(this).attr('title');
						var tp_id=$('img',this).attr('alt');
						var bapak=$(this).parent();
						var bapaknya=$(bapak).parent();
						var bapaklagi=$(bapaknya).parent();
						if(sekarang=='Enable')
						{
							$('img',this).attr('src','<?php echo base_url();?>assets/blueprint/images/disable.png');
							$(this).attr('title','Disable');
							$(bapaklagi).fadeTo('slow',1);
							var tp_enabled='1';
						}
						else if(sekarang=='Disable')
						{
							$('img',this).attr('src','<?php echo base_url();?>assets/blueprint/images/enable.png');	
							$(this).attr('title','Enable');
							$(bapaklagi).fadeTo('slow',0.5);
							var tp_enabled='0';
						}
						$.post('<?php echo site_url('page_management/pm_home/enabling_page');?>',{the_page_id : tp_id, the_page_enabled : tp_enabled},function(){
						});
						
						
				});
				$('#delete_dialog').dialog({
							modal: true,
								bgiframe: true,
								
						  autoOpen: false	   
										   });
				
				$('.delete_confirm').click(function(e){
							e.preventDefault();
							var theHREF = $(this).attr("href");
					
					
							$("#delete_dialog").dialog('option', 'buttons', {
									"Confirm" : function() {
										window.location.href = theHREF;
										},
									"Cancel" : function() {
										$(this).dialog("close");
										}
									});
					
							$("#delete_dialog").dialog("open");

							
													});
				$('#info_sorting').hide();
				$('#sortable').sortable({
								opacity: 0.6,
								
								stop: function() {
									$('#info_sorting').fadeIn();
									$('#info_sorting').html('<img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif"> Saving');
									var kearray=$('#sortable').sortable("toArray");
									var kestring=kearray.toString();
									$.post('<?php echo site_url('page_management/pm_home/save_order');?>',{ tostring : kestring }, function(data){
											
											$('#info_sorting').html('<img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif"> Order Saved');	
											$('#info_sorting').fadeOut('slow');
																													  });
								
								}
										
										});		
				
				
								   });
	</script>
    <? $totalpage=$query->num_rows;?>
    

   
    <div class="penuh formbox">
    	<div class="formboxtitle">
            
    	        Page Management
 	       	
    		
        </div>
         <div class="formboxitem t_r_even">
    			<a href="<?php echo site_url('page_management/pm_add');?>" class="addnewbtn">Add New</a>
    	</div>
     
    	<ol id="sortable" style="margin-left:-10px;margin-top:10px;clear:both;">
    	<? foreach($query->result() as $rows)
		{ 
			$querysub=$this->the_page_model->get_by_parent($rows->the_page_id);
			$totalsub=$querysub->num_rows;
		?>
        <div style="cursor:move;padding-top:0;width:99%;float:left;" title="drag to change order" id="<?php echo $rows->the_page_order;?>_<?php echo $rows->the_page_id;?>" class="the_page_item">
        	<? if($totalsub<>0)
				{ ?><div class="view_sub_menu" style="margin-top:16px;width:4%;float:left;">
            	
        		<span class="small"><a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/blueprint/images/submenu_square.png" title="View Submenu" /></a></span><br />
                
      		</div>
            <div class="tigaperempat" style="margin-top:15px;">
                <strong><?php echo $rows->the_page_menu;?> (<?php echo $totalsub;?>)</strong>
               
                
            </div>
			<? } else { ?>
            <div class="tigaperempat" style="margin-top:15px;">
                <strong><?php echo $rows->the_page_menu;?></strong>
               
                
            </div>
            <? } ?>
        	
          	<div class="seperempat last" style="text-align:right;margin-top:10px;width:25%;">
        		<span class="small">
                	<? if($rows->the_page_enabled==1)
						{ ?><a href="javascript:void(0);" class="enabling" title="Disable"><img src="<?php echo base_url();?>assets/blueprint/images/disable.png" class="imgblur" alt="<?php echo $rows->the_page_id;?>" /></a>
                        <? } elseif($rows->the_page_enabled==0)
						{ ?><a href="javascript:void(0);" class="enabling" title="Enable"><img src="<?php echo base_url();?>assets/blueprint/images/enable.png" class="imgblur" alt="<?php echo $rows->the_page_id;?>" /></a><? } ?>
                         <a href="<?php echo site_url('page_management/pm_edit/index/'.$rows->the_page_id);?>"><img src="<?php echo base_url();?>assets/blueprint/images/edit_square.png" title="Edit" class="imgblur" /></a> <a href="<?php echo site_url('page_management/pm_home/delete/'.$rows->the_page_id);?>" class="delete_confirm"><img src="<?php echo base_url();?>assets/blueprint/images/delete_square.png" title="Delete" class="imgblur" /></a>
               	</span><br />
                
      		</div>
            <div class="the_sub_menu" style="display:none;width:99%;">
        		<? 
				   foreach($querysub->result() as $rowssub)
				   { ?>
                   <div class="formboxitem tigaperempat">
                   		<div class="span-10 border"><?php echo $rowssub->the_page_menu;?></div>
                        <div class="span-10 last"> 
                        <? if($rowssub->the_page_enabled==0)
							{ ?>
                            	<a href="javascript:void(0);" class="enabling2" title="Enable"><span title="<?php echo $rowssub->the_page_id;?>">Enable</span></a> | 
                        <? } else { ?>
                        		<a href="javascript:void(0);" class="enabling2" title="Disable"><span title="<?php echo $rowssub->the_page_id;?>">Disable</span></a> |
                        <? } ?>
                        	<a href="<?php echo site_url('page_management/pm_edit/index/'.$rowssub->the_page_id);?>">Edit</a> | <a href="<?php echo site_url('page_management/pm_home/delete/'.$rowssub->the_page_id);?>" class="delete_confirm">Delete</a>
                        </div>
                   </div>
                   <? } ?>
        	</div>
        </div>
        
        <? } ?><div id="info_sorting" style="position:fixed;left:40%;top:40%;width:100px;height:50px;" class="the_page_item">
     			</div>
    </ol>
    </div>
    
   
   <div id="delete_dialog" title="Confirmation Required">
   		Are you sure to delete this page ?
   </div>
<? $this->load->view('the_master/footer'); ?>