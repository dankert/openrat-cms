
	
		
		
		<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_token" name="token<?php if ('') echo '_disabled' ?>" type="hidden" maxlength="256" class="text" value="<?php echo Text::encodeHtml($token) ?>" /><?php if ('') { ?><input type="hidden" name="token" value="<?php $token ?>"/><?php } ?></div>
		
		<table class="sortable" width="100%">
			<tr class="headline">
				<td class="help clickable">
					<a title="<?php echo lang('FOLDER_FLIP') ?>" target="_self" data-type="post" data-action="folder" data-method="reorder" data-id="<?php echo OR_ID ?>" data-extra="{'type':'flip'}" data-data="{&quot;action&quot;:&quot;folder&quot;,&quot;subaction&quot;:&quot;reorder&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;type&quot;:&quot;flip&quot;,&quot;none&quot;:&quot;0&quot;}">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'FOLDER_ORDER'.'')))); ?></span>
						
					</a>

				</td>
				<td class="help clickable">
					<a title="<?php echo lang('FOLDER_ORDERBYTYPE') ?>" target="_self" data-type="post" data-action="folder" data-method="reorder" data-id="<?php echo OR_ID ?>" data-extra="{'type':'type'}" data-data="{&quot;action&quot;:&quot;folder&quot;,&quot;subaction&quot;:&quot;reorder&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;type&quot;:&quot;type&quot;,&quot;none&quot;:&quot;0&quot;}">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_TYPE'.'')))); ?></span>
						
					</a>

				</td>
				<td class="help clickable">
					<a title="<?php echo lang('FOLDER_ORDERBYNAME') ?>" target="_self" data-type="post" data-action="folder" data-method="reorder" data-id="<?php echo OR_ID ?>" data-extra="{'type':'name'}" data-data="{&quot;action&quot;:&quot;folder&quot;,&quot;subaction&quot;:&quot;reorder&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;type&quot;:&quot;name&quot;,&quot;none&quot;:&quot;0&quot;}">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
						
					</a>

				</td>
				<td class="help clickable">
					<a title="<?php echo lang('FOLDER_ORDERBYLASTCHANGE') ?>" target="_self" data-type="post" data-action="folder" data-method="reorder" data-id="<?php echo OR_ID ?>" data-extra="{'type':'lastchange'}" data-data="{&quot;action&quot;:&quot;folder&quot;,&quot;subaction&quot;:&quot;reorder&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;type&quot;:&quot;lastchange&quot;,&quot;none&quot;:&quot;0&quot;}">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_LASTCHANGE'.'')))); ?></span>
						
					</a>

				</td>
			</tr>
			<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data" data-id="<?php echo $id ?>">
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td colspan="2">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_<?php echo $icon ?>.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
					<td>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date) ?>
						
					</td>
				</tr>
			<?php } ?>
		</table>
	