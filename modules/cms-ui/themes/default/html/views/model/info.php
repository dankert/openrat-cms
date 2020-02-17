<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="model" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form model">
		<span class="headline"><?php echo encodeHtml(htmlentities(@$name)) ?>
		</span>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</div>
			<div class="input clickable">
				<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
				</span>
				<a target="_self" data-type="edit" data-action="model" data-method="prop" data-id="" data-extra="[]" href="/#/model/" class="or-link-btn">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
					</span>
				</a>
			</div>
		</div>
	</form>