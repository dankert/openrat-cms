<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="text" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form text">
		<tr class="">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</td>
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
				</span>
			</td>
		</tr>
		<tr class="">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DELETE'))) ?>
				</span>
			</td>
			<td class="">
				<input type="checkbox" name="delete" value="1" <?php if(''.@$delete.''){ ?>checked="1"<?php } ?> class="">
				</input>
			</td>
		</tr>
		<tr class="">
			<td colspan="2" class="">
			</td>
		</tr>
	</form>