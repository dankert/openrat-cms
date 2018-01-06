
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_ADD') ?>" data-type="dialog" data-name="<?php echo lang('MENU_ADD') ?>" data-method="add"><img src="./themes/default/images/icon/action/add.svg" title="<?php echo lang('MENU_add_DESC') ?>" /><?php echo lang('MENU_add') ?></a></div></div>
		
		<table width="100%">
			<tr class="headline">
				<td>
					<img class="" title="" src="./themes/default/images/icon_user.png" />
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td onclick="javascript:openNewAction('<?php echo $name ?>','user','<?php echo $id ?>');">
						<img class="" title="" src="./themes/default/images/icon_user.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
					<td onclick="javascript:openNewAction('<?php echo $name ?>','user','<?php echo $id ?>');">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($fullname))); ?></span>
						
						<?php $if6=($isAdmin); if($if6){?>
							<span class="text"><?php echo nl2br('&nbsp;('); ?></span>
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_ADMIN'.'')))); ?></span>
							
							<span class="text"><?php echo nl2br(')'); ?></span>
							
						<?php } ?>
					</td>
					<td class="clickable">
						<a target="_self" data-type="post" data-action="user" data-method="switch" data-id="<?php echo $userid ?>" data-data="{&quot;action&quot;:&quot;user&quot;,&quot;subaction&quot;:&quot;switch&quot;,&quot;id&quot;:&quot;<?php echo $userid ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td class="clickable" colspan="3">
					<a target="_self" date-name="<?php echo lang('add') ?>" name="<?php echo lang('add') ?>" data-type="dialog" data-action="<?php echo OR_ACTION ?>" data-method="add" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	