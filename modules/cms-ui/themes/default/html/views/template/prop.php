<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form template" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="template" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('TEMPLATE_NAME')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if ('') echo '_disabled' ?>" type="text" maxlength="50" class="" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div class="closable">
			</div></fieldset>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file_extension'.'')))); ?></span>
					
				</div>
				<div class="input">
					<a target="_self" data-type="view" data-action="" data-method="extension" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
						<div class="inputholder">
							<span><?php echo nl2br(encodeHtml(htmlentities($extension))); ?></span>
							
						</div>
					</a>
					<div class="clickable">
						<a class="action" target="_self" data-type="view" data-action="" data-method="extension" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
							
						</a>
					</div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file_mimetype'.'')))); ?></span>
					
				</div>
				<div class="input">
					<a target="_self" data-action="template" data-method="extension" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/template/">
						<div class="inputholder">
							<span><?php echo nl2br(encodeHtml(htmlentities($mime_type))); ?></span>
							
						</div>
					</a>
				</div>
			</div>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
	