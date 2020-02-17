<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="help">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</td>
			<td class="help">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_VALUE'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($config as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@$key)) ?>
					</span>
				</td>
				<td class="<?php echo encodeHtml(htmlentities(@$class)) ?>">
					<span class="<?php echo encodeHtml(htmlentities(@$class)) ?>"><?php echo encodeHtml(htmlentities(@$value)) ?>
					</span>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>