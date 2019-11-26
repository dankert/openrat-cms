<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="name" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form element" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="element" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="name" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_NAME')))); ?></span>
					</td>
					<td>
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if (false) { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					</td>
				</tr>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DESCRIPTION')))); ?></span>
					</td>
					<td>
						<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>description<?php if (false) echo '_disabled' ?>"><?php echo Text::encodeHtml($description) ?></textarea></div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="act">
								<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
						</div>
					</td>
				</tr>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>