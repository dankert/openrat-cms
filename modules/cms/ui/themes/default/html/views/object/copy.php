<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="copy" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
		<div class="line">
			<div class="label">
				<input type="hidden" name="sourceid" value="<?php echo encodeHtml(htmlentities(@$sourceId)) ?>" class="">
				</input>
			</div>
			<div class="input">
				<span class=""><?php echo encodeHtml(htmlentities(@$source['name'])) ?>
				</span>
			</div>
		</div>
		<div class="line">
			<div class="label">
			</div>
			<div class="input">
				<input name="type" value="<?php echo encodeHtml(htmlentities(@$type)) ?>" size="1" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<input type="hidden" name="targetid" value="<?php echo encodeHtml(htmlentities(@$targetId)) ?>" class="">
				</input>
			</div>
			<div class="input">
				<span class=""><?php echo encodeHtml(htmlentities(@$target['name'])) ?>
				</span>
			</div>
		</div>
	</form>