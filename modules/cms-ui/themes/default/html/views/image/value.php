<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="value" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form image">
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_VALUE'))) ?>
					</span>
				</td>
				<td class="">
					<textarea name="value" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor code-editor">
					</textarea>
				</td>
			</tr>
			<tr class="">
				<td colspan="2" class="act">
				</td>
			</tr>
	</form>