<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="clickable">
		<a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>" data-type="popup" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="action">
			<span class=""><?php echo encodeHtml(htmlentities(@lang('LINK_OPEN_IN_NEW_WINDOW'))) ?>
			</span>
		</a>
	</div>