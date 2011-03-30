<? $this->load->view($site_skin.'/top'); ?>
<div id="left_content" class="span-16">
	<? foreach($the_post as $post):?>
    <div class="the_post span-16">
        
            <h3><?=$post['title'];?></h3>
            <div class="post_info span-16">
                <span class="post_date"><?=$post['date'];?></span> <span class="post_tags">Tags: <?=$post['tags'];?></span><a href="<?=$post['link_to_comment'];?>" style="text-decoration:none;"><span class="post_comment"><?=$post['totalcomment'];?> Komentar</span></a>
            </div>
            <p><?=$post['content'];?></p>
    </div>
    
     <? endforeach; ?>
    <div class="pagination span-16">
       <?=$the_pagination;?>
    </div>
</div>
<? $this->load->view($site_skin.'/sidebar'); ?>
<? $this->load->view($site_skin.'/footer'); ?>