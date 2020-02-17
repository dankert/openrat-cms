<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="import" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
				<tr class="">
					<td class="">
						<input name="type" value="<?php echo encodeHtml(htmlentities(@$type)) ?>" size="1" class="">
						</input>
					</td>
				</tr>
				<tr class="">
					<td class="">
						<input id="req0_file" name="file" size="40" class="upload">
						</input>
					</td>
				</tr>
				<tr class="">
					<td class="">
					</td>
				</tr>
		</form>