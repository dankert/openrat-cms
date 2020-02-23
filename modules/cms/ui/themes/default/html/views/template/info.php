<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="data">
			<td colspan="1" class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('id'))) ?>
				</span>
			</td>
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@$id)) ?>
				</span>
			</td>
		</tr>
		<tr class="headline">
			<td colspan="2" class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('pages'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($pages as $pageid=>$name) {  ?>
			<tr class="data">
				<td colspan="2" class="clickable">
					<a target="_self" data-type="open" data-action="page" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$pageid)) ?>" data-extra="[]" href="/#/page/<?php echo encodeHtml(htmlentities(@$pageid)) ?>" class="">
						<i class="image-icon image-icon--action-page">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>