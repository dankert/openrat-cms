<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="">
				<img src="./modules/cms-ui/themes/default/images/icon_user.png" class="">
				</img>
				<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
				</span>
			</td>
			<td class="">
				<span class="">
				</span>
			</td>
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('LOGIN'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td data-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-action="user" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="clickable clickable">
					<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="user" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/user/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
						<i class="image-icon image-icon--action-user">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
				</td>
				<td data-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-action="user" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="clickable">
					<span class=""><?php echo encodeHtml(htmlentities(@$fullname)) ?>
					</span>
					<?php $if6=($isAdmin); if($if6) {  ?>
						<span class=""> (
						</span>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_ADMIN'))) ?>
						</span>
						<span class="">)
						</span>
					 <?php } ?>
				</td>
				<td class="clickable">
					<a target="_self" data-type="post" data-action="user" data-method="switch" data-id="<?php echo encodeHtml(htmlentities(@$userid)) ?>" data-extra="[]" data-data="{"action":"user","subaction":"switch","id":"<?php echo encodeHtml(htmlentities(@$userid)) ?>",\"token":"<?php echo token() ?>","none":"0"}"" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('LOGIN'))) ?>
						</span>
					</a>
				</td>
			</tr>
		 <?php } ?>
		<tr class="data">
			<td colspan="3" class="clickable">
				<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@lang('add'))) ?>" name="<?php echo encodeHtml(htmlentities(@lang('add'))) ?>" data-type="dialog" data-action="" data-method="add" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="/#//" class="">
					<i class="image-icon image-icon--method-add">
					</i>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
					</span>
				</a>
			</td>
		</tr>
	</table></div></div>