
	
		<form name="" target="_self" data-target="view" action="./" data-method="src" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form template" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="template" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="src" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php foreach($src as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo $name ?></legend><div>
					<?php $$name= $source; ?>
					
					<textarea  name="<?php if ('source') echo 'source'.'_' ?><?php echo $name ?><?php if ('') echo '_disabled' ?>" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor code-editor"><?php echo ${$name} ?></textarea>
					
				</div></fieldset>
			<?php } ?>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	