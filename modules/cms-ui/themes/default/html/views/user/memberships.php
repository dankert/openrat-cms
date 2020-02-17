<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="memberships" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
			<tr class="headline">
				<td colspan="2" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('group'))) ?>
					</span>
				</td>
			</tr>
			<?php foreach($memberships as $list_key=>$list_value) { extract($list_value); ?>
				<tr class="data">
					<td width="10%" class="">
						<input type="checkbox" name="group<?php echo encodeHtml(htmlentities(@$id)) ?>" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$member)) ?>" class="">
						</input>
					</td>
					<td class="">
						<label class="label">
							<i class="image-icon image-icon--action-group">
							</i>
							<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
							</span>
						</label>
					</td>
				</tr>
			 <?php } ?>
		</table></div></div>
	</form>