<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="preview">
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('page_preview') ?></legend><div class="closable">
			<span><?php echo nl2br($preview); ?></span>
		</div></fieldset>
	</div>