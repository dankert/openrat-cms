
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_EXTENSION') ?>" data-type="dialog" data-name="<?php echo lang('MENU_EXTENSION') ?>" data-method="extension"><img src="./themes/default/images/icon/action/extension.svg" title="<?php echo lang('MENU_extension_DESC') ?>" /><?php echo lang('MENU_extension') ?></a></div></div>
		
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('TEMPLATE_NAME')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
			</div></fieldset>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file_extension'.'')))); ?></span>
					
				</div>
				<div class="input">
					<a target="_self" data-type="view" data-action="" data-method="extension" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<div class="inputholder">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($extension))); ?></span>
							
						</div>
					</a>

					<div class="clickable">
						<a class="action" target="_self" data-type="view" data-action="" data-method="extension" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
							
						</a>

					</div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file_mimetype'.'')))); ?></span>
					
				</div>
				<div class="input">
					<a target="_self" data-action="template" data-method="extension" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<div class="inputholder">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($mime_type))); ?></span>
							
						</div>
					</a>

				</div>
			</div>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" /></div></div></form>
	