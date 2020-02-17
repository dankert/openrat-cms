<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('language'))) ?>
				</span>
			</th>
			<th class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('value'))) ?>
				</span>
			</th>
		</tr>
		<?php foreach($languages as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data clickable">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@$languagename)) ?>
					</span>
				</td>
				<td title="<?php echo encodeHtml(htmlentities(@$value)) ?>" class="">
					<a target="_self" data-type="edit" data-action="pageelement" data-method="value" data-id="" data-extra="{'languageid':'<?php echo encodeHtml(htmlentities(@$languageid)) ?>'}" href="/#/pageelement/" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$value)) ?>
						</span>
					</a>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>