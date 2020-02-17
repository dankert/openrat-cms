<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="language" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form language">
		<span class="headline"><?php echo encodeHtml(htmlentities(@$name)) ?>
		</span>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</div>
			<div class="input clickable">
				<span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
				</span>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('LANGUAGE_ISOCODE'))) ?>
				</span>
			</div>
			<div class="input clickable">
				<span class=""><?php echo encodeHtml(htmlentities(@$isocode)) ?>
				</span>
			</div>
		</div>
		<div class="line">
			<div class="label">
			</div>
			<div class="input clickable">
				<a target="_self" data-type="edit" data-action="language" data-method="prop" data-id="" data-extra="[]" href="/#/language/" class="or-link-btn">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
					</span>
				</a>
			</div>
		</div>
	</form>