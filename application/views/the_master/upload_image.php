<script type="text/javascript">
	$(document).ready(function(){
				$('#move_to_editor').click(function(){
					$('.tinymce_content').tinymce().execCommand('mceInsertContent',false,'<img src=<?=base_url();?>image_library/<?=$nama_file_gambar;?> />');
					$('#image_library').fadeOut();
													});
							   });
</script>


	<div class="imguptitle">
    	<?=$nama_file_gambar;?>
    </div>
    <div style="width:450px;" class="imgupcontent">
    	<div class="formbox">
        	<div class="formboxtitle">
            </div>
            <div class="formboxitem">
                <img src="<?=base_url();?>image_library/<?=$nama_file_thumb;?>">
            </div>
            <div class="formboxitem">
                <label>Title</label> <br /><input type="text" name="img_title" id="img_title" style="width:400px;" />
            </div>
            <div class="formboxitem">
            <label>Description</label> <br />
            <input type="text" name="img_desc" id="img_desc" style="width:400px;" /><br />
            </div>
            <div class="formboxitem">
            <a href="#" id="move_to_editor" class="btnmerah">Move to Editor</a>
            </div>
        </div>
    </div>
