
	
		<form name="" target="_self" data-target="view" action="./" data-method="order" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form folder" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="order" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table class="or-table--sortable" width="100%"></div>
				<tr class="headline">
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'FOLDER_ORDER'.'')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_TYPE'.'')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_FILENAME'.'')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_LASTCHANGE'.'')))); ?></span>
						
					</td>
				</tr>
				<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
					<tr class="data" data-id="<?php echo $id ?>">
						<td>
							<span><?php echo nl2br('&nbsp;'); ?></span>
							
						</td>
						<td>
							<span class="sort-value"><?php echo nl2br(encodeHtml(htmlentities($icon))); ?></span>
							
							<i class="image-icon image-icon--action-<?php echo $icon ?>"></i>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities($filename))); ?></span>
							
						</td>
						<td>
							<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date) ?>
							
						</td>
					</tr>
				<?php } ?>
			</table>
			<input type="hidden" name="order" value=""/>
			
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	