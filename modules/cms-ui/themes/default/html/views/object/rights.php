
	
		<?php $if2=($type=='folder'); if($if2){?>
			
			
		<?php } ?>
		<?php if(!$if2){?>
			
			
		<?php } ?>
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<tr class="headline">
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
					
				</td>
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_LANGUAGE'.'')))); ?></span>
					
				</td>
				<?php foreach($show as $list_key=>$t){ ?>
					<td class="help">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('acl_'.$t.'_abbrev')))); ?></span>
						
					</td>
				<?php } ?>
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'global_delete'.'')))); ?></span>
					
				</td>
			</tr>
			<?php $if3=(($acls)==FALSE); if($if3){?>
				<tr class="data">
					<td colspan="99">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=!(($acls)==FALSE); if($if3){?>
			<?php } ?>
			<?php foreach($acls as $aclid=>$acl){ ?><?php extract($acl) ?>
				<tr class="data">
					<td>
						<?php $if6=(isset($username)); if($if6){?>
							<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/user.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($username))); ?></span>
							
						<?php } ?>
						<?php $if6=(isset($groupname)); if($if6){?>
							<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/group.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($groupname))); ?></span>
							
						<?php } ?>
						<?php $if6=!(isset($username)); if($if6){?>
							<?php $if7=!(isset($groupname)); if($if7){?>
								<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/group.svg" />
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'global_all'.'')))); ?></span>
								
							<?php } ?>
						<?php } ?>
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
						
					</td>
					<?php foreach($show as $list_key=>$t){ ?>
						<td>
							<?php $if7=($$t); if($if7){?>
								<span class="text"><?php echo nl2br('&check;'); ?></span>
								
							<?php } ?>
						</td>
					<?php } ?>
					<td class="clickable">
						<a target="_self" data-type="post" data-action="" data-method="delacl" data-id="<?php echo OR_ID ?>" data-extra="{'aclid':'<?php echo $aclid ?>'}" data-data="{&quot;action&quot;:&quot;object&quot;,&quot;subaction&quot;:&quot;delacl&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;aclid&quot;:&quot;<?php echo $aclid ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_DELETE'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td colspan="99" class="clickable">
					<a target="_self" date-name="<?php echo lang('menu_aclform') ?>" name="<?php echo lang('menu_aclform') ?>" data-type="dialog" data-action="" data-method="aclform" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'aclform'}" href="<?php echo Html::url('','aclform','',array('dialogAction'=>'','dialogMethod'=>'aclform')) ?>">
						<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	