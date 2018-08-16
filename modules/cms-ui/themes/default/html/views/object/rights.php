
	
		<?php $if2=($type=='folder'); if($if2){?>
			<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_INHERIT') ?>" data-type="dialog" data-name="<?php echo lang('MENU_INHERIT') ?>" data-method="inherit"><img src="./themes/default/images/icon/action/inherit.svg" title="<?php echo lang('MENU_inherit_DESC') ?>" /><?php echo lang('MENU_inherit') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_ACLFORM') ?>" data-type="dialog" data-name="<?php echo lang('MENU_ACLFORM') ?>" data-method="aclform"><img src="./themes/default/images/icon/action/aclform.svg" title="<?php echo lang('MENU_aclform_DESC') ?>" /><?php echo lang('MENU_aclform') ?></a></div></div>
			
		<?php } ?>
		<?php if(!$if2){?>
			<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_ACLFORM') ?>" data-type="dialog" data-name="<?php echo lang('MENU_ACLFORM') ?>" data-method="aclform"><img src="./themes/default/images/icon/action/aclform.svg" title="<?php echo lang('MENU_aclform_DESC') ?>" /><?php echo lang('MENU_aclform') ?></a></div></div>
			
		<?php } ?>
		<table width="100%">
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
			<?php $if3=(empty($acls)); if($if3){?>
				<tr class="data">
					<td colspan="99">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=!(empty($acls)); if($if3){?>
			<?php } ?>
			<?php foreach($acls as $aclid=>$acl){ ?><?php extract($acl) ?>
				<tr class="data">
					<td>
						<?php $if6=(!empty($username)); if($if6){?>
							<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_user.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($username))); ?></span>
							
						<?php } ?>
						<?php $if6=(!empty($groupname)); if($if6){?>
							<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_group.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($groupname))); ?></span>
							
						<?php } ?>
						<?php $if6=!(!empty($username)); if($if6){?>
							<?php $if7=!(!empty($groupname)); if($if7){?>
								<img class="" title="" src="./modules/cms-ui/themes/default/images/icon_group.png" />
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'global_all'.'')))); ?></span>
								
							<?php } ?>
						<?php } ?>
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
						
					</td>
					<?php foreach($show as $list_key=>$t){ ?>
						<td>
							<?php { $tmpname     = $t;$default  = '';$readonly = '1';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
							
						</td>
					<?php } ?>
					<td class="clickable">
						<a target="_self" data-type="post" data-action="" data-method="delacl" data-id="<?php echo OR_ID ?>" data-data="{&quot;action&quot;:&quot;<?php echo OR_ACTION ?>&quot;,&quot;subaction&quot;:&quot;delacl&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;var1&quot;:&quot;<?php echo $aclid ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_DELETE'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td colspan="99" class="clickable">
					<a target="_self" date-name="<?php echo lang('menu_aclform') ?>" name="<?php echo lang('menu_aclform') ?>" data-type="dialog" data-action="" data-method="aclform" data-id="<?php echo OR_ID ?>" href="<?php echo Html::url('','aclform','') ?>">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	