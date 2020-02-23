<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($templates as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="clickable">
					<i class="image-icon image-icon--action-template">
					</i>
					<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="template" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/template/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
				</td>
			</tr>
		 <?php } ?>
		<?php $if3=(($templates)==FALSE); if($if3) {  ?>
			<tr class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC'))) ?>
				</span>
			</tr>
		 <?php } ?>
		<tr class="data">
			<td colspan="1" class="clickable">
				<a target="_self" data-type="dialog" data-action="" data-method="add" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="/#//" class="">
					<i class="image-icon image-icon--method-add">
					</i>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
					</span>
				</a>
			</td>
		</tr>
	</table></div></div>