
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="changetemplateselectelements" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="get" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="changetemplateselectelements" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('page_template_old')))); ?></span>
					
				</div>
				<div class="input">
					<a target="_self" data-url="<?php echo $template_url ?>" data-action="" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
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
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_newtemplateid" name="newtemplateid" title="" class="focus"<?php if (count($templates)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($templates,$newtemplateid,0,0) ?><?php if (count($templates)==0) { ?><input type="hidden" name="newtemplateid" value="" /><?php } ?><?php if (count($templates)==1) { ?><input type="hidden" name="newtemplateid" value="<?php echo array_keys($templates)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
		<div class="bottom"><div class="command 1"><input type="button" class="submit ok" value="<?php echo lang('BUTTON_NEXT') ?>" onclick="$(this).closest('div.sheet').find('form').submit(); " /><input type="button" class="submit cancel" value="<?php echo lang("CANCEL") ?>" onclick="$(div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" /></div></div></form>
	