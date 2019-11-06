<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
		<tr class="headline">
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NAME'.'')))); ?></span>
			</th>
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang('DESCRIPTION')))); ?></span>
			</th>
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TYPE'.'')))); ?></span>
			</th>
		</tr>
		<?php $if3=(($elements)==FALSE); if($if3){?>
			<tr>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOT_FOUND'.'')))); ?></span>
				</td>
			</tr>
		<?php } ?>
		<?php foreach($elements as $list_key=>$list_value){ ?><?php extract($list_value) ?>
			<tr class="data clickable">
				<td>
					<a title="<?php echo $desc ?>" target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="pageelement" data-method="edit" data-id="<?php echo $pageelementid ?>" data-extra="[]" href="./#/pageelement/<?php echo $pageelementid ?>">
						<i class="image-icon image-icon--action-pageelement"></i>
						<span><?php echo nl2br(encodeHtml(htmlentities($label))); ?></span>
					</a>
				</td>
				<td title="<?php echo $desc ?>">
					<span><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
				</td>
				<td>
					<i class="image-icon image-icon--action-el_<?php echo $typename ?>"></i>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('el_'.$typename.'')))); ?></span>
				</td>
			</tr>
		<?php } ?>
	</table></div></div>