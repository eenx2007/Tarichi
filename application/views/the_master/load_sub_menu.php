<script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.core.js"></script>
	<link rel="stylesheet" href="<?=base_url();?>jquery/ui/themes/ui-lightness/jquery.ui.all.css">
    
    
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>jquery/ui/themes/redmond/ui.dialog.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>jquery/ui/themes/redmond/ui.resizable.css" />
	<script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.dialog.js"></script>
	<script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.resizable.js"></script>
    <script type="text/javascript" src="<?=base_url();?>jquery/ui/ui.draggable.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
				$('#delete_dialog2').dialog({
							modal: true,
								bgiframe: true,
								
						  autoOpen: false	   
										   });
				
				$('.delete_confirm2').click(function(e){
							e.preventDefault();
							var theHREF = $(this).attr("href");
					
					
							$("#delete_dialog2").dialog('option', 'buttons', {
									"Confirm" : function() {
										window.location.href = theHREF;
										},
									"Cancel" : function() {
										$(this).dialog("close");
										}
									});
					
							$("#delete_dialog2").dialog("open");

							
													});		
				$('.imgblur').hover(function(){
									$(this).fadeTo('fast',1);},
									function(){
									$(this).fadeTo('slow',0.5);});
							   });
</script>
<? 
$total=$query->num_rows;

if($total<>0)
{
	
	foreach($query->result() as $rows)
			{ ?>
			<div id="<?=$rows->the_page_order;?>_<?=$rows->the_page_id;?>" class="the_page_item span-10" style="padding-top:0;">
				
				<div class="span-6" style="margin-top:20px;">
					<strong><?=$rows->the_page_menu;?></strong>
				</div>
					
				<div class="span-4 last" style="text-align:right;margin-top:10px;">
					<span class="small"><a href="<?=site_url('the_master/page_management/edit/'.$rows->the_page_id);?>"><img src="<?=base_url();?>blueprint/images/edit_square.png" title="Edit" class="imgblur" /></a> <a href="<?=site_url('the_master/page_management/delete/'.$rows->the_page_id);?>" class="delete_confirm2"><img src="<?=base_url();?>blueprint/images/delete_square.png" title="Delete" class="imgblur" /></a></span><br />
					
				
				</div>
				
			</div>
        <? } } else { echo "No Submenu"; } ?>
		
         <div id="delete_dialog2" title="Confirmation Required">
   		Are you sure to delete this page ?
   		</div>