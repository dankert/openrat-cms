<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr class="headline">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php $if3=(($groups)==FALSE); if($if3){?>
				<tr class="data">
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOT_FOUND'.'')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($groups as $list_key=>$group){ ?>
				<tr class="data">
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities($group))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
	