<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php foreach($projects as $list_key=>$list_value) { extract($list_value); ?>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<?php $if4=(($rights)==FALSE); if($if4) {  ?>
				<div class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
					</span>
				</div>
			 <?php } ?>
			<?php $if4=!(($rights)==FALSE); if($if4) {  ?>
				<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
					<tr class="headline">
						<td class="help">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USER'))) ?>
							</span>
						</td>
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
								<span title="message:acl<?php echo encodeHtml(htmlentities()) ?>" class=""><?php echo encodeHtml(htmlentities(@lang('${t'))) ?>}
								</span>
							</td>
						 <?php } ?>
					</tr>
					<?php foreach($rights as $aclid=>$acl) { extract($acl); ?>
						<tr class="data clickable">
							<td class="">
								<?php $if9=(isset($username)); if($if9) {  ?>
									<i class="image-icon image-icon--action-user">
									</i>
									<span class=""><?php echo encodeHtml(htmlentities(@$username)) ?>
									</span>
								 <?php } ?>
								<?php $if9=(isset($groupname)); if($if9) {  ?>
									<i class="image-icon image-icon--action-group">
									</i>
									<span class=""><?php echo encodeHtml(htmlentities(@$groupname)) ?>
									</span>
								 <?php } ?>
								<?php $if9=!(isset($username)); if($if9) {  ?>
									<?php $if10=!(isset($groupname)); if($if10) {  ?>
										<i class="image-icon image-icon--action-group">
										</i>
										<span class=""><?php echo encodeHtml(htmlentities(@lang('global_all'))) ?>
										</span>
									 <?php } ?>
								 <?php } ?>
								<?php  { unset($username) ?>
								 <?php } ?>
								<?php  { unset($groupname) ?>
								 <?php } ?>
							</td>
							<td class="">
								<i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$objecttype)) ?>">
								</i>
								<a target="_self" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$objecttype)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$objecttype)) ?>/<?php echo encodeHtml(htmlentities(@$objectid)) ?>" class="">
									<span title="<?php echo encodeHtml(htmlentities(@lang('select'))) ?>" class=""><?php echo encodeHtml(htmlentities(@$objectname)) ?>
									</span>
								</a>
							</td>
							<td class="">
								<i class="image-icon image-icon--action-language">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@$languagename)) ?>
								</span>
							</td>
							<?php foreach($show as $list_key=>$list_value) {  ?>
								<td class="">
									<?php  { $$list_value= $bits[$list_value]; ?>
									 <?php } ?>
									<input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$list_value)) ?>" disabled="disabled" value="1" <?php if(''.@$${list_value.'}'){ ?>checked="1"<?php } ?> class="">
									</input>
								</td>
							 <?php } ?>
						</tr>
					 <?php } ?>
				</table></div></div>
			 <?php } ?>
		</div></fieldset>
	 <?php } ?>