<? $this->load->view('the_master/top'); ?>	
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.core.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery/ui/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/ui/themes/redmond/ui.dialog.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/ui/themes/redmond/ui.resizable.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.dialog.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.resizable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/ui.draggable.js"></script>

<script type="text/javascript">
	 	$(document).ready(function(){
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

            Post Management

        
    </div>
 		 <div class="formboxitem t_d_even">
            <a href="<?php echo site_url('post_management/psm_add');?>" class="addnewbtn">Add New</a>
        </div>
        	<table>
            <tr class="t_header">
            	<td>Date</td><td>Post</td><td>Category</td><td>Actions</td>
            </tr>
            <? $query=$this->the_post_model->get_all(10,$start);
            $i=0;
			$eod='';
			foreach($query->result() as $rows)
            { 
				$i++;	
				if($i%2<>0)
					$eod="t_r_even";
				else
					$eod="t_r_odd";
			?> 
           <tr class="<?php echo $eod;?>">
           	<td>
            	<?php echo mdate('%d/%m/%Y %h:%i:%s',$rows->the_post_date);?>
            </td>
            <td>
				<a href="<?php echo site_url('post_management/psm_edit/index/'.$rows->the_post_id);?>" title="<?php echo character_limiter(strip_tags($rows->the_post_content),70);?>"><?php echo character_limiter($rows->the_post_title,70);?></a><br />
                
            </td>
            <td>
            	<strong><?php echo $rows->category_name;?></strong>
            </td>
            <td>
                <a href="<?php echo site_url('post_management/psm_home/delete/'.$rows->the_post_id);?>" class="delete_confirm">Delete</a>
                
           	</td> 
           
           </tr>
         	 
            <? } ?>
		<tr class="t_header">
			<td colspan="4"><?php echo $the_pagination;?></td>
        </tr>
       
        </table>
   
</div>
    <div id="delete_dialog" title="Confirmation Required">
   		Are you sure to delete this page ?
   </div>
   
<? $this->load->view('the_master/footer'); ?>