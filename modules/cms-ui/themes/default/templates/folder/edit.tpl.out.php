
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_ORDER') ?>" data-type="dialog" data-name="<?php echo lang('MENU_ORDER') ?>" data-method="order"><img src="./themes/default/images/icon/action/order.svg" title="<?php echo lang('MENU_order_DESC') ?>" /><?php echo lang('MENU_order') ?></a></div></div>
		
		<form name="" target="_self" action="folder" data-method="edit" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="folder" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="edit" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<table width="100%">
				<tr class="headline">
					<td class="help">
						<?php { $tmpname     = 'checkall';$default  = '';$readonly = '';		
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
					<td class="help">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_TYPE'.'')))); ?></span>
						
						<span class="text"><?php echo nl2br('&nbsp;/&nbsp;'); ?></span>
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
						
					</td>
				</tr>
				<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
					<tr class="data">
						<td width="1%">
							<?php $if7=($writable); if($if7){?>
								<?php { $tmpname     = $id;$default  = '';$readonly = '';		
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
								
							<?php } ?>
							<?php $if7=(!'writable'); if($if7){?>
								<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
								
							<?php } ?>
						</td>
						<td class="clickable">
							<label for="<?php echo REQUEST_ID ?>_<?php echo $id ?>" class="label">
								<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="<?php echo $type ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo $objectid ?>" href="javascript:void(0);">
									<img class="" title="" src="./themes/default/images/icon_<?php echo $icon ?>.png" />
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,40,'..',constant('STR_PAD_BOTH') )))); ?></span>
									
									<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
									
								</a>

							</label>
						</td>
					</tr>
				<?php } ?>
				<?php $if4=(empty($object)); if($if4){?>
					<tr>
						<td colspan="2">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
							
						</td>
					</tr>
				<?php } ?>
				<tr class="data">
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2">
						<a target="_self" data-type="view" data-action="folder" data-method="createfolder" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfolder'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr class="data">
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2">
						<a target="_self" data-type="view" data-action="folder" data-method="createpage" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createpage'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr class="data">
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2">
						<a target="_self" data-type="view" data-action="folder" data-method="createfile" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfile'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr class="data">
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2">
						<a target="_self" data-type="view" data-action="folder" data-method="createlink" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createlink'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr>
					<td colspan="2">
						<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
							<?php $type= $defaulttype; ?>
							
							<?php foreach($actionlist as $list_key=>$actiontype){ ?>
								<div class="line">
									<div class="label">
									</div>
									<div class="input">
										<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_<?php echo $actiontype ?>" name="type" value="<?php echo $actiontype ?>"<?php if($actiontype==@$type)echo ' checked="checked"' ?> />
										
										<label for="<?php echo REQUEST_ID ?>_type_<?php echo $actiontype ?>" class="label">
											<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
											
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('FOLDER_SELECT_'.$actiontype.'')))); ?></span>
											
										</label>
									</div>
								</div>
							<?php } ?>
							<div class="line">
								<div class="label">
								</div>
								<div class="input">
									<span class="text"><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
									
									<?php { $tmpname     = 'confirm';$default  = '';$readonly = '';		
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
									
									<label for="<?php echo REQUEST_ID ?>_confirm" class="label">
										<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'CONFIRM_DELETE'.'')))); ?></span>
										
									</label>
								</div>
							</div>
							<div class="line">
								<div class="label">
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'FOLDER_SELECT_TARGET_FOLDER'.'')))); ?></span>
									
								</div>
								<div class="input">
									<div class="selector">
<div class="inputholder">
<input type="hidden" name="targetobjectid" value="{id}" />
<input type="text" disabled="disabled" value="{name}" />
</div>
<div class="tree selector" data-types="{types}" data-init-id="<?php echo $rootfolderid ?>" data-init-folderid="<?php echo $rootfolderid ?>">
									
								</div>
							</div>
						</div></fieldset>
					</td>
				</tr>
			</table>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " /></div></div></form>
		
		
	