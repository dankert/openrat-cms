<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('security','nopublish')); if($if2){?>
		<div class="message warn">
			<span class="help"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NOPUBLISH_DESC'.'')))); ?></span>
		</div>
	<?php } ?>
	<form name="" target="_self" data-target="view" action="./" data-method="pub" data-action="file" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form file" data-async="true" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="file" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="pub" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<tr>
			<td>
				<br/>
			</td>
		</tr>
		<tr>
			<td class="act">
						<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
				</div>
			</td>
		</tr>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('publish') ?>" /></div></form>