<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
			<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
				<tr class="headline">
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
						</span>
					</td>
					<td class="">
						<span class="">
						</span>
					</td>
					<td class="">
						<span class="">
						</span>
					</td>
					<td class="">
						<span class="">
						</span>
					</td>
				</tr>
				<?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
					<tr class="data">
						<td class="">
							<img src="./modules/cms-ui/themes/default/images/icon/icon_language.png" class="">
							</img>
							<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
							</span>
						</td>
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@$isocode)) ?>
							</span>
						</td>
						<td class="">
							<?php $if8=(isset($default_url)); if($if8) {  ?>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_make_default'))) ?>
								</span>
							 <?php } ?>
							<?php if(!$if8) {  ?>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_is_default'))) ?>
								</span>
							 <?php } ?>
						</td>
						<td class="">
							<?php $if8=(isset($select_url)); if($if8) {  ?>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_select'))) ?>
								</span>
							 <?php } ?>
							<?php if(!$if8) {  ?>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_selected'))) ?>
								</span>
							 <?php } ?>
						</td>
					</tr>
					<?php  { unset($select_url) ?>
					 <?php } ?>
					<?php  { unset($default_url) ?>
					 <?php } ?>
				 <?php } ?>
			</table></div></div>