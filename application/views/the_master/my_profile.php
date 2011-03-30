<? $this->load->view('the_master/top'); ?>
<script type="text/javascript">
	$(document).ready(function(){
			$('#loader_image').hide();	
			$('#save').click(function(){
					var u_name=$('#username').val();
					var n_lengkap=$('#nama_lengkap').val();
					var pwd=$('#password').val();
					var pwd2=$('#password2').val();
					if(u_name=='')
					{
							
					}
									  });
							   });
</script>
<div class="formbox span-24">
	<div class="formboxtitle" style="float:left;width:930px;">
        <div class="span-17">
        	My Profile
        </div>
        <div class="span-6 last" style="text-align:right;">
            <img src="<?=base_url();?>blueprint/images/ajax_start.gif" id="loader_image" /> <a href="#" class="savebtn" id="save">Save</a> 
        </div>
	</div>
    <div class="span-7">
    	<div class="formboxitem"?
            <label>Username</label><br />
            <input type="text" name="username" value="<?=$row->username;?>" id="username">
        </div>
        <div class="formboxitem">
	        <label>Name</label><br />
    	    <input type="text" name="nama_lengkap" value="<?=$row->nama_lengkap;?>" id="nama_lengkap">
        </div>
    </div>
    <div class="span-7 border">
    	<div class="formboxitem">
	    	<label>New Password ?</label><br />
    	    <input type="text" name="password" id="password">
        </div>
        <div class="formboxitem">
	        <label>Type it again</label><br />
    	    <input type="text" name="password2" id="password2">
        </div>
        
    </div>
    <div class="span-10 last">
    	<div class="formboxitem">
    	
        	type new password if you want to change the password, leave it blank if want to keep old password
        </div>
        
    </div>
</div>

<? $this->load->view('the_master/footer');?>