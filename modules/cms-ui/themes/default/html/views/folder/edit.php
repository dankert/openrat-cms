
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form folder" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="edit" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
				<tr class="headline">
					<td class="help">
						<?php { $tmpname     = 'checkall';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_TYPE'.'')))); ?></span>
						
						<span><?php echo nl2br('&nbsp;/&nbsp;'); ?></span>
						
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
						
					</td>
				</tr>
				<?php foreach($object as $list_key=>$list_value){ ?><?php extract($list_value) ?>
					<tr class="data">
						<td width="1%">
							<?php $if7=($writable); if($if7){?>
								<?php { $tmpname     = $id;$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
								
							<?php } ?>
							<?php $if7=(!'writable'); if($if7){?>
								<span><?php echo nl2br('&nbsp;'); ?></span>
								
							<?php } ?>
						</td>
						<td class="clickable">
							<label for="<?php echo REQUEST_ID ?>_<?php echo $id ?>" class="label">
								<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="<?php echo $type ?>" data-method="edit" data-id="<?php echo $objectid ?>" data-extra="[]" href="<?php echo Html::url($type,'',$objectid,array()) ?>">
									<imgsrc="./modules/cms-ui/themes/default/images/icon_<?php echo $icon ?>.png" />
									
									<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,40,'..',constant('STR_PAD_BOTH') )))); ?></span>
									
									<span><?php echo nl2br('&nbsp;'); ?></span>
									
								</a>

							</label>
						</td>
					</tr>
				<?php } ?>
				<?php $if4=(($object)==FALSE); if($if4){?>
					<tr>
						<td colspan="2">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
							
						</td>
					</tr>
				<?php } ?>
				<tr class="data">
					<td>
						<span><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td colspan="2" class="clickable">
						<a target="_self" data-type="dialog" data-action="folder" data-method="createfolder" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'folder','dialogMethod':'createfolder'}" href="<?php echo Html::url('folder','createfolder','',array('dialogAction'=>'folder','dialogMethod'=>'createfolder')) ?>">
							<i class="image-icon image-icon--method-add"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfolder'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr class="data">
					<td>
						<span><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td colspan="2" class="clickable">
						<a target="_self" data-type="dialog" data-action="folder" data-method="createpage" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'folder','dialogMethod':'createpage'}" href="<?php echo Html::url('folder','createpage','',array('dialogAction'=>'folder','dialogMethod'=>'createpage')) ?>">
							<i class="image-icon image-icon--method-add"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createpage'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr class="data">
					<td>
						<span><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td colspan="2" class="clickable">
						<a target="_self" data-type="dialog" data-action="folder" data-method="createfile" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'folder','dialogMethod':'createfile'}" href="<?php echo Html::url('folder','createfile','',array('dialogAction'=>'folder','dialogMethod'=>'createfile')) ?>">
							<i class="image-icon image-icon--method-add"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfile'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr class="data">
					<td>
						<span><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td colspan="2" class="clickable">
						<a target="_self" data-type="dialog" data-action="folder" data-method="createlink" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'folder','dialogMethod':'createlink'}" href="<?php echo Html::url('folder','createlink','',array('dialogAction'=>'folder','dialogMethod'=>'createlink')) ?>">
							<i class="image-icon image-icon--method-add"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createlink'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
				<tr>
					<td colspan="2">
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div>
							<?php $type= $defaulttype; ?>
							
							<?php foreach($actionlist as $list_key=>$actiontype){ ?>
								<div class="line">
									<div class="label">
									</div>
									<div class="input">
										<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_<?php echo $actiontype ?>" name="type" value="<?php echo $actiontype ?>"<?php if($actiontype==@$type)echo ' checked="checked"' ?> />
										
										<label for="<?php echo REQUEST_ID ?>_type_<?php echo $actiontype ?>" class="label">
											<span><?php echo nl2br('&nbsp;'); ?></span>
											
											<span><?php echo nl2br(encodeHtml(htmlentities(lang('FOLDER_SELECT_'.$actiontype.'')))); ?></span>
											
										</label>
									</div>
								</div>
							<?php } ?>
							<div class="line">
								<div class="label">
								</div>
								<div class="input">
									<span><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
									
									<?php { $tmpname     = 'confirm';$default  = '';$readonly = '';$required = '1';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
									
									<label for="<?php echo REQUEST_ID ?>_confirm" class="label">
										<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'CONFIRM_DELETE'.'')))); ?></span>
										
									</label>
								</div>
							</div>
							<div class="line">
								<div class="label">
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'FOLDER_SELECT_TARGET_FOLDER'.'')))); ?></span>
									
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
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
		
		
	