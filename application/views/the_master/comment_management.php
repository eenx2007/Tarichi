<? $this->load->view('the_master/top'); ?>
<div class="formbox span-24">
	<div class="formboxtitle">
		Comment Management
    </div>
    <? if($site_comment_moderation==0)
	{
		?>
        
    <div class="formboxitem"><font color="red">Comment Moderation is Off !!</font></div>
    <? } else { ?>
   		<div class="formboxitem"><font color="green">Comment Moderation is On</font></div>
    <? } ?>
    		<script type="text/javascript">
				$(document).ready(function(){
							$('.approve').click(function(){
										var c_id=$(this).attr('alt');
										$.post('<?=site_url('ajax_things/approve_comment');?>',{ comment_id : c_id },function(data){
											$('#status_'+c_id).html('Approved');
											});
										$(this).hide();
										
														  });
							
							$('.delete').click(function(){
										var c_id=$(this).attr('alt');
										$.post('<?=site_url('ajax_things/delete_comment');?>',{ comment_id : c_id },function(data){
											$('#'+c_id).hide();
											});

														});
							
							$('.maincheck').click(function(){
									var checkfirst=$(this).attr('checked');
									
									if(checkfirst==true)
									{
										$('.childcheck').attr('checked',true);
									}
									else
									{
										$('.childcheck').attr('checked',false);
									}
														   });
							$('#actions').change(function(){
									var checked=$('.childcheck');
									var selection = $(this).val();
									
									for(i=0;i<checked.length;i++)
									{
										if(checked.eq(i).attr('checked') == true)
										{
											if(selection == '0')
											{
												var comment_status=$('#status_'+checked.eq(i).val()).attr('title');
												if(comment_status=='0')
												{	
													$.post('<?=site_url('ajax_things/approve_comment');?>',{ comment_id : checked.eq(i).val() },function(data){
														
																																		   });
													$('#status_'+checked.eq(i).val()).html('Approved');	
												}
											}
											else if(selection == '1')
												$('#'+checked.eq(i).val()).fadeOut();
											
										}
									}
									$('.childcheck').attr('checked',false);
									$('.maincheck').attr('checked',false);
									$('#actions option[value=00]').attr('selected',true);
														  });
										   });
			</script>
        	
            <? $querypending=$this->comment_model->get_pending("yes",$start);
			   $totalpending=$querypending->num_rows; ?>
            	<div class="formboxitem">Pending Comments (<span class="total_comment"><?=$totalpending;?>)</span></div>
                
                	<div class="t_header span-24">
               	    	<div class="t_d span-1"><input type="checkbox" class="maincheck"></div>
                		<div class="t_d span-4">From</div>
                        <div class="t_d span-9">Comment</div>
                        <div class="t_d span-5">On Post</div>
                        <div class="t_d_last span-3">Status</div>
                  	</div>
                <?
				
				$query=$this->comment_model->get_pending("no",$start);
				$i=0;
				$eod='';
				   foreach($query->result() as $rows)
				   {
					   $i++;
					   if($i%2<>0)
					   	  $eod="t_r_odd";
					   else
					   	  $eod="t_r_even";
					   ?>
                   <div class="<?=$eod;?> span-24" id="<?=$rows->comment_id;?>">
                   		<div class="t_d_in span-1"><input type="checkbox" class="childcheck" value="<?=$rows->comment_id;?>"></div>                       <td>
						<div class="t_d_in span-4"><?=$rows->comment_name;?> <br /><span class="small"><?=$rows->comment_email;?><br /><span class="small"><?=$rows->comment_website;?></span></span></div>
						<div class="t_d_in span-9">
                        	<span class="small"><?=mdate($site_date_format,$rows->comment_date);?></span><br />
							<?=$rows->comment_content;?><br />
                            <? if($rows->comment_status==0) { ?>
                            	<a href="javascript:void(0);" class="approve" alt="<?=$rows->comment_id;?>">Approve</a> | <? } ?><a href="#">Edit</a> | <a href="javascript:void(0);" class="delete" alt="<?=$rows->comment_id;?>">Delete</a>
                        </div>
                        <div class="t_d_in span-5"><?=$rows->the_post_title;?></div>
                        <div class="t_d_last span-3">
                        	<div class="comment_status" title="<?=$rows->comment_status;?>" id="status_<?=$rows->comment_id;?>">
							<? if($rows->comment_status==0)
				   				echo "Pending";
								elseif($rows->comment_status==1)
								echo "Approved";
							?>
                            </div>
                         </div>
                     </div>
				   
                   
                <? } ?>
                
              
                <div class="t_header span-24" style="text-align:left;font-size:15px;color:#FFF;"><?=$the_pagination;?></div>
            	<? $action=array('00'=>'Select Action','0'=>'Approve Selected','1'=>'Delete Selected');
				          echo form_dropdown('action',$action,'','id="actions"'); ?>
				
    
</div>
<? $this->load->view('the_master/footer');?>