<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%">
			<tr class="data">
				<td colspan="1">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'id'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities($id))); ?></span>
					
				</td>
			</tr>
			<tr class="headline">
				<td colspan="2">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'pages'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($pages as $pageid=>$name){ ?>
				<tr class="data">
					<td colspan="2" class="clickable">
						<a target="_self" data-type="open" data-action="page" data-method="info" data-id="<?php echo $pageid ?>" data-extra="[]" href="./#/page/<?php echo $pageid ?>">
							<i class="image-icon image-icon--action-page"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
	