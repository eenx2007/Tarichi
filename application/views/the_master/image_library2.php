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
						
						$('.tinymce_content').tinymce().execCommand('mceInsertContent',false,'<img src=<?=base_url();?>image_library/'+the_image+' />');
											});
				
							   });
</script>

<div class="imguptitle">
	Image Library
</div>
<div style="width:450px;float:left;" class="imgupcontent">
	<div class="formbox" style="width:450px;float:left;height:300px;overflow:scroll;">
		
		<div class="t_header" style="width:450px;">
			<div class="t_d span-5">FileName</div>
			<div class="t_d span-3">Type</div>
			<div class="t_d span-2">Size</div>
		</div>
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
					<div class="<?=$odev;?>" style="width:450px;">
						<div class="t_d_in span-5">
							<?=$imgs;?> <img src="<?=base_url();?>blueprint/images/preview.png" style="float:right;cursor:pointer;" alt="<?=$imgs;?>" title="Move To Editor" class="mvtedt">
							<div class="preview" style="position:absolute;border:2px solid #666;padding:5px;background:#FFF;display:none;">
								<img src="<?=base_url();?>image_library/<?=$nama_file;?>_thumb.<?=$pisah[1];?>" />
							</div>
						</div>
						<div class="t_d_in span-3"><?=get_mime_by_extension($imgs);?></div>
						<div class="t_d_in span-2" style="text-align:right;"><?=number_format($infofile['size']/1024,2);?> KB</div>
					</div>

				<? } ?>
			<? } ?>
		<? } ?>
    </div>
</div>
