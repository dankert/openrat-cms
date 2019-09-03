<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
			
				<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
					<tr class="headline">
						<td>
							<img src="./modules/cms-ui/themes/default/images/icon_user.png" />
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN'.'')))); ?></span>
							
						</td>
					</tr>
					<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
						<tr class="data">
							<td>
								<img src="./modules/cms-ui/themes/default/images/icon_user.png" />
								
								<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
								
							</td>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities($fullname))); ?></span>
								
								<?php $if8=($isAdmin); if($if8){?>
									<span><?php echo nl2br('&nbsp;('); ?></span>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_ADMIN'.'')))); ?></span>
									
									<span><?php echo nl2br(')'); ?></span>
									
								<?php } ?>
							</td>
							<td>
								<a target="_self" data-action="index" data-method="switchuser" data-id="<?php echo $userid ?>" data-extra="[]" href="./#/index/<?php echo $userid ?>">
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN'.'')))); ?></span>
									
								</a>
							</td>
						</tr>
					<?php } ?>
				</table></div></div>
			
		
	