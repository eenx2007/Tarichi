
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ajaxfileupload.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			$('#upload_loader').hide();				   
							   });
</script>
<script type="text/javascript">
	
		function ajaxFileUpload()
		{

			
			$("#upload_loader").ajaxStart(function(){
				$(this).show();
			}).ajaxComplete(function(){
				$(this).hide();
			});
			
			$.ajaxFileUpload(
			{
				url:'<?php echo site_url('ajax_things/upload_image');?>', 
				secureuri:false,
				fileElementId:'img_name', 
				dataType: 'json',
			
				success: function (data, status)  {
				
					if(typeof(data.error) != 'undefined') {
					alert(data.error);
			
					} else {
			
						$("#the_image_placer").load('<?php echo site_url('ajax_things/show_image');?>/' + data.nama_file_gambar + '/' + data.nama_file_thumb); // create image and append the html inside <div id=#image>
						
			
					}
			
				}
			
			})
			return false;
		}



</script>

<div id="the_image_placer">
	<div class="imguptitle">
		Image Uploader
    </div>
    <div style="width:450px;float:left;" class="imgupcontent">
    	<div class="formbox" style="width:450px;">
        	<div class="formboxtitle">
            </div>
            <div class="formboxitem">
            <label>Image file</label> <input type="file" name="img_name" id="img_name" /><br />
            </div>
            <div class="formboxitem">
            <a href="#" class="btnmerah" id="upload_now" onclick="return ajaxFileUpload();">Upload</a> <img src="<?php echo base_url();?>assets/blueprint/images/ajax_start.gif" id="upload_loader" />
            </div>
        </div>
    </div>
</div>