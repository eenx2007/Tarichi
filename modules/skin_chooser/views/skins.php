<? $this->load->view('the_master/top'); ?>	
<script type="text/javascript">
	$(document).ready(function(){
			$('#loader_image').hide();
			
			$('.previewbtn').hover(function(){
					var bapak=$(this).parent();
					$('.preview',bapak).fadeIn();
											},
									function(){
					$('.preview').fadeOut();
											});
			$('.activate').live('click',function(){
					var s_skin=$(this).attr('title');
					$('#loader_image').show();
					$.post('<?php echo site_url('ajax_things/update_skin');?>',{ site_skin : s_skin },function(data){
							$('#loader_image').fadeOut('slow');
																							   });
					var bapak=$(this).parent();
					var aktif_lama=$('.activated').attr('title');
					$(bapak).html('Activated');
					$('.activated').html('<a href="javascript:void(0);" title="'+aktif_lama+'" class="activate">Activate</a>');
					
					$('.activated').attr('class','not_active');
					$(bapak).attr('class','activated');
					$(bapak).attr('title',s_skin);
										  });
			
			
			
							   });
			
</script>
	<div class="formbox penuh">
    	<div class="formboxtitle">
        	Skin Chooser
        </div>
        <table>
            <tr class="t_header">
                <td>Name</td>
                <td>Author</td>
                <td>Description</td>
                <td>Status</td>
            </tr>
        <?
		$i=0;
		$odev='';
		foreach($skin_list as $skins)
		{
			if($skins<>'index.html')
			{
			$i++;
			if($i%2<>0)
				$odev="t_r_odd";
			else
				$odev="t_r_even";
			
			
			$infofile=read_file('./skins/'.$skins.'/_info/description.txt');
			$readinfo=split(';',$infofile);
			?>
        <tr class="<?php echo $odev;?>">
 	        <td><?php echo $readinfo[0];?> <img src="<?php echo base_url();?>blueprint/images/preview.png" style="float:right;cursor:pointer;" title="preview" class="previewbtn">
            	<div class="preview" style="position:absolute;width:200px;height:127px;border:2px solid #666;padding:5px;background:#FFF;display:none;">
                	<img src="<?php echo base_url();?>skins/<?php echo $skins;?>/_info/preview.png" />
                </div>
            </td>
            <td><?php echo $readinfo[1];?></td>
            <td><?php echo $readinfo[2];?></td>
            <td>
            	<? if($skins==$site_skin)
					echo '<span class="activated" title="'.$skins.'">Activated</span>';
				   else {	
				?>
                	<span class="not_active"><a href="javascript:void(0);" title="<?php echo $skins;?>" class="activate">Activate</a></span>
                <? } ?>
            </td>
		</tr>       
        <? } } ?>
    
    </table></div>
     <div id="loader_image" style="position:fixed;left:45%;top:40%;width:100px;height:50px;text-align:center;" class="the_page_item">
    	 	<img src="<?php echo base_url();?>blueprint/images/ajax_start.gif" /> Changing ...
        </div>
<? $this->load->view('the_master/footer'); ?>