<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		
			
				<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
					<tr class="headline">
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
							
						</td>
					</tr>
					<?php foreach($templates as $list_key=>$list_value){ ?><?php extract($list_value) ?>
						<tr class="data">
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
								
							</td>
						</tr>
					<?php } ?>
				</table></div></div>
				<?php $if4=(($templates)==FALSE); if($if4){?>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC')))); ?></span>
					
				<?php } ?>
				<a class="action" target="_self" data-action="template" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/template/">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_template_add'.'')))); ?></span>
					
				</a>
			
		
	