<? $this->load->view('the_master/top'); ?>

<div class="formbox penuh">
	<div class="formboxtitle">
    	Module Management
    </div>
    
    <table>
    	<tr class="t_header">
        	<td>Name</td><td>Ver</td><td>Function</td><td>Type</td><td>Description</td><td class="t_d_last">Status</td></tr>
        </tr>
         <? foreach($module_list as $modules)
		{ 
		$i=0;
		if($modules<>'index.html')
		{
		$i++;
		if($i%2<>0)
			$odev="t_r_odd";
		else
			$odev="t_r_even";
		
		
		$infofile=read_file('./modules/'.$modules.'/info.txt');
		$readinfo=split(';',$infofile);
		
	?>
        <tr class="<?=$odev;?>">
        	<td><?=$readinfo[0];?></td><td><?=$readinfo[1];?></td><td><?=$readinfo[2];?></td><td><?=$readinfo[3];?></td><td><?=$readinfo[4];?></td>
            <td class="t_d_last">
            	<? if($readinfo[3]=="Add-on")
				{ 
					$cek=$this->global_model->cek_module($readinfo[5]);
					if($cek==0)
						echo 'Disable / <a href="javascript:void(0);" class="activate_modul_'.$readinfo[5].'">Enable Now</a>';
					else
						echo 'Activated / <a href="javascript:void(0);" class="deactivate_modul_'.$readinfo[5].'">Disable Now</a>';
				?>
                <script type="text/javascript">
					$(document).ready(function(){
						$('.activate_modul_<?=$readinfo[5];?>').click(function(){
							var ao_id='<?=$readinfo[5];?>';
							var ao_name='<?=$readinfo[0];?>';
							var ao_def_controller='<?=$readinfo[6];?>';
							var ao_def_setting='<?=$readinfo[7];?>';
							var bapak=$(this).parent();
							$.post('<?=site_url('ajax_things/activate_module');?>',{add_on_id : ao_id, add_on_name : ao_name, add_on_def_controller : ao_def_controller, add_on_def_setting : ao_def_setting}, function(){
								$(bapak).html('Activated / <a href="javascript:void(0);" class="deactivate_modul_<?=$readinfo[5];?>">Disable Now</a>');
							});
						});
						$('.deactivate_modul_<?=$readinfo[5];?>').click(function(){
							var ao_id='<?=$readinfo[5];?>';
							var bapak=$(this).parent();
							$.post('<?=site_url('ajax_things/deactivate_module');?>',{add_on_id : ao_id},function(){
								$(bapak).html('Disable / <a href="javascript:void(0);" class="activate_modul_<?=$readinfo[5];?>">Enable Now</a>');
							});
						});
					});
				</script>	
                <? } elseif($readinfo[3]=="Base")
					echo "Auto Activated"; ?>
                    
            </td></tr>
        </tr>
    <? } } ?>
    </table>
    
</div>


<? $this->load->view('the_master/footer'); ?>