<? $this->load->view($site_skin.'/top'); ?>
<div id="left_content" class="span-16">
	
    <div class="the_post span-16">
    	<h3><?=$site_slogan;?></h3>
    	<p><?=$messages;?></p>
     </div>
    
</div>
    
<? $this->load->view($site_skin.'/sidebar'); ?>
<? $this->load->view($site_skin.'/footer'); ?>