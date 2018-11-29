
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
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
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_folder_up.png" />
						
						<span><?php echo nl2br('..'); ?></span>
						
					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a title="<?php echo $desc ?>" target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="<?php echo $type ?>" data-method="preview" data-id="<?php echo $id ?>" data-extra="[]" href="<?php echo Html::url($type,'',$id,array()) ?>">
							<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_<?php echo $icon ?>.png" />
							
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
							<span><?php echo nl2br('&nbsp;'); ?></span>
							
						</a>

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
		</table>
	