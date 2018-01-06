
	
		<table width="100%">
			<tr class="data">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
					
				</td>
				<td class="name">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('description')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('type')))); ?></span>
					
				</td>
				<td class="filename">
					<img class="image-icon image-icon--element" title="" src="./themes/default/images/icon/element/<?php echo $element_type ?>.svg" />
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'el_'.$element_type.''.'')))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'template'.'')))); ?></span>
					
				</td>
				<td onclick="javascript:openNewAction('<?php echo $template_name ?>','template','<?php echo $template_id ?>');">
					<img class="" title="" src="./themes/default/images/icon/icon_template.png" />
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'element'.'')))); ?></span>
					
				</td>
				<td onclick="javascript:openNewAction('<?php echo $element_name ?>','element','<?php echo $element_id ?>');">
					<img class="" title="" src="./themes/default/images/icon_<?php echo $element_type ?>.png" />
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities($element_name))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('lastchange')))); ?></span>
					
				</td>
				<td>
					<img class="" title="" src="./themes/default/images/icon/el_date.png" />
					
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
					
					<span class="text"><?php echo nl2br(', '); ?></span>
					
					<img class="" title="" src="./themes/default/images/icon/user.png" />
					
					<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
					
				</td>
			</tr>
		</table>
	