<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="inherit" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form folder" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="inherit" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php $if3=($type=='folder'); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php $inherit= '1'; ?>
							
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_inherit" name="<?php if ('') echo ''.'_' ?>inherit<?php if (false) echo '_disabled' ?>" type="checkbox" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$inherit) ?>" /><?php if (false) { ?><input type="hidden" name="inherit" value="<?php $inherit ?>"/><?php } ?></div>
							
							<label for="<?php echo REQUEST_ID ?>_inherit" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'inherit_rights'.'')))); ?></span>
								
							</label>
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	