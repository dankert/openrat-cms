<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
				</span>
				<span class=""> / 
				</span>
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</td>
		</tr>
		<?php $if3=(isset($up_url)); if($if3) {  ?>
			<tr class="data">
				<td class="">
					<img src="./modules/cms-ui/themes/default/images/icon_folder_up.png" class="">
					</img>
					<span class="">..
					</span>
				</td>
			</tr>
		 <?php } ?>
		<?php foreach($content as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="clickable">
					<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
						<i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$type)) ?>">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('${name'))) ?>}
						</span>
						<span class=""> 
						</span>
					</a>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>