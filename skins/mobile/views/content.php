<? $this->load->view($site_skin.'/top'); ?>
        <? foreach($the_post as $post):?>
        <div class="the_post">
            
                <h3><?php echo $post['title'];?></h3>
                <div class="post_info">
                    <span class="post_date"><?php echo $post['date'];?></span><br />
                    <span class="post_tags">Tags: <?php echo $post['tags'];?></span><a href="<?php echo $post['link_to_comment'];?>" style="text-decoration:none;"><br />
                    <span class="post_comment"><?php echo $post['totalcomment'];?> Komentar</span></a>
                </div>
                <p><?php echo $post['content'];?></p>
        </div>
        
         <? endforeach; ?>
        <div class="pagination">
           	<?php echo $the_pagination;?>
        </div>
<? $this->load->view($site_skin.'/footer'); ?>