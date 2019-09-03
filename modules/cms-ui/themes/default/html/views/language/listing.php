<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
			
				<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
					<tr class="headline">
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
							
						</td>
					</tr>
					<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
						<tr class="data">
							<td>
								<img src="./modules/cms-ui/themes/default/images/icon/icon_language.png" />
								
								<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,25,'..',constant('STR_PAD_BOTH') )))); ?></span>
								
							</td>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities($isocode))); ?></span>
								
							</td>
							<td>
								<?php $if8=(isset($default_url)); if($if8){?>
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_make_default')))); ?></span>
									
								<?php } ?>
								<?php if(!$if8){?>
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_is_default')))); ?></span>
									
								<?php } ?>
							</td>
							<td>
								<?php $if8=(isset($select_url)); if($if8){?>
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_select')))); ?></span>
									
								<?php } ?>
								<?php if(!$if8){?>
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_selected')))); ?></span>
									
								<?php } ?>
							</td>
						</tr>
						<?php unset($select_url) ?>
						
						<?php unset($default_url) ?>
						
					<?php } ?>
				</table></div></div>
			
		
	