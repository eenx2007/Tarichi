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
			$('.the_sub_menu').hide();
			
			$('.view_sub_menu').click(function(){
					var sekarang=$('img',this).attr('src');
					if(sekarang=="<?=base_url();?>blueprint/images/submenu_square.png")
						$('img',this).attr('src','<?=base_url();?>blueprint/images/close_square.png');	
					else
						$('img',this).attr('src','<?=base_url();?>blueprint/images/submenu_square.png');
						
						var bapak=$(this).parent();
						$('.the_sub_menu',bapak).slideToggle('fast');
						
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
							   });
</script>
<div class="formbox penuh">
	<div class="formboxtitle">
		Category Management
	</div>
    <div class="formboxitem t_d_even">
			<a href="<?=site_url('/category_management/cm_add');?>" class="addnewbtn">Add New</a>
		</div>
	<div style="clear:both;padding-top:15px;margin-left:10px;">
		
			<?
				foreach($query->result() as $rows)
				{
					$totalpost=$this->the_post_model->get_all_per_category($rows->category_id);
					
			?>
				<div class="the_page_item" style="padding-top:0;width:95%;margin-right:10px;float:left;">
					<div class="view_sub_menu" style="margin-top:16px;float:left;width:3%;">
						<span class="small"><a href="javascript:void(0);"><img src="<?=base_url();?>blueprint/images/submenu_square.png" title="Show Detail" alt="open" /></a></span><br />
					</div>
					<div class="tigaperempat" style="margin-top:15px;">
						<strong><?=$rows->category_name;?></strong>
					</div>
					<div class="last" style="text-align:right;margin-top:10px;width:10%;float:left;">
						<a href="<?=site_url('category_management/cm_edit/index/'.$rows->category_id);?>" style="text-decoration:none;color:#333"><img src="<?=base_url();?>blueprint/images/edit_square.png" title="Edit" class="imgblur" /></a>
						<a href="<?=site_url('category_management/cm_home/delete/'.$rows->category_id);?>" title="Delete <?=$rows->category_name;?>" class="delete_confirm"><img src="<?=base_url();?>blueprint/images/delete_square.png" title="Delete" class="imgblur" /></a>
					</div>
					<div class="the_sub_menu">
						<div class="formboxitem">
							<?=$totalpost;?> Post(s)
						</div>
						<div class="formboxitem">
							<?=$rows->category_desc;?>
						</div>
					</div>
				</div>
			<? } ?>
	  
	</div>
</div>
<div id="delete_dialog" title="Confirmation Required">
	Are you sure to delete this category ?
</div>
<? $this->load->view('the_master/footer'); ?>