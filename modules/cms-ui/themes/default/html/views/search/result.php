
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr>
				<td class="header">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
					
				</td>
				<td class="header">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_LASTCHANGE'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($result as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="<?php echo $type ?>" data-method="result" data-id="<?php echo $id ?>" data-extra="[]" href="./#/<?php echo $type ?>/<?php echo $id ?>">
							<img src="./modules/cms-ui/themes/default/images/icon_<?php echo $type ?>.png" />
							
							<span title="<?php echo $desc ?>"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>
					</td>
					<td>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
	