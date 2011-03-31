<script type="text/javascript">
	$(document).ready(function(){
				$('.mvtedt').hover(function(){
					var bapak=$(this).parent();
					$('.preview',bapak).fadeIn();
											},
									function(){
					$('.preview').fadeOut();
											});	
				
				$('.mvtedt').click(function(){
						var the_image=$(this).attr('alt');
						
						$('.tinymce_content').tinymce().execCommand('mceInsertContent',false,'<img src=<?php echo base_url();?>image_library/'+the_image+' />');
											});
				
							   });
</script>

<div class="imguptitle">
	Image Library
</div>
<div style="width:450px;float:left;" class="imgupcontent">
	<div class="formbox" style="width:450px;float:left;height:300px;overflow:scroll;">
		<table>
		<tr class="t_header">
			<td>FileName</td>
			<td>Type</td>
			<td>Size</td>
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
				{ ?>
					<tr class="<?php echo $odev;?>">
						<td>
							<?php echo $imgs;?> <img src="<?php echo base_url();?>blueprint/images/preview.png" style="float:right;cursor:pointer;" alt="<?php echo $imgs;?>" title="Move To Editor" class="mvtedt">
							<div class="preview" style="position:absolute;border:2px solid #666;padding:5px;background:#FFF;display:none;">
								<img src="<?php echo base_url();?>image_library/<?php echo $nama_file;?>_thumb.<?php echo $pisah[1];?>" />
							</div>
						</td>
						<td><?php echo ucwords($pisah[1]);?></td>
						<td><?php echo number_format($infofile['size']/1024,2);?> KB</td>
					</tr>

				<? } ?>
			<? } ?>
		<? } ?>
        </table>
    </div>
</div>
