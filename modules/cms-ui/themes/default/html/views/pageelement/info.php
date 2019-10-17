<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
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
					<i class="image-icon image-icon--action-el_<?php echo $element_type ?>"></i>
					
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'el_'.$element_type.''.'')))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'template'.'')))); ?></span>
					
				</td>
				<td class="clickable">
					<a target="_self" data-type="open" data-action="template" data-method="info" data-id="<?php echo $template_id ?>" data-extra="[]" href="./#/template/<?php echo $template_id ?>">
						<i class="image-icon image-icon--action-template"></i>
						
						<span><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
						
					</a>
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'element'.'')))); ?></span>
					
				</td>
				<td class="clickable">
					<a target="_self" date-name="<?php echo $element_name ?>" name="<?php echo $element_name ?>" data-action="element" data-method="info" data-id="<?php echo $element_id ?>" data-extra="[]" href="./#/element/<?php echo $element_id ?>">
						<i class="image-icon image-icon--action-el_<?php echo $element_type ?>"></i>
						
						<span><?php echo nl2br(encodeHtml(htmlentities($element_name))); ?></span>
						
					</a>
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'format'.'')))); ?></span>
					
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'element'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities($element_format))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'format'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities($format))); ?></span>
					
				</td>
			</tr>
			<tr class="data">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('lastchange')))); ?></span>
					
				</td>
				<td>
					<i class="image-icon image-icon--action-el_date"></i>
					
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
					
					<span><?php echo nl2br(', '); ?></span>
					
					<i class="image-icon image-icon--action-user"></i>
					
					<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
					
				</td>
			</tr>
		</table></div></div>
	