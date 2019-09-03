
	
		<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form project" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="project" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php foreach($info as $list_key=>$list_value){ ?>
				<label class="or-form-row"><span class="or-form-label"><?php echo lang($list_key) ?></span><span class="or-form-input"><span><?php echo nl2br(encodeHtml(htmlentities($list_value))); ?></span></span></label>
				
			<?php } ?>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /></div></form>
	