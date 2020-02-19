<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="memberships" data-action="group" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="1" class="or-form group">
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
			<tr class="headline">
				<td width="10%" class="">
				</td>
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
					</span>
				</td>
			</tr>
			<?php foreach($memberships as $list_key=>$list_value) { extract($list_value); ?>
				<tr class="data">
					<td class="">
						<input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$var)) ?>" value="1" <?php if(''.@$${var.'}'){ ?>checked="1"<?php } ?> class="">
						</input>
					</td>
					<td class="">
						<label class="label">
							<i class="image-icon image-icon--action-user">
							</i>
							<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
							</span>
						</label>
					</td>
				</tr>
			 <?php } ?>
		</table></div></div>
		<tr class="">
			<td colspan="2" class="act">
			</td>
		</tr>
	</form>