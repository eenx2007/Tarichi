<? $this->load->view('the_master/top'); ?>			
     
        	
             <? if($this->session->userdata('user_login'))
			{
				?>
           
           
           	<div class="formbox separo">
            	
                	<div class="formboxtitle">Site Statistic</div>
                    	<?
                            $querypage=$this->the_page_model->get_all();
                            $totalpage=$querypage->num_rows();
							$totalpost=$this->the_post_model->total_post_all();
							$querycateg=$this->category_model->get_all();
							$totalcategory=$querycateg->num_rows();
							$totalcomment=$this->comment_model->get_total();
                        ?>
                    	<div class="formboxitem"><?php echo $totalpage;?> page(s) created</div>
                        <div class="formboxitem"><?php echo $totalpost;?> post(s) created</div>
                        <div class="formboxitem"><?php echo $totalcategory;?> category(ies) created</div>
                        <div class="formboxitem"><?php echo $totalcomment;?> comment(s)</div>
                    
                    
              
            </div>
            <div class="separo last formbox">
            	
                	<div class="formboxtitle">Site Configuration</div>
                    <div class="formboxitem">Site Name : <?php echo $site_name;?></div>
                    <div class="formboxitem">Slogan : <?php echo $site_slogan;?></div>
                    <div class="formboxitem"><a href="<?php echo site_url('skin_chooser');?>">Skin : <?php echo $site_skin;?></a></div>
                    <div class="formboxitem">Comment Moderation : <? if($site_comment_moderation==0) echo "OFF"; else echo "ON"; ?></div>
                    
              
            </div>
            <div class="separo formbox">
            		<div class="formboxtitle">Page</div>
                    <div class="formboxitem"><a href="<?php echo site_url('page_management/pm_add');?>">Create New</a></div>
                    <div class="formboxitem"><a href="<?php echo site_url('page_management/pm_home');?>">Manage</a></div>
                    <div class="formboxitem"><a href="<?php echo site_url('static_home_page');?>">Static Home Page</a></div>
                    <div class="formboxitem"><a href="<?php echo site_url('side_panel');?>">Side Panel</a></div>
            </div>
            <div class="separo last last formbox">
            		<div class="formboxtitle">Post</div>
                    <div class="formboxitem"><a href="<?php echo site_url('post_management/psm_add');?>">Create New</a></div>
                    <div class="formboxitem"><a href="<?php echo site_url('post_management/psm_home');?>">Manage</a></div>
                    <div class="formboxitem"><a href="<?php echo site_url('category_management/cm_home');?>">Manage Category</a></div>
                    <div class="formboxitem"><a href="<?php echo site_url('comment_management');?>">Manage Comment</a></div>
            </div>
            <? } else {
				
				?>
            	<div class="span-10 formbox">
                	<div class="formboxtitle">Please Login</div>
                   		<?php echo form_open('the_master/login_form');?>
                        	<table>
                            	<tr><td>Username</td><td><?php echo form_input('username');?></td></tr>
                                <tr><td>Password</td><td><?php echo form_password('password');?></td></tr>
                                <tr><td><?php echo form_submit('login','Login');?></td></tr>
                            </table>
                        <?php echo form_close();?> 
                   
                </div>
            <? } ?>
       
<? $this->load->view('the_master/footer'); ?>