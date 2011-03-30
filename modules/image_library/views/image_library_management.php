<? $this->load->view('the_master/top'); ?>	
<script type="text/javascript">
	$(document).ready(function(){
				$('.previewbtn').hover(function(){
					var bapak=$(this).parent();
					$('.preview',bapak).fadeIn();
											},
									function(){
					$('.preview').fadeOut();
											});			   
							   });
</script>
    <div class="formbox penuh">
    	<div class="formboxtitle">
        	Image Library
        </div>
        <table>
        <tr class="t_header">
        	<td>FileName</td>
            <td>Type</td>
            <td>Size</td>
            <td>Date Modified</td>
            <td>Status</td>
        </tr>
        <?
		$i=0;
		$odev='';
		foreach($img_list as $imgs)
		{
			if($imgs<>'index.html')
			{
			$i++;
			if($i%2<>0)
				$odev="t_r_odd";
			else
				$odev="t_r_even";
			
			
			$infofile=get_file_info('./image_library/'.$imgs);
			$pisah=split("[.]",$imgs);
			$nama_file=$pisah[0];
			$panjang=strlen($nama_file);
			$thumbnya=substr($nama_file,-6);
			if($thumbnya<>'_thumb')
			{
			
			?>
                <tr class="<?php echo $odev;?>">
                    <td><?php echo $imgs;?> <img src="<?php echo base_url();?>blueprint/images/preview.png" style="float:right;cursor:pointer;" title="preview" class="previewbtn">
                        <div class="preview" style="position:absolute;border:2px solid #666;padding:5px;background:#FFF;display:none;">
                            <img src="<?php echo base_url();?>image_library/<?php echo $nama_file;?>_thumb.<?php echo $pisah[1];?>" />
                        </div>
                    </td>
                    <td><?php echo ucwords($pisah[1]);?></td>
                    <td><?php echo number_format($infofile['size']/1024,2);?> KB</td>
                    <td><?php echo mdate('%d/%m/%Y %h:%i:%s',$infofile['date']);?></td>
                    <td>
                        
                    </td>
                </tr>       
        <? } } } ?>
    	</table>
    </div>
    
     <div id="loader_image" style="position:fixed;left:45%;top:40%;width:100px;height:50px;text-align:center;display:none;" class="the_page_item">
    	 	<img src="<?php echo base_url();?>blueprint/images/ajax_start.gif" /> Changing ...
        </div>
<? $this->load->view('the_master/footer'); ?>