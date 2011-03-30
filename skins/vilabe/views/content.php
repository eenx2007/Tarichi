<? $this->load->view($site_skin.'/top'); ?>
<div id="left_content" class="span-16">
	<? foreach($the_post as $post):?>
    <div class="the_post span-16">
        
            <h3><?php echo $post['title'];?></h3>
            <div class="post_info span-16">
                <span class="post_date"><?php echo $post['date'];?></span> <span class="post_tags">Tags: <?php echo $post['tags'];?></span><a href="<?php echo $post['link_to_comment'];?>" style="text-decoration:none;"><span class="post_comment"><?php echo $post['totalcomment'];?> Komentar</span></a>
            </div>
            <p><?php echo $post['content'];?></p>
    </div>
    
     <? endforeach; ?>
    <div class="pagination span-16">
       <?php echo $the_pagination;?>
    </div>
</div>
<? $this->load->view($site_skin.'/sidebar'); ?>
<? $this->load->view($site_skin.'/footer'); ?>