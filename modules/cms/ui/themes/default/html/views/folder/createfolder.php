<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="createfolder" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
		<input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" class="">
		</input>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_FOLDER'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="256" value="" class="">
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