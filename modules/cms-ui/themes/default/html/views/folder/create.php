
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_CREATEFOLDER') ?>" data-type="dialog" data-name="<?php echo lang('MENU_CREATEFOLDER') ?>" data-method="createfolder"><img src="./themes/default/images/icon/action/createfolder.svg" title="<?php echo lang('MENU_createfolder_DESC') ?>" /><?php echo lang('MENU_createfolder') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_CREATELINK') ?>" data-type="dialog" data-name="<?php echo lang('MENU_CREATELINK') ?>" data-method="createlink"><img src="./themes/default/images/icon/action/createlink.svg" title="<?php echo lang('MENU_createlink_DESC') ?>" /><?php echo lang('MENU_createlink') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_CREATEPAGE') ?>" data-type="dialog" data-name="<?php echo lang('MENU_CREATEPAGE') ?>" data-method="createpage"><img src="./themes/default/images/icon/action/createpage.svg" title="<?php echo lang('MENU_createpage_DESC') ?>" /><?php echo lang('MENU_createpage') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_CREATEFILE') ?>" data-type="dialog" data-name="<?php echo lang('MENU_CREATEFILE') ?>" data-method="createfile"><img src="./themes/default/images/icon/action/createfile.svg" title="<?php echo lang('MENU_createfile_DESC') ?>" /><?php echo lang('MENU_createfile') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_CREATEURL') ?>" data-type="dialog" data-name="<?php echo lang('MENU_CREATEURL') ?>" data-method="createurl"><img src="./themes/default/images/icon/action/createurl.svg" title="<?php echo lang('MENU_createurl_DESC') ?>" /><?php echo lang('MENU_createurl') ?></a></div></div>
		
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="multipart/form-data" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('folder') ?></legend><div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_folder" name="type" value="folder"<?php if('folder'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_folder" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_folder')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_folder_name" name="folder_name<?php if ('') echo '_disabled' ?>" type="text" maxlength="250" class="name" value="<?php echo Text::encodeHtml('') ?>" /><?php if ('') { ?><input type="hidden" name="folder_name" value="<?php '' ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('file') ?></legend><div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_file" name="type" value="file"<?php if('file'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_file" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_FILE')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<input size="30" id="req15143201701905745775_file" type="file" maxlength="<?php echo $maxlength ?>" name="file" class="upload"  />
						
						<br/>
						
						<span class="help"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file_max_size'.'')))); ?></span>
						
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($max_size))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('page') ?></legend><div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_page" name="type" value="page"<?php if('page'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_page" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_TEMPLATE')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_page_templateid" name="page_templateid" title="" class=""<?php if (count($templates)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($templates,'',0,0) ?><?php if (count($templates)==0) { ?><input type="hidden" name="page_templateid" value="" /><?php } ?><?php if (count($templates)==1) { ?><input type="hidden" name="page_templateid" value="<?php echo array_keys($templates)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_type_page" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_NAME')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_page_name" name="page_name<?php if ('') echo '_disabled' ?>" type="text" maxlength="250" class="name" value="<?php echo Text::encodeHtml(@$page_name) ?>" /><?php if ('') { ?><input type="hidden" name="page_name" value="<?php $page_name ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('link') ?></legend><div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_link" name="type" value="link"<?php if('link'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_link" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_NAME')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_link_name" name="link_name<?php if ('') echo '_disabled' ?>" type="text" maxlength="250" class="name" value="<?php echo Text::encodeHtml(@$link_name) ?>" /><?php if ('') { ?><input type="hidden" name="link_name" value="<?php $link_name ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('url') ?></legend><div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_url" name="type" value="url"<?php if('url'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_link" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('url')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_url" name="url<?php if ('') echo '_disabled' ?>" type="text" maxlength="250" class="name" value="<?php echo Text::encodeHtml(@$url) ?>" /><?php if ('') { ?><input type="hidden" name="url" value="<?php $url ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " /></div></div></form>
	