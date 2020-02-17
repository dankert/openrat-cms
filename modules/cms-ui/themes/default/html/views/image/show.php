<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
			<tr class="">
				<td colspan="2" class="">
					<iframe src="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>" class="">
					</iframe>
					<a target="_self" data-action="file" data-method="edit" data-id="" data-extra="[]" href="/#/file/" class="action">
						<img src="./modules/cms-ui/themes/default/images/icon/icon/edit.png" class="">
						</img>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_file_edit'))) ?>
						</span>
					</a>
					<a target="_self" data-action="file" data-method="editvalue" data-id="" data-extra="[]" href="/#/file/" class="action">
						<img src="./modules/cms-ui/themes/default/images/icon/icon/editvalue.png" class="">
						</img>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_file_editvalue'))) ?>
						</span>
					</a>
				</td>
			</tr>