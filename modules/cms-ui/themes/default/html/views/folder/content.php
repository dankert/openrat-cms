<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
		<tr class="headline">
			<td class="help">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_TYPE'.'')))); ?></span>
				<span><?php echo nl2br('&nbsp;/&nbsp;'); ?></span>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
			</td>
			<td class="help">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_LASTCHANGE'.'')))); ?></span>
			</td>
		</tr>
		<?php $if3=(isset($up_url)); if($if3){?>
			<tr class="data">
				<td>
					<img src="./modules/cms-ui/themes/default/images/icon_folder.png" />
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
		<tr class="data">
			<td colspan="2">
				<a target="_self" data-type="view" data-action="folder" data-method="createfolder" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/folder/">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" />
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfolder'.'')))); ?></span>
				</a>
			</td>
		</tr>
		<tr class="data">
			<td colspan="2">
				<a target="_self" data-type="view" data-action="folder" data-method="createpage" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/folder/">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" />
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createpage'.'')))); ?></span>
				</a>
			</td>
		</tr>
		<tr class="data">
			<td colspan="2">
				<a target="_self" data-type="view" data-action="folder" data-method="createfile" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/folder/">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" />
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfile'.'')))); ?></span>
				</a>
			</td>
		</tr>
		<tr class="data">
			<td colspan="2">
				<a target="_self" data-type="modal" data-action="folder" data-method="createlink" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/folder/">
					<img src="./modules/cms-ui/themes/default/images/icon/icon/create.png" />
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createlink'.'')))); ?></span>
				</a>
			</td>
		</tr>
	</table></div></div>