
<? 
if($this->uri->segment(1)=="read")
	$side_panel_status=1;
else
$side_panel_status=0;
$querysp=$this->side_panel_model->get_all($side_panel_status);
foreach($querysp->result() as $rowssp)
{ ?>

	<h3><?php echo $rowssp->side_panel_title;?></h3>
	<? if($rowssp->side_panel_type=="last_comment")
	{ ?>
		<ul>
			<? $querycom2=$this->comment_model->get_last_comment($rowssp->side_panel_config,$site_comment_moderation);
			foreach($querycom2->result() as $rowscom2)
			{ ?>
				<li>
                <img src="<?php echo $this->template_model->get_gravatar($rowscom2->comment_email);?>" height="30" style="padding-bottom:10px;padding-right:4px;padding-top:3px;" align="left" />
				<? if($rowscom2->comment_website<>'') { ?><a href="<?php echo $rowscom2->comment_website;?>"> <? } ?>
				<?php echo $rowscom2->comment_name;?><? if($rowscom2->comment_website<>'') { ?></a><? } ?> on <a href="<?php echo site_url('read/'.$rowscom2->the_post_year.'/'.$rowscom2->the_post_month.'/'.$rowscom2->the_post_day.'/'.$rowscom2->the_post_title_url);?>#comment_<?php echo $rowscom2->comment_id;?>"><?php echo $rowscom2->the_post_title;?></a><br />
					<span class="small"><?php echo mdate($site_date_format,$rowscom2->comment_date);?></span><br />
				</li>

			<? } ?>
		</ul>                    

	<? } elseif($rowssp->side_panel_type=="post_by_category")
	{ ?>
		<ul>
			<? $querypostby=$this->the_post_model->get_per_category($rowssp->side_panel_config);
			foreach($querypostby->result() as $rowspostby)
			{ ?>
				<li><span class="small"><?php echo mdate($site_date_format,$rowspostby->the_post_date);?></span><br />
                	<a href="<?php echo site_url('read/'.$rowspostby->the_post_year.'/'.$rowspostby->the_post_month.'/'.$rowspostby->the_post_day.'/'.$rowspostby->the_post_title_url);?>"><?php echo $rowspostby->the_post_title;?></a>
                </li>
			<? } ?>
		</ul>
	<? } elseif($rowssp->side_panel_type=="calendar")
	{ ?>
		<? 
			echo $this->calendar->generate();
		?>
	<? } elseif($rowssp->side_panel_type=="free_text")
	{ ?>
    	<ul>
			<li><?php echo $rowssp->side_panel_config;?></li>
        </ul>
	<? } elseif($rowssp->side_panel_type=="category_list")
	{ ?>
		<ul>
			<? $querycat=$this->category_model->get_all();
			foreach($querycat->result() as $rowscat)
			{ ?>
				<li><a href="<?php echo site_url('category/'.$rowscat->category_url);?>"><?php echo $rowscat->category_name;?></a></li>  
			<? } ?>
		</ul>
	<? } elseif($rowssp->side_panel_type=="pages")
	{ ?>
		<ul>
			<? $querypages=$this->the_page_model->get_parent();
			foreach($querypages->result() as $rowspages)
			{
			?>
				<li><a href="<?php echo site_url($rowspages->the_page_link_to);?>"><?php echo $rowspages->the_page_menu;?></a></li>
			<? } ?>
		</ul>
	<? } elseif($rowssp->side_panel_type=="archives")
	{
	?>
    	<ul>
			<? $queryarch=$this->the_post_model->archives();
               foreach($queryarch->result() as $rowsarch)
               { ?>
             		<li><a href="<?php echo site_url('archive/'.$rowsarch->the_post_year);?>"><?php echo $rowsarch->the_post_year;?> (<?php echo $rowsarch->total;?>)</a></li>       
            <? } ?>
        </ul>
	<? } elseif($rowssp->side_panel_type=="tag_cloud")
	{ ?>
    	<ul>
        	<li>
            	<? 
					$querytag=$this->the_tag_model->get_cloud();
					foreach($querytag->result() as $rowstag)
					{ ?>
                    <span class="tag_item"><a href="<?php echo site_url('tag/'.$rowstag->the_tag_name_url);?>"><font size="+<?php echo $rowstag->total-1;?>"><?php echo $rowstag->the_tag_name;?></font></a></span>
                    <? } ?>
            </li>
        </ul>
    <? } ?>
<? } ?>

