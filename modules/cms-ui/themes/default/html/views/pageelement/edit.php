<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
		<tr class="headline">
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'language'.'')))); ?></span>
			</th>
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'value'.'')))); ?></span>
			</th>
		</tr>
		<?php foreach($languages as $list_key=>$list_value){ ?><?php extract($list_value) ?>
			<tr class="data clickable">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
				</td>
				<td title="<?php echo $value ?>">
					<a target="_self" data-type="edit" data-action="pageelement" data-method="value" data-id="<?php echo OR_ID ?>" data-extra="{'languageid':'<?php echo $languageid ?>'}" href="./#/pageelement/">
						<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $value,120,'..',constant('STR_PAD_BOTH') )))); ?></span>
					</a>
				</td>
			</tr>
		<?php } ?>
	</table></div></div>