<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
		<tr class="headline">
			<td class="help">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
			</td>
			<td class="help">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_VALUE'.'')))); ?></span>
			</td>
		</tr>
		<?php foreach($config as $list_key=>$list_value){ ?><?php extract($list_value) ?>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities($key))); ?></span>
				</td>
				<td class="<?php echo $class ?>">
					<span class="<?php echo $class ?>"><?php echo nl2br(encodeHtml(htmlentities($value))); ?></span>
				</td>
			</tr>
		<?php } ?>
	</table></div></div>