<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="data">
			<td colspan="2" class="">
				<a target="_self" data-action="index" data-method="projectmenu" data-id="" data-extra="[]" href="/#/index/" class="">
					<span class="">OpenRat
					</span>
				</a>
			</td>
		</tr>
		<?php foreach($applications as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="">
					<a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
				</td>
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@$description)) ?>
					</span>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>