
	
		<?php $if2=(!empty($$dbname)); if($if2){?>
			<div class="toolbar-icon">
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/database.svg" />
				
				<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry">
						<span class="text" title="<?php echo $dbid ?>"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $dbname,50,'..',constant('STR_PAD_BOTH') )))); ?></span>
						
					</div>
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon menu">
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/file.svg" />
				
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file'.'')))); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry clickable filtered on-action-folder on-action-page on-action-file">
						<a title="<?php echo lang('menu_new_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="new" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_new'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_save_desc') ?>" target="_self" data-type="post" data-action="" data-method="save" data-id="<?php echo OR_ID ?>" data-data="{&quot;action&quot;:&quot;<?php echo OR_ACTION ?>&quot;,&quot;subaction&quot;:&quot;save&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/save.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_save'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_saveall_desc') ?>" target="_self" data-type="post" data-action="" data-method="saveall" data-id="<?php echo OR_ID ?>" data-data="{&quot;action&quot;:&quot;<?php echo OR_ACTION ?>&quot;,&quot;subaction&quot;:&quot;saveall&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/save.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_saveall'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-page on-action-file on-action-template on-action-pageelement">
						<a title="<?php echo lang('menu_preview_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="preview" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/preview.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_preview'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable">
						<a class="entry" title="<?php echo lang('USER_LOGOUT_DESC') ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="<?php echo OR_ID ?>" data-data="{&quot;action&quot;:&quot;login&quot;,&quot;subaction&quot;:&quot;logout&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/logout.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
							
						</a>

					</div>
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon menu">
				<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/edit.svg" />
				
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry clickable filtered on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file">
						<a title="<?php echo lang('menu_prop_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/prop.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_prop'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-page on-action-file on-action-folder on-action-pageelement on-action-template">
						<a title="<?php echo lang('menu_pub_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/publish.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_pub'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-pageelement">
						<a class="entry" title="<?php echo lang('menu_archive_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="archive" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/archive.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_archive'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-project on-action-folder on-action-link on-action-user on-action-group on-action-page on-action-file">
						<a title="<?php echo lang('menu_rights_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="rights" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/rights.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_rights'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-pageelement on-action-user on-action-group on-action-page on-action-project on-action-projectlist">
						<a title="<?php echo lang('menu_history_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="history" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/history.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_history'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-page">
						<a title="<?php echo lang('menu_changetemplate_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="changetemplate" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/changetemplate.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_changetemplate'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-user">
						<a title="<?php echo lang('menu_password_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pw" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/password.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_password'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-language">
						<a title="<?php echo lang('menu_advanced_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="advanced" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/advanced.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_advanced'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-element">
						<a title="<?php echo lang('menu_src_type') ?>" target="_self" data-type="dialog" data-action="" data-method="type" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/type.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_type'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-project on-action-template on-action-page on-action-element on-action-image on-action-file on-action-folder on-action-link on-action-language on-action-model">
						<a title="<?php echo lang('menu_delete_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="remove" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/delete.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_delete'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-template">
						<a title="<?php echo lang('menu_src_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="src" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/src.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_src'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-template">
						<a title="<?php echo lang('menu_order_extension') ?>" target="_self" data-type="dialog" data-action="" data-method="extension" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/extension.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_extension'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-text">
						<a title="<?php echo lang('menu_value_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="value" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/value.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_value'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_order_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="order" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/order.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_order'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-file">
						<a title="<?php echo lang('menu_compress_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="compress" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/compress.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_compress'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-file">
						<a title="<?php echo lang('menu_decompress_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="decompress" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/decompress.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_decompress'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-file">
						<a title="<?php echo lang('menu_extract_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="extract" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/extract.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_extract'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-image">
						<a title="<?php echo lang('menu_size_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="size" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/size.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_size'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-project">
						<a title="<?php echo lang('menu_maintenance_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="maintenance" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/maintenance.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_maintenance'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-project">
						<a title="<?php echo lang('menu_export_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="export" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/export.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_export'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-user on-action-group">
						<a title="<?php echo lang('menu_memberships_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="memberships" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/memberships.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_memberships'.'')))); ?></span>
							
						</a>

					</div>
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon projects">
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/project.svg" />
				
				<span class="titletext"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_PROJECT'.'')))); ?></span>
				
				<div class="dropdown">
					<?php $if5=($isAdmin); if($if5){?>
						<div class="entry clickable">
							<a class="entry" target="_self" data-type="post" data-action="start" data-method="administration" data-id="-1" data-data="{&quot;action&quot;:&quot;start&quot;,&quot;subaction&quot;:&quot;administration&quot;,&quot;id&quot;:&quot;-1&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
								<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/settings.svg" />
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'administration'.'')))); ?></span>
								
							</a>

						</div>
						<div class="divide">
						</div>
					<?php } ?>
					<?php $if5=(intval('00')<intval(@count($languages))); if($if5){?>
						<?php foreach($languages as $id=>$name){ ?>
							<div class="entry clickable">
								<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/language.svg" />
								
								<a title="<?php echo lang('select_language') ?>" target="_self" data-type="post" data-action="tree" data-method="language" data-id="<?php echo $id ?>" data-data="{&quot;action&quot;:&quot;tree&quot;,&quot;subaction&quot;:&quot;language&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
									
								</a>

							</div>
						<?php } ?>
						<div class="divide">
						</div>
					<?php } ?>
					<?php $if5=(intval('0')<intval(@count($models))); if($if5){?>
						<?php foreach($models as $id=>$name){ ?>
							<div class="entry clickable">
								<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/model.svg" />
								
								<a title="<?php echo lang('select_model') ?>" target="_self" data-type="post" data-action="tree" data-method="model" data-id="<?php echo $id ?>" data-data="{&quot;action&quot;:&quot;tree&quot;,&quot;subaction&quot;:&quot;model&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
									
								</a>

							</div>
						<?php } ?>
						<div class="divide">
						</div>
					<?php } ?>
					<?php foreach($projects as $id=>$name){ ?>
						<div class="entry clickable">
							<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/project.svg" />
							
							<a title="<?php echo lang('select_project') ?>" target="_self" data-type="post" data-action="start" data-method="projectmenu" data-id="<?php echo $id ?>" data-data="{&quot;action&quot;:&quot;start&quot;,&quot;subaction&quot;:&quot;projectmenu&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,45,'..',constant('STR_PAD_BOTH') )))); ?></span>
								
							</a>

						</div>
					<?php } ?>
				</div>
				<div class="arrow-down">
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon clickable filtered on-action-folder on-action-file on-action-page on-action-link on-action-template on-action-element">
				<a title="<?php echo lang('menu_prop_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
					<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/prop.svg" />
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_prop'.'')))); ?></span>
					
				</a>

			</div>
			<div class="toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-pageelement on-action-template">
				<a title="<?php echo lang('menu_pub_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
					<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/publish.svg" />
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_pub'.'')))); ?></span>
					
				</a>

			</div>
		<?php } ?>
		<?php $if2=(empty(@$conf['login']['motd'])); if($if2){?>
			<div class="toolbar-icon">
				<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/motd.svg" />
				
				<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry">
						<span class="text"><?php echo nl2br('config:login/motd'); ?></span>
						
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="search">
			<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> data-hint="<?php echo lang('search') ?>" id="<?php echo REQUEST_ID ?>_text" name="text<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$text) ?>" /><?php if ('') { ?><input type="hidden" name="text" value="<?php $text ?>"/><?php } ?><img src="/themes/default/images/icon_search<?php echo IMG_ICON_EXT ?>" width="16" height="16" /></div>
			
			<div class="dropdown">
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
				
			</div>
		</div>
		<div class="toolbar-icon user">
			<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
			
			<span class="titletext"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $userfullname,25,'..',constant('STR_PAD_BOTH') )))); ?></span>
			
			<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/arrow_down.svg" />
			
			<div class="dropdown">
				<div class="entry clickable">
					<a title="<?php echo lang('USER_PROFILE_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="edit" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'profile'.'')))); ?></span>
						
					</a>

				</div>
				<div class="entry clickable">
					<a title="<?php echo lang('USER_PROFILE_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="pw" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'password'.'')))); ?></span>
						
					</a>

				</div>
				<div class="entry clickable">
					<a title="<?php echo lang('USER_PROFILE_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="mail" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'mail'.'')))); ?></span>
						
					</a>

				</div>
				<div class="entry clickable">
					<a title="<?php echo lang('start') ?>" target="_self" data-type="post" data-action="start" data-method="start" data-id="<?php echo OR_ID ?>" data-data="{&quot;action&quot;:&quot;start&quot;,&quot;subaction&quot;:&quot;start&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/dashboard.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'start'.'')))); ?></span>
						
					</a>

				</div>
				<div class="divide">
				</div>
				<div class="entry clickable">
					<a class="entry" title="<?php echo lang('USER_LOGOUT_DESC') ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="<?php echo OR_ID ?>" data-data="{&quot;action&quot;:&quot;login&quot;,&quot;subaction&quot;:&quot;logout&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
						<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/close.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
						
					</a>

				</div>
			</div>
		</div>
	