
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
					
				</td>
				<td class="name">
					<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('description')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('type')))); ?></span>
					
				</td>
				<td class="filename">
					<i class="image-icon image-icon--element-var:element_type"></i>
					
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'el_'.$element_type.''.'')))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'template'.'')))); ?></span>
					
				</td>
				<td data-name="<?php echo $template_name ?>" data-action="template" data-id="<?php echo $template_id ?>" class="clickable">
					<imgsrc="./modules/cms-ui/themes/default/images/icon/icon_template.png" />
					
					<span><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'element'.'')))); ?></span>
					
				</td>
				<td data-name="<?php echo $element_name ?>" data-action="element" data-id="<?php echo $element_id ?>" class="clickable">
					<imgsrc="./modules/cms-ui/themes/default/images/icon_<?php echo $element_type ?>.png" />
					
					<span><?php echo nl2br(encodeHtml(htmlentities($element_name))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('lastchange')))); ?></span>
					
				</td>
				<td>
					<imgsrc="./modules/cms-ui/themes/default/images/icon/el_date.png" />
					
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
					
					<span><?php echo nl2br(', '); ?></span>
					
					<imgsrc="./modules/cms-ui/themes/default/images/icon/user.png" />
					
					<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
					
				</td>
			</tr>
		</table>
	