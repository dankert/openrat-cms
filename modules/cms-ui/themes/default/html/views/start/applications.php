<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr class="data">
				<td colspan="2">
					<a target="_self" data-action="index" data-method="projectmenu" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/index/">
						<span><?php echo nl2br('OpenRat'); ?></span>
						
					</a>
				</td>
			</tr>
			<?php foreach($applications as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td>
						<a target="_self" data-url="<?php echo $url ?>" data-action="" data-method="applications" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>
					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
	