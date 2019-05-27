
	
		<form name="" target="_self" data-target="view" action="./" data-method="extension" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form template" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="template" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="extension" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php foreach($extension as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $name ?></legend><div class="closable">
					<?php $$name= $extension; ?>
					
					<label class="or-form-row"><span class="or-form-label"><?php echo lang('template_extension') ?></span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_<?php echo $name ?>" name="<?php if ('') echo ''.'_' ?><?php echo $name ?><?php if ('') echo '_disabled' ?>" required="required" type="text" maxlength="10" class="" value="<?php echo Text::encodeHtml(@$$name) ?>" /><?php if ('') { ?><input type="hidden" name="<?php echo $name ?>" value="<?php $$name ?>"/><?php } ?></div></span></label>
					
				</div></fieldset>
			<?php } ?>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	