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
<?=form_open('the_master/my_profile');?>
<div class="formbox penuh">
	<div class="formboxtitle">
        <div>
        	My Profile
        </div>
        
	</div>
    <div class="t_r_even">
        <div class="formboxitem">
        	<input type="submit" value="save" class="savebtn" name="save" /> 
        </div>
    </div>
    <div class="separo">
    	<div class="formboxitem">
            <label>Username</label><br />
            <input type="text" name="username" value="<?=$row->username;?>" id="username">
        </div>
        <div class="formboxitem">
	        <label>Name</label><br />
    	    <input type="text" name="nama_lengkap" value="<?=$row->nama_lengkap;?>" id="nama_lengkap">
        </div>
   
    	<div class="formboxitem">
	    	<label>New Password ?</label><br />
    	    <input type="text" name="password" id="password">
        </div>
        <div class="formboxitem">
	        <label>Type it again</label><br />
    	    <input type="text" name="password2" id="password2">
        </div>
        
    </div>
    <div class="separo last">
    	<div class="formboxitem">
    	
        	type new password if you want to change the password, leave it blank if want to keep old password
        </div>
        
    </div>
</div>
<?=form_close();?>
<? $this->load->view('the_master/footer');?>