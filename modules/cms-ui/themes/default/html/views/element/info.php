<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr class="data">
				<td colspan="1">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'type'.'')))); ?></span>
					
				</td>
				<td>
					<i class="image-icon image-icon--element-<?php echo $type ?>"></i>
					
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('el_'.$type.'')))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td colspan="1">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td class="clickable">
					<a class="" target="_self" data-type="edit" data-action="element" data-method="prop" data-id="<?php echo $id ?>" data-extra="[]" href="./#/element/<?php echo $id ?>">
						<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</a>
				</td>
			</tr>
			<tr class="data">
				<td colspan="1">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'id'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities($id))); ?></span>
					
				</td>
			</tr>
		</table></div></div>
	