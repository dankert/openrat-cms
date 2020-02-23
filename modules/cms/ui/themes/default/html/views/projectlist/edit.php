<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($projects as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="clickable">
					<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="project" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/project/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
						<i class="image-icon image-icon--action-project">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
				</td>
			</tr>
		 <?php } ?>
		<tr class="data">
			<td class="clickable">
				<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@lang('new'))) ?>" name="<?php echo encodeHtml(htmlentities(@lang('new'))) ?>" data-type="dialog" data-action="" data-method="add" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="/#//" class="">
					<i class="image-icon image-icon--method-add">
					</i>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
					</span>
				</a>
			</td>
		</tr>
	</table></div></div>