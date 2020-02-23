<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="data">
			<td colspan="1" class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
				</span>
			</td>
			<td class="">
				<i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$type)) ?>">
				</i>
				<span class=""><?php echo encodeHtml(htmlentities(@lang('${type'))) ?>}
				</span>
			</td>
		</tr>
		<tr class="data">
			<td colspan="1" class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
				</span>
			</td>
			<td class="clickable">
				<a target="_self" data-type="edit" data-action="element" data-method="prop" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/element/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
					</span>
				</a>
			</td>
		</tr>
		<tr class="data">
			<td colspan="1" class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('id'))) ?>
				</span>
			</td>
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@$id)) ?>
				</span>
			</td>
		</tr>
	</table></div></div>