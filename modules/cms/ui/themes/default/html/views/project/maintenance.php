<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="maintenance" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form project">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="">
				<span class="">
				</span>
				<input type="radio" name="type" disabled="" value="check_limit" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
				</input>
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('project_check_limit'))) ?>
					</span>
				</label>
			</div>
			<div class="">
				<span class="">
				</span>
				<input type="radio" name="type" disabled="" value="check_files" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
				</input>
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('project_check_files'))) ?>
					</span>
				</label>
			</div>
		</div></fieldset>
	</form>