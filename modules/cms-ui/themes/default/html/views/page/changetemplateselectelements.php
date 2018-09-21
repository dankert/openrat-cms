
	
		<form name="" target="_self" data-target="view" action="./" data-method="changetemplateselectelements" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="page" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="changetemplateselectelements" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<input type="hidden" name="newtemplateid" value="<?php echo $newtemplateid ?>"/>
			
			<?php foreach($elements as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<div class="line">
					<div class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_<?php echo $newElementsName ?>" name="<?php echo $newElementsName ?>" title="" class=""<?php if (count($newElementsList)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($newElementsList,'',0,0) ?><?php if (count($newElementsList)==0) { ?><input type="hidden" name="<?php echo $newElementsName ?>" value="" /><?php } ?><?php if (count($newElementsList)==1) { ?><input type="hidden" name="<?php echo $newElementsName ?>" value="<?php echo array_keys($newElementsList)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			<?php } ?>
		<div class="bottom"><div class="command 1"><input type="submit" class="submit ok" value="<?php echo lang('MENU_CHANGETEMPLATE') ?>" /><input type="button" class="submit cancel" value="<?php echo lang("CANCEL") ?>" /></div></div></form>
	