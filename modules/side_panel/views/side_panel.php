<? $this->load->view('the_master/top'); ?>
<script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.core.js"></script>
 <link rel="stylesheet" href="<?=base_url();?>jquery/ui/themes/ui-lightness/jquery.ui.all.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>jquery/ui/themes/redmond/ui.dialog.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>jquery/ui/themes/redmond/ui.resizable.css" />
	<script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.dialog.js"></script>
	<script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.resizable.js"></script>
    <script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.draggable.js"></script>
    
<script type="text/javascript">
	$(document).ready(function(){
				
				$('#dialog_add_new').dialog({
							modal: true,
							bgiframe: true,
							autoOpen: false	   
										   });	
				
				$('#panel_detail').hide();
				$('#loader_thing').hide();
			
				$('#btn_add_new').click(function(){
					
					$('#dialog_add_new').dialog('option', 'buttons', {
									"Cancel" : function() {
										$(this).dialog("close");
										},
									"Add" : function() {
										$('#loader_thing').show();
										var s_panel_type = $('#side_panel_type').val();
										var s_panel_title = $('#side_panel_title').val();
										var s_panel_status = $('#side_panel_status').val();
										$.post('<?=site_url('side_panel/save_side_panel');?>',{ side_panel_type : s_panel_type, side_panel_title : s_panel_title, side_panel_status : s_panel_status }, function(data){
											$('#loader_thing').fadeOut();
											$('#dialog_add_new').dialog('close');
											$('#side_panel_title').val('');
											if(data == 0)
												$('#side_panel_list').load('<?=site_url('side_panel/side_panel_list/0');?>');
											else
												$('#side_panel_list2').load('<?=site_url('side_panel/side_panel_list/1');?>');
																																											  });
									}
										});		
					$('#dialog_add_new').dialog('open');
												 });
				$('#side_panel_list').load('<?=site_url('side_panel/side_panel_list/0');?>');
				$('#side_panel_list2').load('<?=site_url('side_panel/side_panel_list/1');?>');
				
				$('.deletebtn').live('click',function(){
							var s_p_id=$(this).attr('alt');
							var s_p_status=$(this).attr('id');
							$('#loader_thing').show();
							$.post('<?=site_url('side_panel/delete_side_panel');?>',{ side_panel_id : s_p_id }, function(data){
									    if(s_p_status==0)
											$('#side_panel_list').load('<?=site_url('side_panel/side_panel_list/0');?>');
										else
											$('#side_panel_list2').load('<?=site_url('side_panel/side_panel_list/1');?>');
										$('#loader_thing').hide();
																											  });
							
							
													  });
							   });
</script>

<div class="formbox penuh">
	<div class="formboxtitle">
    	Side Panel Item
       
    </div>
	<div class="formboxitem t_r_even">
    	<a href="#" class="addnewbtn" id="btn_add_new">Add New Item</a>
    </div>	
	<div class="span-10 border" style="clear:both">
    	<div class="formboxitem" style="margin-bottom:10px;">
    		<strong>Global Panel</strong>
        </div>
    	<div class="span-10" id="side_panel_list">
    		<img src="<?=base_url();?>blueprint/images/ajax_start.gif" />
        </div>
    </div>
    <div class="span-10 border">
    	<div class="formboxitem" style="margin-bottom:10px;">
    		<strong>Read Post Panel</strong>
        </div>
		<div class="span-10" id="side_panel_list2">
			<img src="<?=base_url();?>blueprint/images/ajax_start.gif" />
		</div>
    </div>
    
</div>  
		<div id="loader_thing" style="position:fixed;left:40%;top:40%;width:100px;height:50px;" class="the_page_item">
    	 	<img src="<?=base_url();?>blueprint/images/ajax_start.gif" /> Saving ...
        </div>
    <div id="dialog_add_new" title="Add New Panel Item" style="display:none;">
 	  	<label>Title</label><br />
        <input type="text" name="side_panel_title" id="side_panel_title" style="width:95%;"><br />
    	<label>Panel Item Type</label><br />
		<?
			$side_panel_type=array('post_by_category'=>'Post By Category','category_list'=>'Category List','last_comment'=>'Last Comment','pages'=>'Pages','calendar'=>'Calendar','archives'=>'Archives','free_text'=>'Free Text','tag_cloud'=>'Tag Cloud');
			echo form_dropdown('side_panel_type',$side_panel_type,'','id="side_panel_type"');
		?>	<br />
        <label>Panel Type</label><br />
        	<? $side_panel_status=array('0'=>'Global Panel','1'=>'Read Post Panel');
			echo form_dropdown('side_panel_status',$side_panel_status,'','id="side_panel_status"');
			?><br />
       
        <div id="panel_detail">
        	
        </div>		
    </div>

<? $this->load->view('the_master/footer'); ?>