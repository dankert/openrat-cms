
	
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form folder" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('global_prop') ?></legend><div>
				<label class="or-form-row"><span class="or-form-label">Dateiname</span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_filename" name="<?php if ('') echo ''.'_' ?>filename<?php if ('') echo '_disabled' ?>" autofocus="autofocus" type="text" maxlength="150" class="filename" value="<?php echo Text::encodeHtml(@$filename) ?>" /><?php if ('') { ?><input type="hidden" name="filename" value="<?php $filename ?>"/><?php } ?></div></span></label>
				
			</div></fieldset>
			<?php foreach($names as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<fieldset class="toggle-open-close<?php echo $languageIsDefault?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $languageName ?></legend><div>
					<?php $$languageName= $name; ?>
					
					<label class="or-form-row"><span class="or-form-label">Name</span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_<?php echo $languageName ?>" name="<?php if ('name') echo 'name'.'_' ?><?php echo $languageName ?><?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="filename" value="<?php echo Text::encodeHtml(@$$languageName) ?>" /><?php if ('') { ?><input type="hidden" name="<?php echo $languageName ?>" value="<?php $$languageName ?>"/><?php } ?></div></span></label>
					
					<?php $$languageName= $description; ?>
					
					<label class="or-form-row"><span class="or-form-label">Beschreibung</span><span class="or-form-input"><div class="inputholder"><textarea class="description" name="<?php if ('description') echo 'description'.'_' ?><?php echo $languageName ?><?php if ('') echo '_disabled' ?>" maxlength="255"><?php echo Text::encodeHtml($$languageName) ?></textarea></div></span></label>
					
				</div></fieldset>
			<?php } ?>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('global_save') ?>" /></div></form>
	