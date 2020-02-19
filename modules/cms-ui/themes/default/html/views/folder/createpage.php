<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="createpage" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_TEMPLATE'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="templateid" value="" size="1" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_NAME'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus,name">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_DESCRIPTION'))) ?>
				</span>
			</div>
			<div class="input">
				<textarea name="description" disabled="" maxlength="0" class="inputarea">
				</textarea>
			</div>
		</div>
	</form>