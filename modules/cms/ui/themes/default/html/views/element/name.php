<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="name" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
				<tr class="">
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
						</span>
					</td>
					<td class="">
						<input name="name" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
						</input>
					</td>
				</tr>
				<tr class="">
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DESCRIPTION'))) ?>
						</span>
					</td>
					<td class="">
						<textarea name="description" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$description)) ?>
						</textarea>
					</td>
				</tr>
				<tr class="">
					<td colspan="2" class="act">
					</td>
				</tr>
		</form>