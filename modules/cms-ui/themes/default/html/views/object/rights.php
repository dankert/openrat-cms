<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=($type=='folder'); if($if2) {  ?>
	 <?php } ?>
	<?php if(!$if2) {  ?>
	 <?php } ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="headline">
			<td class="help">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</td>
			<td class="help">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LANGUAGE'))) ?>
				</span>
			</td>
			<?php foreach($show as $list_key=>$t) {  ?>
				<td class="help">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('${t'))) ?>}
					</span>
				</td>
			 <?php } ?>
			<td class="help">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_delete'))) ?>
				</span>
			</td>
		</tr>
		<?php $if3=(($acls)==FALSE); if($if3) {  ?>
			<tr class="data">
				<td colspan="99" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
					</span>
				</td>
			</tr>
		 <?php } ?>
		<?php $if3=!(($acls)==FALSE); if($if3) {  ?>
		 <?php } ?>
		<?php foreach($acls as $aclid=>$acl) { extract($acl); ?>
			<tr class="data">
				<td class="">
					<?php $if6=(isset($username)); if($if6) {  ?>
						<i class="image-icon image-icon--action-user">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$username)) ?>
						</span>
					 <?php } ?>
					<?php $if6=(isset($groupname)); if($if6) {  ?>
						<i class="image-icon image-icon--action-group">
						</i>
						<span class=""><?php echo encodeHtml(htmlentities(@$groupname)) ?>
						</span>
					 <?php } ?>
					<?php $if6=!(isset($username)); if($if6) {  ?>
						<?php $if7=!(isset($groupname)); if($if7) {  ?>
							<i class="image-icon image-icon--action-group">
							</i>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('global_all'))) ?>
							</span>
						 <?php } ?>
					 <?php } ?>
				</td>
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@$languagename)) ?>
					</span>
				</td>
				<?php foreach($show as $list_key=>$t) {  ?>
					<td class="">
						<?php $if7=('var:$t'); if($if7) {  ?>
							<span class="">&check;
							</span>
						 <?php } ?>
					</td>
				 <?php } ?>
				<td class="clickable">
					<a target="_self" data-type="post" data-action="" data-method="delacl" data-id="" data-extra="{'aclid':'<?php echo encodeHtml(htmlentities(@$aclid)) ?>'}" data-data="{"action":"object","subaction":"delacl","id":"",\"token":"<?php echo token() ?>","aclid":"<?php echo encodeHtml(htmlentities(@$aclid)) ?>","none":"0"}"" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DELETE'))) ?>
						</span>
					</a>
				</td>
			</tr>
		 <?php } ?>
		<tr class="data">
			<td colspan="99" class="clickable">
				<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@lang('menu_aclform'))) ?>" name="<?php echo encodeHtml(htmlentities(@lang('menu_aclform'))) ?>" data-type="dialog" data-action="" data-method="aclform" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'aclform'}" href="/#//" class="">
					<i class="image-icon image-icon--method-add">
					</i>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
					</span>
				</a>
			</td>
		</tr>
	</table></div></div>