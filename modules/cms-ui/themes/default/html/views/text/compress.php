<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="compress" data-action="text" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form text" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="text" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="compress" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('OPTIONS') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('type')))); ?></span>
						
					</div>
					<div class="input">
						<?php $gz= 'gz'; ?>
						
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_format" name="format" title="" class=""<?php if (count($formats)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($formats,'gz',0,0) ?><?php if (count($formats)==0) { ?><input type="hidden" name="format" value="" /><?php } ?><?php if (count($formats)==1) { ?><input type="hidden" name="format" value="<?php echo array_keys($formats)[0] ?>" /><?php } ?>
						</select></div>
						<?php $replace= '1'; ?>
						
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_replace_1" name="<?php if ('') echo ''.'_' ?>replace<?php if ('') echo '_disabled' ?>" value="1"<?php if('1'==@$replace)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_replace_1" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'replace'.'')))); ?></span>
							
						</label>
						<br/>
						
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_replace_0" name="<?php if ('') echo ''.'_' ?>replace<?php if ('') echo '_disabled' ?>" value="0"<?php if('0'==@$replace)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_replace_0" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'new'.'')))); ?></span>
							
						</label>
					</div>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
	