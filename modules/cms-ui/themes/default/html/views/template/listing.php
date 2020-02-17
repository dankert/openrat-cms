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
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
							</span>
						</td>
					</tr>
				 <?php } ?>
			</table></div></div>
			<?php $if4=(($templates)==FALSE); if($if4) {  ?>
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC'))) ?>
				</span>
			 <?php } ?>
			<a target="_self" data-action="template" data-method="add" data-id="" data-extra="[]" href="/#/template/" class="action">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_template_add'))) ?>
				</span>
			</a>