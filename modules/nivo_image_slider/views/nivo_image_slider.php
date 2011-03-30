<? $this->load->view('the_master/top'); ?>	
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#generate').click(function(){
			var elmnt=$('#elementx').val();
			var cnav=$('#control_nav').val();
			var a_speed=$('#anim_speed').val();
			var p_time=$('#pause_time').val();
			var opct=$('#opacityx').val();
			$.post('<?=site_url('nivo_image_slider/save_config');?>',{elementx:elmnt,control_nav:cnav,anim_speed:a_speed,pause_time:p_time,opacityx:opct},function(){
				
			});
		});
	});
</script>

	<div class="separo formbox">
    	<div class="formboxtitle">
        	Nivo Image Slider
        </div>
        <div class="formboxitem">
        	<label>Element</label><br />
			<input type="text" name="elementx" id="elementx" value="<?=$detailnya[0];?>" />
        </div>
        <div class="formboxitem">
        	<label>Control Nav</label><br />
            <? $control_nav=array('true'=>'Enable','false'=>'Disable');
				echo form_dropdown('control_nav',$control_nav,$detailnya[1],'id="control_nav"');
				?>
        </div>
        <div class="formboxitem">
        	<label>Animation Speed</label><br />
          	<input type="text" name="anim_speed" id="anim_speed" value="<?=$detailnya[2];?>" />
        </div>
        <div class="formboxitem">
        	<label>Pause Time</label><br />
            <input type="text" name="pause_time" id="pause_time" value="<?=$detailnya[3];?>" />
        </div>
        <div class="formboxitem">
        	<label>Opacity</label><br />
            <?
				$opacity=array();
				for($i=0;$i<=1;$i=$i+0.1)
				{
					$opacity[$i]=$i;
				}
				echo form_dropdown('opactiy',$opacity,$detailnya[4],'id="opacityx"');
			?>
        </div>
        <div class="formboxitem">
        	<a href="#" class="btnmerah" id="generate">Save Generate</a>
        </div>
    </div>

<? $this->load->view('the_master/footer'); ?>