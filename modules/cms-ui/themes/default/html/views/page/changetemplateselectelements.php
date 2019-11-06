<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="changetemplateselectelements" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form page" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="changetemplateselectelements" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<input type="hidden" name="newtemplateid" value="<?php echo $newtemplateid ?>"/>
		<?php foreach($elements as $list_key=>$list_value){ ?><?php extract($list_value) ?>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_<?php echo $newElementsName ?>" name="<?php echo $newElementsName ?>" title="" class=""<?php if (count($newElementsList)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($newElementsList,'',0,0) ?><?php if (count($newElementsList)==0) { ?><input type="hidden" name="<?php echo $newElementsName ?>" value="" /><?php } ?><?php if (count($newElementsList)==1) { ?><input type="hidden" name="<?php echo $newElementsName ?>" value="<?php echo array_keys($newElementsList)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
		<?php } ?>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('MENU_CHANGETEMPLATE') ?>" /></div></form>