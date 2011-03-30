
            <hr class="space" />
        </div>
        <div id="footer">
   		<div id="footer_content" class="container">
        	<div id="footer_kiri" class="span-12">
            	<img src="<?=base_url();?>blueprint/images/footer_logo.png" /><br />
                <?php echo $this->benchmark->elapsed_time();?> <?php echo $this->benchmark->memory_usage();?>
            </div>
            <div id="footer_kanan" class="span-12 last">
            	Tarichi V.2.0.1 Copyright &copy; 2008 - <?=date('Y');?><br />
                <a href="http://www.goblogan.com">Developer's blog</a> | <a href="<?=site_url('the_master/credits');?>">Credits</a>
            </div>
        </div>
    </div>
        </div>
        
        <hr class="space" />
        <hr class="space" />
        <hr class="space" />
    </div>
    

</body>
</html>
