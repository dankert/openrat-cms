<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
		<tr class="headline">
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TYPE'.'')))); ?></span>
			</th>
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NAME'.'')))); ?></span>
			</th>
			<th>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LASTCHANGE'.'')))); ?></span>
			</th>
		</tr>
		<?php $if3=(isset($up_url)); if($if3){?>
			<tr class="data clickable">
				<td>
					<i class="image-icon image-icon--action-folder"></i>
				</td>
				<td>
					<span><?php echo nl2br('..'); ?></span>
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
				</td>
			</tr>
		<?php } ?>
		<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
			<tr class="data">
				<td title="<?php echo $desc ?>" data-name="<?php echo $name ?>" data-action="<?php echo $type ?>" data-id="<?php echo $id ?>" class="clickable <?php echo $class ?>">
					<img src="./modules/cms-ui/themes/default/images/icon_<?php echo $icon ?>.png" />
					<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
					<span><?php echo nl2br('&nbsp;'); ?></span>
				</td>
				<td>
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date) ?>
				</td>
			</tr>
		<?php } ?>
		<?php $if3=(($object)==FALSE); if($if3){?>
			<tr>
				<td colspan="2">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
				</td>
			</tr>
		<?php } ?>
	</table></div></div>
	<div class="clickable">
		<a class="or-link-btn" target="_self" data-type="view" data-action="folder" data-method="create" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/folder/">
			<i class="image-icon image-icon--action-new"></i>
			<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'new'.'')))); ?></span>
		</a>
	</div>