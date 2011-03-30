<? $this->load->view($site_skin.'/top'); ?>
<div id="left_content" class="span-16">
	<div class="the_post span-16">
        <h3>Kategori</h3>
        <div class="post_info span-16">
           <?php echo $cat_total;?> Hasil
        </div>
        
        <ul>
        <? foreach($categories as $list_categ): ?>
            <li><?php echo $list_categ['result'];?></li>
        <? endforeach; ?>
        </ul>
    </div>
    <div class="the_post span-16">    
		<h3>Post</h3>
        <div class="post_info span-16">
        <?php echo $post_total;?> Hasil
        </div>
        <ul>
        <? foreach($the_post as $list_post): ?>
        	<li><?php echo $list_post['result'];?></li>
        <? endforeach; ?>
        </ul>
    </div>
    
</div>
<? $this->load->view($site_skin.'/sidebar'); ?>
<? $this->load->view($site_skin.'/footer'); ?>