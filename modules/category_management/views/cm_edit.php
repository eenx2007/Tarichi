<? $this->load->view('the_master/top'); ?>
<?php echo form_open('category_management/cm_edit/index/'.$row->category_id);?>
<div class="formbox span-14">
    <div class="formboxtitle" style="width:530px;float:left;">
        <div class="span-8">
    		Edit <?php echo $row->category_name;?>
  		</div>
    	<div class="span-5 last" style="text-align:right;">
    		<input type="submit" value="Save" name="save" class="savebtn"> <a href="<?php echo site_url('category_management/cm_home');?>" class="discardbtn">Discard</a>
    	</div>
    </div>
    <div class="formboxitem" style="clear:both;">
    	<label>Category Name</label><br />
		<?php echo form_input(array('name'=>'category_name','style'=>'width:95%;','value'=>$row->category_name));?>
    </div>
    <div class="formboxitem">
        <label>Description</label><br />
        <textarea name="category_desc" style="width:95%;"><?php echo $row->category_desc;?></textarea>
    </div>
</div>
<?php echo form_close();?>

<? $this->load->view('the_master/footer'); ?>