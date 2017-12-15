
	
		<table width="100%">
			<tr class="headline">
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_TYPE'.'')))); ?></span>
					
					<span class="text"><?php echo nl2br('&nbsp;/&nbsp;'); ?></span>
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
					
				</td>
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_LASTCHANGE'.'')))); ?></span>
					
				</td>
			</tr>
			<?php $if3=(!empty($up_url)); if($if3){?>
				<tr class="data">
					<td>
						<img class="" title="" src="./themes/default/images/icon_folder_up.png" />
						
						<span class="text"><?php echo nl2br('..'); ?></span>
						
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="<?php echo $class ?>" title="<?php echo $desc ?>" onclick="javascript:openNewAction('<?php echo $name ?>','<?php echo $type ?>','<?php echo $id ?>');">
						<img class="" title="" src="./themes/default/images/icon_<?php echo $icon ?>.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date) ?>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(empty($object)); if($if3){?>
				<tr>
					<td colspan="2">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table>
	