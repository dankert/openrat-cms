
	
		<form name="" target="_self" data-target="view" action="./" data-method="changetemplateselectelements" data-action="page" data-id="<?php echo OR_ID ?>" method="get" enctype="application/x-www-form-urlencoded" class="page" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="changetemplateselectelements" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<input type="hidden" name="templateid" value="<?php echo $templateid ?>"/>
			
			<input type="hidden" name="modelid" value="<?php echo $modelid ?>"/>
			
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('page_template_old')))); ?></span>
					
				</div>
				<div class="input">
					<a target="_self" data-url="<?php echo $template_url ?>" data-action="" data-method="changetemplate" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_template.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
						
					</a>

				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('page_template_new')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_newtemplateid" name="newtemplateid" title="" class=""<?php if (count($templates)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($templates,'',0,0) ?><?php if (count($templates)==0) { ?><input type="hidden" name="newtemplateid" value="" /><?php } ?><?php if (count($templates)==1) { ?><input type="hidden" name="newtemplateid" value="<?php echo array_keys($templates)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
		<div class="bottom"><div class="command 1"><input type="submit" class="submit ok" value="<?php echo lang('BUTTON_NEXT') ?>" /><input type="button" class="submit cancel" value="<?php echo lang("CANCEL") ?>" /></div></div></form>
	